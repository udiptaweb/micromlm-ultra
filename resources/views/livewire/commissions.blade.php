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
            position: relative;
            overflow: hidden;
            transition: border-color 0.25s, transform 0.2s;
        }
        .summary-card:hover { border-color: var(--border); transform: translateY(-2px); }
        .summary-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--card-stripe, var(--accent));
            opacity: 0.7;
        }
        .summary-card::after {
            content: '';
            position: absolute;
            top: -30%; right: -10%;
            width: 110px; height: 110px;
            background: radial-gradient(circle, var(--card-stripe, var(--accent)) 0%, transparent 70%);
            opacity: 0.07;
            pointer-events: none;
        }
        .summary-label {
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .summary-label-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--card-stripe, var(--accent));
            flex-shrink: 0;
        }
        .summary-value {
            font-family: var(--font-display);
            font-size: 1.9rem;
            font-weight: 500;
            line-height: 1;
        }

        /* ── Panel ── */
        .panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
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
        }

        /* ── Filter select ── */
        .filter-select {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.55rem 0.9rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            font-family: var(--font-body);
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .filter-select:focus { border-color: var(--border); }

        /* ── Table ── */
        .comm-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .comm-table thead th {
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
        .comm-table tbody td {
            padding: 0.9rem 1.25rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
        }
        .comm-table tbody tr:last-child td { border-bottom: none; }
        .comm-table tbody tr:hover td { background: var(--accent-dim); color: var(--text); }

        /* Date cell */
        .date-main { font-size: 0.82rem; color: var(--text); white-space: nowrap; }
        .date-time  { font-size: 0.68rem; color: var(--text-faint); }

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

        /* From user */
        .from-name     { font-size: 0.82rem; color: var(--text); }
        .from-username { font-size: 0.7rem;  color: var(--text-faint); }

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

        /* Amount */
        .amount-cell { font-weight: 500; color: var(--success); white-space: nowrap; }

        /* Status badges */
        .status-badge {
            display: inline-block;
            padding: 0.22rem 0.65rem;
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

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
        }
        .empty-state svg {
            width: 38px; height: 38px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            margin: 0 auto 0.85rem; display: block; opacity: 0.6;
        }
        .empty-state p       { font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.3rem; }
        .empty-state small   { font-size: 0.78rem; color: var(--text-faint); }

        /* Pagination */
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
            .comm-table thead th:nth-child(7),
            .comm-table tbody td:nth-child(7) { display: none; }
        }
        @media (max-width: 560px) {
            .comm-table thead th:nth-child(4),
            .comm-table tbody td:nth-child(4) { display: none; }
        }
    </style>

    {{-- ═══ SUMMARY CARDS ═══ --}}
    <div class="comm-grid-3">

        <div class="summary-card" style="--card-stripe: var(--success);">
            <div class="summary-label">
                <span class="summary-label-dot" style="background: var(--success);"></span>
                Total Paid
            </div>
            <div class="summary-value" style="color: var(--success);">
                ₹{{ number_format($totalEarnings, 2) }}
            </div>
        </div>

        <div class="summary-card" style="--card-stripe: var(--accent);">
            <div class="summary-label">
                <span class="summary-label-dot"></span>
                Approved
            </div>
            <div class="summary-value" style="color: var(--accent-text);">
                ₹{{ number_format($approvedEarnings, 2) }}
            </div>
        </div>

        <div class="summary-card" style="--card-stripe: var(--warning);">
            <div class="summary-label">
                <span class="summary-label-dot" style="background: var(--warning);"></span>
                Pending
            </div>
            <div class="summary-value" style="color: var(--warning);">
                ₹{{ number_format($pendingEarnings, 2) }}
            </div>
        </div>

    </div>

    {{-- ═══ COMMISSION HISTORY PANEL ═══ --}}
    <div class="panel">

        <div class="panel-header">
            <div class="panel-title">Commission History</div>
            <select wire:model.live="filter" class="filter-select">
                <option value="all">All Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="paid">Paid</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div class="table-wrap">
            <table class="comm-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>From</th>
                        <th>Level</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $commission)
                        <tr>
                            <td>
                                <div class="date-main">{{ $commission->created_at->format('M d, Y') }}</div>
                                <div class="date-time">{{ $commission->created_at->format('H:i') }}</div>
                            </td>
                            <td>
                                <span class="type-pill">
                                    {{ ucfirst(str_replace('_', ' ', $commission->type)) }}
                                </span>
                            </td>
                            <td>
                                <div class="from-name">{{ $commission->fromUser->name }}</div>
                                <div class="from-username">{{ $commission->fromUser->username }}</div>
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
                            <td style="font-size:0.78rem; color:var(--text-faint); max-width:180px;">
                                {{ $commission->description ?? '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24">
                                        <line x1="12" y1="1" x2="12" y2="23"/>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                    </svg>
                                    <p>No commissions yet</p>
                                    <small>Your earnings will appear here once you start building your network</small>
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