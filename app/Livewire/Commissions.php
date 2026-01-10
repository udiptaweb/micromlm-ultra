<?php

namespace App\Livewire;

use App\Models\Commission;
use Livewire\Component;
use Livewire\WithPagination;

class Commissions extends Component
{
    use WithPagination;

    public $filter = 'all'; // all, pending, approved, paid

    public function updatedFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = auth()->user()->commissions()
            ->with('fromUser')
            ->latest();

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        $commissions = $query->paginate(20);
        $totalEarnings = auth()->user()->commissions()->where('status', 'paid')->sum('amount');
        $pendingEarnings = auth()->user()->commissions()->where('status', 'pending')->sum('amount');
        $approvedEarnings = auth()->user()->commissions()->where('status', 'approved')->sum('amount');

        return view('livewire.commissions', [
            'commissions' => $commissions,
            'totalEarnings' => $totalEarnings,
            'pendingEarnings' => $pendingEarnings,
            'approvedEarnings' => $approvedEarnings,
        ])->layout('layouts.app');
    }
}
