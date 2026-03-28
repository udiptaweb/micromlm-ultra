<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    #[Locked]
    public string $token                 = '';
    public string $email                 = '';
    public string $password              = '';
    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->string('email');
    }

    public function resetPassword(): void
    {
        $this->validate([
            'token'    => ['required'],
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password'       => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));
            return;
        }

        Session::flash('status', __($status));
        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div>
    <style>
        .auth-shell {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: var(--bg); padding: 2rem 1.5rem;
            position: relative; overflow: hidden;
        }
        .auth-shell::before {
            content: ''; position: fixed; inset: 0;
            background-image:
                linear-gradient(var(--border-soft) 1px, transparent 1px),
                linear-gradient(90deg, var(--border-soft) 1px, transparent 1px);
            background-size: 60px 60px; pointer-events: none; z-index: 0;
        }
        .auth-shell::after {
            content: ''; position: fixed;
            top: -20%; left: 50%; transform: translateX(-50%);
            width: 700px; height: 600px;
            background: radial-gradient(ellipse,
                var(--accentGlow, rgba(139,92,246,.12)) 0%, transparent 65%);
            pointer-events: none; z-index: 0;
        }

        .auth-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 440px;
            background: var(--bg-2); border: 1px solid var(--border-soft);
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 32px 80px rgba(0,0,0,0.35);
        }
        .auth-card::before {
            content: ''; display: block; height: 3px;
            background: linear-gradient(90deg, transparent 5%, var(--accent) 50%, transparent 95%);
        }

        .auth-header { padding: 1.75rem 2rem 1.25rem; text-align: center; }
        .auth-logo {
            font-family: var(--font-display);
            font-size: 1.5rem; font-weight: 500;
            color: var(--accent); letter-spacing: 0.03em;
            margin-bottom: 1.1rem; display: block; text-decoration: none;
        }
        .auth-logo span { color: var(--text); font-weight: 300; }

        .auth-icon-wrap {
            width: 52px; height: 52px; border-radius: 50%;
            background: var(--accent-dim); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .auth-icon-wrap svg { width: 22px; height: 22px; stroke: var(--accent-text); fill: none; stroke-width: 1.6; }

        .auth-title { font-family: var(--font-display); font-size: 1.3rem; font-weight: 500; color: var(--text); margin-bottom: 0.3rem; }
        .auth-sub   { font-size: 0.8rem; color: var(--text-faint); line-height: 1.65; max-width: 300px; margin: 0 auto; }

        .auth-body { padding: 0.5rem 2rem 2rem; display: flex; flex-direction: column; gap: 0.9rem; }

        /* Section divider */
        .form-section {
            display: flex; align-items: center; gap: 0.65rem;
            font-size: 0.62rem; letter-spacing: 0.14em;
            text-transform: uppercase; color: var(--text-faint);
            margin: 0.25rem 0 0.1rem;
        }
        .form-section::before, .form-section::after {
            content: ''; flex: 1; height: 1px; background: var(--border-soft);
        }

        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; }
        @media (max-width: 460px) { .form-row-2 { grid-template-columns: 1fr; } }

        .reg-label {
            display: block; font-size: 0.75rem; font-weight: 500;
            color: var(--text-muted); margin-bottom: 0.3rem; letter-spacing: 0.03em;
        }
        .reg-input {
            width: 100%; background: var(--bg-3); border: 1px solid var(--border-soft);
            border-radius: 8px; padding: 0.65rem 0.9rem;
            font-size: 0.875rem; color: var(--text); font-family: var(--font-body);
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
        }
        .reg-input::placeholder { color: var(--text-faint); }
        .reg-input:focus { border-color: var(--border); box-shadow: 0 0 0 3px var(--accent-dim); }
        .reg-input.has-error { border-color: rgba(248,113,113,0.5); box-shadow: 0 0 0 3px rgba(248,113,113,0.08); }
        .reg-error { font-size: 0.7rem; color: var(--danger); margin-top: 0.25rem; display: block; }

        /* Email field — read-only style */
        .reg-input[readonly] {
            background: var(--bg-3);
            color: var(--text-faint);
            cursor: default;
            opacity: 0.75;
        }

        .btn-reset {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--accent); color: var(--bg);
            border: none; border-radius: 8px;
            font-family: var(--font-body); font-size: 0.9rem; font-weight: 500;
            cursor: pointer; margin-top: 0.25rem;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-reset:hover:not(:disabled) {
            opacity: 0.88; transform: translateY(-1px);
            box-shadow: 0 6px 24px var(--accentGlow, rgba(0,0,0,0.25));
        }
        .btn-reset:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-reset svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }

        .btn-spinner {
            width: 14px; height: 14px; border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2); border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .auth-footer {
            padding: 1rem 2rem; border-top: 1px solid var(--border-soft);
            text-align: center; background: var(--bg-3);
            font-size: 0.78rem; color: var(--text-faint);
        }
        .auth-footer a {
            color: var(--accent-text); text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.35rem;
            transition: color 0.2s;
        }
        .auth-footer a:hover { color: var(--accent); }
        .auth-footer a svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }
    </style>

    <div class="auth-shell">
        <div class="auth-card">

            {{-- Header --}}
            <div class="auth-header">
                <a href="/" wire:navigate class="auth-logo">MLM<span>Pro</span></a>
                <div class="auth-icon-wrap">
                    {{-- Key icon --}}
                    <svg viewBox="0 0 24 24">
                        <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/>
                    </svg>
                </div>
                <div class="auth-title">Reset Password</div>
                <div class="auth-sub">Choose a strong new password for your account.</div>
            </div>

            <div class="auth-body">
                <form wire:submit="resetPassword">

                    {{-- ── Account ── --}}
                    <div class="form-section">Account</div>

                    <div>
                        <label class="reg-label" for="email">Email Address</label>
                        <input
                            wire:model="email"
                            id="email" type="email" name="email"
                            class="reg-input @error('email') has-error @enderror"
                            placeholder="you@example.com"
                            required autofocus autocomplete="username"
                        >
                        @error('email') <span class="reg-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- ── New Password ── --}}
                    <div class="form-section" style="margin-top:.5rem;">New Password</div>

                    <div class="form-row-2">
                        <div>
                            <label class="reg-label" for="password">New Password</label>
                            <input
                                wire:model="password"
                                id="password" type="password" name="password"
                                class="reg-input @error('password') has-error @enderror"
                                placeholder="••••••••"
                                required autocomplete="new-password"
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
                                required autocomplete="new-password"
                            >
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="btn-reset">
                        <span wire:loading wire:target="resetPassword" class="btn-spinner"></span>
                        <svg wire:loading.remove wire:target="resetPassword" viewBox="0 0 24 24">
                            <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/>
                        </svg>
                        <span wire:loading.remove wire:target="resetPassword">Reset Password</span>
                        <span wire:loading wire:target="resetPassword">Resetting…</span>
                    </button>

                </form>
            </div>

            <div class="auth-footer">
                <a href="{{ route('login') }}" wire:navigate>
                    <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Back to Sign In
                </a>
            </div>

        </div>
    </div>

</div>