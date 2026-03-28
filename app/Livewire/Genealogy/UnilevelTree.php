<?php

namespace App\Livewire\Genealogy;

use Livewire\Component;

class UnilevelTree extends Component
{
    public $node = [];
    public function render()
    {
        return view('livewire.genealogy.unilevel-tree', [
            'node' => $this->node,
        ]);
    }
}
