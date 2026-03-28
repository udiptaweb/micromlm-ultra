<?php

namespace App\Livewire\Member\Wallet;

use App\Models\PayoutRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class WithdrawRequests extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    // ── Filters ───────────────────────────────────────────────────
    public string $search = '';
    public string $status = 'all';

    // ── Sorting ───────────────────────────────────────────────────
    public string $sortBy  = 'created_at';
    public string $sortDir = 'desc';

    // ── Remark modal ──────────────────────────────────────────────
    public bool   $showRemarkModal = false;
    public ?int   $remarkTargetId  = null;
    public string $remarkAction    = '';   // 'approve' | 'reject'
    public string $remark          = '';

    // ── Open remark modal before acting ──────────────────────────
    public function openRemark(int $id, string $action): void
    {
        $this->remarkTargetId = $id;
        $this->remarkAction   = $action;
        $this->remark         = '';
        $this->showRemarkModal = true;
    }

    public function cancelRemark(): void
    {
        $this->showRemarkModal = false;
        $this->remarkTargetId  = null;
        $this->remark          = '';
    }

    public function confirmAction(): void
    {
        if ($this->remarkAction === 'approve') {
            $this->approve($this->remarkTargetId);
        } else {
            $this->reject($this->remarkTargetId);
        }
        $this->showRemarkModal = false;
    }

    // ── Approve ───────────────────────────────────────────────────
    public function approve(int $id): void
    {
        $withdraw = PayoutRequest::with('user')->findOrFail($id);

        if ($withdraw->status !== 'pending') {
            throw ValidationException::withMessages([
                'status' => 'This withdrawal is already processed.',
            ]);
        }

        $withdraw->update([
            'status'        => 'approved',
            'admin_remarks' => $this->remark ?: null,
            'processed_at'  => now(),
            'approved_by'   => Auth::id(),
            'approved_at'   => now(),
        ]);

        $this->remark = '';
        session()->flash('success', "Withdrawal #{$id} approved.");
    }

    // ── Reject ────────────────────────────────────────────────────
    public function reject(int $id): void
    {
        $withdraw = PayoutRequest::with('user')->findOrFail($id);

        if ($withdraw->status !== 'pending') {
            throw ValidationException::withMessages([
                'status' => 'This withdrawal is already processed.',
            ]);
        }

        // Refund to main wallet
        $withdraw->user->mainWallet->credit(
            $withdraw->amount,
            'Withdrawal Rejected',
            "Withdrawal #{$id} rejected and refunded",
            ['payout_request_id' => $withdraw->id]
        );

        $withdraw->update([
            'status'        => 'rejected',
            'admin_remarks' => $this->remark ?: null,
            'processed_at'  => now(),
            'rejected_by'   => Auth::id(),
            'rejected_at'   => now(),
        ]);

        $this->remark = '';
        session()->flash('success', "Withdrawal #{$id} rejected and amount refunded.");
    }

    // ── Reset page on filter change ───────────────────────────────
    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStatus(): void { $this->resetPage(); }

    // ── Sorting ───────────────────────────────────────────────────
    public function setSorting(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy  = $field;
            $this->sortDir = 'asc';
        }
        $this->resetPage();
    }

    // ── Data ──────────────────────────────────────────────────────
    public function getWithdrawsProperty()
    {
        return PayoutRequest::query()
            ->with(['user', 'payoutInfo'])   // eager load both
            ->when($this->search, fn($q) =>
                $q->where(function ($sub) {
                    $sub->where('method', 'like', "%{$this->search}%")
                        ->orWhereHas('user', fn($u) =>
                            $u->where('name',  'like', "%{$this->search}%")
                              ->orWhere('email', 'like', "%{$this->search}%")
                        );
                })
            )
            ->when($this->status !== 'all', fn($q) =>
                $q->where('status', $this->status)
            )
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(15);
    }

    // ── Stats — single query with groupBy ─────────────────────────
    public function getStatsProperty(): array
    {
        $counts = PayoutRequest::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'total'    => $counts->sum(),
            'pending'  => $counts->get('pending',  0),
            'approved' => $counts->get('approved', 0),
            'rejected' => $counts->get('rejected', 0),
        ];
    }

    public function render()
    {
        return view('livewire.member.wallet.withdraw-requests', [
            'withdraws' => $this->withdraws,
            'stats'     => $this->stats,
        ])->layout('layouts.app');
    }
}