<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Genealogy extends Component
{
    public User $user;
    public $userId;
    public string $planType;
    public array $tree = [];
    public int $totalNetwork = 0;
    public int $maxLevel;

    public function mount(): void
    {
        $this->user = User::find($this->userId ?? auth()->id());
        $this->planType = config('mlm.genealogy.type', 'binary');
        $this->maxLevel = config('mlm.genealogy.max_levels', 3);

        match ($this->planType) {
            'binary'   => $this->loadBinaryTree(),
            'matrix'   => $this->loadMatrixTree(),
            default    => $this->loadUnilevelTree(),
        };

        $this->totalNetwork = $this->getTotalNetworkCount($this->user);
    }

    /* ===============================
     | Binary Tree
     ===============================*/
    protected function loadBinaryTree(): void
    {
        $this->tree = $this->buildBinaryNode($this->user, 1);
    }

    protected function buildBinaryNode(User $user, int $level): ?array
    {
        if ($level > $this->maxLevel) {
            return null;
        }

        return [
            'user'     => $user,
            'level'    => $level,
            'position' => $user->position, // left / right
            'left'     => $user->leftChild
                ? $this->buildBinaryNode($user->leftChild, $level + 1)
                : null,
            'right'    => $user->rightChild
                ? $this->buildBinaryNode($user->rightChild, $level + 1)
                : null,
        ];
    }

    /* ===============================
     | Matrix Tree
     ===============================*/
    protected function loadMatrixTree(): void
    {
        $this->tree = $this->buildMatrixNode($this->user, 1);
    }

    protected function buildMatrixNode(User $user, int $level): ?array
    {
        if ($level > $this->maxLevel) {
            return null;
        }

        return [
            'user'     => $user,
            'level'    => $level,
            'children' => $user->matrixChildren
                ->map(fn ($child) => $this->buildMatrixNode($child, $level + 1))
                ->filter()
                ->values()
                ->toArray(),
        ];
    }

    /* ===============================
     | Unilevel Tree
     ===============================*/
    protected function loadUnilevelTree(): void
    {
        $this->tree = $this->buildUnilevelNode($this->user, 1);
    }

    protected function buildUnilevelNode(User $user, int $level): ?array
    {
        if ($level > $this->maxLevel) {
            return null;
        }

        return [
            'user'     => $user,
            'level'    => $level,
            'children' => $user->downlines
                ->map(fn ($child) => $this->buildUnilevelNode($child, $level + 1))
                ->filter()
                ->values()
                ->toArray(),
        ];
    }

    /* ===============================
     | Utilities
     ===============================*/
    protected function getTotalNetworkCount(User $user): int
    {
        $count = $user->downlines()->count();

        foreach ($user->downlines as $downline) {
            $count += $this->getTotalNetworkCount($downline);
        }

        return $count;
    }

    public function render()
    {
        return view('livewire.genealogy', [
            'planType' => $this->planType,
            'tree'     => $this->tree,
            'maxLevel' => $this->maxLevel,
        ])->layout('layouts.app');
    }
}
