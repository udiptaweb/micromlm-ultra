<x-app-layout>
    <x-slot name="header">My Wallets</x-slot>

    <style>
        .wallets-stack {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        /* ── Wallet cards grid ── */
        .wallet-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }
        @media (max-width: 900px) { .wallet-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .wallet-grid { grid-template-columns: 1fr; } }

        .wallet-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 1.4rem 1.5rem;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 1.25rem;
            transition: border-color 0.25s, transform 0.2s;
        }
        .wallet-card:hover { border-color: var(--border); transform: translateY(-2px); }

        /* Top accent stripe */
        .wallet-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--card-stripe, var(--accent));
        }

        /* Glow blob */
        .wallet-card::after {
            content: '';
            position: absolute;
            top: -30%; right: -10%;
            width: 110px; height: 110px;
            background: radial-gradient(circle, var(--card-stripe, var(--accent)) 0%, transparent 70%);
            opacity: 0.07;
            pointer-events: none;
        }

        .wallet-label {
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .wallet-label-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--card-stripe, var(--accent));
        }

        .wallet-amount {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 500;
            line-height: 1;
            margin-bottom: 0.35rem;
        }

        .wallet-sublabel {
            font-size: 0.72rem;
            color: var(--text-faint);
        }

        /* Withdraw button */
        .btn-withdraw {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.65rem 1rem;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-withdraw svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }
        .btn-withdraw-active {
            background: var(--accent);
            color: var(--bg);
        }
        .btn-withdraw-active:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-withdraw-disabled {
            background: var(--bg-3);
            color: var(--text-faint);
            cursor: not-allowed;
            border: 1px solid var(--border-soft);
        }

        .insufficient-label {
            font-size: 0.7rem;
            color: var(--text-faint);
            text-align: center;
            margin-top: 0.4rem;
        }

        /* ── Policy info box ── */
        .policy-box {
            background: var(--accent-dim);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.1rem 1.4rem;
            display: flex;
            gap: 0.85rem;
            align-items: flex-start;
        }
        .policy-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--bg-2);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            margin-top: 0.1rem;
        }
        .policy-icon svg { width: 15px; height: 15px; stroke: var(--accent-text); fill: none; stroke-width: 1.8; }
        .policy-title {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--accent-text);
            margin-bottom: 0.5rem;
            letter-spacing: 0.02em;
        }
        .policy-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }
        .policy-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.5;
        }
        .policy-list li::before {
            content: '';
            width: 4px; height: 4px;
            border-radius: 50%;
            background: var(--accent-text);
            flex-shrink: 0;
            margin-top: 0.5rem;
            opacity: 0.6;
        }

        /* ── Transactions panel ── */
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
            gap: 0.75rem;
        }
        .panel-header-icon {
            width: 30px; height: 30px;
            border-radius: 7px;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .panel-header-icon svg { width: 14px; height: 14px; stroke: var(--accent-text); fill: none; stroke-width: 1.8; }
        .panel-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--text);
        }

        /* ── Table ── */
        .txn-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
        .txn-table thead th {
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
        .txn-table tbody td {
            padding: 0.9rem 1.25rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
        }
        .txn-table tbody tr:last-child td { border-bottom: none; }
        .txn-table tbody tr:hover td { background: var(--accent-dim); }

        /* Wallet type pill */
        .wallet-type-pill {
            display: inline-block;
            padding: 0.18rem 0.55rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            background: var(--bg-3);
            color: var(--text-muted);
            border: 1px solid var(--border-soft);
        }

        /* Txn type badge */
        .txn-badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.04em;
        }
        .badge-credit { background: rgba(74,222,128,0.1);  color: var(--success); border: 1px solid rgba(74,222,128,0.22); }
        .badge-debit  { background: rgba(248,113,113,0.1); color: var(--danger);  border: 1px solid rgba(248,113,113,0.22); }

        /* Amount */
        .amount-credit { font-weight: 500; color: var(--success); }
        .amount-debit  { font-weight: 500; color: var(--danger); }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }
        .empty-state svg {
            width: 36px; height: 36px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            margin: 0 auto 0.75rem; display: block; opacity: 0.6;
        }
        .empty-state p { font-size: 0.875rem; color: var(--text-muted); }

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

        @media (max-width: 640px) {
            .txn-table thead th:nth-child(5),
            .txn-table tbody td:nth-child(5) { display: none; }
        }
    </style>

    @php
        $balance = auth()->user()->mainWallet?->balance ?? 0;
        $transactions = auth()->user()->walletTransactions()->latest()->paginate(20);
    @endphp

    <div class="wallets-stack">

        {{-- ═══ WALLET CARDS ═══ --}}
        <div class="wallet-grid">

            {{-- Main Wallet --}}
            <div class="wallet-card" style="--card-stripe: var(--accent);">
                <div>
                    <div class="wallet-label">
                        <span class="wallet-label-dot"></span>
                        Main Wallet
                    </div>
                    <div class="wallet-amount" style="color: var(--accent-text);">
                        ₹{{ number_format($balance, 2) }}
                    </div>
                    <div class="wallet-sublabel">Withdrawable balance</div>
                </div>
                <div>
                    @if($balance > 0)
                        <a href="{{ route('wallets.request-withdraw') }}" class="btn-withdraw btn-withdraw-active">
                            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M7 12h14m0 0l-3-3m3 3l-3 3"/></svg>
                            Withdraw Funds
                        </a>
                    @else
                        <span class="btn-withdraw btn-withdraw-disabled">
                            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M7 12h14m0 0l-3-3m3 3l-3 3"/></svg>
                            Withdraw Funds
                        </span>
                        <div class="insufficient-label">Insufficient balance</div>
                    @endif
                </div>
            </div>

            {{-- Commission Wallet --}}
            <div class="wallet-card" style="--card-stripe: var(--success);">
                <div>
                    <div class="wallet-label">
                        <span class="wallet-label-dot" style="background: var(--success);"></span>
                        Commission Wallet
                    </div>
                    <div class="wallet-amount" style="color: var(--success);">
                        ₹{{ number_format(auth()->user()->commissionWallet?->balance ?? 0, 2) }}
                    </div>
                    <div class="wallet-sublabel">Direct, Binary, Unilevel earnings</div>
                </div>
            </div>

            {{-- Bonus Wallet --}}
            <div class="wallet-card" style="--card-stripe: var(--warning);">
                <div>
                    <div class="wallet-label">
                        <span class="wallet-label-dot" style="background: var(--warning);"></span>
                        Bonus Wallet
                    </div>
                    <div class="wallet-amount" style="color: var(--warning);">
                        ₹{{ number_format(auth()->user()->bonusWallet?->balance ?? 0, 2) }}
                    </div>
                    <div class="wallet-sublabel">Rank &amp; performance bonuses</div>
                </div>
            </div>

        </div>

        {{-- ═══ COMMISSION TRANSFER POLICY ═══ --}}
        <div class="policy-box">
            <div class="policy-icon">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div>
                <div class="policy-title">Commission Transfer Policy</div>
                <ul class="policy-list">
                    <li>Commission wallet is periodically transferred to your Main Wallet</li>
                    <li>Transfers are processed by the system or an admin</li>
                    <li>Only Main Wallet balance is withdrawable</li>
                </ul>
            </div>
        </div>

        {{-- ═══ TRANSACTIONS TABLE ═══ --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-header-icon">
                    <svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                </div>
                <div class="panel-title">Wallet Transactions</div>
            </div>

            <div class="table-wrap">
                <table class="txn-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Wallet</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $txn)
                            <tr>
                                <td style="font-size:0.8rem; white-space:nowrap;">
                                    {{ $txn->created_at->format('d M Y') }}
                                    <div style="font-size:0.68rem; color:var(--text-faint);">
                                        {{ $txn->created_at->format('H:i') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="wallet-type-pill">
                                        {{ ucfirst($txn->wallet->type) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="txn-badge {{ $txn->type === 'credit' ? 'badge-credit' : 'badge-debit' }}">
                                        {{ ucfirst($txn->type) }}
                                    </span>
                                </td>
                                <td class="{{ $txn->type === 'credit' ? 'amount-credit' : 'amount-debit' }}">
                                    {{ $txn->type === 'credit' ? '+' : '−' }}₹{{ number_format($txn->amount, 2) }}
                                </td>
                                <td style="font-size:0.8rem; color:var(--text-faint); max-width:200px;">
                                    {{ $txn->description ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                                        <p>No wallet transactions yet</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrap">
                {{ $transactions->links() }}
            </div>
        </div>

    </div>

</x-app-layout>