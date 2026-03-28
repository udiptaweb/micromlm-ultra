<?php
use App\Models\UserProfile;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts.app')] class extends Component {
    public $profile;

    public function mount(): void
    {
        $user = Auth::user();
        $this->profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);
    }

    public function save(): void
    {
        $this->profile->save();
        session()->flash('success', 'Profile updated!');
    }
}; ?>
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">My Profile</h1>
    <form wire:submit.prevent="save" class="space-y-4">
        <input type="text" wire:model.defer="profile.phone" placeholder="Phone" class="input input-bordered w-full" />
        <input type="text" wire:model.defer="profile.address" placeholder="Address" class="input input-bordered w-full" />
        <button type="submit" class="btn btn-primary w-full">Save</button>
    </form>
    @if(session('success'))
        <div class="alert alert-success mt-4">{{ session('success') }}</div>
    @endif
</div>
