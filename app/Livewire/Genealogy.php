<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Genealogy extends Component
{
    public $downlines;
    public $totalNetwork;

    public function mount()
    {
        $user = auth()->user();
        $this->downlines = $user->downlines()->with(['rank', 'downlines'])->get();
        $this->totalNetwork = $this->getTotalNetworkCount($user);
    }

    private function getTotalNetworkCount(User $user): int
    {
        $count = $user->downlines()->count();
        
        foreach ($user->downlines()->get() as $downline) {
            $count += $this->getTotalNetworkCount($downline);
        }
        
        return $count;
    }

    public function render()
    {
        return view('livewire.genealogy')->layout('layouts.app');
    }
}
