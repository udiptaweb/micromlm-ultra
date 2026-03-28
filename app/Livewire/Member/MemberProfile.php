<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Models\User;

class MemberProfile extends Component
{
    public User $member;

    // Downline tab state
    public string $downlineTab = 'direct'; // direct | all

    public function mount(int $userId): void
    {
        // Anyone logged in can view any member profile
        // Admins see full financial data; members see limited view
        $this->member = User::with([
            'sponsor',
            'rank',
            'profile',
            'binaryParent',
            'payoutInfos',   // admin-only payout accounts
        ])
        ->where('role', 'user')
        ->findOrFail($userId);
    }

    // Viewer is admin
    public function viewerIsAdmin(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    // Viewer is the member themselves
    public function viewerIsOwner(): bool
    {
        return auth()->id() === $this->member->id;
    }

    // Can see financial details
    public function canSeeFinancials(): bool
    {
        return $this->viewerIsAdmin() || $this->viewerIsOwner();
    }

    // Direct referrals (level 1)
    public function getDirectDownlinesProperty()
    {
        return User::where('sponsor_id', $this->member->id)
            ->with(['rank'])
            ->latest()
            ->get();
    }

    // Count all descendants recursively via binary tree
    public function getTeamCountProperty(): int
    {
        return $this->member->team_count
            ?? User::where('sponsor_id', $this->member->id)->count();
    }

    // Recent commissions — only visible to admin/owner
    public function getRecentCommissionsProperty()
    {
        if (! $this->canSeeFinancials()) return collect();

        return $this->member->commissions()
            ->with('fromUser')
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        $payoutInfos = $this->viewerIsAdmin()
            ? $this->member->payoutInfos->groupBy('method')
            : collect();

        return view('livewire.member.member-profile', [
            'directDownlines'    => $this->directDownlines,
            'teamCount'          => $this->teamCount,
            'recentCommissions'  => $this->recentCommissions,
            'canSeeFinancials'   => $this->canSeeFinancials(),
            'isAdmin'            => $this->viewerIsAdmin(),
            'isOwner'            => $this->viewerIsOwner(),
            'payoutInfos'        => $payoutInfos,
        ])->layout('layouts.app');
    }
}