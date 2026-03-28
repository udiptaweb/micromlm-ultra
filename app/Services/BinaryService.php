<?php

namespace App\Services;

use App\Models\User;

class BinaryService
{
    // ── Read config once on construction ──────────────────────────
    protected bool   $autoPlacement;
    protected string $preference;   // left | right | balanced
    protected bool   $spillover;

    public function __construct()
    {
        $this->autoPlacement = config('mlm.commission.binary.auto_placement',       true);
        $this->preference    = config('mlm.commission.binary.placement_preference', 'left');
        $this->spillover     = config('mlm.genealogy.spillover',                    true);
    }

    // ─────────────────────────────────────────────────────────────
    // Entry point — called right after User is created
    // ─────────────────────────────────────────────────────────────
    public function placeInBinaryTree(User $user): void
    {
        // ── Auto placement is OFF → leave unlinked for manual admin placement ──
        if (! $this->autoPlacement) {
            // binary_parent_id and binary_position stay null
            // Admin will assign via ManagePlacements component
            return;
        }

        $sponsor = $user->sponsor_id
            ? User::find($user->sponsor_id)
            : null;

        // No valid sponsor → place directly under root (no parent)
        if (! $sponsor) {
            $user->binary_parent_id = null;
            $user->binary_position  = 'left';
            $user->save();
            return;
        }

        // Find the best open slot using BFS
        $slot = $this->findOpenSlot($sponsor);

        if (! $slot) {
            // Tree is full and spillover is disabled — leave unlinked
            // You can fire an event here to notify the admin
            \Illuminate\Support\Facades\Log::warning(
                "BinaryService: No slot found for user #{$user->id}. " .
                "Spillover is disabled and sponsor tree is full."
            );
            return;
        }

        $position = $this->determinePosition($slot);

        $user->binary_parent_id = $slot->id;
        $user->binary_position  = $position;
        $user->save();
    }

    // ─────────────────────────────────────────────────────────────
    // BFS — finds the shallowest open slot in the sponsor's subtree
    // Safe for large trees (no recursion / no stack overflow risk)
    // ─────────────────────────────────────────────────────────────
    protected function findOpenSlot(User $sponsor): ?User
    {
        $queue = [$sponsor];

        while (! empty($queue)) {
            $node = array_shift($queue);

            // This node has at least one open position
            if (! $node->leftChild || ! $node->rightChild) {
                return $node;
            }

            // Both slots are filled
            if (! $this->spillover) {
                // Spillover disabled: only check sponsor's own direct slots
                // Since we're past the sponsor and it's full, stop here
                if ($node->id === $sponsor->id) {
                    return null;
                }
                // Don't traverse deeper
                continue;
            }

            // Spillover enabled: add children to queue for deeper search
            if ($node->leftChild) {
                $queue[] = $node->leftChild;
            }
            if ($node->rightChild) {
                $queue[] = $node->rightChild;
            }
        }

        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // Decide left or right based on config preference
    // ─────────────────────────────────────────────────────────────
    protected function determinePosition(User $node): string
    {
        // If one side is simply empty, use it regardless of preference
        if (! $node->leftChild)  return 'left';
        if (! $node->rightChild) return 'right';

        // Both sides empty (new node with no children yet) — use preference
        return match ($this->preference) {
            'right'    => 'right',
            'balanced' => $this->weakerLeg($node),
            default    => 'left', // 'left' preference
        };
    }

    // ─────────────────────────────────────────────────────────────
    // Balanced preference — count subtree members on each side
    // and place in the leg with fewer members
    // ─────────────────────────────────────────────────────────────
    protected function weakerLeg(User $node): string
    {
        $leftCount  = $node->leftChild  ? $this->countSubtree($node->leftChild)  : 0;
        $rightCount = $node->rightChild ? $this->countSubtree($node->rightChild) : 0;

        return $leftCount <= $rightCount ? 'left' : 'right';
    }

    // ─────────────────────────────────────────────────────────────
    // Recursively count all members in a subtree
    // (only used by weakerLeg — small subtrees only in practice)
    // ─────────────────────────────────────────────────────────────
    protected function countSubtree(User $node): int
    {
        $count = 1;
        if ($node->leftChild)  $count += $this->countSubtree($node->leftChild);
        if ($node->rightChild) $count += $this->countSubtree($node->rightChild);
        return $count;
    }

    // ─────────────────────────────────────────────────────────────
    // Manual placement — called from ManagePlacements admin component
    // when auto_placement is disabled
    // ─────────────────────────────────────────────────────────────
    public function placeManually(User $user, User $parent, string $position): void
    {
        if ($position === 'left' && $parent->leftChild) {
            throw new \RuntimeException(
                "{$parent->name}'s left position is already occupied by {$parent->leftChild->name}."
            );
        }

        if ($position === 'right' && $parent->rightChild) {
            throw new \RuntimeException(
                "{$parent->name}'s right position is already occupied by {$parent->rightChild->name}."
            );
        }

        $user->binary_parent_id = $parent->id;
        $user->binary_position  = $position;
        $user->save();
    }
}