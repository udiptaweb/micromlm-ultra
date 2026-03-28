<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Purchase;

class MyPurchases extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filter = 'all'; // all | pending | completed | cancelled

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Purchase::where('user_id', auth()->id())
            ->with(['items.product'])   // eager load items → product
            ->latest();

        // Search through the purchase's items → product name
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('id', 'like', "%{$this->search}%")
                  ->orWhereHas('items.product', fn($p) =>
                      $p->where('name', 'like', "%{$this->search}%")
                  );
            });
        }

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        return view('livewire.member.my-purchases', [
            'orders' => $query->paginate(12),
        ])->layout('layouts.app');
    }
}