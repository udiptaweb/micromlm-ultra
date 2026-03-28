<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Services\BinaryService;

class ManagePlacements extends Component
{
    use WithPagination;

    public string $search        = '';
    public string $parentSearch  = '';

    public ?int   $selectedUserId   = null; // user to place
    public ?int   $selectedParentId = null; // parent user id
    public string $selectedPosition = 'left';

    public string $errorMsg   = '';
    public string $successMsg = '';

    // ── Open modal for a specific unplaced user ──────────────────
    public function selectUser(int $userId): void
    {
        $this->selectedUserId   = $userId;
        $this->selectedParentId = null;
        $this->parentSearch     = '';
        $this->selectedPosition = 'left';
        $this->errorMsg         = '';
    }

    public function cancelPlacement(): void
    {
        $this->selectedUserId   = null;
        $this->selectedParentId = null;
        $this->parentSearch     = '';
        $this->errorMsg         = '';
    }

    // When position radio changes, reset parent search
    // (a parent valid for 'left' may not be valid for 'right')
    public function updatedSelectedPosition(): void
    {
        $this->selectedParentId = null;
        $this->parentSearch     = '';
    }

    // ── Confirm and execute placement ────────────────────────────
    public function confirmPlacement(): void
    {
        $this->validate([
            'selectedUserId'   => 'required|exists:users,id',
            'selectedParentId' => 'required|exists:users,id',
            'selectedPosition' => 'required|in:left,right',
        ]);

        $user   = User::find($this->selectedUserId);
        $parent = User::find($this->selectedParentId);

        if (! $user || ! $parent) {
            $this->errorMsg = 'Invalid user or parent. Please try again.';
            return;
        }

        // Cannot place a user under themselves
        if ($user->id === $parent->id) {
            $this->errorMsg = 'A member cannot be placed under themselves.';
            return;
        }

        try {
            app(BinaryService::class)->placeManually($user, $parent, $this->selectedPosition);

            $this->successMsg     = "{$user->name} has been placed under {$parent->name} on the {$this->selectedPosition} leg.";
            $this->selectedUserId = null;
            $this->parentSearch   = '';
            $this->resetPage();
        } catch (\Exception $e) {
            $this->errorMsg = $e->getMessage();
        }
    }

    // ── Available parents search ──────────────────────────────────
    // Returns users who have an open slot on the selected position
    public function getAvailableParentsProperty()
    {
        if (strlen($this->parentSearch) < 2) {
            return collect();
        }

        return User::query()
            ->where(fn($q) =>
                $q->where('name',     'like', "%{$this->parentSearch}%")
                  ->orWhere('username', 'like', "%{$this->parentSearch}%")
                  ->orWhere('email',    'like', "%{$this->parentSearch}%")
            )
            // Exclude the user being placed (can't be their own parent)
            ->when($this->selectedUserId, fn($q) =>
                $q->where('id', '!=', $this->selectedUserId)
            )
            // Only users with an open slot on the selected side
            ->when($this->selectedPosition === 'left', fn($q) =>
                $q->whereDoesntHave('leftChild')
            )
            ->when($this->selectedPosition === 'right', fn($q) =>
                $q->whereDoesntHave('rightChild')
            )
            ->where('role', 'user')
            ->with(['leftChild', 'rightChild'])
            ->limit(8)
            ->get();
    }

    // ── Unplaced users query ──────────────────────────────────────
    public function render()
    {
        // Unplaced = member users with no binary_parent_id assigned
        // Exclude root/admin who intentionally has no parent
        $unplaced = User::where('role', 'user')
            ->whereNull('binary_parent_id')
            ->whereNull('binary_position')
            ->with(['sponsor'])
            ->when($this->search, fn($q) =>
                $q->where(fn($s) =>
                    $s->where('name',     'like', "%{$this->search}%")
                      ->orWhere('username', 'like', "%{$this->search}%")
                      ->orWhere('email',    'like', "%{$this->search}%")
                )
            )
            ->latest()
            ->paginate(15);

        $selectedUser = $this->selectedUserId
            ? User::with(['sponsor'])->find($this->selectedUserId)
            : null;

        return view('livewire.admin.manage-placements', [
            'unplaced'         => $unplaced,
            'selectedUser'     => $selectedUser,
            'availableParents' => $this->availableParents,
        ])->layout('layouts.app');
    }
}