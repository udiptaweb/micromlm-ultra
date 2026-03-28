<?php

namespace App\Livewire\Genealogy;

use Livewire\Component;

class BinaryTree extends Component
{
    public $node = [];
    public function render()
    {
        return view('livewire.genealogy.binary-tree',[
            'node' => $this->node,
        ]);
    }
}
