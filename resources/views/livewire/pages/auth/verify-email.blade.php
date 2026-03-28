<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
            return;
        }

        Auth::user()->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
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

        /* Animated envelope icon */
        .auth-icon-wrap {
            width: 60px; height: 60px; border-radius: 50%;
            background: var(--accent-dim); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
            animation: float 3s ease-in-out infinite;
        }
        .auth-icon-wrap svg { width: 26px; height: 26px; stroke: var(--accent-text); fill: none; stroke-width: 1.5; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-5px); }
        }

        .auth-title { font-family: var(--font-display); font-size: 1.3rem; font-weight: 500; color: var(--text); margin-bottom: 0.35rem; }
        .auth-sub   { font-size: 0.82rem; color: var(--text-faint); line-height: 1.7; max-width: 320px; margin: 0 auto; }

        .auth-body { padding: 1rem 2rem 2rem; display: flex; flex-direction: column; gap: 1rem; }

        /* Email display chip */
        .email-chip {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.7rem 1rem;
            background: var(--bg-3); border: 1px solid var(--border-soft);
            border-radius: 9px; font-size: 0.82rem;
        }
        .email-chip svg { width: 14px; height: 14px; stroke: var(--accent-text); fill: none; stroke-width: 2; flex-shrink: 0; }
        .email-chip span { color: var(--text-muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .email-chip strong { color: var(--text); font-weight: 500; }

        /* Sent flash */
        .sent-flash {
            display: flex; align-items: flex-start; gap: 0.65rem;
            padding: 0.85rem 1rem;
            background: rgba(74,222,128,0.08); border: 1px solid rgba(74,222,128,0.22);
            border-radius: 8px; font-size: 0.82rem; color: var(--success);
        }
        .sent-flash svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        /* Steps */
        .steps {
            display: flex; flex-direction: column; gap: 0.55rem;
        }
        .step {
            display: flex; align-items: flex-start; gap: 0.65rem;
            font-size: 0.78rem; color: var(--text-faint); line-height: 1.55;
        }
        .step-num {
            width: 20px; height: 20px; border-radius: 50%;
            background: var(--accent-dim); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.62rem; font-weight: 600; color: var(--accent-text);
            flex-shrink: 0; margin-top: 1px;
        }

        /* Resend button */
        .btn-resend {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--accent); color: var(--bg);
            border: none; border-radius: 8px;
            font-family: var(--font-body); font-size: 0.875rem; font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-resend:hover:not(:disabled) {
            opacity: 0.88; transform: translateY(-1px);
            box-shadow: 0 6px 24px var(--accentGlow, rgba(0,0,0,0.25));
        }
        .btn-resend:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-resend svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }

        .btn-spinner {
            width: 14px; height: 14px; border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2); border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Footer */
        .auth-footer {
            padding: 1rem 2rem; border-top: 1px solid var(--border-soft);
            display: flex; align-items: center; justify-content: space-between;
            background: var(--bg-3); gap: 1rem; flex-wrap: wrap;
        }
        .footer-hint { font-size: 0.72rem; color: var(--text-faint); }

        .btn-logout {
            display: inline-flex; align-items: center; gap: 0.35rem;
            background: none; border: none;
            font-family: var(--font-body); font-size: 0.78rem;
            color: var(--text-faint); cursor: pointer;
            transition: color 0.2s; padding: 0;
        }
        .btn-logout:hover { color: var(--danger); }
        .btn-logout svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }
    </style>

    <div class="auth-shell">
        <div class="auth-card">

            {{-- Header --}}
            <div class="auth-header">
                <a href="{{ route('dashboard') }}" wire:navigate class="auth-logo">MLM<span>Pro</span></a>

                <div class="auth-icon-wrap">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                        {{-- Badge dot --}}
                        <circle cx="18" cy="5" r="3" style="fill:var(--accent);stroke:var(--bg-2);stroke-width:1.5;"/>
                    </svg>
                </div>

                <div class="auth-title">Check Your Email</div>
                <div class="auth-sub">
                    We've sent a verification link to your inbox. Click it to activate your account.
                </div>
            </div>

            <div class="auth-body">

                {{-- Sent confirmation flash --}}
                @if(session('status') === 'verification-link-sent')
                    <div class="sent-flash">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        A new verification link has been sent to your email address.
                    </div>
                @endif

                {{-- Email chip --}}
                <div class="email-chip">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <span>Sent to <strong>{{ Auth::user()->email }}</strong></span>
                </div>

                {{-- Steps --}}
                <div class="steps">
                    <div class="step">
                        <div class="step-num">1</div>
                        <span>Open your email app and find the message from us</span>
                    </div>
                    <div class="step">
                        <div class="step-num">2</div>
                        <span>Click the <strong style="color:var(--text);">Verify Email Address</strong> button in the email</span>
                    </div>
                    <div class="step">
                        <div class="step-num">3</div>
                        <span>You'll be redirected to your dashboard automatically</span>
                    </div>
                </div>

                {{-- Resend button --}}
                <button
                    wire:click="sendVerification"
                    wire:loading.attr="disabled"
                    class="btn-resend">
                    <span wire:loading wire:target="sendVerification" class="btn-spinner"></span>
                    <svg wire:loading.remove wire:target="sendVerification" viewBox="0 0 24 24">
                        <polyline points="1 4 1 10 7 10"/>
                        <path d="M3.51 15a9 9 0 1 0 .49-3.51"/>
                    </svg>
                    <span wire:loading.remove wire:target="sendVerification">Resend Verification Email</span>
                    <span wire:loading wire:target="sendVerification">Sending…</span>
                </button>

            </div>

            {{-- Footer --}}
            <div class="auth-footer">
                <span class="footer-hint">Wrong account?</span>
                <button wire:click="logout" class="btn-logout">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Sign out
                </button>
            </div>

        </div>
    </div>

</div>