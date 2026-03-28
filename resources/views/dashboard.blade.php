<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <style>
        /* ── All colours consume CSS variables injected by app.blade.php ── */

        .dash-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }

        @media (max-width: 900px) { .dash-grid-3 { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .dash-grid-3 { grid-template-columns: 1fr; } }

        /* ── Wallet cards ── */
        .wallet-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 1.4rem 1.5rem;
            position: relative;
            overflow: hidden;
            transition: border-color 0.25s, transform 0.2s;
        }
        .wallet-card:hover { border-color: var(--border); transform: translateY(-2px); }

        .wallet-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; bottom: 0;
            width: 3px;
            background: var(--card-accent, var(--accent));
            border-radius: 0;
        }

        .wallet-card::after {
            content: '';
            position: absolute;
            top: -30%; right: -10%;
            width: 120px; height: 120px;
            background: radial-gradient(circle, var(--card-accent, var(--accent)) 0%, transparent 70%);
            opacity: 0.07;
            pointer-events: none;
        }

        .wallet-label {
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .wallet-label-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--card-accent, var(--accent));
            flex-shrink: 0;
        }

        .wallet-amount {
            font-family: var(--font-display);
            font-size: 1.9rem;
            font-weight: 500;
            color: var(--card-accent, var(--accent));
            line-height: 1;
            margin-bottom: 0.4rem;
            letter-spacing: -0.01em;
        }

        .wallet-sublabel {
            font-size: 0.72rem;
            color: var(--text-faint);
        }

        /* ── Stat cards ── */
        .stat-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 1.4rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: border-color 0.25s, transform 0.2s;
        }
        .stat-card:hover { border-color: var(--border); transform: translateY(-2px); }

        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon svg {
            width: 20px; height: 20px;
            stroke: var(--accent-text);
            fill: none; stroke-width: 1.8;
        }

        .stat-body { flex: 1; min-width: 0; }

        .stat-label {
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.35rem;
        }

        .stat-value {
            font-family: var(--font-display);
            font-size: 1.7rem;
            font-weight: 500;
            color: var(--text);
            line-height: 1;
        }

        /* Rank uses dynamic badge color inline */
        .stat-value.rank { font-size: 1.3rem; }

        /* ── Section panels ── */
        .panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            margin-bottom: 1.25rem;
            overflow: hidden;
        }

        .panel-header {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .panel-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.02em;
        }

        .panel-body { padding: 1.5rem; }

        /* ── Referral input ── */
        .referral-row {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .referral-input {
            flex: 1;
            min-width: 0;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.65rem 1rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            font-family: var(--font-mono, monospace);
            outline: none;
            transition: border-color 0.2s;
        }
        .referral-input:focus { border-color: var(--border); }

        .btn-copy {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.4rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            white-space: nowrap;
        }
        .btn-copy:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-copy svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

        .copy-toast {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.75rem;
            color: var(--success);
            opacity: 0;
            transition: opacity 0.3s;
            margin-top: 0.5rem;
        }
        .copy-toast.show { opacity: 1; }

        /* ── Table ── */
        .dash-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .dash-table thead th {
            padding: 0.65rem 1rem;
            text-align: left;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-faint);
            border-bottom: 1px solid var(--border-soft);
            background: var(--bg-3);
        }

        .dash-table tbody td {
            padding: 0.9rem 1rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
        }

        .dash-table tbody tr:last-child td { border-bottom: none; }
        .dash-table tbody tr:hover td {
            background: var(--accent-dim);
            color: var(--text);
        }

        .dash-table .amount-cell {
            font-weight: 500;
            color: var(--success);
        }

        /* Commission type pill */
        .type-pill {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: capitalize;
            background: var(--accent-dim);
            color: var(--accent-text);
            border: 1px solid var(--border);
        }

        /* Status badges */
        .badge-paid     { background: rgba(74,222,128,0.12);  color: var(--success); border: 1px solid rgba(74,222,128,0.2); }
        .badge-approved { background: rgba(96,165,250,0.12);  color: #60a5fa;         border: 1px solid rgba(96,165,250,0.2); }
        .badge-pending  { background: rgba(251,191,36,0.12);  color: var(--warning);  border: 1px solid rgba(251,191,36,0.2); }

        .status-badge {
            display: inline-block;
            padding: 0.22rem 0.65rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.04em;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--text-faint);
            font-size: 0.875rem;
        }
        .empty-state svg {
            width: 36px; height: 36px;
            stroke: var(--text-faint);
            fill: none; stroke-width: 1.4;
            margin: 0 auto 0.75rem;
            display: block;
        }

        /* View all link */
        .view-all {
            font-size: 0.78rem;
            color: var(--accent-text);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: color 0.2s;
        }
        .view-all:hover { color: var(--accent); }
        .view-all svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Responsive table ── */
        .table-scroll { overflow-x: auto; }
        @media (max-width: 640px) {
            .dash-table thead th:nth-child(3),
            .dash-table tbody td:nth-child(3) { display: none; }
        }
    </style>

    {{-- ═══════════════════════════════════
         WALLET CARDS
    ═══════════════════════════════════ --}}
    <div class="dash-grid-3">

        {{-- Main Wallet --}}
        <div class="wallet-card" style="--card-accent: var(--success);">
            <div class="wallet-label">
                <span class="wallet-label-dot"></span>
                Main Wallet
            </div>
            <div class="wallet-amount" style="color: var(--success);">
                ₹{{ number_format(auth()->user()->mainWallet?->balance ?? 0, 2) }}
            </div>
            <div class="wallet-sublabel">Withdrawable Balance</div>
        </div>

        {{-- Commission Wallet --}}
        <div class="wallet-card" style="--card-accent: var(--accent);">
            <div class="wallet-label">
                <span class="wallet-label-dot"></span>
                Commission Wallet
            </div>
            <div class="wallet-amount">
                ₹{{ number_format(auth()->user()->commissionWallet?->balance ?? 0, 2) }}
            </div>
            <div class="wallet-sublabel">MLM Earnings — Direct, Binary, Unilevel</div>
        </div>

        {{-- Bonus Wallet --}}
        <div class="wallet-card" style="--card-accent: var(--warning);">
            <div class="wallet-label">
                <span class="wallet-label-dot"></span>
                Bonus Wallet
            </div>
            <div class="wallet-amount" style="color: var(--warning);">
                ₹{{ number_format(auth()->user()->bonusWallet?->balance ?? 0, 2) }}
            </div>
            <div class="wallet-sublabel">Locked / Incentive Rewards</div>
        </div>

    </div>

    {{-- ═══════════════════════════════════
         STAT CARDS
    ═══════════════════════════════════ --}}
    <div class="dash-grid-3">

        {{-- Direct Referrals --}}
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="stat-body">
                <div class="stat-label">Direct Referrals</div>
                <div class="stat-value">{{ auth()->user()->downlines()->count() }}</div>
            </div>
        </div>

        {{-- Total Team --}}
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="5" y2="17"/><line x1="12" y1="12" x2="19" y2="17"/></svg>
            </div>
            <div class="stat-body">
                <div class="stat-label">Total Team</div>
                <div class="stat-value">{{ auth()->user()->team_count ?? 0 }}</div>
            </div>
        </div>

        {{-- Current Rank --}}
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <div class="stat-body">
                <div class="stat-label">Current Rank</div>
                <div class="stat-value rank"
                     style="color: {{ auth()->user()->rank?->badge_color ?? 'var(--accent)' }}">
                    {{ auth()->user()->rank?->name ?? 'Member' }}
                </div>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════
         REFERRAL LINK
    ═══════════════════════════════════ --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Your Referral Link</div>
            <span style="font-size:0.72rem;color:var(--text-faint);letter-spacing:0.08em;text-transform:uppercase;">
                Share &amp; earn
            </span>
        </div>
        <div class="panel-body">
            <div class="referral-row">
                <input
                    type="text"
                    id="referralLink"
                    readonly
                    value="{{ url('/register?ref=' . auth()->user()->referral_code) }}"
                    class="referral-input"
                >
                <button onclick="copyReferralLink()" class="btn-copy">
                    <svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    Copy Link
                </button>
            </div>
            <div class="copy-toast" id="copyToast">
                <svg viewBox="0 0 24 24" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2.5;"><polyline points="20 6 9 17 4 12"/></svg>
                Copied to clipboard
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════
         RECENT COMMISSIONS TABLE
    ═══════════════════════════════════ --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Recent Commissions</div>
            <a href="{{ route('commissions') }}" class="view-all" wire:navigate>
                View all
                <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>

        <div class="table-scroll">
            <table class="dash-table">
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
                    @forelse(auth()->user()->commissions()->latest()->take(10)->get() as $commission)
                        <tr>
                            <td>{{ $commission->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="type-pill">
                                    {{ str_replace('_', ' ', $commission->type) }}
                                </span>
                            </td>
                            <td>{{ $commission->fromUser?->name ?? 'System' }}</td>
                            <td class="amount-cell">
                                ₹{{ number_format($commission->amount, 2) }}
                            </td>
                            <td>
                                <span class="status-badge
                                    @if($commission->status === 'paid') badge-paid
                                    @elseif($commission->status === 'approved') badge-approved
                                    @else badge-pending
                                    @endif">
                                    {{ ucfirst($commission->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                    No commissions yet. Share your referral link to start earning.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function copyReferralLink() {
            const input = document.getElementById('referralLink');
            input.select();
            input.setSelectionRange(0, 99999);

            if (navigator.clipboard) {
                navigator.clipboard.writeText(input.value);
            } else {
                document.execCommand('copy');
            }

            const toast = document.getElementById('copyToast');
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2500);
        }
    </script>

</x-app-layout>