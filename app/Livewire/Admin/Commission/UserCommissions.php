<?php

namespace App\Livewire\Admin\Commission;

use App\Models\Commission;
use App\Models\Wallet;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class UserCommissions extends Component
{
    use WithPagination;

    public $filter = 'pending'; // all, pending, approved, paid

    public function updatedFilter()
    {
        $this->resetPage();
    }

    #[On('approveEarning')]
    public function approveEarning($commission_id)
    {
        $commission = Commission::find($commission_id);
        if (in_array($commission->type, ['direct', 'binary', 'unilevel', 'matching', 'rank_bonus'])) {
            $wallet = Wallet::where('user_id', $commission->user_id)->where('type', 'commission')->first();
            if ($wallet) {
                $wallet->credit($commission->amount, 'commission', $commission->description, ['commission_id' => $commission->id]);
                $commission->update(['status' => 'approved']);
            }
        }
    }

    #[On('approveAll')]
    public function approveAll()
    {
        $commissions = Commission::where('status', 'pending')->get();
        foreach ($commissions as $commission) {
            if (in_array($commission->type, ['direct', 'binary', 'unilevel', 'matching', 'rank_bonus'])) {
                $wallet = Wallet::where('user_id', $commission->user_id)->where('type', 'commission')->first();
                if ($wallet) {
                    $wallet->credit($commission->amount, 'commission', $commission->description, ['commission_id' => $commission->id]);
                    $commission->update(['status' => 'approved']);
                }
            }
        }
    }

    public function render()
    {
        $query = Commission::query();

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }
        $query->with('fromUser:id,name,referral_code', 'user:id,name,referral_code');
        $commissions = $query->paginate(20);
        $totalEarnings = Commission::where('status', 'paid')->sum('amount');
        $pendingEarnings = Commission::where('status', 'pending')->sum('amount');
        $approvedEarnings = Commission::where('status', 'approved')->sum('amount');
        return view('livewire.admin.commission.user-commissions', [
            'commissions' => $commissions,
            'totalEarnings' => $totalEarnings,
            'pendingEarnings' => $pendingEarnings,
            'approvedEarnings' => $approvedEarnings
        ])->layout('layouts.app');
    }
}
