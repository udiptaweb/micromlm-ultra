<div>
    <style>
        /* ── Page header ── */
        .settings-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .page-title {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.01em;
            margin-bottom: 0.25rem;
        }

        .page-sub {
            font-size: 0.82rem;
            color: var(--text-faint);
        }

        /* ── Save button ── */
        .btn-save-main {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.4rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            flex-shrink: 0;
        }

        .btn-save-main:hover {
            opacity: 0.88;
            transform: translateY(-1px);
        }

        .btn-save-main:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-save-main svg {
            width: 15px;
            height: 15px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        .btn-spinner {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 2px solid rgba(0, 0, 0, 0.2);
            border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ── Flash ── */
        .alert-success {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.9rem 1.1rem;
            background: rgba(74, 222, 128, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.25);
            border-radius: 8px;
            font-size: 0.85rem;
            color: var(--success);
            margin-bottom: 1.25rem;
        }

        .alert-success svg {
            width: 15px;
            height: 15px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ── Tab nav ── */
        .tab-nav {
            display: flex;
            gap: 0;
            border-bottom: 1px solid var(--border-soft);
            margin-bottom: 1.5rem;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .tab-nav::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.65rem 1.1rem;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            font-family: var(--font-body);
            font-size: 0.82rem;
            color: var(--text-faint);
            cursor: pointer;
            white-space: nowrap;
            transition: color 0.2s, border-color 0.2s;
            margin-bottom: -1px;
        }

        .tab-btn:hover {
            color: var(--text-muted);
        }

        .tab-btn.active {
            color: var(--accent-text);
            border-bottom-color: var(--accent);
        }

        .tab-btn svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
        }

        /* ── Settings panels ── */
        .settings-panel {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .settings-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
        }

        .card-section-label {
            font-size: 0.65rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--text-faint);
            padding: 0.85rem 1.5rem 0.4rem;
            border-top: 1px solid var(--border-soft);
        }

        .card-section-label:first-child {
            border-top: none;
            padding-top: 1.25rem;
        }

        .card-fields {
            padding: 0 1.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .field-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .field-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        @media (max-width: 700px) {

            .field-grid-2,
            .field-grid-3 {
                grid-template-columns: 1fr;
            }
        }

        /* ── Fields ── */
        .field {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .field-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.03em;
        }

        .field-hint {
            font-size: 0.7rem;
            color: var(--text-faint);
        }

        .field-error {
            font-size: 0.7rem;
            color: var(--danger);
        }

        .field-input,
        .field-select {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.62rem 0.9rem;
            font-size: 0.875rem;
            color: var(--text);
            font-family: var(--font-body);
            width: 100%;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field-input:focus,
        .field-select:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }

        .field-input.has-error {
            border-color: rgba(248, 113, 113, 0.5);
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.08);
        }

        /* ── Toggle rows ── */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-soft);
        }

        .toggle-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .toggle-row:first-child {
            padding-top: 0;
        }

        .toggle-info {
            flex: 1;
        }

        .toggle-label {
            font-size: 0.85rem;
            color: var(--text);
            font-weight: 400;
        }

        .toggle-sub {
            font-size: 0.72rem;
            color: var(--text-faint);
            margin-top: 0.1rem;
        }

        /* Custom toggle switch */
        .toggle-switch {
            position: relative;
            width: 40px;
            height: 22px;
            flex-shrink: 0;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-track {
            position: absolute;
            inset: 0;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 11px;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }

        .toggle-track::after {
            content: '';
            position: absolute;
            left: 3px;
            top: 2px;
            width: 16px;
            height: 16px;
            background: var(--text-faint);
            border-radius: 50%;
            transition: transform 0.2s, background 0.2s;
        }

        .toggle-switch input:checked+.toggle-track {
            background: var(--accent-dim);
            border-color: var(--accent);
        }

        .toggle-switch input:checked+.toggle-track::after {
            transform: translateX(18px);
            background: var(--accent);
        }

        /* ── Level rate table ── */
        .level-table {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            overflow: hidden;
        }

        .level-table-head {
            display: flex;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid var(--border-soft);
        }

        .level-table-head span {
            font-size: 0.63rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-faint);
            flex: 1;
        }

        .level-table-row {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            gap: 1rem;
            border-bottom: 1px solid var(--border-soft);
        }

        .level-table-row:last-child {
            border-bottom: none;
        }

        .level-num {
            flex: 1;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .level-input {
            flex: 1;
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 6px;
            padding: 0.4rem 0.65rem;
            font-size: 0.82rem;
            color: var(--text);
            font-family: var(--font-body);
            outline: none;
            transition: border-color 0.2s;
            width: 100%;
        }

        .level-input:focus {
            border-color: var(--border);
        }

        /* ── Days checkboxes ── */
        .days-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .day-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.75rem;
            border-radius: 6px;
            font-size: 0.78rem;
            cursor: pointer;
            border: 1px solid var(--border-soft);
            background: var(--bg-3);
            color: var(--text-muted);
            transition: background 0.15s, border-color 0.15s, color 0.15s;
            user-select: none;
        }

        .day-chip input {
            display: none;
        }

        .day-chip.checked {
            background: var(--accent-dim);
            border-color: var(--accent);
            color: var(--accent-text);
        }

        /* ── Info box ── */
        .info-box {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            padding: 0.75rem 1rem;
            background: rgba(251, 191, 36, 0.07);
            border: 1px solid rgba(251, 191, 36, 0.18);
            border-radius: 8px;
            font-size: 0.8rem;
            color: var(--warning);
            line-height: 1.5;
        }

        .info-box svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            flex-shrink: 0;
            margin-top: 1px;
        }
    </style>

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="settings-header">
        <div>
            <div class="page-title">MLM Settings</div>
            <div class="page-sub">Configure commission plans, genealogy, wallet, registration and security rules</div>
        </div>
        <button wire:click="saveSettings" wire:loading.attr="disabled" class="btn-save-main">
            <span wire:loading wire:target="saveSettings" class="btn-spinner"></span>
            <svg wire:loading.remove wire:target="saveSettings" viewBox="0 0 24 24">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                <polyline points="17 21 17 13 7 13 7 21" />
                <polyline points="7 3 7 8 15 8" />
            </svg>
            <span wire:loading.remove wire:target="saveSettings">Save All Settings</span>
            <span wire:loading wire:target="saveSettings">Saving…</span>
        </button>
    </div>

    {{-- Flash --}}
    @if (session()->has('settings_saved'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
            {{ session('settings_saved') }}
        </div>
    @endif

    {{-- ═══ TAB NAV ═══ --}}
    <div class="tab-nav">
        @php
            $tabs = [
                'genealogy' => [
                    'icon' =>
                        '<circle cx="12" cy="5" r="2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="5" y2="17"/><line x1="12" y1="12" x2="19" y2="17"/>',
                    'label' => 'Genealogy',
                ],
                'commission' => [
                    'icon' =>
                        '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
                    'label' => 'Commissions',
                ],
                // 'wallet' => ['icon' => '<path d="M20 12V22H4V12"/><path d="M22 7H2v5h20V7z"/>', 'label' => 'Wallet'],
                'registration' => [
                    'icon' =>
                        '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>',
                    'label' => 'Registration',
                ],
                'security' => [
                    'icon' => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
                    'label' => 'Security',
                ],
                'payout' => [
                    'icon' => '<rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>',
                    'label' => 'Payout',
                ],
                'ranks' => [
                    'icon' =>
                        '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
                    'label' => 'Ranks',
                ],
            ];
        @endphp
        @foreach ($tabs as $key => $tab)
            <button wire:click="setTab('{{ $key }}')"
                class="tab-btn {{ $activeTab === $key ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">{!! $tab['icon'] !!}</svg>
                {{ $tab['label'] }}
            </button>
        @endforeach
    </div>

    {{-- ═══════════════════════════════
         TAB: GENEALOGY
    ═══════════════════════════════ --}}
    @if ($activeTab === 'genealogy')
        <div class="settings-panel">
            <div class="settings-card">
                <div class="card-section-label">Network Structure</div>
                <div class="card-fields">
                    <div class="field-grid-3">
                        <div class="field">
                            <label class="field-label">Plan Type</label>
                            <select wire:model.live="genealogy_type" class="field-select">
                                <option value="binary">Binary</option>
                                <option value="unilevel">Unilevel</option>
                                <option value="matrix">Matrix</option>
                            </select>
                            @error('genealogy_type')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="field-label">Max Display Levels</label>
                            <input type="number" wire:model.live="genealogy_max_levels" min="1" max="20"
                                class="field-input @error('genealogy_max_levels') has-error @enderror">
                            @error('genealogy_max_levels')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="toggle-row">
                        <div class="toggle-info">
                            <div class="toggle-label">Enable Spillover</div>
                            <div class="toggle-sub">Auto-place new members into available positions below existing
                                downlines</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" wire:model.live="genealogy_spillover">
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                    @if ($genealogy_type == 'binary')
                        <div class="card-section-label"
                            style="padding:0.75rem 0 0.4rem; border-top: 1px solid var(--border-soft);">Member Placement
                        </div>

                        <div class="toggle-row">
                            <div class="toggle-info">
                                <div class="toggle-label">Auto Placement</div>
                                <div class="toggle-sub">Automatically place new members in the next available binary
                                    position. Disable to let sponsors place members manually.</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" wire:model.live="binary_auto_placement">
                                <span class="toggle-track"></span>
                            </label>
                        </div>

                        @if ($binary_auto_placement)
                            <div class="field" style="max-width:280px;">
                                <label class="field-label">Placement Preference</label>
                                <select wire:model.live="binary_placement_preference" class="field-select">
                                    <option value="left">Left leg first</option>
                                    <option value="right">Right leg first</option>
                                    <option value="balanced">Balanced (weaker leg)</option>
                                </select>
                                <span class="field-hint">
                                    @if ($binary_placement_preference === 'left')
                                        Fills left leg positions before right leg.
                                    @elseif($binary_placement_preference === 'right')
                                        Fills right leg positions before left leg.
                                    @else
                                        Places the new member in whichever leg currently has fewer members.
                                    @endif
                                </span>
                                @error('binary_placement_preference')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════
         TAB: COMMISSIONS
    ═══════════════════════════════ --}}
    @if ($activeTab === 'commission')
        <div class="settings-panel">

            {{-- Direct Referral --}}
            <div class="settings-card">
                <div class="card-section-label">Direct Referral Commission</div>
                <div class="card-fields">
                    <div class="toggle-row">
                        <div class="toggle-info">
                            <div class="toggle-label">Enable Direct Referral Commission</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" wire:model.live="direct_enabled">
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                    @if ($direct_enabled)
                        <div class="field-grid-2">
                            <div class="field">
                                <label class="field-label">Commission Rate</label>
                                <input type="number" step="0.01" wire:model.live="direct_rate" min="0"
                                    class="field-input @error('direct_rate') has-error @enderror">
                                @error('direct_rate')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field">
                                <label class="field-label">Rate Type</label>
                                <select wire:model.live="direct_type" class="field-select">
                                    <option value="percentage">Percentage (%)</option>
                                    <option value="fixed">Fixed Amount (₹)</option>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Binary --}}
            <div class="settings-card">
                <div class="card-section-label">Binary Commission</div>
                <div class="card-fields">
                    <div class="toggle-row">
                        <div class="toggle-info">
                            <div class="toggle-label">Enable Binary Commission</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" wire:model.live="binary_enabled">
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                    @if ($binary_enabled)
                        <div class="field">
                            <label class="field-label">Amount Earned Per Pair (₹)</label>
                            <input type="number" wire:model.live="binary_pair_amount" min="0"
                                class="field-input @error('binary_pair_amount') has-error @enderror"
                                style="max-width:200px;">
                            @error('binary_pair_amount')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="card-section-label"
                            style="padding:0.75rem 0 0.4rem; border-top: 1px solid var(--border-soft);">Capping Limits
                        </div>
                        <div class="toggle-row">
                            <div class="toggle-info">
                                <div class="toggle-label">Enable Capping</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" wire:model.live="binary_capping_enabled">
                                <span class="toggle-track"></span>
                            </label>
                        </div>
                        @if ($binary_capping_enabled)
                            <div class="field-grid-3">
                                <div class="field">
                                    <label class="field-label">Daily Limit (₹)</label>
                                    <input type="number" wire:model.live="binary_capping_daily_limit"
                                        class="field-input @error('binary_capping_daily_limit') has-error @enderror">
                                    @error('binary_capping_daily_limit')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="field-label">Weekly Limit (₹)</label>
                                    <input type="number" wire:model.live="binary_capping_weekly_limit"
                                        class="field-input @error('binary_capping_weekly_limit') has-error @enderror">
                                    @error('binary_capping_weekly_limit')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="field-label">Monthly Limit (₹)</label>
                                    <input type="number" wire:model.live="binary_capping_monthly_limit"
                                        class="field-input @error('binary_capping_monthly_limit') has-error @enderror">
                                    @error('binary_capping_monthly_limit')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="card-section-label"
                            style="padding:0.75rem 0 0.4rem; border-top: 1px solid var(--border-soft);">Matching Bonus
                        </div>
                        <div class="toggle-row">
                            <div class="toggle-info">
                                <div class="toggle-label">Enable Matching Bonus</div>
                                <div class="toggle-sub">% of downline's binary commission paid to upline</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" wire:model.live="binary_matching_enabled">
                                <span class="toggle-track"></span>
                            </label>
                        </div>
                        @if ($binary_matching_enabled)
                            <div class="level-table">
                                <div class="level-table-head">
                                    <span>Level</span><span>Matching % of downline commission</span>
                                </div>
                                @foreach ($binary_matching_levels as $lvl => $rate)
                                    <div class="level-table-row">
                                        <span class="level-num">Level {{ $lvl }}</span>
                                        <input type="number" step="0.01" min="0" max="100"
                                            wire:model.live="binary_matching_levels.{{ $lvl }}"
                                            class="level-input">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Matrix --}}
            <div class="settings-card">
                <div class="card-section-label">Matrix Commission</div>
                <div class="card-fields">
                    <div class="toggle-row">
                        <div class="toggle-info">
                            <div class="toggle-label">Enable Matrix Commission</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" wire:model.live="matrix_enabled">
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                    @if ($matrix_enabled)
                        <div class="field-grid-2">
                            <div class="field">
                                <label class="field-label">Matrix Width (max direct referrals)</label>
                                <input type="number" wire:model.live="matrix_width" min="1" max="10"
                                    class="field-input @error('matrix_width') has-error @enderror">
                                @error('matrix_width')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field">
                                <label class="field-label">Matrix Depth (commission levels)</label>
                                <input type="number" wire:model.live="matrix_depth" min="1" max="10"
                                    class="field-input @error('matrix_depth') has-error @enderror">
                                @error('matrix_depth')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="level-table">
                            <div class="level-table-head">
                                <span>Level</span><span>Commission %</span>
                            </div>
                            @foreach ($matrix_levels as $lvl => $rate)
                                <div class="level-table-row">
                                    <span class="level-num">Level {{ $lvl }}</span>
                                    <input type="number" step="0.01" min="0" max="100"
                                        wire:model.live="matrix_levels.{{ $lvl }}" class="level-input">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Unilevel --}}
            <div class="settings-card">
                <div class="card-section-label">Unilevel Commission</div>
                <div class="card-fields">
                    <div class="toggle-row">
                        <div class="toggle-info">
                            <div class="toggle-label">Enable Unilevel Commission</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" wire:model.live="unilevel_enabled">
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                    @if ($unilevel_enabled)
                        <div class="level-table">
                            <div class="level-table-head">
                                <span>Level</span><span>Commission %</span>
                            </div>
                            @foreach ($unilevel_levels as $lvl => $rate)
                                <div class="level-table-row">
                                    <span class="level-num">Level {{ $lvl }}</span>
                                    <input type="number" step="0.01" min="0" max="100"
                                        wire:model.live="unilevel_levels.{{ $lvl }}" class="level-input">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    @endif

    {{-- ═══════════════════════════════
         TAB: WALLET
    ═══════════════════════════════ --}}
    {{-- @if ($activeTab === 'wallet')
        <div class="settings-panel">
            <div class="settings-card">
                <div class="card-section-label">Withdrawal Settings</div>
                <div class="card-fields">
                    <div class="field-grid-3">
                        <div class="field">
                            <label class="field-label">Minimum Withdrawal (₹)</label>
                            <input type="number" wire:model.live="wallet_minimum_withdrawal" min="1"
                                class="field-input @error('wallet_minimum_withdrawal') has-error @enderror">
                            @error('wallet_minimum_withdrawal')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="field-label">Withdrawal Fee (%)</label>
                            <input type="number" step="0.01" wire:model.live="wallet_withdrawal_fee" min="0"
                                max="100"
                                class="field-input @error('wallet_withdrawal_fee') has-error @enderror">
                            @error('wallet_withdrawal_fee')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="field-label">Processing Days</label>
                            <input type="number" wire:model.live="wallet_withdrawal_processing_days" min="1"
                                class="field-input @error('wallet_withdrawal_processing_days') has-error @enderror">
                            @error('wallet_withdrawal_processing_days')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}

    {{-- ═══════════════════════════════
         TAB: REGISTRATION
    ═══════════════════════════════ --}}
    @if ($activeTab === 'registration')
        <div class="settings-panel">
            <div class="settings-card">
                <div class="card-section-label">Sponsor & Placement</div>
                <div class="card-fields">
                    <div class="toggle-row">
                        <div class="toggle-info">
                            <div class="toggle-label">Require Sponsor at Registration</div>
                            <div class="toggle-sub">Members must enter a referral code to register</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" wire:model.live="reg_require_sponsor">
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                    <div class="field">
                        <label class="field-label">Default Sponsor Username</label>
                        <input type="text" wire:model.live="reg_default_sponsor"
                            class="field-input @error('reg_default_sponsor') has-error @enderror"
                            placeholder="admin">
                        <span class="field-hint">Used when no sponsor is provided or referral code is invalid</span>
                        @error('reg_default_sponsor')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="info-box">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        <span><strong>Auto Placement</strong> and <strong>Placement Preference</strong> are binary plan
                            settings. You'll find them in the <strong>Commissions → Binary</strong> tab.</span>
                    </div>
                    <div class="toggle-row">
                        <div class="toggle-info">
                            <div class="toggle-label">Require Email Verification</div>
                            <div class="toggle-sub">New members must verify their email before accessing the platform
                            </div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" wire:model.live="reg_email_verification">
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════
         TAB: SECURITY
    ═══════════════════════════════ --}}
    @if ($activeTab === 'security')
        <div class="settings-panel">
            <div class="settings-card">
                <div class="card-section-label">Login & Session</div>
                <div class="card-fields">
                    <div class="field-grid-3">
                        <div class="field">
                            <label class="field-label">Max Login Attempts</label>
                            <input type="number" wire:model.live="sec_max_login_attempts" min="1"
                                class="field-input @error('sec_max_login_attempts') has-error @enderror">
                            @error('sec_max_login_attempts')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="field-label">Lockout Duration (minutes)</label>
                            <input type="number" wire:model.live="sec_lockout_duration" min="1"
                                class="field-input @error('sec_lockout_duration') has-error @enderror">
                            @error('sec_lockout_duration')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="field-label">Session Timeout (minutes)</label>
                            <input type="number" wire:model.live="sec_session_timeout" min="1"
                                class="field-input @error('sec_session_timeout') has-error @enderror">
                            @error('sec_session_timeout')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="toggle-row">
                        <div class="toggle-info">
                            <div class="toggle-label">Require Two-Factor Authentication (2FA)</div>
                            <div class="toggle-sub">Force all users to enable 2FA on their accounts</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" wire:model.live="sec_require_2fa">
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════
         TAB: PAYOUT
    ═══════════════════════════════ --}}
    @if ($activeTab === 'payout')
        <div class="settings-panel">
            <div class="settings-card">
                <div class="card-section-label">Payout Rules</div>
                <div class="card-fields">
                    <div class="field-grid-2">
                        <div class="field">
                            <label class="field-label">Minimum Payout Amount (₹)</label>
                            <input type="number" wire:model.live="payout_min_amount" min="1"
                                class="field-input @error('payout_min_amount') has-error @enderror">
                            @error('payout_min_amount')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="field-label">Maximum Payout Amount (₹)</label>
                            <input type="number" wire:model.live="payout_max_amount" min="1"
                                class="field-input @error('payout_max_amount') has-error @enderror">
                            @error('payout_max_amount')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="field-label">Processing Charges (%)</label>
                            <input type="number" step="0.01" wire:model.live="payout_charges_percent" min="0"
                                max="100"
                                class="field-input @error('payout_charges_percent') has-error @enderror">
                            @error('payout_charges_percent')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="field-label">Processing Days</label>
                            <input type="number" wire:model.live="payout_processing_days" min="1"
                                class="field-input @error('payout_processing_days') has-error @enderror">
                            @error('payout_processing_days')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="field-label">Payout Allowed Days</label>
                        <div class="days-grid">
                            @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <label class="day-chip {{ in_array($day, $payout_allowed_days) ? 'checked' : '' }}">
                                    <input type="checkbox" value="{{ $day }}"
                                        wire:model.live="payout_allowed_days"
                                        @change="this.closest('.day-chip').classList.toggle('checked', this.checked)">
                                    {{ substr($day, 0, 3) }}
                                </label>
                            @endforeach
                        </div>
                        <span class="field-hint">Days on which payout requests are processed</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════
         TAB: RANKS
    ═══════════════════════════════ --}}
    @if ($activeTab === 'ranks')
        <div class="settings-panel">
            <div class="settings-card">
                <div class="card-section-label">Rank Upgrade Rules</div>
                <div class="card-fields">
                    <div class="toggle-row">
                        <div class="toggle-info">
                            <div class="toggle-label">Auto Rank Upgrade</div>
                            <div class="toggle-sub">System automatically upgrades member ranks when criteria are met
                            </div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" wire:model.live="ranks_auto_upgrade">
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                    <div class="field" style="max-width:220px;">
                        <label class="field-label">Check Interval</label>
                        <select wire:model.live="ranks_check_interval" class="field-select">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Rank levels (read-only display — edit via seeder/migration) --}}
            <div class="settings-card">
                <div class="card-section-label">Rank Levels (read-only — edit in config/mlm.php)</div>
                <div class="card-fields">
                    <div class="info-box">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Rank level criteria (minimum sales, team sales, directs, bonus amounts) are defined in
                        <code style="font-family:var(--font-mono,monospace);font-size:0.78rem;">config/mlm.php</code>
                        under <code
                            style="font-family:var(--font-mono,monospace);font-size:0.78rem;">ranks.rank_levels</code>.
                        Edit that file directly or seed the <code
                            style="font-family:var(--font-mono,monospace);font-size:0.78rem;">ranks</code> table to
                        change level thresholds.
                    </div>
                    <div style="overflow-x:auto;">
                        <table style="width:100%;border-collapse:collapse;font-size:0.82rem;">
                            <thead>
                                <tr>
                                    @foreach (['Rank', 'Min Sales', 'Team Sales', 'Min Directs', 'Bonus'] as $h)
                                        <th
                                            style="padding:0.55rem 0.85rem;text-align:left;font-size:0.63rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-faint);border-bottom:1px solid var(--border-soft);background:var(--bg-3);white-space:nowrap;">
                                            {{ $h }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (config('mlm.ranks.rank_levels') as $rank)
                                    <tr>
                                        <td
                                            style="padding:0.7rem 0.85rem;border-bottom:1px solid var(--border-soft);color:var(--text);">
                                            <span style="display:inline-flex;align-items:center;gap:0.4rem;">
                                                <span
                                                    style="width:8px;height:8px;border-radius:50%;background:var(--accent);display:inline-block;"></span>
                                                {{ $rank['name'] }}
                                            </span>
                                        </td>
                                        <td
                                            style="padding:0.7rem 0.85rem;border-bottom:1px solid var(--border-soft);color:var(--text-muted);">
                                            ₹{{ number_format($rank['minimum_sales']) }}</td>
                                        <td
                                            style="padding:0.7rem 0.85rem;border-bottom:1px solid var(--border-soft);color:var(--text-muted);">
                                            ₹{{ number_format($rank['minimum_team_sales']) }}</td>
                                        <td
                                            style="padding:0.7rem 0.85rem;border-bottom:1px solid var(--border-soft);color:var(--text-muted);">
                                            {{ $rank['minimum_directs'] }}</td>
                                        <td
                                            style="padding:0.7rem 0.85rem;border-bottom:1px solid var(--border-soft);color:var(--success);font-weight:500;">
                                            ₹{{ number_format($rank['bonus_amount']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
