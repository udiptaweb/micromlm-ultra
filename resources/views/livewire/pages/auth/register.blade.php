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
    public string $name                  = '';
    public string $username              = '';
    public string $email                 = '';
    public string $password              = '';
    public string $password_confirmation = '';
    public string $referral_code         = '';
    public ?int   $sponsor_id            = null;
    public ?string $sponsorName          = null;

    public function mount(): void
    {
        $this->referral_code = request()->query('ref', '');

        if ($this->referral_code) {
            $sponsor = User::where('referral_code', $this->referral_code)->first();
            if ($sponsor) {
                $this->sponsor_id   = $sponsor->id;
                $this->sponsorName  = $sponsor->name;
            }
        }
    }

    // Live-resolve referral code as user types
    public function updatedReferralCode(): void
    {
        $sponsor = User::where('referral_code', strtoupper($this->referral_code))->first();
        $this->sponsor_id  = $sponsor?->id;
        $this->sponsorName = $sponsor?->name;
    }

    public function register(): void
    {
        $validated = $this->validate([
            'name'          => ['required', 'string', 'max:255'],
            'username'      => ['required', 'string', 'max:255', 'unique:'.User::class, 'alpha_dash'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'      => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'referral_code' => ['nullable', 'exists:users,referral_code'],
        ]);

        if (!empty($validated['referral_code'])) {
            $sponsor = User::where('referral_code', $validated['referral_code'])->first();
            $validated['sponsor_id'] = $sponsor?->id;
        } elseif (config('mlm.registration.require_sponsor')) {
            $defaultSponsor = User::where('username', config('mlm.registration.default_sponsor_username'))->first();
            $validated['sponsor_id'] = $defaultSponsor?->id;
        }

        $validated['password']      = Hash::make($validated['password']);
        $validated['referral_code'] = Str::upper(Str::random(8));
        $validated['status']        = 'active';

        $defaultRank          = \App\Models\Rank::where('level', 0)->first();
        $validated['rank_id'] = $defaultRank?->id;

        $user = User::create($validated);

        if (config('mlm.genealogy.type') === 'binary') {
            app(\App\Services\BinaryService::class)->placeInBinaryTree($user);
        }
        if (config('mlm.genealogy.type') === 'matrix') {
            \App\Services\MatrixService::placeInMatrixTree($user);
        }

        event(new Registered($user));
        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false));
    }
}; ?>

