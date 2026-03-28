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

        /* ── Flash alerts ── */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.9rem 1.1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
        .alert svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }
        .alert-success {
            background: rgba(74,222,128,0.08);
            border: 1px solid rgba(74,222,128,0.25);
            color: var(--success);
        }
        .alert-error {
            background: rgba(248,113,113,0.08);
            border: 1px solid rgba(248,113,113,0.25);
            color: var(--danger);
        }

        /* ── Panel ── */
        .panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
        }

        /* ── Remark bar ── */
        .remark-bar {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
            background: var(--bg-3);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .remark-bar svg {
            width: 15px; height: 15px;
            stroke: var(--text-faint); fill: none; stroke-width: 2;
            flex-shrink: 0;
        }
        .remark-input {
            flex: 1;
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.6rem 0.9rem;
            font-size: 0.85rem;
            color: var(--text);
            font-family: var(--font-body);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .remark-input::placeholder { color: var(--text-faint); }
        .remark-input:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }

        /* ── Table ── */
        .epin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .epin-table thead th {
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
        .epin-table thead th:last-child { text-align: right; }

        .epin-table tbody td {
            padding: 1rem 1.25rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: top;
        }
        .epin-table tbody tr:last-child td { border-bottom: none; }
        .epin-table tbody tr:hover td { background: var(--accent-dim); }

        /* ── User cell ── */
        .user-name  { font-size: 0.875rem; color: var(--text); font-weight: 400; margin-bottom: 0.15rem; }
        .user-email { font-size: 0.72rem; color: var(--text-faint); }

        /* ── Order cell ── */
        .order-line {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-bottom: 0.35rem;
        }
        .order-total {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 500;
            color: var(--accent-text);
        }

        /* Pin count badge */
        .pin-badge {
            display: inline-block;
            padding: 0.15rem 0.55rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            background: var(--accent-dim);
            color: var(--accent-text);
            border: 1px solid var(--border);
            margin-bottom: 0.35rem;
        }

        /* ── Receipt / proof link ── */
        .proof-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.78rem;
            color: var(--accent-text);
            text-decoration: none;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: var(--accent-dim);
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
        }
        .proof-link:hover { background: var(--border); color: var(--text); }
        .proof-link svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Action buttons ── */
        .actions-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.65rem;
            flex-wrap: wrap;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.9rem;
            border-radius: 6px;
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid;
            transition: background 0.2s, opacity 0.2s;
            white-space: nowrap;
        }
        .btn-action svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2.5; }
        .btn-action:disabled { opacity: 0.5; cursor: not-allowed; }

        .btn-approve {
            color: var(--success);
            border-color: rgba(74,222,128,0.25);
            background: rgba(74,222,128,0.1);
        }
        .btn-approve:hover:not(:disabled) { background: rgba(74,222,128,0.2); }

        .btn-reject {
            color: var(--danger);
            border-color: rgba(248,113,113,0.25);
            background: rgba(248,113,113,0.08);
        }
        .btn-reject:hover { background: rgba(248,113,113,0.18); }

        /* ── Empty state ── */
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
        .empty-state p { font-size: 0.875rem; color: var(--text-muted); }

        /* ── Pagination ── */
        .pagination-wrap {
            padding: 1rem 1.5rem;
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

        @media (max-width: 640px) {
            .epin-table thead th:nth-child(3),
            .epin-table tbody td:nth-child(3) { display: none; }
        }
    </style>

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="page-header">
        <div>
            <div class="page-title">E-Pin Requests</div>
            <div class="page-sub">Review, approve or reject member E-Pin purchase requests</div>
        </div>
    </div>

    {{-- ═══ FLASH ALERTS ═══ --}}
    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- ═══ MAIN PANEL ═══ --}}
    <div class="panel">

        {{-- Remark bar --}}
        <div class="remark-bar">
            <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <input
                type="text"
                wire:model="admin_remark"
                placeholder="Add a note or remark for the member before approving / rejecting…"
                class="remark-input"
            >
        </div>

        {{-- Table --}}
        <div class="table-wrap">
            <table class="epin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Order Details</th>
                        <th>Receipt</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                        <tr>
                            {{-- User --}}
                            <td>
                                <div class="user-name">{{ $request->user->name }}</div>
                                <div class="user-email">{{ $request->user->email }}</div>
                            </td>

                            {{-- Order details --}}
                            <td>
                                <div>
                                    <span class="pin-badge">{{ $request->pin_count }} Pins</span>
                                </div>
                                <div class="order-line">
                                    ₹{{ number_format($request->pin_amount, 2) }} × {{ $request->pin_count }}
                                </div>
                                <div class="order-total">
                                    ₹{{ number_format($request->total_amount, 2) }}
                                </div>
                            </td>

                            {{-- Receipt --}}
                            <td>
                                <a href="{{ asset('storage/' . $request->payment_proof) }}"
                                   target="_blank"
                                   class="proof-link">
                                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    View Proof
                                </a>
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="actions-cell">
                                    <button
                                        wire:click="approveRequest({{ $request->id }})"
                                        wire:loading.attr="disabled"
                                        wire:confirm="Approve {{ $request->pin_count }} E-Pins for {{ $request->user->name }}?"
                                        class="btn-action btn-approve">
                                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                        Approve & Issue
                                    </button>
                                    <button
                                        wire:click="rejectRequest({{ $request->id }})"
                                        wire:confirm="Reject this E-Pin request from {{ $request->user->name }}?"
                                        class="btn-action btn-reject">
                                        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        Reject
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
                                    <p>No pending E-Pin requests</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrap">
            {{ $requests->links() }}
        </div>

    </div>

</div>