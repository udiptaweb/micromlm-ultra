<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <style>
        /* ── Page shell ── */
        .login-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg, #0A0A0F);
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Background grid pattern */
        .login-shell::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(var(--border-soft, rgba(255,255,255,.06)) 1px, transparent 1px),
                linear-gradient(90deg, var(--border-soft, rgba(255,255,255,.06)) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        /* Glow blob */
        .login-shell::after {
            content: '';
            position: fixed;
            top: -20%; left: 50%; transform: translateX(-50%);
            width: 700px; height: 600px;
            background: radial-gradient(ellipse, var(--accentGlow, rgba(139,92,246,.12)) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── Card ── */
        .login-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 420px;
            background: var(--bg-2, #111118);
            border: 1px solid var(--border-soft, rgba(255,255,255,.06));
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(0,0,0,0.4);
        }

        /* Top accent line */
        .login-card::before {
            content: '';
            display: block; height: 3px;
            background: linear-gradient(90deg,
                transparent 5%,
                var(--accent, #8b5cf6) 50%,
                transparent 95%);
        }

        /* ── Card header ── */
        .login-header {
            padding: 2rem 2rem 1.25rem;
            text-align: center;
        }
        .login-logo {
            font-family: var(--font-display, 'Cormorant Garamond', serif);
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--accent, #8b5cf6);
            letter-spacing: 0.03em;
            margin-bottom: 1.25rem;
            display: block;
        }
        .login-logo span {
            color: var(--text, #F0EDE6);
            font-weight: 300;
        }
        .login-title {
            font-family: var(--font-display, serif);
            font-size: 1.4rem;
            font-weight: 500;
            color: var(--text, #F0EDE6);
            margin-bottom: 0.3rem;
        }
        .login-sub {
            font-size: 0.8rem;
            color: var(--text-faint, rgba(240,237,230,.25));
        }

        /* ── Form body ── */
        .login-body {
            padding: 0.5rem 2rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* Session status */
        .session-status {
            padding: 0.75rem 1rem;
            background: rgba(74,222,128,.08);
            border: 1px solid rgba(74,222,128,.22);
            border-radius: 8px;
            font-size: 0.82rem;
            color: var(--success, #4ade80);
        }

        /* ── Fields ── */
        .field { display: flex; flex-direction: column; gap: 0.35rem; }

        .field-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted, rgba(240,237,230,.5));
            letter-spacing: 0.03em;
        }

        .field-input {
            background: var(--bg-3, #18181f);
            border: 1px solid var(--border-soft, rgba(255,255,255,.06));
            border-radius: 8px;
            padding: 0.68rem 0.9rem;
            font-size: 0.875rem;
            color: var(--text, #F0EDE6);
            font-family: var(--font-body, 'DM Sans', sans-serif);
            width: 100%;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field-input::placeholder { color: var(--text-faint, rgba(240,237,230,.25)); }
        .field-input:focus {
            border-color: var(--border, rgba(139,92,246,.18));
            box-shadow: 0 0 0 3px var(--accent-dim, rgba(139,92,246,.12));
        }
        .field-error {
            font-size: 0.72rem;
            color: var(--danger, #f87171);
        }

        /* ── Remember row ── */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.55rem;
        }
        .remember-row input[type="checkbox"] {
            width: 15px; height: 15px;
            accent-color: var(--accent, #8b5cf6);
            cursor: pointer;
            flex-shrink: 0;
        }
        .remember-label {
            font-size: 0.8rem;
            color: var(--text-faint, rgba(240,237,230,.25));
            cursor: pointer;
            user-select: none;
        }

        /* ── Actions row ── */
        .login-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 0.25rem;
        }

        .forgot-link {
            font-size: 0.78rem;
            color: var(--text-faint, rgba(240,237,230,.25));
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: var(--accent-text, #c4b5fd); }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.75rem;
            background: var(--accent, #8b5cf6);
            color: var(--bg, #0A0A0F);
            border: none;
            border-radius: 8px;
            font-family: var(--font-body, 'DM Sans', sans-serif);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-login:hover {
            opacity: 0.88;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px var(--accentGlow, rgba(139,92,246,.25));
        }
        .btn-login:active { transform: translateY(0); }
        .btn-login:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-login svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }

        .btn-spinner {
            width: 14px; height: 14px;
            border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2);
            border-top-color: var(--bg, #0A0A0F);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Footer ── */
        .login-footer {
            padding: 1rem 2rem;
            border-top: 1px solid var(--border-soft, rgba(255,255,255,.06));
            text-align: center;
            background: var(--bg-3, #18181f);
            font-size: 0.78rem;
            color: var(--text-faint, rgba(240,237,230,.25));
        }
        .login-footer a {
            color: var(--accent-text, #c4b5fd);
            text-decoration: none;
            transition: color 0.2s;
        }
        .login-footer a:hover { color: var(--accent, #8b5cf6); }
    </style>

    <div class="login-shell">
        <div class="login-card">

            {{-- Header --}}
            <div class="login-header">
                <span class="login-logo">MLM<span>Pro</span></span>
                <div class="login-title">Welcome back</div>
                <div class="login-sub">Sign in to access your dashboard</div>
            </div>

            <div class="login-body">

                {{-- Session status --}}
                @if(session('status'))
                    <div class="session-status">{{ session('status') }}</div>
                @endif

                <form wire:submit="login">

                    {{-- Email --}}
                    <div class="field" style="margin-bottom:1rem;">
                        <label class="field-label" for="email">Email Address</label>
                        <input
                            wire:model="form.email"
                            id="email"
                            type="email"
                            name="email"
                            class="field-input"
                            placeholder="you@example.com"
                            required
                            autofocus
                            autocomplete="username"
                        >
                        @error('form.email')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="field" style="margin-bottom:1rem;">
                        <label class="field-label" for="password">Password</label>
                        <input
                            wire:model="form.password"
                            id="password"
                            type="password"
                            name="password"
                            class="field-input"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                        @error('form.password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Remember me --}}
                    <div class="remember-row" style="margin-bottom:1.25rem;">
                        <input
                            wire:model="form.remember"
                            id="remember"
                            type="checkbox"
                            name="remember"
                        >
                        <label class="remember-label" for="remember">Remember me</label>
                    </div>

                    {{-- Actions --}}
                    <div class="login-actions">
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" wire:navigate class="forgot-link">
                                Forgot password?
                            </a>
                        @else
                            <span></span>
                        @endif

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="btn-login">
                            <span wire:loading wire:target="login" class="btn-spinner"></span>
                            <svg wire:loading.remove wire:target="login" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                                <polyline points="10 17 15 12 10 7"/>
                                <line x1="15" y1="12" x2="3" y2="12"/>
                            </svg>
                            <span wire:loading.remove wire:target="login">Sign In</span>
                            <span wire:loading wire:target="login">Signing in…</span>
                        </button>
                    </div>

                </form>
            </div>

            {{-- Footer --}}
            @if(Route::has('register'))
                <div class="login-footer">
                    Don't have an account?
                    <a href="{{ route('register') }}" wire:navigate>Create one</a>
                </div>
            @endif

        </div>
    </div>

</div>