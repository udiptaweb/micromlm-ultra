<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Str;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $referral_code = '';
    public ?int $sponsor_id = null;

    public function mount(): void
    {
        // Get referral code from URL
        $this->referral_code = request()->query('ref', '');
        
        if ($this->referral_code) {
            $sponsor = User::where('referral_code', $this->referral_code)->first();
            if ($sponsor) {
                $this->sponsor_id = $sponsor->id;
            }
        }
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class, 'alpha_dash'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'referral_code' => ['nullable', 'exists:users,referral_code'],
        ]);

        // Find sponsor
        if (!empty($validated['referral_code'])) {
            $sponsor = User::where('referral_code', $validated['referral_code'])->first();
            $validated['sponsor_id'] = $sponsor?->id;
        } elseif (config('mlm.registration.require_sponsor')) {
            // Use default sponsor if required
            $defaultSponsor = User::where('username', config('mlm.registration.default_sponsor_username'))->first();
            $validated['sponsor_id'] = $defaultSponsor?->id;
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['referral_code'] = Str::upper(Str::random(8));
        $validated['status'] = 'active';
        
        // Get default rank (Member - level 0)
        $defaultRank = \App\Models\Rank::where('level', 0)->first();
        $validated['rank_id'] = $defaultRank?->id;

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" required />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Referral Code -->
        <div class="mt-4">
            <x-input-label for="referral_code" :value="__('Referral Code (Optional)')" />
            <x-text-input wire:model="referral_code" id="referral_code" class="block mt-1 w-full" type="text" name="referral_code" />
            <x-input-error :messages="$errors->get('referral_code')" class="mt-2" />
            @if($sponsor_id)
                <p class="mt-1 text-sm text-green-600">✓ Valid referral code</p>
            @endif
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