<div>
    <style>
        .register-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg);
            padding: 2rem 1.5rem;
            position: relative;
            overflow: hidden;
        }
        .register-shell::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(var(--border-soft) 1px, transparent 1px),
                linear-gradient(90deg, var(--border-soft) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none; z-index: 0;
        }
        .register-shell::after {
            content: '';
            position: fixed;
            top: -20%; left: 50%; transform: translateX(-50%);
            width: 700px; height: 600px;
            background: radial-gradient(ellipse,
                var(--accentGlow, rgba(139,92,246,.12)) 0%, transparent 65%);
            pointer-events: none; z-index: 0;
        }

        .register-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 520px;
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(0,0,0,0.35);
        }
        .register-card::before {
            content: ''; display: block; height: 3px;
            background: linear-gradient(90deg,
                transparent 5%, var(--accent) 50%, transparent 95%);
        }

        .register-header {
            padding: 1.75rem 2rem 1rem;
            text-align: center;
        }
        .register-logo {
            font-family: var(--font-display);
            font-size: 1.5rem; font-weight: 500;
            color: var(--accent); letter-spacing: 0.03em;
            margin-bottom: 1rem; display: block; text-decoration: none;
        }
        .register-logo span { color: var(--text); font-weight: 300; }
        .register-title {
            font-family: var(--font-display);
            font-size: 1.3rem; font-weight: 500;
            color: var(--text); margin-bottom: 0.2rem;
        }
        .register-sub { font-size: 0.78rem; color: var(--text-faint); }

        .register-body {
            padding: 0.5rem 2rem 1.75rem;
        }

        /* Section label dividers */
        .form-section {
            display: flex; align-items: center; gap: 0.65rem;
            font-size: 0.62rem; letter-spacing: 0.14em;
            text-transform: uppercase; color: var(--text-faint);
            margin: 1rem 0 0.85rem;
        }
        .form-section::before,
        .form-section::after {
            content: ''; flex: 1;
            height: 1px; background: var(--border-soft);
        }

        .form-row-2 {
            display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem;
        }
        @media (max-width: 480px) { .form-row-2 { grid-template-columns: 1fr; } }

        .form-group { margin-bottom: 0.9rem; }

        .reg-label {
            display: block;
            font-size: 0.75rem; font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 0.3rem; letter-spacing: 0.03em;
        }
        .reg-label .opt {
            color: var(--text-faint); font-weight: 300;
            font-size: 0.68rem; margin-left: 3px;
        }

        .reg-input {
            width: 100%;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.62rem 0.9rem;
            font-size: 0.875rem; color: var(--text);
            font-family: var(--font-body);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .reg-input::placeholder { color: var(--text-faint); }
        .reg-input:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }
        .reg-input.has-error {
            border-color: rgba(248,113,113,0.5);
            box-shadow: 0 0 0 3px rgba(248,113,113,0.08);
        }

        .reg-error { font-size: 0.7rem; color: var(--danger); margin-top: 0.25rem; display: block; }
        .reg-hint  { font-size: 0.68rem; color: var(--text-faint); margin-top: 0.25rem; display: block; }

        /* Referral verified indicator */
        .referral-ok {
            display: flex; align-items: center; gap: 0.4rem;
            margin-top: 0.3rem;
            padding: 0.3rem 0.65rem;
            background: rgba(74,222,128,0.08);
            border: 1px solid rgba(74,222,128,0.2);
            border-radius: 6px;
            font-size: 0.72rem; color: var(--success);
        }
        .referral-ok svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2.5; flex-shrink: 0; }

        /* Submit */
        .btn-register {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.78rem 1.5rem;
            background: var(--accent); color: var(--bg);
            border: none; border-radius: 8px;
            font-family: var(--font-body); font-size: 0.9rem; font-weight: 500;
            cursor: pointer; margin-top: 0.5rem;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-register:hover:not(:disabled) {
            opacity: 0.88; transform: translateY(-1px);
            box-shadow: 0 6px 24px var(--accentGlow, rgba(0,0,0,0.25));
        }
        .btn-register:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-register svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }

        .btn-spinner {
            width: 14px; height: 14px; border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2);
            border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .register-footer {
            padding: 1rem 2rem;
            border-top: 1px solid var(--border-soft);
            text-align: center;
            background: var(--bg-3);
            font-size: 0.78rem; color: var(--text-faint);
        }
        .register-footer a {
            color: var(--accent-text); text-decoration: none; transition: color 0.2s;
        }
        .register-footer a:hover { color: var(--accent); }
    </style>

    <div class="register-shell">
        <div class="register-card">

            {{-- Header --}}
            <div class="register-header">
                <a href="/" wire:navigate class="register-logo">MLM<span>Pro</span></a>
                <div class="register-title">Create Account</div>
                <div class="register-sub">Join the network and start earning today</div>
            </div>

            <div class="register-body">
                <form wire:submit="register">

                    {{-- ── Personal info ── --}}
                    <div class="form-section">Personal Info</div>

                    <div class="form-group">
                        <label class="reg-label" for="name">Full Name</label>
                        <input
                            wire:model="name"
                            id="name" type="text" name="name"
                            class="reg-input @error('name') has-error @enderror"
                            placeholder="Your full name"
                            required autofocus
                        >
                        @error('name') <span class="reg-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-row-2 form-group">
                        <div>
                            <label class="reg-label" for="username">Username</label>
                            <input
                                wire:model="username"
                                id="username" type="text" name="username"
                                class="reg-input @error('username') has-error @enderror"
                                placeholder="john_doe"
                                required
                            >
                            @error('username') <span class="reg-error">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="reg-label" for="email">Email Address</label>
                            <input
                                wire:model="email"
                                id="email" type="email" name="email"
                                class="reg-input @error('email') has-error @enderror"
                                placeholder="you@example.com"
                                required
                            >
                            @error('email') <span class="reg-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- ── Referral ── --}}
                    <div class="form-section">Referral</div>

                    <div class="form-group">
                        <label class="reg-label" for="referral_code">
                            Referral Code
                            @if(!config('mlm.registration.require_sponsor'))
                                <span class="opt">(optional)</span>
                            @endif
                        </label>
                        <input
                            wire:model.live.debounce.400ms="referral_code"
                            id="referral_code" type="text" name="referral_code"
                            class="reg-input @error('referral_code') has-error @enderror"
                            placeholder="e.g. AB12CD34"
                            style="font-family:var(--font-mono,monospace);letter-spacing:.08em;text-transform:uppercase;"
                            {{ config('mlm.registration.require_sponsor') ? 'required' : '' }}
                        >
                        @if($sponsor_id && $sponsorName)
                            <div class="referral-ok">
                                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                Referred by <strong style="margin-left:.25rem;">{{ $sponsorName }}</strong>
                            </div>
                        @elseif(strlen($referral_code) > 3 && !$sponsor_id)
                            <span class="reg-error">Referral code not found</span>
                        @elseif(!$sponsor_id && config('mlm.registration.require_sponsor'))
                            <span class="reg-hint">A valid referral code is required to register</span>
                        @endif
                        @error('referral_code') <span class="reg-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- ── Security ── --}}
                    <div class="form-section">Security</div>

                    <div class="form-row-2 form-group">
                        <div>
                            <label class="reg-label" for="password">Password</label>
                            <input
                                wire:model="password"
                                id="password" type="password" name="password"
                                class="reg-input @error('password') has-error @enderror"
                                placeholder="••••••••"
                                required
                            >
                            @error('password') <span class="reg-error">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="reg-label" for="password_confirmation">Confirm Password</label>
                            <input
                                wire:model="password_confirmation"
                                id="password_confirmation" type="password" name="password_confirmation"
                                class="reg-input"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="btn-register">
                        <span wire:loading wire:target="register" class="btn-spinner"></span>
                        <svg wire:loading.remove wire:target="register" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <line x1="19" y1="8" x2="19" y2="14"/>
                            <line x1="22" y1="11" x2="16" y2="11"/>
                        </svg>
                        <span wire:loading.remove wire:target="register">Create Account</span>
                        <span wire:loading wire:target="register">Creating account…</span>
                    </button>

                </form>
            </div>

            {{-- Footer --}}
            <div class="register-footer">
                Already have an account?
                <a href="{{ route('login') }}" wire:navigate>Sign in</a>
            </div>

        </div>
    </div>

</div>