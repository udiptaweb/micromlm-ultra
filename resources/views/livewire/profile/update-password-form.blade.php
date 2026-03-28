<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password'         => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->dispatch('password-updated');
    }
}; ?>

<section>
    <style>
        .pw-fields {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .pw-field { display: flex; flex-direction: column; gap: 0.35rem; }

        .pw-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.03em;
        }

        .pw-input {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            font-size: 0.875rem;
            color: var(--text);
            font-family: var(--font-body);
            width: 100%;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .pw-input::placeholder { color: var(--text-faint); }
        .pw-input:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }
        .pw-input.has-error {
            border-color: rgba(248,113,113,0.5);
            box-shadow: 0 0 0 3px rgba(248,113,113,0.08);
        }

        .pw-error { font-size: 0.72rem; color: var(--danger); }
        .pw-hint  { font-size: 0.72rem; color: var(--text-faint); }

        /* Password notice */
        .pw-notice {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            padding: 0.65rem 0.85rem;
            background: rgba(251,191,36,0.07);
            border: 1px solid rgba(251,191,36,0.2);
            border-radius: 6px;
            font-size: 0.75rem;
            color: var(--warning);
            margin-bottom: 0.25rem;
        }
        .pw-notice svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        /* Footer row */
        .pw-footer {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-top: 0.5rem;
        }

        .btn-pw-save {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.4rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-pw-save:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-pw-save svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* Saved confirmation */
        .pw-saved {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.78rem;
            color: var(--success);
            opacity: 0;
            transition: opacity 0.4s;
        }
        .pw-saved.show { opacity: 1; }
        .pw-saved svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2.5; }
    </style>

    <form wire:submit="updatePassword">
        <div class="pw-fields">

            <div class="pw-notice">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Use a long, random password you don't use anywhere else.
            </div>

            {{-- Current password --}}
            <div class="pw-field">
                <label class="pw-label" for="update_password_current_password">
                    Current Password
                </label>
                <input
                    wire:model="current_password"
                    type="password"
                    id="update_password_current_password"
                    name="current_password"
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="pw-input @error('current_password') has-error @enderror"
                >
                @error('current_password')
                    <span class="pw-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- New password --}}
            <div class="pw-field">
                <label class="pw-label" for="update_password_password">
                    New Password
                </label>
                <input
                    wire:model="password"
                    type="password"
                    id="update_password_password"
                    name="password"
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="pw-input @error('password') has-error @enderror"
                >
                @error('password')
                    <span class="pw-error">{{ $message }}</span>
                @else
                    <span class="pw-hint">Minimum 8 characters recommended</span>
                @enderror
            </div>

            {{-- Confirm password --}}
            <div class="pw-field">
                <label class="pw-label" for="update_password_password_confirmation">
                    Confirm New Password
                </label>
                <input
                    wire:model="password_confirmation"
                    type="password"
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="pw-input @error('password_confirmation') has-error @enderror"
                >
                @error('password_confirmation')
                    <span class="pw-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="pw-footer">
                <button type="submit" class="btn-pw-save">
                    <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Update Password
                </button>

                <span
                    class="pw-saved"
                    id="pwSavedMsg"
                    x-data
                    x-on:password-updated.window="
                        $el.classList.add('show');
                        setTimeout(() => $el.classList.remove('show'), 3000);
                    ">
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Saved successfully
                </span>
            </div>

        </div>
    </form>
</section>