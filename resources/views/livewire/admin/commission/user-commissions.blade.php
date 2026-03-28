<div>
    <style>
        .comm-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }
        @media (max-width: 900px) { .comm-grid-3 { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .comm-grid-3 { grid-template-columns: 1fr; } }

        /* ── Summary cards ── */
        .summary-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 1.4rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            overflow: hidden;
            transition: border-color 0.25s, transform 0.2s;
        }
        .summary-card:hover { border-color: var(--border); transform: translateY(-2px); }
        .summary-card::after {
            content: '';
            position: absolute;
            top: -30%; right: -10%;
            width: 110px; height: 110px;
            background: radial-gradient(circle, var(--card-glow, var(--accent)) 0%, transparent 70%);
            opacity: 0.07;
            pointer-events: none;
        }

        .summary-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .summary-icon svg { width: 20px; height: 20px; fill: none; stroke-width: 1.8; stroke: currentColor; }

        .summary-body { flex: 1; }
        .summary-label {
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.35rem;
        }
        .summary-value {
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 500;
            line-height: 1;
        }

        /* ── Main panel ── */
        .panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .panel-header {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .panel-title {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.02em;
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        /* ── Filter select ── */
        .filter-select {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.6rem 0.9rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            font-family: var(--font-body);
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .filter-select:focus { border-color: var(--border); }

        /* ── Approve all button ── */
        .btn-approve-all {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: rgba(74,222,128,0.12);
            color: var(--success);
            border: 1px solid rgba(74,222,128,0.25);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            white-space: nowrap;
        }
        .btn-approve-all:hover { background: rgba(74,222,128,0.2); transform: translateY(-1px); }
        .btn-approve-all svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }

        /* ── Loading overlay ── */
        .loading-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.25);
            backdrop-filter: blur(2px);
            z-index: 10;
            display: flex; align-items: center; justify-content: center;
        }
        .spinner {
            width: 34px; height: 34px;
            border-radius: 50%;
            border: 3px solid var(--border-soft);
            border-top-color: var(--accent);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Table ── */
        .comm-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.82rem;
        }

        .comm-table thead th {
            padding: 0.7rem 1rem;
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

        .comm-table tbody td {
            padding: 0.85rem 1rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
        }
        .comm-table tbody tr:last-child td { border-bottom: none; }
        .comm-table tbody tr:hover td { background: var(--accent-dim); color: var(--text); }

        /* Type pill */
        .type-pill {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: capitalize;
            background: var(--accent-dim);
            color: var(--accent-text);
            border: 1px solid var(--border);
            white-space: nowrap;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            white-space: nowrap;
        }
        .badge-paid      { background: rgba(74,222,128,0.1);  color: var(--success); border: 1px solid rgba(74,222,128,0.22); }
        .badge-approved  { background: rgba(96,165,250,0.1);  color: #60a5fa;         border: 1px solid rgba(96,165,250,0.22); }
        .badge-cancelled { background: rgba(248,113,113,0.1); color: var(--danger);   border: 1px solid rgba(248,113,113,0.22); }
        .badge-pending   { background: rgba(251,191,36,0.1);  color: var(--warning);  border: 1px solid rgba(251,191,36,0.22); }

        /* Amount */
        .amount-cell { font-weight: 500; color: var(--success); }

        /* User cell */
        .user-cell-name { font-size: 0.82rem; color: var(--text); white-space: nowrap; }
        .user-cell-email { font-size: 0.7rem; color: var(--text-faint); white-space: nowrap; }

        /* Level badge */
        .level-badge {
            display: inline-block;
            padding: 0.18rem 0.55rem;
            border-radius: 4px;
            font-size: 0.68rem;
            background: var(--bg-3);
            color: var(--text-muted);
            border: 1px solid var(--border-soft);
        }

        /* Approve row button */
        .btn-approve-row {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.38rem 0.85rem;
            background: rgba(74,222,128,0.1);
            color: var(--success);
            border: 1px solid rgba(74,222,128,0.22);
            border-radius: 6px;
            font-family: var(--font-body);
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .btn-approve-row:hover { background: rgba(74,222,128,0.2); }
        .btn-approve-row svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2.5; }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
            color: var(--text-faint);
        }
        .empty-state svg {
            width: 38px; height: 38px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            margin: 0 auto 0.85rem; display: block; opacity: 0.6;
        }
        .empty-state p { font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.3rem; }
        .empty-state small { font-size: 0.78rem; }

        /* Pagination */
        .pagination-wrap {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-soft);
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

        .table-wrap { position: relative; overflow-x: auto; }

        @media (max-width: 768px) {
            .comm-table thead th:nth-child(8),
            .comm-table tbody td:nth-child(8) { display: none; }
        }
        @media (max-width: 640px) {
            .comm-table thead th:nth-child(5),
            .comm-table tbody td:nth-child(5),
            .comm-table thead th:nth-child(1),
            .comm-table tbody td:nth-child(1) { display: none; }
        }
    </style>

    {{-- ═══ SUMMARY CARDS ═══ --}}
    <div class="comm-grid-3">

        <div class="summary-card" style="--card-glow: var(--success);">
            <div class="summary-icon"
                 style="background: rgba(74,222,128,0.1); border: 1px solid rgba(74,222,128,0.2);">
                <svg viewBox="0 0 24 24" style="stroke: var(--success);">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
            <div class="summary-body">
                <div class="summary-label">Total Paid</div>
                <div class="summary-value" style="color: var(--success);">
                    ₹{{ number_format($totalEarnings, 2) }}
                </div>
            </div>
        </div>

        <div class="summary-card" style="--card-glow: var(--accent);">
            <div class="summary-icon"
                 style="background: var(--accent-dim); border: 1px solid var(--border);">
                <svg viewBox="0 0 24 24" style="stroke: var(--accent-text);">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <div class="summary-body">
                <div class="summary-label">Approved</div>
                <div class="summary-value" style="color: var(--accent-text);">
                    ₹{{ number_format($approvedEarnings, 2) }}
                </div>
            </div>
        </div>

        <div class="summary-card" style="--card-glow: var(--warning);">
            <div class="summary-icon"
                 style="background: rgba(251,191,36,0.1); border: 1px solid rgba(251,191,36,0.2);">
                <svg viewBox="0 0 24 24" style="stroke: var(--warning);">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>
            <div class="summary-body">
                <div class="summary-label">Pending</div>
                <div class="summary-value" style="color: var(--warning);">
                    ₹{{ number_format($pendingEarnings, 2) }}
                </div>
            </div>
        </div>

    </div>

    {{-- ═══ COMMISSIONS PANEL ═══ --}}
    <div class="panel">

        <div class="panel-header">
            <div class="panel-title">User Commissions</div>
            <div class="toolbar">

                {{-- Approve all --}}
                <button
                    wire:click="approveAll"
                    wire:confirm="Approve all pending commissions?"
                    type="button"
                    class="btn-approve-all">
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Approve All
                </button>

                {{-- Status filter --}}
                <select wire:model.live="filter" class="filter-select">
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="paid">Paid</option>
                    <option value="cancelled">Cancelled</option>
                </select>

            </div>
        </div>

        <div class="table-wrap">

            {{-- Loading overlay --}}
            <div wire:loading wire:target="approve,approveAll,filter" class="loading-overlay">
                <div class="spinner"></div>
            </div>

            <table class="comm-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Level</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $commission)
                        <tr>
                            <td style="white-space:nowrap; font-size:0.78rem;">
                                {{ $commission->created_at->format('M d, Y') }}
                                <div style="font-size:0.68rem; color:var(--text-faint);">
                                    {{ $commission->created_at->format('H:i') }}
                                </div>
                            </td>
                            <td>
                                <span class="type-pill">
                                    {{ ucfirst(str_replace('_', ' ', $commission->type)) }}
                                </span>
                            </td>
                            <td>
                                <div class="user-cell-name">{{ $commission->fromUser->name }}</div>
                                <div class="user-cell-email">{{ $commission->fromUser->email }}</div>
                            </td>
                            <td>
                                <div class="user-cell-name">{{ $commission->user->name }}</div>
                                <div class="user-cell-email">{{ $commission->user->email }}</div>
                            </td>
                            <td>
                                <span class="level-badge">L{{ $commission->level }}</span>
                            </td>
                            <td class="amount-cell">
                                ₹{{ number_format($commission->amount, 2) }}
                            </td>
                            <td>
                                <span class="status-badge
                                    @if($commission->status === 'paid') badge-paid
                                    @elseif($commission->status === 'approved') badge-approved
                                    @elseif($commission->status === 'cancelled') badge-cancelled
                                    @else badge-pending
                                    @endif">
                                    {{ ucfirst($commission->status) }}
                                </span>
                            </td>
                            <td style="max-width:180px; font-size:0.78rem; color:var(--text-faint);">
                                {{ $commission->description ?? '—' }}
                            </td>
                            <td>
                                <button
                                    wire:click="approveEarning({{ $commission->id }})"
                                    wire:confirm="Approve this commission for ₹{{ number_format($commission->amount, 2) }}?"
                                    type="button"
                                    class="btn-approve-row">
                                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                    Approve
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24">
                                        <line x1="12" y1="1" x2="12" y2="23"/>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                    </svg>
                                    <p>No commissions found</p>
                                    @if($filter !== 'all')
                                        <small>Try changing the status filter</small>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($commissions->hasPages())
            <div class="pagination-wrap">
                {{ $commissions->links() }}
            </div>
        @endif

    </div>

</div>