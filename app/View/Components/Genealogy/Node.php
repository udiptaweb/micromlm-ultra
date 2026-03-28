<?php

namespace App\View\Components\Genealogy;

use App\Models\User;
use Illuminate\View\Component;

class Node extends Component
{
    public User $user;
    public int $level;

    public function __construct(User $user, int $level = 1)
    {
        $this->user = $user;
        $this->level = $level;
    }

    public function render()
    {
        return view('components.genealogy.node');
    }
}
