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
        .page-sub {
            font-size: 0.82rem;
            color: var(--text-faint);
        }

        .btn-nav {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: var(--accent-dim);
            color: var(--accent-text);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            text-decoration: none;
            white-space: nowrap;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-nav:hover { background: var(--border); transform: translateY(-1px); }
        .btn-nav svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Panel ── */
        .panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
        }

        /* ── Toolbar ── */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-soft);
            background: var(--bg-3);
            flex-wrap: wrap;
        }

        .search-wrap { position: relative; flex: 1; min-width: 180px; }
        .search-wrap svg {
            position: absolute; left: 0.75rem; top: 50%;
            transform: translateY(-50%);
            width: 15px; height: 15px;
            stroke: var(--text-faint); fill: none; stroke-width: 2;
            pointer-events: none;
        }
        .search-input {
            width: 100%;
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.6rem 0.9rem 0.6rem 2.2rem;
            font-size: 0.85rem;
            color: var(--text);
            font-family: var(--font-mono, monospace);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-input::placeholder { color: var(--text-faint); font-family: var(--font-body); }
        .search-input:focus { border-color: var(--border); box-shadow: 0 0 0 3px var(--accent-dim); }

        .filter-select {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.6rem 0.9rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            font-family: var(--font-body);
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
            min-width: 150px;
        }
        .filter-select:focus { border-color: var(--border); }

        /* ── Table ── */
        .inv-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .inv-table thead th {
            padding: 0.7rem 1.25rem;
            text-align: left;
            font-size: 0.63rem;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-faint);
            border-bottom: 1px solid var(--border-soft);
            background: var(--bg-3);
            white-space: nowrap;
        }
        .inv-table tbody td {
            padding: 0.9rem 1.25rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
            white-space: nowrap;
        }
        .inv-table tbody tr:last-child td { border-bottom: none; }
        .inv-table tbody tr:hover td { background: var(--accent-dim); }

        /* ── PIN code cell ── */
        .pin-code {
            font-family: var(--font-mono, monospace);
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--accent-text);
            letter-spacing: 0.06em;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            padding: 0.25rem 0.7rem;
            border-radius: 5px;
            display: inline-block;
        }

        /* ── Amount ── */
        .amount-cell {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text);
        }

        /* ── Status badges ── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.22rem 0.65rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.04em;
        }
        .status-badge::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.7;
            flex-shrink: 0;
        }
        .badge-active   { background: rgba(74,222,128,0.1);  color: var(--success); border: 1px solid rgba(74,222,128,0.22); }
        .badge-used     { background: var(--bg-3);            color: var(--text-faint); border: 1px solid var(--border-soft); }
        .badge-expired  { background: rgba(248,113,113,0.1); color: var(--danger);  border: 1px solid rgba(248,113,113,0.22); }

        /* ── Assigned cell ── */
        .assigned-name  { font-size: 0.82rem; color: var(--text); }
        .assigned-none  { font-size: 0.78rem; color: var(--text-faint); font-style: italic; }

        /* ── Usage info cell ── */
        .usage-by {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.15rem;
        }
        .usage-by strong { color: var(--text); font-weight: 500; }
        .usage-date {
            font-size: 0.68rem;
            color: var(--text-faint);
        }
        .usage-none {
            font-size: 0.75rem;
            color: var(--text-faint);
            font-style: italic;
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
        }
        .empty-state svg {
            width: 38px; height: 38px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            margin: 0 auto 0.85rem; display: block; opacity: 0.6;
        }
        .empty-state p { font-size: 0.875rem; color: var(--text-muted); }
        .empty-state small { font-size: 0.78rem; color: var(--text-faint); }

        /* ── Pagination ── */
        .pagination-wrap {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-3);
        }
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

        .table-wrap { overflow-x: auto; }

        @media (max-width: 768px) {
            .inv-table thead th:nth-child(5),
            .inv-table tbody td:nth-child(5) { display: none; }
        }
        @media (max-width: 560px) {
            .inv-table thead th:nth-child(4),
            .inv-table tbody td:nth-child(4) { display: none; }
        }
    </style>

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="page-header">
        <div>
            <div class="page-title">E-Pin Inventory</div>
            <div class="page-sub">All issued E-Pins — active, used and expired</div>
        </div>
        <a href="{{ route('admin.e-pins.requests') }}" class="btn-nav" wire:navigate>
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
            View Requests
        </a>
    </div>

    {{-- ═══ PANEL ═══ --}}
    <div class="panel">

        {{-- Toolbar --}}
        <div class="toolbar">
            <div class="search-wrap">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Search by PIN code…"
                    class="search-input"
                >
            </div>
            <select wire:model.live="status" class="filter-select">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="used">Used</option>
                <option value="expired">Expired</option>
            </select>
        </div>

        {{-- Table --}}
        <div class="table-wrap">
            <table class="inv-table">
                <thead>
                    <tr>
                        <th>PIN Code</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Usage Info</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pins as $pin)
                        <tr>
                            {{-- PIN code --}}
                            <td>
                                <span class="pin-code">{{ $pin->code }}</span>
                            </td>

                            {{-- Value --}}
                            <td class="amount-cell">
                                ₹{{ number_format($pin->amount, 2) }}
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($pin->status === 'active')
                                    <span class="status-badge badge-active">Active</span>
                                @elseif($pin->status === 'used')
                                    <span class="status-badge badge-used">Used</span>
                                @else
                                    <span class="status-badge badge-expired">Expired</span>
                                @endif
                            </td>

                            {{-- Assigned to --}}
                            <td>
                                @if($pin->user)
                                    <span class="assigned-name">{{ $pin->user->name }}</span>
                                @else
                                    <span class="assigned-none">Unassigned</span>
                                @endif
                            </td>

                            {{-- Usage info --}}
                            <td>
                                @if($pin->status === 'used')
                                    <div class="usage-by">
                                        Used by: <strong>{{ $pin->usedBy->name ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="usage-date">
                                        {{ $pin->used_at?->format('M d, Y · H:i') ?? '—' }}
                                    </div>
                                @else
                                    <span class="usage-none">Not used yet</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                    <p>No E-Pins found</p>
                                    @if($search || $status)
                                        <small>Try adjusting your search or status filter</small>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrap">
            {{ $pins->links() }}
        </div>

    </div>

</div>