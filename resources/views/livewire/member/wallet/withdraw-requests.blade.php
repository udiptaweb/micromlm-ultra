<div>
    <style>
        .wr-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }

        @media (max-width: 1024px) {
            .wr-grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 560px) {
            .wr-grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .summary-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 1.25rem 1.4rem;
            position: relative;
            overflow: hidden;
            transition: border-color 0.25s, transform 0.2s;
        }

        .summary-card:hover {
            border-color: var(--border);
            transform: translateY(-2px);
        }

        .summary-card::after {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, var(--card-glow, var(--accent)) 0%, transparent 70%);
            opacity: 0.07;
            pointer-events: none;
        }

        .summary-label {
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.5rem;
        }

        .summary-value {
            font-family: var(--font-display);
            font-size: 1.9rem;
            font-weight: 500;
            line-height: 1;
        }

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

        .toolbar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .search-wrap {
            position: relative;
        }

        .search-wrap svg {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            stroke: var(--text-faint);
            fill: none;
            stroke-width: 2;
            pointer-events: none;
        }

        .search-input {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.6rem 0.9rem 0.6rem 2.2rem;
            font-size: 0.85rem;
            color: var(--text);
            font-family: var(--font-body);
            width: 220px;
            outline: none;
            transition: border-color 0.2s, width 0.2s;
        }

        .search-input::placeholder {
            color: var(--text-faint);
        }

        .search-input:focus {
            border-color: var(--border);
            width: 260px;
        }

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
        }

        .filter-select:focus {
            border-color: var(--border);
        }

        .loading-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(2px);
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spinner {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 3px solid var(--border-soft);
            border-top-color: var(--accent);
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .wr-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .wr-table thead th {
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
            cursor: pointer;
            user-select: none;
            transition: background 0.15s, color 0.15s;
        }

        .wr-table thead th:hover {
            background: var(--accent-dim);
            color: var(--text);
        }

        .wr-table thead th.sort-active {
            color: var(--accent-text);
        }

        .wr-table thead th.no-sort {
            cursor: default;
        }

        .wr-table thead th:last-child {
            text-align: right;
            cursor: default;
        }

        .sort-icon {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .sort-arrow {
            font-size: 0.75rem;
            color: var(--accent);
        }

        .sort-arrow-neutral {
            font-size: 0.75rem;
            color: var(--text-faint);
            opacity: 0.5;
        }

        .wr-table tbody td {
            padding: 0.9rem 1rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
        }

        .wr-table tbody tr:last-child td {
            border-bottom: none;
        }

        .wr-table tbody tr:hover td {
            background: var(--accent-dim);
            color: var(--text);
        }

        .user-name {
            font-size: 0.85rem;
            color: var(--text);
            white-space: nowrap;
        }

        .user-email {
            font-size: 0.7rem;
            color: var(--text-faint);
            white-space: nowrap;
        }

        /* Amount + fee breakdown */
        .amount-main {
            font-weight: 500;
            color: var(--text);
            white-space: nowrap;
        }

        .amount-sub {
            font-size: 0.68rem;
            color: var(--text-faint);
            white-space: nowrap;
        }

        .amount-net {
            font-size: 0.72rem;
            color: var(--success);
            white-space: nowrap;
        }

        /* Method + payout info */
        .method-pill {
            display: inline-block;
            padding: 0.18rem 0.55rem;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .pill-bank {
            background: rgba(59, 130, 246, .1);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, .2);
        }

        .pill-upi {
            background: rgba(34, 197, 94, .1);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, .2);
        }

        .pill-crypto {
            background: rgba(251, 191, 36, .1);
            color: var(--warning);
            border: 1px solid rgba(251, 191, 36, .2);
        }

        .payout-detail {
            font-size: 0.7rem;
            color: var(--text-faint);
            margin-top: 0.2rem;
            font-family: var(--font-mono, monospace);
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

        .badge-approved {
            background: rgba(74, 222, 128, 0.1);
            color: var(--success);
            border: 1px solid rgba(74, 222, 128, 0.22);
        }

        .badge-rejected {
            background: rgba(248, 113, 113, 0.1);
            color: var(--danger);
            border: 1px solid rgba(248, 113, 113, 0.22);
        }

        .badge-pending {
            background: rgba(251, 191, 36, 0.1);
            color: var(--warning);
            border: 1px solid rgba(251, 191, 36, 0.22);
        }

        .actions-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.35rem 0.8rem;
            border-radius: 6px;
            font-family: var(--font-body);
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid;
            transition: background 0.2s;
            background: none;
            white-space: nowrap;
        }

        .btn-action svg {
            width: 12px;
            height: 12px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
        }

        .btn-approve {
            color: var(--success);
            border-color: rgba(74, 222, 128, 0.25);
            background: rgba(74, 222, 128, 0.08);
        }

        .btn-approve:hover {
            background: rgba(74, 222, 128, 0.18);
        }

        .btn-reject {
            color: var(--danger);
            border-color: rgba(248, 113, 113, 0.25);
            background: rgba(248, 113, 113, 0.08);
        }

        .btn-reject:hover {
            background: rgba(248, 113, 113, 0.18);
        }

        .action-done {
            font-size: 0.75rem;
            color: var(--text-faint);
        }

        /* Remark tooltip for processed */
        .remark-tip {
            font-size: 0.68rem;
            color: var(--text-faint);
            font-style: italic;
            max-width: 140px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
        }

        .empty-state svg {
            width: 38px;
            height: 38px;
            stroke: var(--text-faint);
            fill: none;
            stroke-width: 1.4;
            margin: 0 auto 0.85rem;
            display: block;
            opacity: 0.6;
        }

        .empty-state p {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .empty-state small {
            font-size: 0.78rem;
            color: var(--text-faint);
        }

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
            transition: background 0.15s;
        }

        .pagination-wrap nav a:hover {
            background: var(--accent-dim) !important;
            color: var(--text) !important;
        }

        .table-wrap {
            position: relative;
            overflow-x: auto;
        }

        /* Flash */
        .alert-success {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            padding: 0.85rem 1rem;
            background: rgba(74, 222, 128, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.22);
            border-radius: 8px;
            font-size: 0.82rem;
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

        /* Remark modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .55);
            backdrop-filter: blur(4px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal-card {
            background: var(--bg-2);
            border: 1px solid var(--border);
            border-radius: 14px;
            width: 100%;
            max-width: 440px;
            overflow: hidden;
        }

        .modal-header {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--text);
        }

        .modal-body {
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-3);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .modal-info {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .modal-info-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            margin-bottom: 0.3rem;
        }

        .modal-info-row:last-child {
            margin-bottom: 0;
        }

        .modal-info-key {
            color: var(--text-faint);
        }

        .modal-info-val {
            color: var(--text);
            font-weight: 400;
        }

        .btn-x {
            background: none;
            border: none;
            color: var(--text-faint);
            cursor: pointer;
            font-size: 1.3rem;
            line-height: 1;
            padding: 0;
            transition: color .2s;
        }

        .btn-x:hover {
            color: var(--text);
        }

        .field-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 0.3rem;
            display: block;
        }

        .field-textarea {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            font-size: 0.875rem;
            color: var(--text);
            font-family: var(--font-body);
            width: 100%;
            outline: none;
            resize: vertical;
            min-height: 80px;
            transition: border-color .2s, box-shadow .2s;
        }

        .field-textarea:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }

        .btn-confirm-approve {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .6rem 1.25rem;
            background: rgba(74, 222, 128, .12);
            color: var(--success);
            border: 1px solid rgba(74, 222, 128, .3);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-confirm-approve:hover {
            background: rgba(74, 222, 128, .22);
        }

        .btn-confirm-reject {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .6rem 1.25rem;
            background: rgba(248, 113, 113, .1);
            color: var(--danger);
            border: 1px solid rgba(248, 113, 113, .3);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-confirm-reject:hover {
            background: rgba(248, 113, 113, .2);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            padding: .6rem 1.2rem;
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: .875rem;
            cursor: pointer;
        }

        .btn-cancel:hover {
            color: var(--text);
        }

        @media (max-width: 900px) {

            .wr-table thead th:nth-child(1),
            .wr-table tbody td:nth-child(1) {
                display: none;
            }

            .wr-table thead th:nth-child(5),
            .wr-table tbody td:nth-child(5) {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .search-input {
                width: 100%;
            }

            .search-input:focus {
                width: 100%;
            }
        }
    </style>

    {{-- Flash --}}
    @if (session('success'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ═══ SUMMARY CARDS ═══ --}}
    <div class="wr-grid-4">
        <div class="summary-card" style="--card-glow: var(--accent);">
            <div class="summary-label">Total Requests</div>
            <div class="summary-value" style="color: var(--accent-text);">{{ $stats['total'] }}</div>
        </div>
        <div class="summary-card" style="--card-glow: var(--warning);">
            <div class="summary-label">Pending</div>
            <div class="summary-value" style="color: var(--warning);">{{ $stats['pending'] }}</div>
        </div>
        <div class="summary-card" style="--card-glow: var(--success);">
            <div class="summary-label">Approved</div>
            <div class="summary-value" style="color: var(--success);">{{ $stats['approved'] }}</div>
        </div>
        <div class="summary-card" style="--card-glow: var(--danger);">
            <div class="summary-label">Rejected</div>
            <div class="summary-value" style="color: var(--danger);">{{ $stats['rejected'] }}</div>
        </div>
    </div>

    {{-- ═══ TABLE PANEL ═══ --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Withdraw Requests</div>
            <div class="toolbar">
                <div class="search-wrap">
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Search name, email, method…" class="search-input">
                </div>
                <select wire:model.live="status" class="filter-select">
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>

        <div class="table-wrap">
            <div wire:loading wire:target="search,status,setSorting" class="loading-overlay">
                <div class="spinner"></div>
            </div>

            <table class="wr-table">
                <thead>
                    <tr>
                        <th wire:click="setSorting('id')" class="{{ $sortBy === 'id' ? 'sort-active' : '' }}">
                            <span class="sort-icon">ID @if ($sortBy === 'id')
                                <span class="sort-arrow">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>@else<span
                                        class="sort-arrow-neutral">↕</span>
                                @endif
                            </span>
                        </th>
                        <th wire:click="setSorting('user_id')" class="{{ $sortBy === 'user_id' ? 'sort-active' : '' }}">
                            <span class="sort-icon">User @if ($sortBy === 'user_id')
                                <span class="sort-arrow">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>@else<span
                                        class="sort-arrow-neutral">↕</span>
                                @endif
                            </span>
                        </th>
                        <th wire:click="setSorting('amount')" class="{{ $sortBy === 'amount' ? 'sort-active' : '' }}">
                            <span class="sort-icon">Amount @if ($sortBy === 'amount')
                                <span class="sort-arrow">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>@else<span
                                        class="sort-arrow-neutral">↕</span>
                                @endif
                            </span>
                        </th>
                        <th class="no-sort">Payout Account</th>
                        <th wire:click="setSorting('status')" class="{{ $sortBy === 'status' ? 'sort-active' : '' }}">
                            <span class="sort-icon">Status @if ($sortBy === 'status')
                                <span class="sort-arrow">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>@else<span
                                        class="sort-arrow-neutral">↕</span>
                                @endif
                            </span>
                        </th>
                        <th wire:click="setSorting('created_at')"
                            class="{{ $sortBy === 'created_at' ? 'sort-active' : '' }}">
                            <span class="sort-icon">Requested @if ($sortBy === 'created_at')
                                <span class="sort-arrow">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>@else<span
                                        class="sort-arrow-neutral">↕</span>
                                @endif
                            </span>
                        </th>
                        <th class="no-sort">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($withdraws as $withdraw)
                        <tr>
                            {{-- ID --}}
                            <td style="font-size:0.78rem;color:var(--text-faint);">#{{ $withdraw->id }}</td>

                            {{-- User --}}
                            <td>
                                <a href="{{ route('member.profile',$withdraw->user->id) }}">
                                    <div class="user-name">{{ $withdraw->user->name }}</div>
                                    <div class="user-email">{{ $withdraw->user->email }}</div>
                                </a>
                            </td>

                            {{-- Amount + fee + net --}}
                            <td>
                                <div class="amount-main">₹{{ number_format($withdraw->amount, 2) }}</div>
                                @if ($withdraw->fee > 0)
                                    <div class="amount-sub">Fee: −₹{{ number_format($withdraw->fee, 2) }}</div>
                                @endif
                                @if ($withdraw->net_amount)
                                    <div class="amount-net">Net: ₹{{ number_format($withdraw->net_amount, 2) }}</div>
                                @endif
                            </td>

                            {{-- Payout account --}}
                            <td>
                                <span class="method-pill pill-{{ $withdraw->method }}">
                                    {{ strtoupper($withdraw->method) }}
                                </span>
                                @if ($withdraw->payoutInfo)
                                    @php $pi = $withdraw->payoutInfo; @endphp
                                    @if ($pi->method === 'bank')
                                        <div class="payout-detail">{{ $pi->bank_name }} · {{ $pi->masked_account }}
                                        </div>
                                        <div class="payout-detail">{{ $pi->account_holder }} · {{ $pi->ifsc_code }}
                                        </div>
                                    @elseif($pi->method === 'upi')
                                        <div class="payout-detail">{{ $pi->upi_id }}</div>
                                    @elseif($pi->method === 'crypto')
                                        <div class="payout-detail">{{ $pi->crypto_network }} ·
                                            {{ $pi->masked_wallet }}</div>
                                    @endif
                                @else
                                    <div class="payout-detail" style="font-style:italic;">No account saved</div>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                <span
                                    class="status-badge @if ($withdraw->status === 'approved') badge-approved @elseif($withdraw->status === 'rejected') badge-rejected @else badge-pending @endif">
                                    {{ ucfirst($withdraw->status) }}
                                </span>
                                @if ($withdraw->admin_remarks)
                                    <div class="remark-tip" title="{{ $withdraw->admin_remarks }}">
                                        "{{ $withdraw->admin_remarks }}"
                                    </div>
                                @endif
                            </td>

                            {{-- Date --}}
                            <td style="font-size:0.8rem;white-space:nowrap;">
                                {{ $withdraw->created_at->format('M d, Y') }}
                                <div style="font-size:0.68rem;color:var(--text-faint);">
                                    {{ $withdraw->created_at->format('H:i') }}</div>
                            </td>

                            {{-- Actions --}}
                            <td>
                                @if ($withdraw->status === 'pending')
                                    <div class="actions-cell">
                                        <button wire:click="openRemark({{ $withdraw->id }}, 'approve')" type="button"
                                            class="btn-action btn-approve">
                                            <svg viewBox="0 0 24 24">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                            Approve
                                        </button>
                                        <button wire:click="openRemark({{ $withdraw->id }}, 'reject')" type="button"
                                            class="btn-action btn-reject">
                                            <svg viewBox="0 0 24 24">
                                                <line x1="18" y1="6" x2="6" y2="18" />
                                                <line x1="6" y1="6" x2="18" y2="18" />
                                            </svg>
                                            Reject
                                        </button>
                                    </div>
                                @else
                                    <div class="actions-cell">
                                        <span class="action-done">—</span>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24">
                                        <rect x="1" y="4" width="22" height="16" rx="2" />
                                        <line x1="1" y1="10" x2="23" y2="10" />
                                    </svg>
                                    <p>No withdrawal requests found</p>
                                    @if ($search || $status !== 'all')
                                        <small>Try adjusting your search or filter</small>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($withdraws->hasPages())
            <div class="pagination-wrap">{{ $withdraws->links() }}</div>
        @endif
    </div>

    {{-- ═══ REMARK MODAL ═══ --}}
    @if ($showRemarkModal)
        @php
            $target =
                $withdraws->firstWhere('id', $remarkTargetId) ??
                \App\Models\PayoutRequest::with(['user', 'payoutInfo'])->find($remarkTargetId);
        @endphp
        <div class="modal-overlay" wire:click.self="cancelRemark">
            <div class="modal-card">

                <div class="modal-header">
                    <div class="modal-title">
                        {{ $remarkAction === 'approve' ? 'Approve' : 'Reject' }} Withdrawal
                    </div>
                    <button class="btn-x" wire:click="cancelRemark">&times;</button>
                </div>

                <div class="modal-body">

                    {{-- Request summary --}}
                    @if ($target)
                        <div class="modal-info">
                            <div class="modal-info-row">
                                <span class="modal-info-key">Member</span>
                                <span class="modal-info-val">{{ $target->user->name }}</span>
                            </div>
                            <div class="modal-info-row">
                                <span class="modal-info-key">Requested</span>
                                <span class="modal-info-val">₹{{ number_format($target->amount, 2) }}</span>
                            </div>
                            @if ($target->fee > 0)
                                <div class="modal-info-row">
                                    <span class="modal-info-key">Fee</span>
                                    <span class="modal-info-val"
                                        style="color:var(--danger);">−₹{{ number_format($target->fee, 2) }}</span>
                                </div>
                                <div class="modal-info-row">
                                    <span class="modal-info-key">Net Payout</span>
                                    <span class="modal-info-val"
                                        style="color:var(--success);">₹{{ number_format($target->net_amount, 2) }}</span>
                                </div>
                            @endif
                            <div class="modal-info-row">
                                <span class="modal-info-key">Method</span>
                                <span class="modal-info-val">{{ strtoupper($target->method) }}</span>
                            </div>
                            @if ($target->payoutInfo)
                                @php $pi = $target->payoutInfo; @endphp
                                @if ($pi->method === 'bank')
                                    <div class="modal-info-row">
                                        <span class="modal-info-key">Bank</span>
                                        <span class="modal-info-val">{{ $pi->bank_name }} ·
                                            {{ $pi->masked_account }}</span>
                                    </div>
                                    <div class="modal-info-row">
                                        <span class="modal-info-key">IFSC</span>
                                        <span class="modal-info-val"
                                            style="font-family:var(--font-mono,monospace);">{{ $pi->ifsc_code }}</span>
                                    </div>
                                    <div class="modal-info-row">
                                        <span class="modal-info-key">Holder</span>
                                        <span class="modal-info-val">{{ $pi->account_holder }}</span>
                                    </div>
                                @elseif($pi->method === 'upi')
                                    <div class="modal-info-row">
                                        <span class="modal-info-key">UPI ID</span>
                                        <span class="modal-info-val"
                                            style="font-family:var(--font-mono,monospace);">{{ $pi->upi_id }}</span>
                                    </div>
                                @elseif($pi->method === 'crypto')
                                    <div class="modal-info-row">
                                        <span class="modal-info-key">Network</span>
                                        <span class="modal-info-val">{{ $pi->crypto_network }}</span>
                                    </div>
                                    <div class="modal-info-row">
                                        <span class="modal-info-key">Address</span>
                                        <span class="modal-info-val"
                                            style="font-family:var(--font-mono,monospace);word-break:break-all;">{{ $pi->wallet_address }}</span>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endif

                    {{-- Remark --}}
                    <div>
                        <label class="field-label">
                            Remark
                            <span style="color:var(--text-faint);font-weight:300;font-size:.68rem;">(optional)</span>
                        </label>
                        <textarea wire:model="remark" class="field-textarea"
                            placeholder="{{ $remarkAction === 'reject' ? 'Reason for rejection…' : 'Any notes for this approval…' }}"></textarea>
                    </div>

                    @if ($remarkAction === 'reject')
                        <div
                            style="display:flex;align-items:flex-start;gap:.5rem;padding:.7rem .9rem;background:rgba(248,113,113,.07);border:1px solid rgba(248,113,113,.18);border-radius:8px;font-size:.78rem;color:var(--danger);">
                            <svg viewBox="0 0 24 24"
                                style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;margin-top:1px;">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            The deducted amount will be refunded to the member's main wallet.
                        </div>
                    @endif

                </div>

                <div class="modal-footer">
                    <button wire:click="cancelRemark" class="btn-cancel">Cancel</button>
                    @if ($remarkAction === 'approve')
                        <button wire:click="confirmAction" class="btn-confirm-approve">
                            <svg viewBox="0 0 24 24"
                                style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            Confirm Approval
                        </button>
                    @else
                        <button wire:click="confirmAction" class="btn-confirm-reject">
                            <svg viewBox="0 0 24 24"
                                style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                            Confirm Rejection
                        </button>
                    @endif
                </div>

            </div>
        </div>
    @endif

</div>
