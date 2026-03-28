<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    // Set the default to 'member' on mount
    public function mount(): void
    {
        $this->setRole('member');
    }

    public function setRole(string $role): void
    {
        if ($role === 'admin') {
            $this->form->email = 'admin@micromlm.com';
            $this->form->password = 'password';
        } else {
            $this->form->email = 'root@micromlm.com';
            $this->form->password = 'password';
        }
    }

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
        /* ... existing styles ... */
        .login-shell { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #0A0A0F; padding: 1.5rem; position: relative; overflow: hidden; }
        .login-shell::before { content: ''; position: fixed; inset: 0; background-image: linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px); background-size: 60px 60px; pointer-events: none; z-index: 0; }
        .login-card { position: relative; z-index: 1; width: 100%; max-width: 420px; background: #111118; border: 1px solid rgba(255,255,255,.06); border-radius: 16px; overflow: hidden; box-shadow: 0 32px 80px rgba(0,0,0,0.4); }
        .login-card::before { content: ''; display: block; height: 3px; background: linear-gradient(90deg, transparent 5%, #8b5cf6 50%, transparent 95%); }
        .login-header { padding: 2rem 2rem 1.25rem; text-align: center; }
        .login-logo { font-size: 1.6rem; font-weight: 500; color: #8b5cf6; margin-bottom: 1.25rem; display: block; }
        .login-logo span { color: #F0EDE6; font-weight: 300; }
        .login-body { padding: 0.5rem 2rem 2rem; display: flex; flex-direction: column; gap: 1rem; }
        .field { display: flex; flex-direction: column; gap: 0.35rem; }
        .field-label { font-size: 0.78rem; font-weight: 500; color: rgba(240,237,230,.5); }
        .field-input { background: #18181f; border: 1px solid rgba(255,255,255,.06); border-radius: 8px; padding: 0.68rem 0.9rem; font-size: 0.875rem; color: #F0EDE6; width: 100%; outline: none; }
        .btn-login { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.7rem 1.75rem; background: #8b5cf6; color: #0A0A0F; border: none; border-radius: 8px; font-weight: 500; cursor: pointer; }
        
        /* ── Role Switcher Styles ── */
        .role-switcher {
            display: flex;
            background: #18181f;
            padding: 4px;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255,255,255,.04);
        }
        .role-btn {
            flex: 1;
            padding: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            color: rgba(240,237,230,.4);
            background: transparent;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            transition: all 0.2s;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .role-btn.active {
            background: rgba(139,92,246, 0.1);
            color: #8b5cf6;
            box-shadow: inset 0 0 0 1px rgba(139,92,246, 0.2);
        }
        /* ── End Role Switcher Styles ── */

        .login-footer { padding: 1rem 2rem; border-top: 1px solid rgba(255,255,255,.06); text-align: center; background: #18181f; font-size: 0.78rem; color: rgba(240,237,230,.25); }
    </style>

    <div class="login-shell">
        <div class="login-card">
            <div class="login-header">
                <span class="login-logo">MLM<span>Pro</span></span>
                <div style="font-size: 1.4rem; color: #F0EDE6; margin-bottom: 0.3rem;">Demo Login</div>
                <div style="font-size: 0.8rem; color: rgba(240,237,230,.25);">Select a role to auto-fill credentials</div>
            </div>

            <div class="login-body">
                {{-- Role Switcher --}}
                <div class="role-switcher">
                    <button type="button" 
                        wire:click="setRole('member')" 
                        class="role-btn {{ $form->email === 'root@micromlm.com' ? 'active' : '' }}">
                        Member
                    </button>
                    <button type="button" 
                        wire:click="setRole('admin')" 
                        class="role-btn {{ $form->email === 'admin@micromlm.com' ? 'active' : '' }}">
                        Admin
                    </button>
                </div>

                @if(session('status'))
                    <div style="padding: 0.75rem 1rem; background: rgba(74,222,128,.08); border: 1px solid rgba(74,222,128,.22); border-radius: 8px; color: #4ade80; font-size: 0.82rem; margin-bottom: 1rem;">
                        {{ session('status') }}
                    </div>
                @endif

                <form wire:submit="login">
                    <div class="field" style="margin-bottom:1rem;">
                        <label class="field-label" for="email">Email Address</label>
                        <input wire:model="form.email" id="email" type="email" class="field-input" required>
                        @error('form.email') <span style="color: #f87171; font-size: 0.72rem;">{{ $message }}</span> @enderror
                    </div>

                    <div class="field" style="margin-bottom:1rem;">
                        <label class="field-label" for="password">Password</label>
                        <input wire:model="form.password" id="password" type="password" class="field-input" required>
                        @error('form.password') <span style="color: #f87171; font-size: 0.72rem;">{{ $message }}</span> @enderror
                    </div>

                    <div class="login-actions">
                        <div style="display:flex; align-items:center; gap:0.5rem;">
                            <input wire:model="form.remember" id="remember" type="checkbox" style="accent-color: #8b5cf6;">
                            <label for="remember" style="color: rgba(240,237,230,.25); font-size: 0.8rem;">Remember</label>
                        </div>

                        <button type="submit" wire:loading.attr="disabled" class="btn-login">
                            <span wire:loading.remove wire:target="login">Sign In</span>
                            <span wire:loading wire:target="login">...</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="login-footer">
                Viewing MLM Demo Version 1.0
            </div>
        </div>
    </div>
</div>