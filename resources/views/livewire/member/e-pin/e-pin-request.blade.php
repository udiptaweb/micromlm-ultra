<div>
    <style>
        .form-wrap {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-page-title {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.01em;
            margin-bottom: 0.35rem;
        }
        .form-page-sub {
            font-size: 0.82rem;
            color: var(--text-faint);
            margin-bottom: 1.75rem;
        }

        /* ── Alerts ── */
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
        .alert-success { background: rgba(74,222,128,0.08);  border: 1px solid rgba(74,222,128,0.25);  color: var(--success); }
        .alert-error   { background: rgba(248,113,113,0.08); border: 1px solid rgba(248,113,113,0.25); color: var(--danger); }

        /* ── Form card ── */
        .form-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
        }

        .form-section-label {
            font-size: 0.65rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--text-faint);
            padding: 0.85rem 1.5rem 0.4rem;
            border-top: 1px solid var(--border-soft);
        }
        .form-section-label:first-child { border-top: none; padding-top: 1.25rem; }

        .form-fields {
            padding: 0 1.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        .field-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        @media (max-width: 520px) { .field-row-2 { grid-template-columns: 1fr; } }

        /* ── Fields ── */
        .field { display: flex; flex-direction: column; gap: 0.35rem; }

        .field-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.03em;
        }
        .field-label .req { color: var(--danger); margin-left: 2px; }
        .field-label .opt { color: var(--text-faint); font-weight: 300; margin-left: 4px; font-size: 0.72rem; }

        .field-input,
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
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field-textarea { resize: vertical; min-height: 88px; }
        .field-input::placeholder,
        .field-textarea::placeholder { color: var(--text-faint); }
        .field-input:focus,
        .field-textarea:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }
        .field-input.has-error {
            border-color: rgba(248,113,113,0.5);
            box-shadow: 0 0 0 3px rgba(248,113,113,0.08);
        }
        .field-error { font-size: 0.72rem; color: var(--danger); }
        .field-hint  { font-size: 0.72rem; color: var(--text-faint); }

        /* ── Total box ── */
        .total-box {
            background: var(--accent-dim);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .total-box-label {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--accent-text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .total-box-label svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }
        .total-box-amount {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--accent-text);
            line-height: 1;
        }

        /* ── File input ── */
        .file-input-wrap {
            background: var(--bg-3);
            border: 1px dashed var(--border-soft);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: border-color 0.2s;
        }
        .file-input-wrap:hover { border-color: var(--border); }
        .file-input-wrap input[type="file"] {
            width: 100%;
            font-size: 0.82rem;
            color: var(--text-muted);
            font-family: var(--font-body);
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
        }
        .file-input-wrap input[type="file"]::file-selector-button {
            padding: 0.3rem 0.8rem;
            margin-right: 0.75rem;
            background: var(--accent-dim);
            color: var(--accent-text);
            border: 1px solid var(--border);
            border-radius: 5px;
            font-size: 0.75rem;
            font-weight: 500;
            font-family: var(--font-body);
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .file-input-wrap input[type="file"]::file-selector-button:hover { opacity: 0.8; }

        .uploading-hint {
            font-size: 0.72rem;
            color: var(--accent-text);
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 0.35rem;
        }
        .uploading-hint svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2; animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Proof preview */
        .proof-preview { margin-top: 0.5rem; }
        .proof-preview img {
            max-height: 100px;
            border-radius: 6px;
            border: 1px solid var(--border-soft);
            object-fit: cover;
        }

        /* ── Form footer ── */
        .form-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-3);
        }

        .btn-submit {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.9rem 1.5rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 9px;
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-submit:hover:not(:disabled) {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 8px 28px var(--accentGlow, rgba(0,0,0,0.25));
        }
        .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-submit svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }
        .btn-spinner {
            width: 16px; height: 16px;
            border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2);
            border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }
    </style>

    <div class="form-wrap">

        {{-- Title --}}
        <div class="form-page-title">Request E-Pins</div>
        <div class="form-page-sub">Fill in the details below and upload your payment receipt to request E-Pins.</div>

        {{-- Alerts --}}
        @if(session()->has('success'))
            <div class="alert alert-success">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-error">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="form-card">
            <form wire:submit.prevent="submitRequest">

                {{-- ── Pin Details ── --}}
                <div class="form-section-label">Pin Details</div>
                <div class="form-fields">

                    <div class="field-row-2">
                        <div class="field">
                            <label class="field-label">
                                Pin Amount <span class="req">*</span>
                            </label>
                            <input
                                type="number"
                                wire:model.live="pin_amount"
                                min="1"
                                class="field-input @error('pin_amount') has-error @enderror"
                                placeholder="e.g. 500"
                            >
                            @error('pin_amount')
                                <span class="field-error">{{ $message }}</span>
                            @else
                                <span class="field-hint">Amount per pin in ₹</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="field-label">
                                Quantity <span class="req">*</span>
                            </label>
                            <input
                                type="number"
                                wire:model.live="pin_count"
                                min="1"
                                class="field-input @error('pin_count') has-error @enderror"
                                placeholder="e.g. 5"
                            >
                            @error('pin_count')
                                <span class="field-error">{{ $message }}</span>
                            @else
                                <span class="field-hint">Number of pins to request</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Live total ── --}}
                    <div class="total-box">
                        <div class="total-box-label">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            Total to Pay
                        </div>
                        <div class="total-box-amount">
                            ₹{{ number_format(($pin_amount ?? 0) * ($pin_count ?? 0), 2) }}
                        </div>
                    </div>

                </div>

                {{-- ── Payment Proof ── --}}
                <div class="form-section-label">Payment Receipt</div>
                <div class="form-fields">

                    <div class="field">
                        <label class="field-label">
                            Upload Receipt <span class="req">*</span>
                        </label>
                        <div class="file-input-wrap">
                            <input
                                type="file"
                                wire:model="payment_proof"
                                accept=".png,.jpg,.jpeg,.svg,.pdf"
                            >
                        </div>

                        {{-- Upload progress indicator --}}
                        <div wire:loading wire:target="payment_proof" class="uploading-hint">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/></svg>
                            Uploading receipt…
                        </div>

                        @error('payment_proof')
                            <span class="field-error">{{ $message }}</span>
                        @else
                            <span class="field-hint" wire:loading.remove wire:target="payment_proof">
                                PNG, JPG, JPEG or SVG — max 2MB
                            </span>
                        @enderror

                        {{-- Live preview --}}
                        @if($payment_proof)
                            <div class="proof-preview">
                                <img src="{{ $payment_proof->temporaryUrl() }}" alt="Receipt preview">
                            </div>
                        @endif
                    </div>

                </div>

                {{-- ── Additional Info ── --}}
                <div class="form-section-label">Additional Info</div>
                <div class="form-fields">

                    <div class="field">
                        <label class="field-label">
                            Note <span class="opt">(optional)</span>
                        </label>
                        <textarea
                            wire:model="note"
                            class="field-textarea"
                            placeholder="e.g. Transaction ID, Bank Name, UTR Number…"
                        ></textarea>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="btn-submit">
                        <span wire:loading wire:target="submitRequest" class="btn-spinner"></span>
                        <span wire:loading.remove wire:target="submitRequest">
                            <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;display:inline;margin-right:4px;vertical-align:-2px;"><polyline points="20 6 9 17 4 12"/></svg>
                            Submit Request
                        </span>
                        <span wire:loading wire:target="submitRequest">Submitting…</span>
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>