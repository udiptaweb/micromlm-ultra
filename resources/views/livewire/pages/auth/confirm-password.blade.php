<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email'    => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
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
            width: 100%; max-width: 420px;
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

        /* Lock icon circle */
        .auth-icon-wrap {
            width: 52px; height: 52px; border-radius: 50%;
            background: var(--accent-dim); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .auth-icon-wrap svg { width: 22px; height: 22px; stroke: var(--accent-text); fill: none; stroke-width: 1.6; }

        .auth-title { font-family: var(--font-display); font-size: 1.3rem; font-weight: 500; color: var(--text); margin-bottom: 0.35rem; }
        .auth-sub   { font-size: 0.8rem; color: var(--text-faint); line-height: 1.65; max-width: 300px; margin: 0 auto; }

        /* Secure area notice */
        .secure-notice {
            display: flex; align-items: flex-start; gap: 0.6rem;
            padding: 0.75rem 1rem;
            background: rgba(251,191,36,0.07);
            border: 1px solid rgba(251,191,36,0.18);
            border-radius: 8px;
            font-size: 0.78rem; color: var(--warning); line-height: 1.55;
        }
        .secure-notice svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        .auth-body { padding: 0.5rem 2rem 2rem; display: flex; flex-direction: column; gap: 1rem; }

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

        .btn-confirm {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--accent); color: var(--bg);
            border: none; border-radius: 8px;
            font-family: var(--font-body); font-size: 0.9rem; font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-confirm:hover:not(:disabled) {
            opacity: 0.88; transform: translateY(-1px);
            box-shadow: 0 6px 24px var(--accentGlow, rgba(0,0,0,0.25));
        }
        .btn-confirm:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-confirm svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }

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

            <div class="auth-header">
                <a href="{{ route('dashboard') }}" wire:navigate class="auth-logo">MLM<span>Pro</span></a>
                <div class="auth-icon-wrap">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
                <div class="auth-title">Confirm Password</div>
                <div class="auth-sub">Verify your identity to continue to the secure area.</div>
            </div>

            <div class="auth-body">

                {{-- Secure area advisory --}}
                <div class="secure-notice">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    This area requires password confirmation. Your session will be marked as verified for a limited time.
                </div>

                <form wire:submit="confirmPassword">

                    <div style="margin-bottom: 1.25rem;">
                        <label class="reg-label" for="password">Current Password</label>
                        <input
                            wire:model="password"
                            id="password" type="password" name="password"
                            class="reg-input @error('password') has-error @enderror"
                            placeholder="••••••••"
                            required autofocus autocomplete="current-password"
                        >
                        @error('password') <span class="reg-error">{{ $message }}</span> @enderror
                    </div>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="btn-confirm">
                        <span wire:loading wire:target="confirmPassword" class="btn-spinner"></span>
                        <svg wire:loading.remove wire:target="confirmPassword" viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <span wire:loading.remove wire:target="confirmPassword">Confirm &amp; Continue</span>
                        <span wire:loading wire:target="confirmPassword">Verifying…</span>
                    </button>

                </form>
            </div>

            <div class="auth-footer">
                <a href="{{ route('dashboard') }}" wire:navigate>
                    <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Back to Dashboard
                </a>
            </div>

        </div>
    </div>

</div>