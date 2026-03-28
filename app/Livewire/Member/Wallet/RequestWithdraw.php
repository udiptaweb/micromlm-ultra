<?php

namespace App\Livewire\Member\Wallet;

use App\Models\PayoutInfo;
use App\Models\PayoutRequest;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequestWithdraw extends Component
{
    public float $amount       = 0;
    public ?int  $payoutInfoId = null;  // selected saved account

    // ── Computed: main wallet balance ─────────────────────────────
    public function getBalanceProperty(): float
    {
        return Wallet::where('user_id', Auth::id())
            ->where('type', 'main')
            ->value('balance') ?? 0;
    }

    // ── Computed: fee ─────────────────────────────────────────────
    public function getFeeAmountProperty(): float
    {
        if (!$this->amount) return 0;
        return round($this->amount * config('mlm.payout.charges_percent', 0) / 100, 2);
    }

    // ── Computed: net payout ──────────────────────────────────────
    public function getNetAmountProperty(): float
    {
        return max(0, round($this->amount - $this->feeAmount, 2));
    }

    // ── Computed: selected payout account ────────────────────────
    public function getSelectedAccountProperty(): ?PayoutInfo
    {
        if (!$this->payoutInfoId) return null;
        return PayoutInfo::where('user_id', Auth::id())->find($this->payoutInfoId);
    }

    // ── Computed: allowed day ─────────────────────────────────────
    public function getIsAllowedDayProperty(): bool
    {
        $days = config('mlm.payout.allowed_days', []);
        return empty($days) || in_array(now()->format('l'), $days);
    }

    // ── Auto-select default account on mount ─────────────────────
    public function mount(): void
    {
        $default = PayoutInfo::where('user_id', Auth::id())
            ->where('is_default', true)
            ->first();

        if ($default) {
            $this->payoutInfoId = $default->id;
        }
    }

    public function store(): void
    {
        $minAmount = config('mlm.payout.min_amount', 10);
        $maxAmount = config('mlm.payout.max_amount', 100000);

        if (!$this->isAllowedDay) {
            $days = implode(', ', config('mlm.payout.allowed_days', []));
            $this->addError('amount', "Withdrawals are only processed on: {$days}.");
            return;
        }

        $this->validate([
            'amount'       => ['required', 'numeric', "min:{$minAmount}", "max:{$maxAmount}"],
            'payoutInfoId' => ['required', 'exists:payout_infos,id'],
        ], [
            'amount.min'            => "Minimum withdrawal amount is \u20b9{$minAmount}.",
            'amount.max'            => "Maximum withdrawal amount is \u20b9{$maxAmount}.",
            'payoutInfoId.required' => 'Please select a payout account.',
            'payoutInfoId.exists'   => 'Selected payout account not found.',
        ]);

        $payoutInfo = PayoutInfo::where('user_id', Auth::id())
            ->findOrFail($this->payoutInfoId);

        $wallet = Auth::user()->mainWallet;

        if ($this->amount > $wallet->balance) {
            $this->addError('amount', 'Insufficient balance in your main wallet.');
            return;
        }

        $payoutRequest = PayoutRequest::create([
            'user_id'        => Auth::id(),
            'amount'         => $this->amount,
            'fee'            => $this->feeAmount,
            'net_amount'     => $this->netAmount,
            'method'         => $payoutInfo->method,
            'payout_info_id' => $payoutInfo->id,
            'status'         => 'pending',
        ]);

        $wallet->debit(
            $this->amount,
            'Withdrawal Request',
            "Withdrawal #{$payoutRequest->id} — \u20b9{$this->amount} via {$payoutInfo->method} ({$payoutInfo->display_label})",
            ['payout_request_id' => $payoutRequest->id]
        );

        $this->reset('amount', 'payoutInfoId');
        $this->mount();
        session()->flash('message', 'Your withdrawal request has been submitted successfully.');
    }

    public function render()
    {
        $payoutAccounts = PayoutInfo::where('user_id', Auth::id())
            ->orderByDesc('is_default')
            ->orderBy('method')
            ->get();

        return view('livewire.member.wallet.request-withdraw', [
            'payoutAccounts' => $payoutAccounts,
        ])->layout('layouts.app');
    }
}