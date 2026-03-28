<div>
    <style>
        /* ══════════════════════════════════════
           LAYOUT
        ══════════════════════════════════════ */
        .profile-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 1.5rem;
            align-items: start;
        }
        @media (max-width: 900px) {
            .profile-layout { grid-template-columns: 1fr; }
        }

        /* ══════════════════════════════════════
           LEFT SIDEBAR — Identity card
        ══════════════════════════════════════ */
        .identity-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            overflow: hidden;
            position: sticky;
            top: 5.5rem;
        }

        /* Cover banner */
        .identity-cover {
            height: 80px;
            background: linear-gradient(135deg,
                var(--accent-dim) 0%,
                var(--bg-3) 100%);
            position: relative;
        }
        .identity-cover::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(var(--border-soft) 1px, transparent 1px),
                linear-gradient(90deg, var(--border-soft) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* Avatar */
        .identity-avatar-wrap {
            display: flex;
            justify-content: center;
            margin-top: -32px;
            position: relative;
            z-index: 1;
        }
        .identity-avatar {
            width: 64px; height: 64px;
            border-radius: 50%;
            background: var(--accent-dim);
            border: 3px solid var(--bg-2);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display);
            font-size: 1.4rem;
            font-weight: 500;
            color: var(--accent-text);
        }

        /* Rank badge overlaid on avatar */
        .rank-overlay {
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%) translateX(20px);
            white-space: nowrap;
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            padding: 0.12rem 0.45rem;
            border-radius: 3px;
            background: var(--accent);
            color: var(--bg);
        }

        .identity-body {
            padding: 0.75rem 1.25rem 1.25rem;
            text-align: center;
        }

        .identity-name {
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 0.2rem;
        }
        .identity-username {
            font-size: 0.75rem;
            color: var(--text-faint);
            margin-bottom: 0.85rem;
        }

        /* Stats row */
        .identity-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0;
            border: 1px solid var(--border-soft);
            border-radius: 9px;
            overflow: hidden;
            margin-bottom: 1rem;
        }
        .identity-stat {
            padding: 0.6rem 0.4rem;
            text-align: center;
            border-right: 1px solid var(--border-soft);
        }
        .identity-stat:last-child { border-right: none; }
        .stat-num {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--accent-text);
            line-height: 1;
            margin-bottom: 0.2rem;
        }
        .stat-lbl {
            font-size: 0.6rem;
            color: var(--text-faint);
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        /* Meta list */
        .identity-meta {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            text-align: left;
        }
        .meta-row {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            font-size: 0.78rem;
        }
        .meta-icon {
            width: 28px; height: 28px;
            border-radius: 6px;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .meta-icon svg {
            width: 13px; height: 13px;
            stroke: var(--accent-text); fill: none; stroke-width: 1.8;
        }
        .meta-label { font-size: 0.65rem; color: var(--text-faint); }
        .meta-value { font-size: 0.78rem; color: var(--text-muted); margin-top: 0.05rem; }

        /* Divider inside card */
        .card-divider {
            height: 1px;
            background: var(--border-soft);
            margin: 0.85rem 0;
        }

        /* Sponsor link */
        .sponsor-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.7rem;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 0.72rem;
            color: var(--accent-text);
            text-decoration: none;
            transition: background 0.15s;
        }
        .sponsor-chip:hover { background: var(--border); }
        .sponsor-chip svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* Binary position badge */
        .position-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.68rem;
            padding: 0.18rem 0.5rem;
            border-radius: 4px;
            font-weight: 500;
        }
        .pos-left  { background: rgba(59,130,246,.1); color: #60a5fa; border: 1px solid rgba(59,130,246,.22); }
        .pos-right { background: rgba(168,85,247,.1); color: #c084fc; border: 1px solid rgba(168,85,247,.22); }

        /* Private badge */
        .private-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.65rem;
            color: var(--text-faint);
            padding: 0.15rem 0.45rem;
            border-radius: 3px;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
        }
        .private-badge svg { width: 10px; height: 10px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ══════════════════════════════════════
           RIGHT COLUMN
        ══════════════════════════════════════ */
        .profile-right {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        /* ── Panel ── */
        .panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
        }
        .panel-header {
            padding: 0.9rem 1.25rem;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .panel-title {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 500;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .panel-title svg {
            width: 15px; height: 15px;
            stroke: var(--accent-text); fill: none; stroke-width: 1.8;
        }
        .panel-body { padding: 1.25rem; }

        /* ── Wallet cards ── */
        .wallet-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
        }
        @media (max-width: 600px) { .wallet-grid { grid-template-columns: 1fr; } }

        .wallet-card {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 9px;
            padding: 0.9rem 1rem;
            position: relative;
            overflow: hidden;
        }
        .wallet-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: var(--w-stripe, var(--accent));
        }
        .w-label {
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.4rem;
        }
        .w-amount {
            font-family: var(--font-display);
            font-size: 1.3rem;
            font-weight: 500;
            line-height: 1;
        }

        /* ── Commission table ── */
        .comm-table { width: 100%; border-collapse: collapse; font-size: 0.82rem; }
        .comm-table thead th {
            padding: 0.55rem 1rem;
            text-align: left;
            font-size: 0.62rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-faint);
            border-bottom: 1px solid var(--border-soft);
            background: var(--bg-3);
        }
        .comm-table tbody td {
            padding: 0.75rem 1rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
        }
        .comm-table tbody tr:last-child td { border-bottom: none; }
        .comm-table tbody tr:hover td { background: var(--accent-dim); }

        .type-pill {
            display: inline-block;
            padding: 0.15rem 0.5rem;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 500;
            background: var(--accent-dim);
            color: var(--accent-text);
            border: 1px solid var(--border);
            text-transform: capitalize;
        }
        .amount-pos { font-weight: 500; color: var(--success); }

        .status-badge {
            display: inline-block;
            padding: 0.15rem 0.5rem;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 500;
        }
        .badge-paid     { background: rgba(74,222,128,.1);  color: var(--success); border: 1px solid rgba(74,222,128,.22); }
        .badge-approved { background: rgba(96,165,250,.1);  color: #60a5fa;        border: 1px solid rgba(96,165,250,.22); }
        .badge-pending  { background: rgba(251,191,36,.1);  color: var(--warning); border: 1px solid rgba(251,191,36,.22); }

        /* ── Downline tab nav ── */
        .tab-row {
            display: flex;
            gap: 0;
            border-bottom: 1px solid var(--border-soft);
        }
        .tab-btn {
            padding: 0.6rem 1rem;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            font-size: 0.78rem;
            color: var(--text-faint);
            cursor: pointer;
            font-family: var(--font-body);
            transition: color 0.15s, border-color 0.15s;
            margin-bottom: -1px;
        }
        .tab-btn.active { color: var(--accent-text); border-bottom-color: var(--accent); }
        .tab-btn:hover:not(.active) { color: var(--text-muted); }

        /* ── Downline member cards ── */
        .downline-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 0.75rem;
            padding: 1rem 1.25rem;
        }

        .downline-card {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 9px;
            padding: 0.85rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            transition: border-color 0.2s, transform 0.15s;
        }
        .downline-card:hover { border-color: var(--border); transform: translateY(-1px); }

        .dl-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem; font-weight: 500;
            color: var(--accent-text);
            flex-shrink: 0;
            font-family: var(--font-display);
        }
        .dl-name {
            font-size: 0.82rem;
            color: var(--text);
            font-weight: 400;
            margin-bottom: 0.15rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dl-meta {
            font-size: 0.65rem;
            color: var(--text-faint);
            display: flex;
            align-items: center;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        /* ── Binary tree mini visualiser ── */
        .binary-mini {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.25rem;
            gap: 0;
        }
        .bm-node {
            background: var(--accent-dim);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.4rem 0.85rem;
            font-size: 0.75rem;
            color: var(--accent-text);
            font-weight: 500;
            text-align: center;
            min-width: 110px;
            position: relative;
            z-index: 1;
        }
        .bm-node.is-self {
            background: var(--accent);
            color: var(--bg);
            border-color: var(--accent);
        }
        .bm-connector-v {
            width: 2px; height: 20px;
            background: linear-gradient(to bottom, var(--accent), transparent);
            opacity: 0.4;
        }
        .bm-children-row {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            position: relative;
        }
        .bm-children-row::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--accent), transparent);
            opacity: 0.3;
        }
        .bm-child-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
        }
        .bm-connector-child {
            width: 2px; height: 16px;
            background: var(--accent);
            opacity: 0.3;
        }
        .bm-empty {
            border: 1px dashed var(--border-soft);
            border-radius: 8px;
            padding: 0.35rem 0.85rem;
            font-size: 0.68rem;
            color: var(--text-faint);
            min-width: 110px;
            text-align: center;
            opacity: 0.5;
        }
        .bm-leg-label {
            font-size: 0.6rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.3rem;
        }

        /* ── Empty state ── */
        .empty-inline {
            padding: 2rem 1.25rem;
            text-align: center;
            color: var(--text-faint);
            font-size: 0.82rem;
        }
        .empty-inline svg {
            width: 32px; height: 32px;
            stroke: currentColor; fill: none; stroke-width: 1.4;
            margin: 0 auto 0.6rem; display: block; opacity: 0.4;
        }

        /* Admin action bar */
        .admin-bar {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.65rem 1.25rem;
            background: rgba(251,191,36,.05);
            border-bottom: 1px solid rgba(251,191,36,.15);
            font-size: 0.75rem;
            color: var(--warning);
            flex-wrap: wrap;
        }
        .admin-bar svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }
        .admin-bar a {
            color: var(--accent-text);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.25rem 0.65rem;
            border-radius: 5px;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            transition: background 0.15s;
            margin-left: auto;
        }
        .admin-bar a:hover { background: var(--border); }
    </style>

    {{-- ═══ ADMIN ACTION BAR ═══ --}}
    @if($isAdmin)
        <div class="admin-bar">
            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Admin view — full financial details visible
            <a href="{{ route('admin.users.edit', ['userId' => $member->id]) }}" wire:navigate>
                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit Member
            </a>
        </div>
    @endif

    <div class="profile-layout">

        {{-- ══════════════════════════════════
             LEFT — Identity card
        ══════════════════════════════════ --}}
        <aside>
            <div class="identity-card">

                {{-- Cover + avatar --}}
                <div class="identity-cover"></div>
                <div class="identity-avatar-wrap">
                    <div style="position:relative;">
                        <div class="identity-avatar">
                            {{ strtoupper(substr($member->name, 0, 2)) }}
                        </div>
                        @if($member->rank)
                            <div class="rank-overlay"
                                 style="background: {{ $member->rank->badge_color ?? 'var(--accent)' }};">
                                {{ $member->rank->name }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="identity-body">
                    <div class="identity-name">{{ $member->name }}</div>
                    <div class="identity-username">
                        @if($member->username) {{ $member->username }} @else ID #{{ $member->id }} @endif
                    </div>

                    {{-- Stats row --}}
                    <div class="identity-stats">
                        <div class="identity-stat">
                            <div class="stat-num">{{ $directDownlines->count() }}</div>
                            <div class="stat-lbl">Directs</div>
                        </div>
                        <div class="identity-stat">
                            <div class="stat-num">{{ $teamCount }}</div>
                            <div class="stat-lbl">Team</div>
                        </div>
                        <div class="identity-stat">
                            <div class="stat-num">{{ $member->rank?->level ?? 0 }}</div>
                            <div class="stat-lbl">Rank</div>
                        </div>
                    </div>

                    {{-- Meta details --}}
                    <div class="identity-meta">

                        {{-- Email --}}
                        @if($canSeeFinancials || $isAdmin)
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div>
                                <div class="meta-label">Email</div>
                                <div class="meta-value">{{ $member->email }}</div>
                            </div>
                        </div>
                        @endif

                        {{-- Phone --}}
                        @if($member->profile?->phone)
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.96a16 16 0 0 0 6.29 6.29l1.34-1.34a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div>
                                <div class="meta-label">Phone</div>
                                <div class="meta-value">{{ $member->profile->phone }}</div>
                            </div>
                        </div>
                        @endif

                        {{-- Address --}}
                        @if($member->profile?->address)
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <div class="meta-label">Address</div>
                                <div class="meta-value">{{ $member->profile->address }}</div>
                            </div>
                        </div>
                        @endif

                        {{-- Joined --}}
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </div>
                            <div>
                                <div class="meta-label">Joined</div>
                                <div class="meta-value">{{ $member->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>

                        <div class="card-divider"></div>

                        {{-- Sponsor --}}
                        <div class="meta-row" style="align-items:center;">
                            <div class="meta-icon">
                                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <div>
                                <div class="meta-label">Sponsor</div>
                                @if($member->sponsor)
                                    <a href="{{ route('member.profile', $member->sponsor->id) }}"
                                       wire:navigate
                                       class="sponsor-chip" style="margin-top:.3rem;">
                                        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                        {{ $member->sponsor->name }}
                                    </a>
                                @else
                                    <div class="meta-value">Root / No sponsor</div>
                                @endif
                            </div>
                        </div>

                        {{-- Binary position --}}
                        @if($member->binary_position && $member->binaryParent)
                        <div class="meta-row" style="align-items:center;">
                            <div class="meta-icon">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="5" y2="17"/><line x1="12" y1="12" x2="19" y2="17"/></svg>
                            </div>
                            <div>
                                <div class="meta-label">Tree Position</div>
                                <div style="display:flex;align-items:center;gap:.4rem;margin-top:.25rem;flex-wrap:wrap;">
                                    <span class="position-badge {{ $member->binary_position === 'left' ? 'pos-left' : 'pos-right' }}">
                                        {{ ucfirst($member->binary_position) }} leg
                                    </span>
                                    <span style="font-size:.68rem;color:var(--text-faint);">
                                        under {{ $member->binaryParent->name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Referral code --}}
                        @if($member->referral_code)
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                            </div>
                            <div>
                                <div class="meta-label">Referral Code</div>
                                <div class="meta-value" style="font-family:var(--font-mono,monospace);letter-spacing:.06em;">
                                    {{ $member->referral_code }}
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </aside>

        {{-- ══════════════════════════════════
             RIGHT — Content panels
        ══════════════════════════════════ --}}
        <div class="profile-right">

            {{-- ── WALLETS — admin/owner only ── --}}
            @if($canSeeFinancials)
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24"><path d="M20 12V22H4V12"/><path d="M22 7H2v5h20V7z"/></svg>
                        Wallet Balances
                    </div>
                    @if(!$isOwner)
                        <span class="private-badge">
                            <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Admin only
                        </span>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="wallet-grid">
                        <div class="wallet-card" style="--w-stripe: var(--accent);">
                            <div class="w-label">Main Wallet</div>
                            <div class="w-amount" style="color:var(--accent-text);">
                                ₹{{ number_format($member->mainWallet?->balance ?? 0, 2) }}
                            </div>
                        </div>
                        <div class="wallet-card" style="--w-stripe: var(--success);">
                            <div class="w-label">Commission</div>
                            <div class="w-amount" style="color:var(--success);">
                                ₹{{ number_format($member->commissionWallet?->balance ?? 0, 2) }}
                            </div>
                        </div>
                        <div class="wallet-card" style="--w-stripe: var(--warning);">
                            <div class="w-label">Bonus</div>
                            <div class="w-amount" style="color:var(--warning);">
                                ₹{{ number_format($member->bonusWallet?->balance ?? 0, 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- ── PAYOUT ACCOUNTS — admin only ── --}}
            @if($isAdmin && $payoutInfos->isNotEmpty())
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        Payout Accounts
                    </div>
                    <span class="private-badge">
                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Admin only
                    </span>
                </div>
                <div class="panel-body" style="display:flex;flex-direction:column;gap:0.85rem;">
                    @foreach($payoutInfos as $method => $accounts)
                        @foreach($accounts as $info)
                            <div style="background:var(--bg-3);border:1px solid var(--border-soft);border-radius:9px;overflow:hidden;">
                                {{-- Card header --}}
                                <div style="display:flex;align-items:center;gap:0.5rem;padding:0.6rem 1rem;border-bottom:1px solid var(--border-soft);">
                                    {{-- Method pill --}}
                                    <span style="font-size:.62rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;padding:.12rem .45rem;border-radius:3px;
                                        @if($info->method==='bank')   background:rgba(59,130,246,.1);color:#60a5fa;border:1px solid rgba(59,130,246,.2);
                                        @elseif($info->method==='upi') background:rgba(34,197,94,.1);color:#4ade80;border:1px solid rgba(34,197,94,.2);
                                        @else                          background:rgba(251,191,36,.1);color:var(--warning);border:1px solid rgba(251,191,36,.2);
                                        @endif">{{ strtoupper($info->method) }}</span>

                                    @if($info->label)
                                        <span style="font-size:.8rem;color:var(--text);font-weight:500;">{{ $info->label }}</span>
                                    @endif

                                    @if($info->is_default)
                                        <span style="font-size:.6rem;padding:.1rem .4rem;border-radius:3px;background:var(--accent-dim);color:var(--accent-text);border:1px solid var(--border);margin-left:auto;">Default</span>
                                    @endif
                                </div>

                                {{-- Details --}}
                                <div style="padding:0.65rem 1rem;display:flex;flex-direction:column;gap:0.3rem;">
                                    @if($info->method === 'bank')
                                        <div style="display:grid;grid-template-columns:100px 1fr;font-size:.78rem;gap:.25rem;">
                                            <span style="color:var(--text-faint);">Bank</span>
                                            <span style="color:var(--text-muted);">{{ $info->bank_name }}</span>
                                        </div>
                                        <div style="display:grid;grid-template-columns:100px 1fr;font-size:.78rem;gap:.25rem;">
                                            <span style="color:var(--text-faint);">Account Holder</span>
                                            <span style="color:var(--text-muted);">{{ $info->account_holder }}</span>
                                        </div>
                                        <div style="display:grid;grid-template-columns:100px 1fr;font-size:.78rem;gap:.25rem;">
                                            <span style="color:var(--text-faint);">Account No.</span>
                                            <span style="color:var(--text-muted);font-family:var(--font-mono,monospace);letter-spacing:.04em;">{{ $info->account_number }}</span>
                                        </div>
                                        <div style="display:grid;grid-template-columns:100px 1fr;font-size:.78rem;gap:.25rem;">
                                            <span style="color:var(--text-faint);">IFSC</span>
                                            <span style="color:var(--text-muted);font-family:var(--font-mono,monospace);">{{ $info->ifsc_code }}</span>
                                        </div>
                                        @if($info->branch)
                                        <div style="display:grid;grid-template-columns:100px 1fr;font-size:.78rem;gap:.25rem;">
                                            <span style="color:var(--text-faint);">Branch</span>
                                            <span style="color:var(--text-muted);">{{ $info->branch }}</span>
                                        </div>
                                        @endif

                                    @elseif($info->method === 'upi')
                                        <div style="display:grid;grid-template-columns:100px 1fr;font-size:.78rem;gap:.25rem;">
                                            <span style="color:var(--text-faint);">UPI ID</span>
                                            <span style="color:var(--text-muted);font-family:var(--font-mono,monospace);">{{ $info->upi_id }}</span>
                                        </div>

                                    @elseif($info->method === 'crypto')
                                        <div style="display:grid;grid-template-columns:100px 1fr;font-size:.78rem;gap:.25rem;">
                                            <span style="color:var(--text-faint);">Network</span>
                                            <span style="color:var(--text-muted);">{{ $info->crypto_network }}</span>
                                        </div>
                                        <div style="display:grid;grid-template-columns:100px 1fr;font-size:.78rem;gap:.25rem;">
                                            <span style="color:var(--text-faint);">Address</span>
                                            <span style="color:var(--text-muted);font-family:var(--font-mono,monospace);font-size:.72rem;word-break:break-all;">{{ $info->wallet_address }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            @elseif($isAdmin && $payoutInfos->isEmpty())
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        Payout Accounts
                    </div>
                    <span class="private-badge">
                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Admin only
                    </span>
                </div>
                <div style="text-align:center;padding:2rem 1.25rem;color:var(--text-faint);font-size:.82rem;">
                    <svg viewBox="0 0 24 24" style="width:32px;height:32px;stroke:currentColor;fill:none;stroke-width:1.4;margin:0 auto .6rem;display:block;opacity:.4;"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                    This member has not saved any payout accounts yet
                </div>
            </div>
            @endif

            {{-- ── RECENT COMMISSIONS — admin/owner only ── --}}
            @if($canSeeFinancials && $recentCommissions->count())
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        Recent Commissions
                    </div>
                    <a href="{{ $isAdmin ? route('admin.user-commissions') : route('commissions') }}"
                       wire:navigate
                       style="font-size:.75rem;color:var(--accent-text);text-decoration:none;">
                        View all →
                    </a>
                </div>
                <div style="overflow-x:auto;">
                    <table class="comm-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>From</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentCommissions as $c)
                            <tr>
                                <td style="font-size:.75rem;white-space:nowrap;">
                                    {{ $c->created_at->format('M d, Y') }}
                                </td>
                                <td>
                                    <span class="type-pill">{{ str_replace('_',' ',$c->type) }}</span>
                                </td>
                                <td style="font-size:.78rem;">{{ $c->fromUser?->name ?? 'System' }}</td>
                                <td class="amount-pos">₹{{ number_format($c->amount, 2) }}</td>
                                <td>
                                    <span class="status-badge
                                        @if($c->status==='paid') badge-paid
                                        @elseif($c->status==='approved') badge-approved
                                        @else badge-pending @endif">
                                        {{ ucfirst($c->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- ── BINARY TREE MINI VIEW ── --}}
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="5" y2="17"/><line x1="12" y1="12" x2="19" y2="17"/></svg>
                        Binary Tree Position
                    </div>
                    <a href="{{ route('genealogy') }}" wire:navigate
                       style="font-size:.75rem;color:var(--accent-text);text-decoration:none;">
                        Full tree →
                    </a>
                </div>
                <div class="binary-mini">
                    @php
                        $leftChild  = $member->leftChild  ?? null;
                        $rightChild = $member->rightChild ?? null;
                    @endphp

                    {{-- Self node --}}
                    <div class="bm-node is-self">
                        {{ $member->name }}
                        <div style="font-size:.6rem;opacity:.7;margin-top:.1rem;">
                            {{ $member->rank?->name ?? 'Member' }}
                        </div>
                    </div>

                    @if($leftChild || $rightChild)
                        <div class="bm-connector-v"></div>
                        <div class="bm-children-row">

                            {{-- Left child --}}
                            <div class="bm-child-wrap">
                                <div class="bm-leg-label">Left</div>
                                <div class="bm-connector-child"></div>
                                @if($leftChild)
                                    <a href="{{ route('member.profile', $leftChild->id) }}"
                                       wire:navigate
                                       style="text-decoration:none;">
                                        <div class="bm-node">
                                            {{ $leftChild->name }}
                                            <div style="font-size:.6rem;opacity:.7;margin-top:.1rem;">
                                                {{ $leftChild->rank?->name ?? 'Member' }}
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <div class="bm-empty">Open slot</div>
                                @endif
                            </div>

                            {{-- Right child --}}
                            <div class="bm-child-wrap">
                                <div class="bm-leg-label">Right</div>
                                <div class="bm-connector-child"></div>
                                @if($rightChild)
                                    <a href="{{ route('member.profile', $rightChild->id) }}"
                                       wire:navigate
                                       style="text-decoration:none;">
                                        <div class="bm-node">
                                            {{ $rightChild->name }}
                                            <div style="font-size:.6rem;opacity:.7;margin-top:.1rem;">
                                                {{ $rightChild->rank?->name ?? 'Member' }}
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <div class="bm-empty">Open slot</div>
                                @endif
                            </div>

                        </div>
                    @else
                        <div style="margin-top:.75rem;font-size:.78rem;color:var(--text-faint);">
                            No direct binary children yet
                        </div>
                    @endif
                </div>
            </div>

            {{-- ── DIRECT DOWNLINES ── --}}
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Downline
                    </div>
                    <span style="font-size:.75rem;color:var(--text-faint);">
                        {{ $directDownlines->count() }} direct
                        @if($teamCount > $directDownlines->count())
                            · {{ $teamCount }} total team
                        @endif
                    </span>
                </div>

                {{-- Tabs --}}
                <div class="tab-row">
                    <button
                        wire:click="$set('downlineTab','direct')"
                        class="tab-btn {{ $downlineTab === 'direct' ? 'active' : '' }}">
                        Direct ({{ $directDownlines->count() }})
                    </button>
                </div>

                @if($directDownlines->count())
                    <div class="downline-grid">
                        @foreach($directDownlines as $dl)
                            <a href="{{ route('member.profile', $dl->id) }}"
                               wire:navigate
                               class="downline-card">
                                <div class="dl-avatar">
                                    {{ strtoupper(substr($dl->name, 0, 2)) }}
                                </div>
                                <div style="min-width:0;">
                                    <div class="dl-name">{{ $dl->name }}</div>
                                    <div class="dl-meta">
                                        @if($dl->rank)
                                            <span style="color:{{ $dl->rank->badge_color ?? 'var(--accent-text)' }};">
                                                {{ $dl->rank->name }}
                                            </span>
                                            <span>·</span>
                                        @endif
                                        <span>{{ $dl->created_at->format('M Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="empty-inline">
                        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        No direct referrals yet
                    </div>
                @endif
            </div>

        </div>
    </div>

</div>