<?php

namespace App\Livewire\Member;

use App\Models\EPin;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class MyEPins extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $pins = EPin::where('assigned_to', Auth::id())
            ->when($this->search, function($query) {
                $query->where('code', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(12);

        return view('livewire.member.my-e-pins', [
            'pins' => $pins
        ])->layout('layouts.app');
    }
}
