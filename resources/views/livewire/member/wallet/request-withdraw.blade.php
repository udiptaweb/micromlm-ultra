<div>
    <style>
        .withdraw-wrap {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        /* ── Balance card ── */
        .balance-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 1.4rem 1.5rem;
            position: relative; overflow: hidden;
            transition: border-color 0.25s;
        }
        .balance-card::before {
            content: '';
            position: absolute; top: 0; left: 0; bottom: 0; width: 3px;
            background: var(--accent);
        }
        .balance-card::after {
            content: '';
            position: absolute; top: -20%; right: -5%;
            width: 120px; height: 120px;
            background: radial-gradient(circle, var(--accent) 0%, transparent 70%);
            opacity: 0.07; pointer-events: none;
        }
        .balance-label {
            font-size: 0.68rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.4rem;
        }
        .balance-amount {
            font-family: var(--font-display);
            font-size: 2.2rem;
            font-weight: 500;
            color: var(--text);
            line-height: 1;
            margin-bottom: 0.35rem;
        }
        .balance-note {
            font-size: 0.72rem;
            color: var(--text-faint);
            display: flex; align-items: center; gap: 0.35rem;
        }
        .balance-note svg { width: 11px; height: 11px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Day restriction notice ── */
        .day-notice {
            display: flex; align-items: flex-start; gap: 0.65rem;
            padding: 0.85rem 1rem;
            background: rgba(251,191,36,0.07);
            border: 1px solid rgba(251,191,36,0.18);
            border-radius: 8px;
            font-size: 0.82rem;
            color: var(--warning);
        }
        .day-notice svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        /* ── Panel ── */
        .panel { background: var(--bg-2); border: 1px solid var(--border-soft); border-radius: 12px; overflow: hidden; }
        .panel-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-soft); }
        .panel-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 500; color: var(--text); }
        .panel-body { padding: 1.25rem 1.5rem; display: flex; flex-direction: column; gap: 1rem; }

        /* ── Alert ── */
        .alert-success {
            display: flex; align-items: flex-start; gap: 0.65rem;
            padding: 0.85rem 1rem;
            background: rgba(74,222,128,0.08); border: 1px solid rgba(74,222,128,0.22);
            border-radius: 8px; font-size: 0.82rem; color: var(--success);
        }
        .alert-success svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        /* ── Field ── */
        .field { display: flex; flex-direction: column; gap: 0.35rem; }
        .field-label { font-size: 0.78rem; font-weight: 500; color: var(--text-muted); letter-spacing: 0.03em; }
        .field-input, .field-select {
            background: var(--bg-3); border: 1px solid var(--border-soft);
            border-radius: 8px; padding: 0.65rem 0.9rem;
            font-size: 0.875rem; color: var(--text); font-family: var(--font-body);
            width: 100%; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field-input:focus, .field-select:focus { border-color: var(--border); box-shadow: 0 0 0 3px var(--accent-dim); }
        .field-input.has-error { border-color: rgba(248,113,113,0.5); box-shadow: 0 0 0 3px rgba(248,113,113,0.08); }
        .field-error { font-size: 0.7rem; color: var(--danger); }
        .field-hint  { font-size: 0.7rem; color: var(--text-faint); }

        /* ── Fee breakdown ── */
        .fee-breakdown {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 9px;
            overflow: hidden;
        }
        .fee-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.6rem 1rem;
            font-size: 0.82rem;
            border-bottom: 1px solid var(--border-soft);
        }
        .fee-row:last-child { border-bottom: none; }
        .fee-key   { color: var(--text-faint); }
        .fee-val   { color: var(--text-muted); font-variant-numeric: tabular-nums; }
        .fee-val.deduction { color: var(--danger); }
        .fee-val.net       { color: var(--success); font-weight: 500; font-size: 0.9rem; }
        .fee-row.total-row { background: var(--accent-dim); }
        .fee-row.total-row .fee-key { color: var(--accent-text); font-weight: 500; }

        /* ── Limit chips ── */
        .limit-chips { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.3rem; }
        .chip {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.18rem 0.6rem;
            border-radius: 4px; font-size: 0.68rem; font-weight: 500;
            background: var(--bg-3); color: var(--text-faint);
            border: 1px solid var(--border-soft);
        }

        /* ── Submit button ── */
        .btn-submit {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.85rem 1.5rem;
            background: var(--accent); color: var(--bg);
            border: none; border-radius: 9px;
            font-family: var(--font-body); font-size: 0.9rem; font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-submit:hover:not(:disabled) {
            opacity: 0.88; transform: translateY(-1px);
            box-shadow: 0 6px 24px var(--accentGlow, rgba(0,0,0,0.25));
        }
        .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-submit svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }
        .btn-spinner {
            width: 15px; height: 15px; border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2); border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Policy box ── */
        .policy-box {
            background: rgba(251,191,36,0.06);
            border: 1px solid rgba(251,191,36,0.18);
            border-radius: 10px;
            padding: 1.1rem 1.25rem;
        }
        .policy-title {
            font-size: 0.82rem; font-weight: 500;
            color: var(--warning);
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 0.75rem;
        }
        .policy-title svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }
        .policy-list { display: flex; flex-direction: column; gap: 0.5rem; }
        .policy-item {
            display: flex; align-items: flex-start; gap: 0.55rem;
            font-size: 0.78rem; color: var(--text-faint); line-height: 1.55;
        }
        .policy-dot {
            width: 5px; height: 5px; border-radius: 50%;
            background: var(--warning); flex-shrink: 0; margin-top: 0.45rem; opacity: 0.7;
        }
    </style>

    <div class="withdraw-wrap">

        {{-- ── PAGE TITLE ── --}}
        <div>
            <div class="page-title">Withdraw Funds</div>
            <div class="page-sub">Request a withdrawal from your main wallet</div>
        </div>

        {{-- ── BALANCE CARD ── --}}
        <div class="balance-card">
            <div class="balance-label">Available Balance</div>
            <div class="balance-amount">₹{{ number_format($this->balance, 2) }}</div>
            <div class="balance-note">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Withdrawable from Main Wallet only
            </div>
        </div>

        {{-- ── ALLOWED DAY NOTICE ── --}}
        @php
            $allowedDays   = config('mlm.payout.allowed_days', []);
            $todayAllowed  = empty($allowedDays) || in_array(now()->format('l'), $allowedDays);
            $minAmount     = config('mlm.payout.min_amount',     10);
            $maxAmount     = config('mlm.payout.max_amount',     100000);
            $feePercent    = config('mlm.payout.charges_percent', 5);
            $processDays   = config('mlm.payout.processing_days', 3);
        @endphp

        @if(!$todayAllowed)
            <div class="day-notice">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>
                    Withdrawals are only accepted on
                    <strong>{{ implode(' and ', $allowedDays) }}</strong>.
                    Today is {{ now()->format('l') }}. Please come back then.
                </span>
            </div>
        @endif

        {{-- ── SUCCESS FLASH ── --}}
        @if(session()->has('message'))
            <div class="alert-success">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('message') }}
            </div>
        @endif

        {{-- ── FORM PANEL ── --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">Withdrawal Request</div>
            </div>
            <div class="panel-body">
                <form wire:submit="store">

                    {{-- Amount --}}
                    <div class="field">
                        <label class="field-label" for="amount">
                            Withdrawal Amount (₹)
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            wire:model.live.debounce.400ms="amount"
                            id="amount"
                            min="{{ $minAmount }}"
                            max="{{ min($maxAmount, $this->balance) }}"
                            class="field-input @error('amount') has-error @enderror"
                            placeholder="Enter amount"
                            {{ !$todayAllowed ? 'disabled' : '' }}
                        >
                        <div class="limit-chips">
                            <span class="chip">Min ₹{{ number_format($minAmount) }}</span>
                            <span class="chip">Max ₹{{ number_format($maxAmount) }}</span>
                            @if(!empty($allowedDays))
                                <span class="chip">Days: {{ implode(', ', array_map(fn($d) => substr($d,0,3), $allowedDays)) }}</span>
                            @endif
                        </div>
                        @error('amount') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Live fee breakdown --}}
                    @if($amount > 0)
                        <div class="fee-breakdown">
                            <div class="fee-row">
                                <span class="fee-key">Requested amount</span>
                                <span class="fee-val">₹{{ number_format($amount, 2) }}</span>
                            </div>
                            @if($feePercent > 0)
                                <div class="fee-row">
                                    <span class="fee-key">Processing fee ({{ $feePercent }}%)</span>
                                    <span class="fee-val deduction">− ₹{{ number_format($this->feeAmount, 2) }}</span>
                                </div>
                            @endif
                            <div class="fee-row total-row">
                                <span class="fee-key">You will receive</span>
                                <span class="fee-val net">₹{{ number_format($this->netAmount, 2) }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Payout account picker --}}
                    <div class="field">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.35rem;">
                            <label class="field-label" for="payoutInfoId">Payout Account</label>
                            <a href="{{ route('member.payout-info') }}" wire:navigate
                               style="font-size:.72rem;color:var(--accent-text);text-decoration:none;">
                               + Manage accounts
                            </a>
                        </div>

                        @if($payoutAccounts->isEmpty())
                            {{-- No accounts saved yet --}}
                            <div style="padding:.85rem 1rem;background:var(--bg-3);border:1px dashed var(--border-soft);border-radius:8px;text-align:center;">
                                <p style="font-size:.78rem;color:var(--text-faint);margin-bottom:.5rem;">
                                    No payout accounts saved yet
                                </p>
                                <a href="{{ route('member.payout-info') }}" wire:navigate
                                   class="btn-primary" style="display:inline-flex;padding:.4rem .9rem;font-size:.75rem;">
                                    Add Account
                                </a>
                            </div>
                        @else
                            <div style="display:flex;flex-direction:column;gap:.5rem;">
                                @foreach($payoutAccounts as $account)
                                    <label style="
                                        display:flex;align-items:center;gap:.75rem;
                                        padding:.7rem .9rem;
                                        border:1px solid {{ $payoutInfoId == $account->id ? 'var(--accent)' : 'var(--border-soft)' }};
                                        background:{{ $payoutInfoId == $account->id ? 'var(--accent-dim)' : 'var(--bg-3)' }};
                                        border-radius:8px;cursor:pointer;
                                        transition:border-color .15s,background .15s;
                                    ">
                                        <input
                                            type="radio"
                                            wire:model.live="payoutInfoId"
                                            value="{{ $account->id }}"
                                            style="accent-color:var(--accent);width:14px;height:14px;flex-shrink:0;"
                                            {{ !$todayAllowed ? 'disabled' : '' }}
                                        >
                                        <div style="flex:1;min-width:0;">
                                            <div style="display:flex;align-items:center;gap:.4rem;flex-wrap:wrap;">
                                                {{-- Method pill --}}
                                                <span style="
                                                    font-size:.62rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;
                                                    padding:.12rem .45rem;border-radius:3px;
                                                    @if($account->method === 'bank')   background:rgba(59,130,246,.1);color:#60a5fa;border:1px solid rgba(59,130,246,.2);
                                                    @elseif($account->method === 'upi') background:rgba(34,197,94,.1);color:#4ade80;border:1px solid rgba(34,197,94,.2);
                                                    @else                               background:rgba(251,191,36,.1);color:var(--warning);border:1px solid rgba(251,191,36,.2);
                                                    @endif
                                                ">{{ strtoupper($account->method) }}</span>
                                                {{-- Label --}}
                                                <span style="font-size:.82rem;color:var(--text);font-weight:400;">
                                                    {{ $account->display_label }}
                                                </span>
                                                @if($account->is_default)
                                                    <span style="font-size:.6rem;padding:.1rem .4rem;border-radius:3px;background:var(--accent-dim);color:var(--accent-text);border:1px solid var(--border);">Default</span>
                                                @endif
                                            </div>
                                            <div style="font-size:.68rem;color:var(--text-faint);margin-top:.15rem;font-family:var(--font-mono,monospace);">
                                                {{ $account->summary }}
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('payoutInfoId') <span class="field-error">{{ $message }}</span> @enderror
                        @endif
                    </div>

                    {{-- Selected account detail preview --}}
                    @if($this->selectedAccount)
                        @php $acc = $this->selectedAccount; @endphp
                        <div style="background:var(--bg-3);border:1px solid var(--border-soft);border-radius:8px;padding:.75rem 1rem;">
                            <div style="font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:var(--text-faint);margin-bottom:.5rem;">
                                Payout to
                            </div>
                            <div style="display:flex;flex-direction:column;gap:.3rem;font-size:.78rem;">
                                @if($acc->method === 'bank')
                                    <div style="display:flex;gap:.5rem;"><span style="color:var(--text-faint);min-width:80px;">Bank</span><span style="color:var(--text-muted);">{{ $acc->bank_name }}</span></div>
                                    <div style="display:flex;gap:.5rem;"><span style="color:var(--text-faint);min-width:80px;">Holder</span><span style="color:var(--text-muted);">{{ $acc->account_holder }}</span></div>
                                    <div style="display:flex;gap:.5rem;"><span style="color:var(--text-faint);min-width:80px;">Account</span><span style="color:var(--text-muted);font-family:var(--font-mono,monospace);">{{ $acc->masked_account }}</span></div>
                                    <div style="display:flex;gap:.5rem;"><span style="color:var(--text-faint);min-width:80px;">IFSC</span><span style="color:var(--text-muted);font-family:var(--font-mono,monospace);">{{ $acc->ifsc_code }}</span></div>
                                @elseif($acc->method === 'upi')
                                    <div style="display:flex;gap:.5rem;"><span style="color:var(--text-faint);min-width:80px;">UPI ID</span><span style="color:var(--text-muted);font-family:var(--font-mono,monospace);">{{ $acc->upi_id }}</span></div>
                                @elseif($acc->method === 'crypto')
                                    <div style="display:flex;gap:.5rem;"><span style="color:var(--text-faint);min-width:80px;">Network</span><span style="color:var(--text-muted);">{{ $acc->crypto_network }}</span></div>
                                    <div style="display:flex;gap:.5rem;"><span style="color:var(--text-faint);min-width:80px;">Address</span><span style="color:var(--text-muted);font-family:var(--font-mono,monospace);word-break:break-all;">{{ $acc->masked_wallet }}</span></div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Processing time hint --}}
                    <div style="font-size:.72rem;color:var(--text-faint);display:flex;align-items:center;gap:.35rem;">
                        <svg viewBox="0 0 24 24" style="width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Processed within {{ $processDays }} working {{ $processDays === 1 ? 'day' : 'days' }} after approval
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="btn-submit"
                        @if(!$todayAllowed) disabled @endif
                    >
                        <span wire:loading wire:target="store" class="btn-spinner"></span>
                        <svg wire:loading.remove wire:target="store" viewBox="0 0 24 24">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                            <polyline points="17 6 23 6 23 12"/>
                        </svg>
                        <span wire:loading.remove wire:target="store">Submit Withdrawal Request</span>
                        <span wire:loading wire:target="store">Submitting…</span>
                    </button>

                </form>
            </div>
        </div>

        {{-- ── POLICY BOX ── --}}
        <div class="policy-box">
            <div class="policy-title">
                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Withdrawal Policy
            </div>
            <div class="policy-list">
                <div class="policy-item">
                    <div class="policy-dot"></div>
                    Minimum withdrawal is ₹{{ number_format($minAmount) }}. Maximum per request is ₹{{ number_format($maxAmount) }}.
                </div>
                @if($feePercent > 0)
                    <div class="policy-item">
                        <div class="policy-dot"></div>
                        A {{ $feePercent }}% processing fee is deducted from every withdrawal.
                    </div>
                @endif
                <div class="policy-item">
                    <div class="policy-dot"></div>
                    Requests are processed within {{ $processDays }} working {{ $processDays === 1 ? 'day' : 'days' }} after admin approval.
                </div>
                @if(!empty($allowedDays))
                    <div class="policy-item">
                        <div class="policy-dot"></div>
                        Withdrawals are only accepted on <strong style="color:var(--text-muted);">{{ implode(' and ', $allowedDays) }}</strong>.
                    </div>
                @endif
                <div class="policy-item">
                    <div class="policy-dot"></div>
                    Requests require admin approval before funds are transferred.
                </div>
                <div class="policy-item">
                    <div class="policy-dot"></div>
                    Ensure your payment details are correct — incorrect details may cause rejection.
                </div>
            </div>
        </div>

    </div>

</div>