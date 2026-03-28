<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink($this->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        $this->reset('email');
        session()->flash('status', __($status));
    }
}; ?>

<div>
    <style>
        .auth-shell {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: var(--bg);
            padding: 2rem 1.5rem;
            position: relative; overflow: hidden;
        }
        .auth-shell::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(var(--border-soft) 1px, transparent 1px),
                linear-gradient(90deg, var(--border-soft) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none; z-index: 0;
        }
        .auth-shell::after {
            content: '';
            position: fixed;
            top: -20%; left: 50%; transform: translateX(-50%);
            width: 700px; height: 600px;
            background: radial-gradient(ellipse,
                var(--accentGlow, rgba(139,92,246,.12)) 0%, transparent 65%);
            pointer-events: none; z-index: 0;
        }

        .auth-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 420px;
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(0,0,0,0.35);
        }
        .auth-card::before {
            content: ''; display: block; height: 3px;
            background: linear-gradient(90deg,
                transparent 5%, var(--accent) 50%, transparent 95%);
        }

        .auth-header {
            padding: 1.75rem 2rem 1.25rem;
            text-align: center;
        }
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
        .auth-icon-wrap svg {
            width: 22px; height: 22px;
            stroke: var(--accent-text); fill: none; stroke-width: 1.6;
        }

        .auth-title {
            font-family: var(--font-display);
            font-size: 1.3rem; font-weight: 500;
            color: var(--text); margin-bottom: 0.35rem;
        }
        .auth-sub {
            font-size: 0.8rem; color: var(--text-faint);
            line-height: 1.65; max-width: 300px; margin: 0 auto;
        }

        .auth-body {
            padding: 0.5rem 2rem 2rem;
            display: flex; flex-direction: column; gap: 1rem;
        }

        .status-flash {
            display: flex; align-items: flex-start; gap: 0.65rem;
            padding: 0.85rem 1rem;
            background: rgba(74,222,128,0.08);
            border: 1px solid rgba(74,222,128,0.22);
            border-radius: 8px;
            font-size: 0.82rem; color: var(--success);
        }
        .status-flash svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        .reg-label {
            display: block;
            font-size: 0.75rem; font-weight: 500;
            color: var(--text-muted); margin-bottom: 0.3rem; letter-spacing: 0.03em;
        }
        .reg-input {
            width: 100%; background: var(--bg-3);
            border: 1px solid var(--border-soft); border-radius: 8px;
            padding: 0.65rem 0.9rem;
            font-size: 0.875rem; color: var(--text); font-family: var(--font-body);
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
        }
        .reg-input::placeholder { color: var(--text-faint); }
        .reg-input:focus { border-color: var(--border); box-shadow: 0 0 0 3px var(--accent-dim); }
        .reg-input.has-error { border-color: rgba(248,113,113,0.5); box-shadow: 0 0 0 3px rgba(248,113,113,0.08); }
        .reg-error { font-size: 0.7rem; color: var(--danger); margin-top: 0.25rem; display: block; }

        .btn-send {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--accent); color: var(--bg);
            border: none; border-radius: 8px;
            font-family: var(--font-body); font-size: 0.9rem; font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-send:hover:not(:disabled) {
            opacity: 0.88; transform: translateY(-1px);
            box-shadow: 0 6px 24px var(--accentGlow, rgba(0,0,0,0.25));
        }
        .btn-send:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-send svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }

        .btn-spinner {
            width: 14px; height: 14px; border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2); border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .auth-footer {
            padding: 1rem 2rem;
            border-top: 1px solid var(--border-soft);
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
                <a href="/" wire:navigate class="auth-logo">MLM<span>Pro</span></a>
                <div class="auth-icon-wrap">
                    <svg viewBox="0 0 24 24">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                </div>
                <div class="auth-title">Forgot Password?</div>
                <div class="auth-sub">
                    Enter your email and we'll send a link to reset your password.
                </div>
            </div>

            <div class="auth-body">

                @if(session('status'))
                    <div class="status-flash">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form wire:submit="sendPasswordResetLink">
                    <div style="margin-bottom: 1.25rem;">
                        <label class="reg-label" for="email">Email Address</label>
                        <input
                            wire:model="email"
                            id="email" type="email" name="email"
                            class="reg-input @error('email') has-error @enderror"
                            placeholder="you@example.com"
                            required autofocus
                        >
                        @error('email') <span class="reg-error">{{ $message }}</span> @enderror
                    </div>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="btn-send">
                        <span wire:loading wire:target="sendPasswordResetLink" class="btn-spinner"></span>
                        <svg wire:loading.remove wire:target="sendPasswordResetLink" viewBox="0 0 24 24">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                        <span wire:loading.remove wire:target="sendPasswordResetLink">Send Reset Link</span>
                        <span wire:loading wire:target="sendPasswordResetLink">Sending…</span>
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