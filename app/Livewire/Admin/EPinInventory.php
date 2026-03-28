<?php

namespace App\Livewire\Admin;

use App\Models\EPin;
use Livewire\Component;
use Livewire\WithPagination;

class EPinInventory extends Component
{
    use WithPagination;

    public $search = '';
    public $status = ''; // Filter by status

    // Reset pagination when searching
    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }

    public function render()
    {
        $query = EPin::query()
            ->with(['user', 'creator', 'usedBy']) // Eager load relationships
            ->when($this->search, function($q) {
                $q->where('code', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function($q) {
                $q->where('status', $this->status);
            })
            ->latest();

        return view('livewire.admin.e-pin-inventory', [
            'pins' => $query->paginate(15)
        ])->layout('layouts.app');
    }
}
