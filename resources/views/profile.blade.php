<x-app-layout>
    <x-slot name="header">Profile</x-slot>

    <style>
        .profile-stack {
            max-width: 640px;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        /* ── Section panels ── */
        .profile-panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
        }

        .profile-panel-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .profile-panel-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .profile-panel-icon svg {
            width: 15px; height: 15px;
            stroke: var(--accent-text); fill: none; stroke-width: 1.8;
        }
        .profile-panel-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.02em;
        }
        .profile-panel-sub {
            font-size: 0.75rem;
            color: var(--text-faint);
            margin-top: 0.1rem;
        }

        .profile-panel-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* ── User identity row ── */
        .user-identity {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            background: var(--accent-dim);
            border-bottom: 1px solid var(--border);
        }
        .user-avatar-lg {
            width: 46px; height: 46px;
            border-radius: 50%;
            background: var(--bg-3);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; font-weight: 500;
            color: var(--accent-text);
            flex-shrink: 0;
            font-family: var(--font-display);
        }
        .user-identity-name {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text);
        }
        .user-identity-email {
            font-size: 0.72rem;
            color: var(--text-faint);
            margin-top: 0.1rem;
        }

        /* ── Fields ── */
        .field { display: flex; flex-direction: column; gap: 0.35rem; }

        .field-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.03em;
        }
        .field-label .req { color: var(--danger); margin-left: 2px; }

        .field-input {
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
        .field-input::placeholder { color: var(--text-faint); }
        .field-input:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }
        .field-input.has-error {
            border-color: rgba(248,113,113,0.5);
            box-shadow: 0 0 0 3px rgba(248,113,113,0.08);
        }
        .field-error { font-size: 0.72rem; color: var(--danger); }
        .field-hint  { font-size: 0.72rem; color: var(--text-faint); }

        /* ── Alerts ── */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
        }
        .alert svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }
        .alert-success { background: rgba(74,222,128,0.08); border: 1px solid rgba(74,222,128,0.22); color: var(--success); }
        .alert-error   { background: rgba(248,113,113,0.08); border: 1px solid rgba(248,113,113,0.22); color: var(--danger); }

        /* ── Footer ── */
        .panel-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-3);
        }

        .btn-save {
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
        .btn-save:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-save svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Danger zone (delete account) ── */
        .danger-zone-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(248,113,113,0.15);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(248,113,113,0.04);
        }
        .danger-zone-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: rgba(248,113,113,0.1);
            border: 1px solid rgba(248,113,113,0.22);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .danger-zone-icon svg {
            width: 15px; height: 15px;
            stroke: var(--danger); fill: none; stroke-width: 1.8;
        }
        .danger-zone-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--danger);
        }
        .danger-zone-sub {
            font-size: 0.75rem;
            color: var(--text-faint);
            margin-top: 0.1rem;
        }

        .danger-panel {
            background: var(--bg-2);
            border: 1px solid rgba(248,113,113,0.2);
            border-radius: 12px;
            overflow: hidden;
        }
    </style>

    <div class="profile-stack">

        {{-- ═══════════════════════════════
             PANEL 1 — PROFILE INFO
        ═══════════════════════════════ --}}
        <div class="profile-panel">

            {{-- User identity strip --}}
            <div class="user-identity">
                <div class="user-avatar-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div>
                    <div class="user-identity-name">{{ auth()->user()->name }}</div>
                    <div class="user-identity-email">{{ auth()->user()->email }}</div>
                </div>
            </div>

            {{-- Header --}}
            <div class="profile-panel-header">
                <div class="profile-panel-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div>
                    <div class="profile-panel-title">Personal Details</div>
                    <div class="profile-panel-sub">Your contact and address information</div>
                </div>
            </div>

            {{-- Flash --}}
            @if(session('success'))
                <div style="padding: 0 1.5rem; padding-top: 1rem;">
                    <div class="alert alert-success">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf

                <div class="profile-panel-body">

                    {{-- Read-only name & email --}}
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                        <div class="field">
                            <label class="field-label">Full Name</label>
                            <input type="text" class="field-input" value="{{ auth()->user()->name }}" disabled
                                   style="opacity:0.5; cursor:not-allowed;">
                        </div>
                        <div class="field">
                            <label class="field-label">Email Address</label>
                            <input type="email" class="field-input" value="{{ auth()->user()->email }}" disabled
                                   style="opacity:0.5; cursor:not-allowed;">
                        </div>
                    </div>

                    {{-- Editable fields --}}
                    <div class="field">
                        <label class="field-label" for="phone">Phone Number</label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone', $user->profile->phone ?? '') }}"
                            placeholder="+91 98765 43210"
                            class="field-input @error('phone') has-error @enderror"
                        >
                        @error('phone')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="field-label" for="address">Address</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            value="{{ old('address', $user->profile->address ?? '') }}"
                            placeholder="Street, City, State, PIN"
                            class="field-input @error('address') has-error @enderror"
                        >
                        @error('address')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="panel-footer">
                    <button type="submit" class="btn-save">
                        <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- ═══════════════════════════════
             PANEL 2 — UPDATE PASSWORD
        ═══════════════════════════════ --}}
        <div class="profile-panel">
            <div class="profile-panel-header">
                <div class="profile-panel-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div>
                    <div class="profile-panel-title">Change Password</div>
                    <div class="profile-panel-sub">Update your account password</div>
                </div>
            </div>
            <div class="profile-panel-body">
                <livewire:profile.update-password-form />
            </div>
        </div>

        {{-- ═══════════════════════════════
             PANEL 3 — DELETE ACCOUNT
        ═══════════════════════════════ --}}
        <div class="danger-panel">
            <div class="danger-zone-header">
                <div class="danger-zone-icon">
                    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                </div>
                <div>
                    <div class="danger-zone-title">Delete Account</div>
                    <div class="danger-zone-sub">Permanently remove your account and all data</div>
                </div>
            </div>
            <div class="profile-panel-body">
                <livewire:profile.delete-user-form />
            </div>
        </div>

    </div>

</x-app-layout>