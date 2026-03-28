<div>
    <style>
        .page-title { font-family:var(--font-display);font-size:1.6rem;font-weight:500;color:var(--text);margin-bottom:.25rem; }
        .page-sub   { font-size:.82rem;color:var(--text-faint);margin-bottom:1.5rem; }

        /* ── Config status bar ── */
        .config-bar {
            display:flex;align-items:center;gap:.65rem;flex-wrap:wrap;
            padding:.75rem 1rem;
            background:var(--bg-2);
            border:1px solid var(--border-soft);
            border-radius:9px;
            margin-bottom:1.25rem;
            font-size:.78rem;
        }
        .config-pill {
            display:inline-flex;align-items:center;gap:.35rem;
            padding:.22rem .65rem;border-radius:4px;font-size:.7rem;font-weight:500;
        }
        .pill-on  { background:rgba(74,222,128,.1);color:var(--success);border:1px solid rgba(74,222,128,.22); }
        .pill-off { background:rgba(248,113,113,.1);color:var(--danger);border:1px solid rgba(248,113,113,.22); }
        .pill-info{ background:var(--accent-dim);color:var(--accent-text);border:1px solid var(--border); }
        .config-pill svg { width:11px;height:11px;stroke:currentColor;fill:none;stroke-width:2.5; }
        .config-label { color:var(--text-faint); }

        /* ── Alerts ── */
        .alert { display:flex;align-items:flex-start;gap:.75rem;padding:.9rem 1.1rem;border-radius:8px;font-size:.85rem;margin-bottom:1rem; }
        .alert svg { width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;margin-top:1px; }
        .alert-success { background:rgba(74,222,128,.08);border:1px solid rgba(74,222,128,.25);color:var(--success); }
        .alert-error   { background:rgba(248,113,113,.08);border:1px solid rgba(248,113,113,.25);color:var(--danger); }

        /* ── Toolbar ── */
        .toolbar { display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem;flex-wrap:wrap; }
        .search-wrap { position:relative; }
        .search-wrap svg { position:absolute;left:.75rem;top:50%;transform:translateY(-50%);width:15px;height:15px;stroke:var(--text-faint);fill:none;stroke-width:2;pointer-events:none; }
        .search-input { background:var(--bg-2);border:1px solid var(--border-soft);border-radius:8px;padding:.6rem .9rem .6rem 2.2rem;font-size:.85rem;color:var(--text);font-family:var(--font-body);width:240px;outline:none;transition:border-color .2s,width .2s; }
        .search-input:focus { border-color:var(--border);width:280px; }
        .search-input::placeholder { color:var(--text-faint); }

        /* ── Panel ── */
        .panel { background:var(--bg-2);border:1px solid var(--border-soft);border-radius:12px;overflow:hidden; }
        .panel-header { padding:1rem 1.5rem;border-bottom:1px solid var(--border-soft);display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap; }
        .panel-title  { font-family:var(--font-display);font-size:1.05rem;font-weight:500;color:var(--text); }
        .count-badge  { display:inline-flex;align-items:center;padding:.18rem .6rem;border-radius:4px;font-size:.7rem;font-weight:600;background:rgba(251,191,36,.1);color:var(--warning);border:1px solid rgba(251,191,36,.22);margin-left:.5rem; }

        /* ── Table ── */
        .pl-table { width:100%;border-collapse:collapse;font-size:.85rem; }
        .pl-table thead th { padding:.65rem 1.25rem;text-align:left;font-size:.63rem;font-weight:500;letter-spacing:.14em;text-transform:uppercase;color:var(--text-faint);border-bottom:1px solid var(--border-soft);background:var(--bg-3);white-space:nowrap; }
        .pl-table tbody td { padding:.9rem 1.25rem;color:var(--text-muted);border-bottom:1px solid var(--border-soft);vertical-align:middle; }
        .pl-table tbody tr:last-child td { border-bottom:none; }
        .pl-table tbody tr:hover td { background:var(--accent-dim);color:var(--text); }

        .user-name { font-size:.85rem;color:var(--text);font-weight:400;margin-bottom:.15rem; }
        .user-meta { font-size:.7rem;color:var(--text-faint); }

        .unplaced-badge { display:inline-block;padding:.18rem .55rem;border-radius:4px;font-size:.65rem;font-weight:500;background:rgba(251,191,36,.1);color:var(--warning);border:1px solid rgba(251,191,36,.2); }

        .btn-place { display:inline-flex;align-items:center;gap:.35rem;padding:.38rem .85rem;background:var(--accent-dim);color:var(--accent-text);border:1px solid var(--border);border-radius:6px;font-size:.75rem;font-weight:500;cursor:pointer;font-family:var(--font-body);transition:background .2s; }
        .btn-place:hover { background:var(--border); }
        .btn-place svg { width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2; }

        /* ── Pagination ── */
        .pagination-wrap { padding:1rem 1.5rem;border-top:1px solid var(--border-soft); }
        .pagination-wrap nav span[aria-current] span,.pagination-wrap nav span[aria-current] { background:var(--accent)!important;color:var(--bg)!important;border-color:var(--accent)!important; }
        .pagination-wrap nav a { color:var(--text-muted)!important;background:var(--bg-2)!important;border-color:var(--border-soft)!important;transition:background .15s; }
        .pagination-wrap nav a:hover { background:var(--accent-dim)!important;color:var(--text)!important; }

        /* ── Empty ── */
        .empty-state { text-align:center;padding:3.5rem 1rem; }
        .empty-state svg { width:38px;height:38px;stroke:var(--text-faint);fill:none;stroke-width:1.4;margin:0 auto .85rem;display:block;opacity:.5; }
        .empty-state p { font-size:.875rem;color:var(--text-muted); }

        /* ═══════════════════════════
           MODAL
        ═══════════════════════════ */
        .modal-overlay { position:fixed;inset:0;background:rgba(0,0,0,.55);backdrop-filter:blur(4px);z-index:200;display:flex;align-items:center;justify-content:center;padding:1rem; }
        .modal-card { background:var(--bg-2);border:1px solid var(--border);border-radius:14px;width:100%;max-width:520px;max-height:90vh;overflow-y:auto;scrollbar-width:none; }
        .modal-card::-webkit-scrollbar { display:none; }
        .modal-header { padding:1.1rem 1.5rem;border-bottom:1px solid var(--border-soft);display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;background:var(--bg-2);z-index:1; }
        .modal-title  { font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:var(--text); }
        .modal-body   { padding:1.5rem;display:flex;flex-direction:column;gap:1rem; }
        .modal-footer { padding:1rem 1.5rem;border-top:1px solid var(--border-soft);background:var(--bg-3);display:flex;align-items:center;justify-content:flex-end;gap:.75rem;position:sticky;bottom:0; }

        /* ── Member preview ── */
        .member-preview { background:var(--bg-3);border:1px solid var(--border-soft);border-radius:9px;padding:.85rem 1rem;display:flex;align-items:center;gap:.75rem; }
        .member-avatar  { width:38px;height:38px;border-radius:50%;background:var(--accent-dim);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:500;color:var(--accent-text);flex-shrink:0;font-family:var(--font-display); }
        .member-name    { font-size:.9rem;font-weight:500;color:var(--text); }
        .member-sub     { font-size:.72rem;color:var(--text-faint);margin-top:.1rem; }

        /* ── Field ── */
        .field { display:flex;flex-direction:column;gap:.35rem; }
        .field-label { font-size:.78rem;font-weight:500;color:var(--text-muted); }
        .field-hint  { font-size:.7rem;color:var(--text-faint); }
        .field-input { background:var(--bg-3);border:1px solid var(--border-soft);border-radius:8px;padding:.62rem .9rem;font-size:.875rem;color:var(--text);font-family:var(--font-body);width:100%;outline:none;transition:border-color .2s,box-shadow .2s; }
        .field-input:focus { border-color:var(--border);box-shadow:0 0 0 3px var(--accent-dim); }
        .field-input::placeholder { color:var(--text-faint); }

        /* ── Position toggle ── */
        .position-row { display:grid;grid-template-columns:1fr 1fr;gap:.65rem; }
        .pos-option { display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;border:1px solid var(--border-soft);border-radius:8px;cursor:pointer;transition:border-color .2s,background .2s; }
        .pos-option.selected { border-color:var(--accent);background:var(--accent-dim); }
        .pos-option:not(.selected):hover { border-color:var(--border);background:var(--bg-3); }
        .pos-option input { accent-color:var(--accent);width:14px;height:14px;flex-shrink:0;cursor:pointer; }
        .pos-label { font-size:.85rem;color:var(--text-muted); }
        .pos-option.selected .pos-label { color:var(--accent-text);font-weight:500; }

        /* ── Parent search results ── */
        .parent-results { background:var(--bg-3);border:1px solid var(--border-soft);border-radius:8px;overflow:hidden;margin-top:.35rem; }
        .parent-item { display:flex;align-items:center;gap:.65rem;padding:.6rem .85rem;cursor:pointer;border-bottom:1px solid var(--border-soft);transition:background .15s; }
        .parent-item:last-child { border-bottom:none; }
        .parent-item:hover { background:var(--accent-dim); }
        .parent-item.is-selected { background:var(--accent-dim);border-left:2px solid var(--accent); }
        .parent-avatar { width:30px;height:30px;border-radius:50%;background:var(--bg-2);border:1px solid var(--border-soft);display:flex;align-items:center;justify-content:center;font-size:.68rem;font-weight:500;color:var(--accent-text);flex-shrink:0; }
        .parent-name { font-size:.82rem;color:var(--text);font-weight:400; }
        .parent-meta { font-size:.68rem;color:var(--text-faint); }

        /* Slot availability indicators */
        .slot-indicators { margin-left:auto;display:flex;gap:.3rem; }
        .slot-dot { width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.55rem;font-weight:700;letter-spacing:.02em;flex-shrink:0; }
        .slot-dot.open   { background:rgba(74,222,128,.15);color:var(--success);border:1px solid rgba(74,222,128,.3); }
        .slot-dot.filled { background:var(--bg-2);color:var(--text-faint);border:1px solid var(--border-soft); }

        /* ── Confirmation summary ── */
        .confirm-box { background:rgba(74,222,128,.07);border:1px solid rgba(74,222,128,.2);border-radius:8px;padding:.75rem 1rem;font-size:.82rem;color:var(--success);display:flex;align-items:flex-start;gap:.5rem; }
        .confirm-box svg { width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;margin-top:1px; }

        /* ── Buttons ── */
        .btn-primary { display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.4rem;background:var(--accent);color:var(--bg);border:none;border-radius:8px;font-family:var(--font-body);font-size:.85rem;font-weight:500;cursor:pointer;transition:opacity .2s; }
        .btn-primary:hover:not(:disabled) { opacity:.88; }
        .btn-primary:disabled { opacity:.4;cursor:not-allowed; }
        .btn-cancel  { display:inline-flex;align-items:center;padding:.6rem 1.2rem;background:transparent;color:var(--text-muted);border:1px solid var(--border-soft);border-radius:8px;font-family:var(--font-body);font-size:.85rem;cursor:pointer;transition:color .2s; }
        .btn-cancel:hover { color:var(--text); }
        .btn-x { background:none;border:none;color:var(--text-faint);cursor:pointer;font-size:1.3rem;line-height:1;padding:0;transition:color .2s; }
        .btn-x:hover { color:var(--text); }

        /* ── No search results ── */
        .no-parents { font-size:.78rem;color:var(--text-faint);padding:.6rem .85rem;background:var(--bg-3);border:1px solid var(--border-soft);border-radius:8px; }
    </style>

    {{-- ═══ HEADER ═══ --}}
    <div class="page-title">Manual Placements</div>
    <div class="page-sub">Assign unplaced members to a position in the binary tree</div>

    {{-- Config status bar --}}
    <div class="config-bar">
        <span class="config-label">Current config:</span>
        <span class="config-pill {{ config('mlm.commission.binary.auto_placement') ? 'pill-off' : 'pill-on' }}">
            @if(config('mlm.commission.binary.auto_placement'))
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>
                Auto placement ON — this page is only needed when auto placement is off
            @else
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                Auto placement OFF — manual placement required
            @endif
        </span>
        <span class="config-pill pill-info">
            Preference: {{ ucfirst(config('mlm.commission.binary.placement_preference', 'left')) }}
        </span>
        <span class="config-pill pill-info">
            Spillover: {{ config('mlm.genealogy.spillover') ? 'On' : 'Off' }}
        </span>
        <a href="{{ route('admin.mlm-settings') }}" wire:navigate
           style="margin-left:auto;font-size:.72rem;color:var(--accent-text);text-decoration:none;">
            Change settings →
        </a>
    </div>

    {{-- Alerts --}}
    @if($successMsg)
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            {{ $successMsg }}
        </div>
    @endif

    {{-- ═══ TOOLBAR ═══ --}}
    <div class="toolbar">
        <div class="search-wrap">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Search unplaced members…"
                class="search-input"
            >
        </div>
    </div>

    {{-- ═══ UNPLACED TABLE ═══ --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">
                Unplaced Members
                @if($unplaced->total() > 0)
                    <span class="count-badge">{{ $unplaced->total() }} pending</span>
                @endif
            </div>
        </div>

        <div style="overflow-x:auto;">
            <table class="pl-table">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Email</th>
                        <th>Sponsor</th>
                        <th>Joined</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($unplaced as $user)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:.65rem;">
                                    <div class="member-avatar" style="width:32px;height:32px;font-size:.72rem;">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="user-name">{{ $user->name }}</div>
                                        @if($user->username)
                                            <div class="user-meta">{{ $user->username }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:.78rem;">{{ $user->email }}</td>
                            <td>
                                @if($user->sponsor)
                                    <div class="user-name">{{ $user->sponsor->name }}</div>
                                    <div class="user-meta">{{ $user->sponsor->username }}</div>
                                @else
                                    <span style="color:var(--text-faint);font-size:.78rem;">No sponsor</span>
                                @endif
                            </td>
                            <td style="font-size:.78rem;white-space:nowrap;">
                                {{ $user->created_at->format('M d, Y') }}
                                <div style="font-size:.68rem;color:var(--text-faint);">
                                    {{ $user->created_at->diffForHumans() }}
                                </div>
                            </td>
                            <td><span class="unplaced-badge">Awaiting placement</span></td>
                            <td>
                                <button wire:click="selectUser({{ $user->id }})" class="btn-place">
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="5" y2="17"/><line x1="12" y1="12" x2="19" y2="17"/></svg>
                                    Place
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                    <p>
                                        @if($search)
                                            No unplaced members match "{{ $search }}"
                                        @else
                                            All members are placed — no pending assignments
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($unplaced->hasPages())
            <div class="pagination-wrap">{{ $unplaced->links() }}</div>
        @endif
    </div>

    {{-- ═══ PLACEMENT MODAL ═══ --}}
    @if($selectedUser)
        <div class="modal-overlay" wire:click.self="cancelPlacement">
            <div class="modal-card">

                {{-- Header --}}
                <div class="modal-header">
                    <div class="modal-title">Place Member in Tree</div>
                    <button class="btn-x" wire:click="cancelPlacement">&times;</button>
                </div>

                <div class="modal-body">

                    {{-- Error --}}
                    @if($errorMsg)
                        <div class="alert alert-error">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $errorMsg }}
                        </div>
                    @endif

                    {{-- Member being placed --}}
                    <div class="field">
                        <div class="field-label">Placing Member</div>
                        <div class="member-preview">
                            <div class="member-avatar">
                                {{ strtoupper(substr($selectedUser->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="member-name">{{ $selectedUser->name }}</div>
                                <div class="member-sub">
                                    {{ $selectedUser->email }}
                                    @if($selectedUser->sponsor)
                                        &nbsp;·&nbsp; Sponsor: {{ $selectedUser->sponsor->name }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Step 1: Choose position --}}
                    <div class="field">
                        <div class="field-label">Step 1 — Choose Position</div>
                        <div class="position-row">
                            <label class="pos-option {{ $selectedPosition === 'left' ? 'selected' : '' }}">
                                <input type="radio" wire:model.live="selectedPosition" value="left">
                                <span class="pos-label">← Left Leg</span>
                            </label>
                            <label class="pos-option {{ $selectedPosition === 'right' ? 'selected' : '' }}">
                                <input type="radio" wire:model.live="selectedPosition" value="right">
                                <span class="pos-label">Right Leg →</span>
                            </label>
                        </div>
                        <span class="field-hint">
                            The member will be placed on the {{ $selectedPosition }} leg of the parent you choose below.
                        </span>
                    </div>

                    {{-- Step 2: Search parent --}}
                    <div class="field">
                        <div class="field-label">Step 2 — Find Parent Node</div>
                        <input
                            wire:model.live.debounce.300ms="parentSearch"
                            type="text"
                            class="field-input"
                            placeholder="Type name, username or email…"
                        >
                        <span class="field-hint">
                            Only showing members with an open {{ $selectedPosition }} slot.
                        </span>

                        {{-- Results --}}
                        @if(strlen($parentSearch) >= 2)
                            @if($availableParents->count() > 0)
                                <div class="parent-results">
                                    @foreach($availableParents as $parent)
                                        <div
                                            wire:click="$set('selectedParentId', {{ $parent->id }})"
                                            class="parent-item {{ $selectedParentId === $parent->id ? 'is-selected' : '' }}"
                                        >
                                            <div class="parent-avatar">
                                                {{ strtoupper(substr($parent->name, 0, 2)) }}
                                            </div>
                                            <div style="flex:1;min-width:0;">
                                                <div class="parent-name">{{ $parent->name }}</div>
                                                <div class="parent-meta">
                                                    {{ $parent->email }}
                                                    @if($parent->username) · {{ $parent->username }} @endif
                                                </div>
                                            </div>
                                            {{-- Show which slots are open/filled --}}
                                            <div class="slot-indicators">
                                                <div class="slot-dot {{ !$parent->leftChild ? 'open' : 'filled' }}"
                                                     title="Left: {{ !$parent->leftChild ? 'open' : 'filled' }}">L</div>
                                                <div class="slot-dot {{ !$parent->rightChild ? 'open' : 'filled' }}"
                                                     title="Right: {{ !$parent->rightChild ? 'open' : 'filled' }}">R</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="no-parents">
                                    No members found with an open <strong>{{ $selectedPosition }}</strong> slot
                                    matching "{{ $parentSearch }}"
                                </div>
                            @endif
                        @endif
                    </div>

                    {{-- Confirmation summary --}}
                    @if($selectedParentId)
                        @php
                            $chosenParent = $availableParents->firstWhere('id', $selectedParentId);
                        @endphp
                        @if($chosenParent)
                            <div class="confirm-box">
                                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>
                                    <strong>{{ $selectedUser->name }}</strong> will be placed under
                                    <strong>{{ $chosenParent->name }}</strong>
                                    on the <strong>{{ $selectedPosition }} leg</strong>.
                                    This cannot be undone without manual DB editing.
                                </span>
                            </div>
                        @endif
                    @endif

                </div>

                {{-- Footer --}}
                <div class="modal-footer">
                    <button wire:click="cancelPlacement" class="btn-cancel">Cancel</button>
                    <button
                        wire:click="confirmPlacement"
                        wire:loading.attr="disabled"
                        wire:target="confirmPlacement"
                        class="btn-primary"
                        @disabled(!$selectedParentId)>
                        <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;">
                            <circle cx="12" cy="5" r="2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/>
                            <line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="5" y2="17"/><line x1="12" y1="12" x2="19" y2="17"/>
                        </svg>
                        Confirm Placement
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>