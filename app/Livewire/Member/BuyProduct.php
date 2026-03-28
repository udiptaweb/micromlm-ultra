<?php
namespace App\Livewire\Member;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BuyProduct extends Component
{
    public Product $product;

    public int $qty = 1;
    public string $payment_method = 'wallet';

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    protected function rules()
    {
        return [
            'qty' => ['required', 'integer', 'min:1'],
            'payment_method' => [
                'required',
                'in:' . implode(',', array_keys(config('payments.methods')))
            ],
        ];
    }

    public function buy()
    {
        $this->validate();

        DB::transaction(function () {

            $amount = bcmul($this->product->price, $this->qty, 2);

            // 1️⃣ Create Purchase
            $purchase = Purchase::create([
                'user_id' => Auth::id(),
                'amount' => $amount,
                'status' => 'pending',
                'payment_method' => $this->payment_method,
            ]);

            // 2️⃣ Create Purchase Item
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $this->product->id,
                'qty' => $this->qty,
                'price' => $this->product->price,
            ]);

            // 3️⃣ Process Payment
            $this->processPayment($purchase);

        });

        session()->flash('message', 'Purchase successful!');
        return redirect()->route('member.purchases');
    }

    protected function processPayment(Purchase $purchase): void
    {
        match ($this->payment_method) {
            'wallet' => $this->payViaWallet($purchase),
            'e_pin'  => $this->payViaEPin($purchase),
            'cash'   => $this->payViaCash($purchase),
            'gateway'=> $this->payViaGateway($purchase),
            'crypto' => $this->payViaCrypto($purchase),
            default  => throw new \RuntimeException('Invalid payment method'),
        };
    }

    protected function markAsPaid(Purchase $purchase, ?string $reference = null): void
    {
        $purchase->update([
            'status' => 'paid',
            'reference' => $reference,
        ]);

        // 🔥 Trigger commissions AFTER payment
        event(new \App\Events\PurchasePaid($purchase));
    }

    protected function payViaWallet(Purchase $purchase): void
    {
        $wallet = Wallet::where('user_id', Auth::id())
            ->where('type', 'main')
            ->lockForUpdate()
            ->first();

        if ($wallet->balance < $purchase->amount) {
            throw new \RuntimeException('Insufficient wallet balance');
        }

        $wallet->decrement('balance', $purchase->amount);

        $this->markAsPaid($purchase, 'WALLET-' . now()->timestamp);
    }

    protected function payViaEPin(Purchase $purchase): void
    {
        // validate epin, mark used, etc.
        $this->markAsPaid($purchase, 'EPIN-' . now()->timestamp);
    }

    protected function payViaCash(Purchase $purchase): void
    {
        // Admin-approved payment
        $this->markAsPaid($purchase, 'CASH-' . now()->timestamp);
    }

    protected function payViaGateway(Purchase $purchase): void
    {
        // Redirect or verify gateway
        $this->markAsPaid($purchase, 'GATEWAY-' . now()->timestamp);
    }

    protected function payViaCrypto(Purchase $purchase): void
    {
        // Generate wallet / verify tx hash
        $this->markAsPaid($purchase, 'CRYPTO-' . now()->timestamp);
    }

    public function render()
    {
        return view('livewire.member.buy-product', [
            'methods' => config('payments.methods'),
            'products' => Product::where('is_active',1)->get()
        ])->layout('layouts.app');
    }
}
