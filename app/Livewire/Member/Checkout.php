<?php

namespace App\Livewire\Member;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\User;
use App\Models\Wallet;
use App\Services\CryptoPaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    public Product $product;
    public $qty = 1;
    public $payment_method;
    public $epin_code;
    public $crypto_payment;

    public function mount($productId)
    {
        $this->product = Product::where('is_active', true)->findOrFail($productId);

        // Set default payment method from config
        $this->payment_method = collect(config('payment.methods'))
            ->where('enabled', true)
            ->keys()
            ->first();
    }


    // Update your rules() method
    protected function rules()
    {
        return [
            'qty' => ['required', 'integer', 'min:1'],
            'payment_method' => ['required', 'in:' . implode(',', array_keys(config('payment.methods')))],
            'epin_code' => ['required_if:payment_method,e_pin'], // Only required if E-PIN selected
        ];
    }

    public function buy()
    {
        $this->validate();

        try {
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
            DB::commit();
            // session()->flash('success', 'Purchase successful!');
            // return redirect()->route('member.purchases'); // Ensure this route exists

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
        }
    }

    protected function processPayment(Purchase $purchase): void
    {
        match ($this->payment_method) {
            'wallet'  => $this->payViaWallet($purchase),
            'e_pin'   => $this->payViaEPin($purchase),
            'cash'    => $this->payViaCash($purchase),
            'gateway' => $this->payViaGateway($purchase),
            'crypto'  => $this->payViaCrypto($purchase),
            default   => throw new \RuntimeException('Invalid payment method selection.'),
        };
    }

    protected function markAsPaid(Purchase $purchase, ?string $reference = null)
    {
        $purchase->update([
            'status' => 'paid',
            'reference' => $reference,
        ]);

        // 🔥 Trigger commissions AFTER payment
        // Ensure this Event exists: php artisan make:event PurchasePaid
        event(new \App\Events\PurchasePaid($purchase));

        session()->flash('success', 'Purchase successful!');
        return redirect()->route('member.purchases'); // Ensure this route exists
    }

    protected function payViaWallet(Purchase $purchase): void
    {
        $mainWallet = User::find(Auth::id())->mainWallet;

        if (!$mainWallet || $mainWallet->balance < $purchase->amount) {
            // Throwing an exception is mandatory to trigger DB::transaction rollback
            throw new \RuntimeException('Insufficient wallet balance!');
        }

        $mainWallet->debit($purchase->amount, 'purchase', 'Purchased product ' . $this->product->name);

        $this->markAsPaid($purchase, 'WALLET-' . now()->timestamp);
    }

    // Placeholder methods for other payment types
    protected function payViaEPin(Purchase $purchase): void
    {
        // 1. Find the E-PIN
        $pin = \App\Models\EPin::where('code', $this->epin_code)
            ->where('assigned_to', Auth::id())
            ->where('status', 'active')
            ->first();

        // 2. Validate PIN existence and status
        if (!$pin) {
            throw new \RuntimeException('Invalid or already used E-PIN.');
        }

        // 3. Validate PIN value against purchase amount
        if ($pin->amount < $purchase->amount) {
            throw new \RuntimeException('E-PIN value is insufficient for this purchase.');
        }

        // 4. Mark PIN as used
        $pin->update([
            'status' => 'used',
            'used_by' => Auth::id(),
            'used_at' => now(),
        ]);

        // 5. Complete Purchase
        $this->markAsPaid($purchase, 'EPIN-' . $pin->code);
    }
    protected function payViaCash(Purchase $purchase): void
    {
        $this->markAsPaid($purchase, 'CASH-' . now()->timestamp);
    }
    protected function payViaGateway(Purchase $purchase): void
    {
        $this->markAsPaid($purchase, 'GATEWAY-' . now()->timestamp);
    }
    protected function payViaCrypto(Purchase $purchase): void
    {
        $crypto = new CryptoPaymentService();
        $response = $crypto->createPayment($purchase->amount, $purchase->id);
        if (!$response || (isset($response['status']) && $response['status'] === false)) {

            if (($response['code'] ?? '') === 'AMOUNT_MINIMAL_ERROR') {
                throw new \RuntimeException(
                    'Amount too low for crypto. Minimum required is higher. Try USDT or increase amount.'
                );
            }

            throw new \RuntimeException(
                $response['message'] ?? 'Crypto payment failed. Please try again.'
            );
        }
        $this->crypto_payment = $response;
    }

    public function render()
    {
        $total = $this->product->price * $this->qty;
        $earned = $this->product->commission_enabled
            ? ($total * $this->product->commission_percent) / 100
            : 0;

        return view('livewire.member.checkout', [
            'total' => $total,
            'potential_earnings' => $earned,
            'methods' => config('payment.methods'),
        ])->layout('layouts.app');
    }
}
