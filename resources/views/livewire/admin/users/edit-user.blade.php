<div>
    <style>
        .form-wrap {
            max-width: 560px;
            margin: 0 auto;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.82rem;
            color: var(--text-faint);
            text-decoration: none;
            transition: color 0.2s;
            margin-bottom: 1.5rem;
        }
        .back-link:hover { color: var(--accent-text); }
        .back-link svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }

        .form-page-title {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.01em;
            margin-bottom: 0.35rem;
        }
        .form-page-sub {
            font-size: 0.82rem;
            color: var(--text-faint);
            margin-bottom: 1.75rem;
        }

        /* ── User identity strip ── */
        .user-identity {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.85rem 1.5rem;
            background: var(--accent-dim);
            border-bottom: 1px solid var(--border);
        }
        .user-identity-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: var(--bg-3);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.82rem; font-weight: 500;
            color: var(--accent-text);
            flex-shrink: 0;
        }
        .user-identity-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text);
        }
        .user-identity-id {
            font-size: 0.72rem;
            color: var(--text-faint);
            margin-top: 0.1rem;
        }

        .alert-success {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.9rem 1.1rem;
            background: rgba(74,222,128,0.08);
            border: 1px solid rgba(74,222,128,0.25);
            border-radius: 8px;
            font-size: 0.85rem;
            color: var(--success);
            margin-bottom: 1.25rem;
        }
        .alert-success svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        .form-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
        }

        .form-section-label {
            font-size: 0.65rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--text-faint);
            padding: 0.85rem 1.5rem 0.4rem;
            border-top: 1px solid var(--border-soft);
        }
        .form-section-label:first-child { border-top: none; padding-top: 1.25rem; }

        .form-fields {
            padding: 0 1.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        .field { display: flex; flex-direction: column; gap: 0.35rem; }

        .field-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.03em;
        }
        .field-label .req { color: var(--danger); margin-left: 2px; }
        .field-label .opt { color: var(--text-faint); font-weight: 300; margin-left: 4px; font-size: 0.72rem; }

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

        .field-hint { font-size: 0.72rem; color: var(--text-faint); }
        .field-error { font-size: 0.72rem; color: var(--danger); }

        /* ── Password change notice ── */
        .password-notice {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            padding: 0.65rem 0.85rem;
            background: rgba(251,191,36,0.07);
            border: 1px solid rgba(251,191,36,0.2);
            border-radius: 6px;
            font-size: 0.75rem;
            color: var(--warning);
        }
        .password-notice svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-3);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            padding: 0.6rem 1.2rem;
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.82rem;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.2s, border-color 0.2s;
        }
        .btn-cancel:hover { color: var(--text); border-color: var(--border); }

        .btn-submit {
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
        .btn-submit:hover:not(:disabled) { opacity: 0.88; transform: translateY(-1px); }
        .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; }

        .btn-spinner {
            width: 14px; height: 14px;
            border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2);
            border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>

    <div class="form-wrap">

        {{-- Back link --}}
        <a href="{{ route('admin.users.index') }}" wire:navigate class="back-link">
            <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Users
        </a>

        {{-- Page title --}}
        <div class="form-page-title">Edit User</div>
        <div class="form-page-sub">Update the user's role, details and password.</div>

        {{-- Success flash --}}
        @if(session()->has('message'))
            <div class="alert-success">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('message') }}
            </div>
        @endif

        {{-- Form card --}}
        <div class="form-card">

            {{-- User identity strip --}}
            <div class="user-identity">
                <div class="user-identity-avatar">
                    {{ strtoupper(substr($name ?? '?', 0, 2)) }}
                </div>
                <div>
                    <div class="user-identity-name">{{ $name ?? 'User' }}</div>
                    <div class="user-identity-id">ID #{{ $userId ?? '—' }}</div>
                </div>
            </div>

            <form wire:submit.prevent="updateUser">

                {{-- ── Account Type ── --}}
                <div class="form-section-label">Account Type</div>
                <div class="form-fields">
                    <div class="field">
                        <label class="field-label">
                            Role <span class="req">*</span>
                        </label>
                        <select wire:model.live="role" class="field-input @error('role') has-error @enderror">
                            <option value="user">Member</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- ── Personal Information ── --}}
                <div class="form-section-label">Personal Information</div>
                <div class="form-fields">

                    <div class="field">
                        <label class="field-label">
                            Full Name <span class="req">*</span>
                        </label>
                        <input
                            type="text"
                            wire:model.defer="name"
                            class="field-input @error('name') has-error @enderror"
                            placeholder="e.g. Priya Sharma"
                        >
                        @error('name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="field-label">
                            Email Address <span class="req">*</span>
                        </label>
                        <input
                            type="email"
                            wire:model.defer="email"
                            class="field-input @error('email') has-error @enderror"
                            placeholder="priya@example.com"
                        >
                        @error('email')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                {{-- ── Security ── --}}
                <div class="form-section-label">Change Password</div>
                <div class="form-fields">

                    <div class="password-notice">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Leave both fields blank to keep the current password unchanged.
                    </div>

                    <div class="field">
                        <label class="field-label">
                            New Password <span class="opt">(optional)</span>
                        </label>
                        <input
                            type="password"
                            wire:model.defer="password"
                            class="field-input @error('password') has-error @enderror"
                            placeholder="••••••••"
                        >
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @else
                            <span class="field-hint">Minimum 8 characters</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="field-label">
                            Confirm New Password <span class="opt">(optional)</span>
                        </label>
                        <input
                            type="password"
                            wire:model.defer="password_confirmation"
                            class="field-input @error('password_confirmation') has-error @enderror"
                            placeholder="••••••••"
                        >
                        @error('password_confirmation')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                {{-- ── Footer actions ── --}}
                <div class="form-footer">
                    <a href="{{ route('admin.users.index') }}"
                       wire:navigate
                       wire:loading.attr="disabled"
                       class="btn-cancel">
                        Cancel
                    </a>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="btn-submit">
                        <span wire:loading wire:target="updateUser" class="btn-spinner"></span>
                        <span wire:loading.remove wire:target="updateUser">Save Changes</span>
                        <span wire:loading wire:target="updateUser">Saving…</span>
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>