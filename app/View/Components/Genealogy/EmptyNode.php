<?php

namespace App\View\Components\Genealogy;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class EmptyNode extends Component
{
    public string $position = '';

    public function render(): View
    {
        return view('components.genealogy.empty-node');
    }
}
