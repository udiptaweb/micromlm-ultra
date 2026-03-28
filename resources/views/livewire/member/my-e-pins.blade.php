<div>
    <style>
        /* ── Page header ── */
        .page-header {
            display: flex;
            align-items: center;
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
        .page-sub { font-size: 0.82rem; color: var(--text-faint); }

        /* ── Search ── */
        .search-wrap { position: relative; }
        .search-wrap svg {
            position: absolute; left: 0.75rem; top: 50%;
            transform: translateY(-50%);
            width: 15px; height: 15px;
            stroke: var(--text-faint); fill: none; stroke-width: 2;
            pointer-events: none;
        }
        .search-input {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.6rem 0.9rem 0.6rem 2.2rem;
            font-size: 0.85rem;
            color: var(--text);
            font-family: var(--font-body);
            width: 220px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-input::placeholder { color: var(--text-faint); }
        .search-input:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
            width: 260px;
        }

        /* ── Pin grid ── */
        .pin-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }
        @media (max-width: 900px) { .pin-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .pin-grid { grid-template-columns: 1fr; } }

        /* ── Pin card ── */
        .pin-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
            transition: border-color 0.25s, transform 0.2s;
        }
        .pin-card:hover { transform: translateY(-2px); }
        .pin-card.active  { border-color: var(--border); }
        .pin-card.used    { border-color: var(--border-soft); opacity: 0.75; }
        .pin-card.expired { border-color: rgba(248,113,113,0.2); opacity: 0.65; }

        /* Top stripe by status */
        .pin-card::before {
            content: '';
            display: block;
            height: 3px;
            background: var(--stripe-color, var(--border-soft));
        }
        .pin-card.active::before  { background: var(--success); }
        .pin-card.used::before    { background: var(--text-faint); }
        .pin-card.expired::before { background: var(--danger); }

        .pin-card-body { padding: 1.1rem 1.25rem 1rem; }

        /* Value + status row */
        .pin-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1rem;
            gap: 0.5rem;
        }
        .pin-value-label {
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.2rem;
        }
        .pin-value {
            font-family: var(--font-display);
            font-size: 1.4rem;
            font-weight: 500;
            color: var(--text);
            line-height: 1;
        }

        /* Status badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.22rem 0.65rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            flex-shrink: 0;
        }
        .status-badge::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.7;
            flex-shrink: 0;
        }
        .badge-active  { background: rgba(74,222,128,0.1);  color: var(--success); border: 1px solid rgba(74,222,128,0.22); }
        .badge-used    { background: var(--bg-3);            color: var(--text-faint); border: 1px solid var(--border-soft); }
        .badge-expired { background: rgba(248,113,113,0.1); color: var(--danger);  border: 1px solid rgba(248,113,113,0.22); }

        /* PIN code box */
        .pin-code-box {
            position: relative;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.65rem 2.5rem 0.65rem 1rem;
            text-align: center;
            margin-bottom: 0.85rem;
        }
        .pin-code-text {
            font-family: var(--font-mono, monospace);
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: var(--accent-text);
        }
        .pin-code-text.used-text {
            color: var(--text-faint);
            text-decoration: line-through;
            opacity: 0.6;
        }

        /* Copy button */
        .pin-copy-btn {
            position: absolute;
            right: 0.6rem;
            top: 50%;
            transform: translateY(-50%);
            width: 28px; height: 28px;
            display: flex; align-items: center; justify-content: center;
            background: none;
            border: none;
            color: var(--text-faint);
            cursor: pointer;
            border-radius: 5px;
            transition: color 0.2s, background 0.2s;
            padding: 0;
        }
        .pin-copy-btn:hover { color: var(--accent-text); background: var(--accent-dim); }
        .pin-copy-btn svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 1.8; }

        /* Footer meta */
        .pin-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.7rem;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .pin-issued { color: var(--text-faint); }
        .pin-used-date {
            color: var(--danger);
            font-style: italic;
            opacity: 0.8;
        }

        /* ── Empty state ── */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 1.5rem;
            background: var(--bg-2);
            border: 1px dashed var(--border-soft);
            border-radius: 12px;
        }
        .empty-state svg {
            width: 40px; height: 40px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            margin: 0 auto 0.85rem; display: block; opacity: 0.5;
        }
        .empty-state p { font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem; }
        .empty-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.82rem;
            color: var(--accent-text);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .empty-link:hover { color: var(--accent); }
        .empty-link svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Pagination ── */
        .pagination-wrap { margin-top: 1.5rem; }
        .pagination-wrap nav span[aria-current] span,
        .pagination-wrap nav span[aria-current] {
            background: var(--accent) !important;
            color: var(--bg) !important;
            border-color: var(--accent) !important;
        }
        .pagination-wrap nav a {
            color: var(--text-muted) !important;
            background: var(--bg-2) !important;
            border-color: var(--border-soft) !important;
            transition: background 0.15s, color 0.15s;
        }
        .pagination-wrap nav a:hover {
            background: var(--accent-dim) !important;
            color: var(--text) !important;
            border-color: var(--border) !important;
        }
    </style>

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="page-header">
        <div>
            <div class="page-title">My E-Pins</div>
            <div class="page-sub">Your issued E-Pins — use them at checkout</div>
        </div>
        <div class="search-wrap">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input
                wire:model.live="search"
                type="text"
                placeholder="Search PIN code…"
                class="search-input"
            >
        </div>
    </div>

    {{-- ═══ PIN GRID ═══ --}}
    <div class="pin-grid">
        @forelse($pins as $pin)
            <div class="pin-card {{ $pin->status }}">

                <div class="pin-card-body">

                    {{-- Value + status --}}
                    <div class="pin-top">
                        <div>
                            <div class="pin-value-label">Pin Value</div>
                            <div class="pin-value">₹{{ number_format($pin->amount, 2) }}</div>
                        </div>
                        <span class="status-badge
                            @if($pin->status === 'active') badge-active
                            @elseif($pin->status === 'used') badge-used
                            @else badge-expired
                            @endif">
                            {{ ucfirst($pin->status) }}
                        </span>
                    </div>

                    {{-- PIN code box --}}
                    <div class="pin-code-box"
                         x-data="{ copied: false }">
                        <span class="pin-code-text {{ $pin->status !== 'active' ? 'used-text' : '' }}">
                            {{ $pin->code }}
                        </span>

                        @if($pin->status === 'active')
                            <button
                                class="pin-copy-btn"
                                title="Copy PIN"
                                x-on:click="
                                    navigator.clipboard.writeText('{{ $pin->code }}');
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                "
                            >
                                <svg x-show="!copied" viewBox="0 0 24 24">
                                    <rect x="9" y="9" width="13" height="13" rx="2"/>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                                </svg>
                                <svg x-show="copied" viewBox="0 0 24 24" style="color:var(--success);">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Meta footer --}}
                    <div class="pin-meta">
                        <span class="pin-issued">
                            Issued {{ $pin->created_at->format('M d, Y') }}
                        </span>
                        @if($pin->status === 'used' && $pin->used_at)
                            <span class="pin-used-date">
                                Used {{ $pin->used_at->format('M d, Y') }}
                            </span>
                        @endif
                    </div>

                </div>
            </div>
        @empty
            <div class="empty-state">
                <svg viewBox="0 0 24 24">
                    <rect x="2" y="7" width="20" height="14" rx="2"/>
                    <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                    <line x1="12" y1="12" x2="12" y2="16"/>
                    <line x1="10" y1="14" x2="14" y2="14"/>
                </svg>
                <p>You don't have any E-Pins yet</p>
                <a href="{{ route('member.epin.request') }}" wire:navigate class="empty-link">
                    Request your first E-Pin
                    <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrap">
        {{ $pins->links() }}
    </div>

</div>