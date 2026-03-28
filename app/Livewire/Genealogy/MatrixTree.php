<?php

namespace App\Livewire\Genealogy;

use Livewire\Component;

class MatrixTree extends Component
{
    public $node = [];
    public function render()
    {
        return view('livewire.genealogy.matrix-tree', [
            'node' => $this->node,
        ]);
    }
}
