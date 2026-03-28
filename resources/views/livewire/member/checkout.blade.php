<div>
    <style>
        .checkout-wrap {
            max-width: 680px;
            margin: 0 auto;
        }

        /* ── Section title ── */
        .section-title {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.01em;
            margin-bottom: 1.5rem;
        }

        /* ── Main checkout card ── */
        .checkout-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            overflow: hidden;
        }

        /* ── Product row ── */
        .product-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
            flex-wrap: wrap;
        }
        .product-row-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .product-thumb {
            width: 72px; height: 72px;
            border-radius: 10px;
            overflow: hidden;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            flex-shrink: 0;
        }
        .product-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .product-thumb-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
        }
        .product-thumb-placeholder svg {
            width: 28px; height: 28px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            opacity: 0.4;
        }
        .product-thumb-name {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 0.25rem;
        }
        .product-thumb-unit {
            font-size: 0.78rem;
            color: var(--text-faint);
        }

        /* Qty input */
        .qty-wrap { text-align: right; }
        .qty-label {
            font-size: 0.65rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.35rem;
        }
        .qty-input {
            width: 68px;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.5rem 0.6rem;
            font-size: 0.875rem;
            color: var(--text);
            font-family: var(--font-body);
            text-align: center;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .qty-input:focus { border-color: var(--border); box-shadow: 0 0 0 3px var(--accent-dim); }
        .field-error { font-size: 0.7rem; color: var(--danger); margin-top: 0.25rem; }

        /* ── Order summary strip ── */
        .order-summary {
            padding: 1.1rem 1.5rem;
            background: var(--bg-3);
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.85rem;
        }
        .summary-label { color: var(--text-muted); }
        .summary-value { color: var(--text); font-weight: 400; }
        .summary-commission { color: var(--success); font-weight: 500; }

        .summary-total-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.75rem;
            border-top: 1px solid var(--border-soft);
        }
        .summary-total-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text);
        }
        .summary-total-amount {
            font-family: var(--font-display);
            font-size: 1.7rem;
            font-weight: 500;
            color: var(--accent-text);
            line-height: 1;
        }

        /* ── Payment method section ── */
        .payment-section { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-soft); }
        .payment-section-label {
            font-size: 0.7rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.85rem;
        }
        .payment-methods { display: flex; flex-direction: column; gap: 0.6rem; }

        .method-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-soft);
            border-radius: 9px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }
        .method-option.active {
            border-color: var(--accent);
            background: var(--accent-dim);
        }
        .method-option:not(.active):hover {
            border-color: var(--border);
            background: var(--bg-3);
        }
        .method-option input[type="radio"] {
            accent-color: var(--accent);
            width: 15px; height: 15px;
            flex-shrink: 0;
        }
        .method-label {
            font-size: 0.875rem;
            font-weight: 400;
        }
        .method-label.active-text { color: var(--accent-text); font-weight: 500; }
        .method-label.inactive-text { color: var(--text-muted); }

        /* E-Pin input box */
        .epin-box {
            margin-top: 0.75rem;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 1rem;
        }
        .epin-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--accent-text);
            margin-bottom: 0.5rem;
        }
        .epin-input {
            width: 100%;
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            font-size: 0.875rem;
            color: var(--text);
            font-family: var(--font-mono, monospace);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .epin-input::placeholder { color: var(--text-faint); letter-spacing: 0.04em; }
        .epin-input:focus { border-color: var(--border); box-shadow: 0 0 0 3px var(--accent-dim); }

        /* ── Error flash ── */
        .alert-error {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            padding: 0.85rem 1rem;
            background: rgba(248,113,113,0.08);
            border: 1px solid rgba(248,113,113,0.22);
            border-radius: 8px;
            font-size: 0.85rem;
            color: var(--danger);
            margin: 0 1.5rem 1rem;
        }
        .alert-error svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        /* ── Success flash ── */
        .alert-success {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            padding: 0.85rem 1rem;
            background: rgba(74,222,128,0.08);
            border: 1px solid rgba(74,222,128,0.22);
            border-radius: 8px;
            font-size: 0.85rem;
            color: var(--success);
            margin: 0 1.5rem 1rem;
        }
        .alert-success svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        /* ── Confirm button ── */
        .btn-confirm-wrap { padding: 1.25rem 1.5rem; }
        .btn-confirm {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.95rem 1.5rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 10px;
            font-family: var(--font-body);
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-confirm:hover:not(:disabled) {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 8px 28px var(--accentGlow, rgba(0,0,0,0.25));
        }
        .btn-confirm:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-confirm svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }
        .btn-spinner {
            width: 16px; height: 16px;
            border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2);
            border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ════════════════════════════
           CRYPTO PAYMENT STEP
        ════════════════════════════ */
        .crypto-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .btn-cancel-crypto {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.82rem;
            color: var(--danger);
            background: none;
            border: none;
            cursor: pointer;
            font-family: var(--font-body);
            padding: 0;
            transition: opacity 0.2s;
        }
        .btn-cancel-crypto:hover { opacity: 0.75; }
        .btn-cancel-crypto svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* Crypto card */
        .crypto-card {
            background: var(--bg-2);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }
        .crypto-card-header {
            background: rgba(251,191,36,0.07);
            border-bottom: 1px solid rgba(251,191,36,0.18);
            padding: 1.1rem 1.5rem;
        }
        .crypto-card-title {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--warning);
            margin-bottom: 0.2rem;
        }
        .crypto-card-sub { font-size: 0.8rem; color: var(--text-faint); }

        .crypto-body { padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem; }

        /* Amounts grid */
        .crypto-amounts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        .crypto-amount-box {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 9px;
            padding: 0.85rem 1rem;
        }
        .crypto-amount-label {
            font-size: 0.65rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.35rem;
        }
        .crypto-amount-value {
            font-family: var(--font-display);
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--accent-text);
            word-break: break-all;
        }
        .crypto-amount-sub {
            font-size: 1rem;
            font-weight: 400;
            color: var(--text-muted);
        }

        /* Address row */
        .address-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }
        .address-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .address-input {
            flex: 1;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.6rem 0.9rem;
            font-size: 0.78rem;
            color: var(--text-muted);
            font-family: var(--font-mono, monospace);
            outline: none;
            word-break: break-all;
        }
        .btn-copy {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.6rem 1rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 500;
            cursor: pointer;
            white-space: nowrap;
            transition: opacity 0.2s;
        }
        .btn-copy:hover { opacity: 0.88; }
        .btn-copy svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* QR code */
        .qr-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 10px;
        }
        .qr-wrap img {
            border-radius: 6px;
            border: 4px solid var(--bg-2);
            margin-bottom: 0.6rem;
        }
        .qr-label { font-size: 0.72rem; color: var(--text-faint); }

        /* Status tracker */
        .status-tracker { border-top: 1px solid var(--border-soft); padding-top: 1rem; }
        .status-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.6rem;
        }
        .status-label { font-size: 0.82rem; color: var(--text-muted); }
        .status-badge {
            display: inline-block;
            padding: 0.22rem 0.7rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .status-waiting  { background: rgba(251,191,36,0.1); color: var(--warning); border: 1px solid rgba(251,191,36,0.22); }
        .status-confirmed{ background: rgba(74,222,128,0.1); color: var(--success); border: 1px solid rgba(74,222,128,0.22); }

        /* Progress bar */
        .progress-track {
            width: 100%;
            height: 4px;
            background: var(--bg-3);
            border-radius: 2px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 2px;
            background: linear-gradient(to right, var(--accent), var(--accentLight, var(--accent)));
            transition: width 0.4s ease;
        }
        .progress-fill.waiting  { width: 45%; animation: pulse-bar 2s ease-in-out infinite; }
        .progress-fill.confirmed{ width: 100%; }
        @keyframes pulse-bar {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Expiry notice */
        .expiry-notice {
            text-align: center;
            font-size: 0.75rem;
            color: var(--danger);
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
        }
    </style>

    <div class="checkout-wrap">

        {{-- ═══════════════════════════════════
             STEP 1: ORDER + PAYMENT METHOD
        ═══════════════════════════════════ --}}
        @if(!$crypto_payment)

            <div class="section-title">Confirm Your Order</div>

            <div class="checkout-card">

                {{-- Product row --}}
                <div class="product-row">
                    <div class="product-row-left">
                        <div class="product-thumb">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div class="product-thumb-placeholder">
                                    <svg viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="product-thumb-name">{{ $product->name }}</div>
                            <div class="product-thumb-unit">Unit price: ₹{{ number_format($product->price, 2) }}</div>
                        </div>
                    </div>
                    <div class="qty-wrap">
                        <div class="qty-label">Quantity</div>
                        <input
                            type="number"
                            wire:model.live="qty"
                            min="1"
                            class="qty-input"
                        >
                        @error('qty') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Order summary --}}
                <div class="order-summary">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value">₹{{ number_format($total, 2) }}</span>
                    </div>
                    @if($product->commission_enabled)
                        <div class="summary-row">
                            <span class="summary-label">Commission Return ({{ $product->commission_percent }}%)</span>
                            <span class="summary-commission">+ ₹{{ number_format($potential_earnings, 2) }}</span>
                        </div>
                    @endif
                    <div class="summary-total-row">
                        <span class="summary-total-label">Total Due</span>
                        <span class="summary-total-amount">₹{{ number_format($total, 2) }}</span>
                    </div>
                </div>

                {{-- Payment method --}}
                <div class="payment-section">
                    <div class="payment-section-label">Payment Method</div>
                    <div class="payment-methods">
                        @foreach($methods as $key => $method)
                            @if($method['enabled'])
                                <label class="method-option {{ $payment_method === $key ? 'active' : '' }}">
                                    <input
                                        type="radio"
                                        wire:model.live="payment_method"
                                        value="{{ $key }}"
                                    >
                                    <span class="method-label {{ $payment_method === $key ? 'active-text' : 'inactive-text' }}">
                                        {{ $method['label'] }}
                                    </span>
                                </label>
                            @endif
                        @endforeach

                        @if($payment_method === 'e_pin')
                            <div class="epin-box">
                                <div class="epin-label">Enter E-Pin Code</div>
                                <input
                                    type="text"
                                    wire:model.live="epin_code"
                                    id="epin_code"
                                    placeholder="XXXX-XXXX-XXXX"
                                    class="epin-input"
                                >
                                @error('epin_code')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    @error('payment_method')
                        <div class="field-error" style="margin-top:0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Success flash --}}
                @if(session()->has('success'))
                    <div class="alert-success">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error flash --}}
                @if(session()->has('error'))
                    <div class="alert-error">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Confirm button --}}
                <div class="btn-confirm-wrap">
                    <button
                        wire:click="buy"
                        wire:loading.attr="disabled"
                        class="btn-confirm"
                    >
                        <span wire:loading wire:target="buy" class="btn-spinner"></span>
                        <span wire:loading.remove wire:target="buy">
                            <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;display:inline;margin-right:4px;vertical-align:-2px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Confirm &amp; Pay ₹{{ number_format($total, 2) }}
                        </span>
                        <span wire:loading wire:target="buy">Processing…</span>
                    </button>
                </div>

            </div>

        @endif

        {{-- ═══════════════════════════════════
             STEP 2: CRYPTO PAYMENT
        ═══════════════════════════════════ --}}
        @if($crypto_payment)

            <div class="crypto-header">
                <div class="section-title" style="margin-bottom:0;">Payment Required</div>
                <button
                    wire:click="$set('crypto_payment', null)"
                    class="btn-cancel-crypto">
                    <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Cancel &amp; Change Method
                </button>
            </div>

            <div class="crypto-card">

                <div class="crypto-card-header">
                    <div class="crypto-card-title">Complete Your Crypto Payment</div>
                    <div class="crypto-card-sub">Send the exact amount to the address below. Do not close this page.</div>
                </div>

                <div class="crypto-body">

                    {{-- Amounts --}}
                    <div class="crypto-amounts">
                        <div class="crypto-amount-box">
                            <div class="crypto-amount-label">You Pay</div>
                            <div class="crypto-amount-value">
                                {{ $crypto_payment['pay_amount'] }}
                                <span style="font-size:0.8rem; color:var(--text-faint); font-family:var(--font-body);">
                                    {{ strtoupper($crypto_payment['pay_currency']) }}
                                </span>
                            </div>
                        </div>
                        <div class="crypto-amount-box">
                            <div class="crypto-amount-label">Order Total</div>
                            <div class="crypto-amount-sub" style="font-size:1.2rem; font-family:var(--font-display); color:var(--text); font-weight:500;">
                                ₹{{ number_format($crypto_payment['price_amount'], 2) }}
                            </div>
                        </div>
                    </div>

                    {{-- Wallet address --}}
                    <div>
                        <div class="address-label">
                            Deposit Address
                            <span style="font-size:0.7rem; color:var(--text-faint);">
                                ({{ strtoupper($crypto_payment['network']) }})
                            </span>
                        </div>
                        <div class="address-row">
                            <input
                                type="text"
                                readonly
                                value="{{ $crypto_payment['pay_address'] }}"
                                class="address-input"
                            >
                            <button
                                onclick="
                                    navigator.clipboard.writeText('{{ $crypto_payment['pay_address'] }}');
                                    this.innerHTML = '<svg viewBox=\'0 0 24 24\' style=\'width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2.5\'><polyline points=\'20 6 9 17 4 12\'/></svg> Copied';
                                    setTimeout(() => this.innerHTML = '<svg viewBox=\'0 0 24 24\' style=\'width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2\'><rect x=\'9\' y=\'9\' width=\'13\' height=\'13\' rx=\'2\'/><path d=\'M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1\'/></svg> Copy', 2500);
                                "
                                class="btn-copy">
                                <svg viewBox="0 0 24 24" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2;"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                Copy
                            </button>
                        </div>
                    </div>

                    {{-- QR code --}}
                    <div class="qr-wrap">
                        <img
                            src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $crypto_payment['pay_address'] }}"
                            width="180" height="180"
                            alt="Payment QR Code"
                        >
                        <div class="qr-label">Scan with your mobile crypto wallet</div>
                    </div>

                    {{-- Status tracker --}}
                    <div class="status-tracker">
                        <div class="status-row">
                            <span class="status-label">Payment Status</span>
                            <span class="status-badge {{ $crypto_payment['payment_status'] === 'waiting' ? 'status-waiting' : 'status-confirmed' }}">
                                {{ $crypto_payment['payment_status'] }}
                            </span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill {{ $crypto_payment['payment_status'] === 'waiting' ? 'waiting' : 'confirmed' }}"></div>
                        </div>
                    </div>

                    {{-- Expiry --}}
                    @if(!empty($crypto_payment['expiration_estimate_date']))
                        <div class="expiry-notice">
                            <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Expires at {{ \Carbon\Carbon::parse($crypto_payment['expiration_estimate_date'])->format('h:i A, d M Y') }}
                        </div>
                    @endif

                </div>
            </div>

        @endif

    </div>
</div>