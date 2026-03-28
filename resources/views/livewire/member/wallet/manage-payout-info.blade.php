<div>
    <style>
        /* ── Method tabs ── */
        .method-tabs {
            display: flex; gap: 0;
            border-bottom: 1px solid var(--border-soft);
            margin-bottom: 1.5rem;
            overflow-x: auto; scrollbar-width: none;
        }
        .method-tabs::-webkit-scrollbar { display: none; }
        .method-tab {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.65rem 1.1rem;
            background: none; border: none;
            border-bottom: 2px solid transparent;
            font-family: var(--font-body); font-size: 0.82rem;
            color: var(--text-faint); cursor: pointer; white-space: nowrap;
            transition: color 0.2s, border-color 0.2s; margin-bottom: -1px;
        }
        .method-tab:hover { color: var(--text-muted); }
        .method-tab.active { color: var(--accent-text); border-bottom-color: var(--accent); }
        .method-tab svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 1.8; }
        .method-count {
            font-size: 0.62rem; padding: 0.1rem 0.4rem;
            border-radius: 3px; background: var(--accent-dim);
            color: var(--accent-text); border: 1px solid var(--border);
        }

        /* ── Info cards grid ── */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1rem;
        }

        /* ── Info card ── */
        .info-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px; overflow: hidden;
            transition: border-color 0.2s, transform 0.15s;
            position: relative;
        }
        .info-card:hover { border-color: var(--border); transform: translateY(-1px); }
        .info-card.is-default { border-color: var(--border); }
        .info-card.is-default::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: var(--accent);
        }

        .info-card-body { padding: 1rem 1.1rem; }

        /* Method pill */
        .method-pill {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.18rem 0.55rem; border-radius: 4px;
            font-size: 0.65rem; font-weight: 500; letter-spacing: 0.06em;
            text-transform: uppercase; margin-bottom: 0.65rem;
        }
        .pill-bank   { background: rgba(59,130,246,.1);  color: #60a5fa; border: 1px solid rgba(59,130,246,.2); }
        .pill-upi    { background: rgba(34,197,94,.1);   color: #4ade80; border: 1px solid rgba(34,197,94,.2); }
        .pill-crypto { background: rgba(251,191,36,.1);  color: var(--warning); border: 1px solid rgba(251,191,36,.2); }

        /* Default badge */
        .default-badge {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.15rem 0.5rem; border-radius: 3px;
            font-size: 0.62rem; font-weight: 600;
            background: var(--accent-dim); color: var(--accent-text);
            border: 1px solid var(--border); margin-left: 0.4rem;
        }
        .default-badge svg { width: 9px; height: 9px; stroke: currentColor; fill: none; stroke-width: 2.5; }

        /* Detail rows */
        .detail-list { display: flex; flex-direction: column; gap: 0.4rem; }
        .detail-row { display: flex; align-items: baseline; gap: 0.5rem; font-size: 0.78rem; }
        .detail-key   { color: var(--text-faint); font-size: 0.68rem; min-width: 90px; flex-shrink: 0; }
        .detail-value { color: var(--text-muted); word-break: break-all; }
        .detail-value.mono { font-family: var(--font-mono, monospace); font-size: 0.75rem; }
        .detail-value.masked { letter-spacing: 0.08em; }

        /* Card label */
        .card-label {
            font-size: 0.82rem; font-weight: 500;
            color: var(--text); margin-bottom: 0.6rem;
        }

        /* Card footer */
        .info-card-footer {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.6rem 1.1rem;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-3);
        }
        .btn-icon {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.28rem 0.65rem; border-radius: 5px;
            font-family: var(--font-body); font-size: 0.72rem;
            cursor: pointer; border: 1px solid transparent;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
            background: none;
        }
        .btn-icon svg { width: 11px; height: 11px; stroke: currentColor; fill: none; stroke-width: 2; }
        .btn-edit    { color: var(--accent-text); border-color: var(--border); }
        .btn-edit:hover { background: var(--accent-dim); }
        .btn-default { color: var(--text-faint); border-color: var(--border-soft); }
        .btn-default:hover { color: var(--accent-text); border-color: var(--border); background: var(--accent-dim); }
        .btn-delete  { color: var(--danger); opacity: 0.7; border-color: transparent; margin-left: auto; }
        .btn-delete:hover { opacity: 1; background: rgba(248,113,113,0.08); border-color: rgba(248,113,113,0.22); }

        /* Add card (dashed placeholder) */
        .add-card {
            background: var(--bg-2);
            border: 1px dashed var(--border-soft);
            border-radius: 12px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 0.5rem; padding: 1.75rem 1rem;
            cursor: pointer; text-align: center;
            transition: border-color 0.2s, background 0.2s;
            min-height: 120px;
        }
        .add-card:hover { border-color: var(--border); background: var(--accent-dim); }
        .add-card svg { width: 22px; height: 22px; stroke: var(--text-faint); fill: none; stroke-width: 1.5; opacity: 0.6; }
        .add-card span { font-size: 0.78rem; color: var(--text-faint); }

        /* ── Alert ── */
        .alert-success {
            display: flex; align-items: flex-start; gap: 0.65rem;
            padding: 0.85rem 1rem;
            background: rgba(74,222,128,0.08); border: 1px solid rgba(74,222,128,0.22);
            border-radius: 8px; font-size: 0.82rem; color: var(--success);
            margin-bottom: 1.25rem;
        }
        .alert-success svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

        /* ── Empty state ── */
        .empty-state {
            text-align: center; padding: 3rem 1rem;
            background: var(--bg-2); border: 1px dashed var(--border-soft);
            border-radius: 12px;
        }
        .empty-state svg { width: 38px; height: 38px; stroke: var(--text-faint); fill: none; stroke-width: 1.4; margin: 0 auto 0.75rem; display: block; opacity: 0.45; }
        .empty-state p { font-size: 0.875rem; color: var(--text-muted); }

        /* ═══ MODAL ═══ */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,.55); backdrop-filter: blur(4px);
            z-index: 200; display: flex; align-items: center; justify-content: center; padding: 1rem;
        }
        .modal-card {
            background: var(--bg-2); border: 1px solid var(--border);
            border-radius: 14px; width: 100%; max-width: 480px;
            max-height: 90vh; overflow-y: auto; scrollbar-width: none;
        }
        .modal-card::-webkit-scrollbar { display: none; }
        .modal-header {
            padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border-soft);
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; background: var(--bg-2); z-index: 1;
        }
        .modal-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 500; color: var(--text); }
        .modal-body { padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem; }
        .modal-footer {
            padding: 1rem 1.5rem; border-top: 1px solid var(--border-soft);
            background: var(--bg-3); display: flex; align-items: center;
            justify-content: flex-end; gap: 0.75rem;
            position: sticky; bottom: 0;
        }
        .btn-x { background: none; border: none; color: var(--text-faint); cursor: pointer; font-size: 1.3rem; line-height: 1; padding: 0; transition: color .2s; }
        .btn-x:hover { color: var(--text); }

        /* Method selector */
        .method-selector { display: grid; grid-template-columns: repeat(3,1fr); gap: 0.6rem; }
        .method-opt {
            display: flex; flex-direction: column; align-items: center; gap: 0.35rem;
            padding: 0.75rem 0.5rem;
            border: 1px solid var(--border-soft); border-radius: 9px;
            cursor: pointer; transition: border-color .2s, background .2s;
            background: var(--bg-3); text-align: center;
        }
        .method-opt.active { border-color: var(--accent); background: var(--accent-dim); }
        .method-opt:not(.active):hover { border-color: var(--border); }
        .method-opt input { display: none; }
        .method-opt svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 1.6; }
        .method-opt.active svg { stroke: var(--accent-text); }
        .method-opt span { font-size: 0.75rem; color: var(--text-muted); }
        .method-opt.active span { color: var(--accent-text); font-weight: 500; }

        /* Form fields */
        .field { display: flex; flex-direction: column; gap: 0.35rem; }
        .field-label { font-size: 0.78rem; font-weight: 500; color: var(--text-muted); letter-spacing: 0.03em; }
        .field-input, .field-select {
            background: var(--bg-3); border: 1px solid var(--border-soft);
            border-radius: 8px; padding: 0.62rem 0.9rem;
            font-size: 0.875rem; color: var(--text); font-family: var(--font-body);
            width: 100%; outline: none; transition: border-color .2s, box-shadow .2s;
        }
        .field-input:focus, .field-select:focus { border-color: var(--border); box-shadow: 0 0 0 3px var(--accent-dim); }
        .field-input.has-error { border-color: rgba(248,113,113,.5); box-shadow: 0 0 0 3px rgba(248,113,113,.08); }
        .field-error { font-size: .7rem; color: var(--danger); }
        .field-hint  { font-size: .7rem; color: var(--text-faint); }
        .field-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; }

        .btn-primary {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .6rem 1.4rem; background: var(--accent); color: var(--bg);
            border: none; border-radius: 8px; font-family: var(--font-body);
            font-size: .875rem; font-weight: 500; cursor: pointer;
            transition: opacity .2s, transform .15s;
        }
        .btn-primary:hover:not(:disabled) { opacity: .88; transform: translateY(-1px); }
        .btn-primary:disabled { opacity: .5; cursor: not-allowed; }
        .btn-cancel {
            display: inline-flex; align-items: center; padding: .6rem 1.2rem;
            background: transparent; color: var(--text-muted); border: 1px solid var(--border-soft);
            border-radius: 8px; font-family: var(--font-body); font-size: .875rem;
            cursor: pointer; transition: color .2s;
        }
        .btn-cancel:hover { color: var(--text); }
        .btn-spinner {
            width: 14px; height: 14px; border-radius: 50%;
            border: 2px solid rgba(0,0,0,.2); border-top-color: var(--bg);
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>

    {{-- ═══ PAGE HEADER ═══ --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;margin-bottom:1.5rem;flex-wrap:wrap;">
        <div>
            <div class="page-title">Payout Details</div>
            <div class="page-sub">Manage your bank accounts, UPI IDs and crypto wallets for withdrawals</div>
        </div>
        <button wire:click="openAdd" class="btn-primary" style="flex-shrink:0;">
            <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Add Account
        </button>
    </div>

    {{-- Flash --}}
    @if(session('payout_info_saved'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('payout_info_saved') }}
        </div>
    @endif

    {{-- ═══ METHOD TABS ═══ --}}
    @php
        $methodLabels = ['bank' => 'Bank Transfer', 'upi' => 'UPI', 'crypto' => 'Crypto'];
        $methodIcons  = [
            'bank'   => '<path d="M3 22h18"/><path d="M6 18V11"/><path d="M10 18V11"/><path d="M14 18V11"/><path d="M18 18V11"/><path d="M2 11l10-7 10 7"/>',
            'upi'    => '<rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>',
            'crypto' => '<path d="M11.767 19.089c4.924.868 6.14-6.025 1.216-6.894m-1.216 6.894L5.86 18.047m5.908 1.042-.347 1.97m1.563-8.864c4.924.869 6.14-6.025 1.215-6.893m-1.215 6.893-3.94-.694m5.155-6.2L8.29 5.4m5.908 1.042.348-1.97M7.48 20.364l3.126-17.727"/>',
        ];
        $activeTab = session('payout_tab', 'bank');
    @endphp

    <div class="method-tabs">
        @foreach($methodLabels as $key => $label)
            <button
                onclick="switchTab('{{ $key }}')"
                id="tab-{{ $key }}"
                class="method-tab {{ $key === 'bank' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">{!! $methodIcons[$key] !!}</svg>
                {{ $label }}
                @if(isset($infos[$key]) && $infos[$key]->count() > 0)
                    <span class="method-count">{{ $infos[$key]->count() }}</span>
                @endif
            </button>
        @endforeach
    </div>

    {{-- ═══ CONTENT PANELS ═══ --}}
    @foreach($methodLabels as $key => $label)
        <div id="panel-{{ $key }}" style="{{ $key !== 'bank' ? 'display:none;' : '' }}">

            @if(isset($infos[$key]) && $infos[$key]->count() > 0)
                <div class="info-grid">
                    @foreach($infos[$key] as $info)
                        <div class="info-card {{ $info->is_default ? 'is-default' : '' }}">
                            <div class="info-card-body">

                                {{-- Method pill + default badge --}}
                                <div style="display:flex;align-items:center;margin-bottom:.65rem;flex-wrap:wrap;gap:.4rem;">
                                    <span class="method-pill pill-{{ $info->method }}">{{ strtoupper($info->method) }}</span>
                                    @if($info->is_default)
                                        <span class="default-badge">
                                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                            Default
                                        </span>
                                    @endif
                                </div>

                                {{-- Custom label --}}
                                @if($info->label)
                                    <div class="card-label">{{ $info->label }}</div>
                                @endif

                                {{-- Detail rows --}}
                                <div class="detail-list">
                                    @if($info->method === 'bank')
                                        <div class="detail-row">
                                            <span class="detail-key">Bank</span>
                                            <span class="detail-value">{{ $info->bank_name }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-key">Holder</span>
                                            <span class="detail-value">{{ $info->account_holder }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-key">Account</span>
                                            <span class="detail-value mono masked">{{ $info->masked_account }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-key">IFSC</span>
                                            <span class="detail-value mono">{{ $info->ifsc_code }}</span>
                                        </div>
                                        @if($info->branch)
                                            <div class="detail-row">
                                                <span class="detail-key">Branch</span>
                                                <span class="detail-value">{{ $info->branch }}</span>
                                            </div>
                                        @endif

                                    @elseif($info->method === 'upi')
                                        <div class="detail-row">
                                            <span class="detail-key">UPI ID</span>
                                            <span class="detail-value mono">{{ $info->upi_id }}</span>
                                        </div>

                                    @elseif($info->method === 'crypto')
                                        <div class="detail-row">
                                            <span class="detail-key">Network</span>
                                            <span class="detail-value">{{ $info->crypto_network }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-key">Address</span>
                                            <span class="detail-value mono masked">{{ $info->masked_wallet }}</span>
                                        </div>
                                    @endif
                                </div>

                            </div>

                            {{-- Card footer actions --}}
                            <div class="info-card-footer">
                                <button wire:click="openEdit({{ $info->id }})" class="btn-icon btn-edit">
                                    <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </button>
                                @if(!$info->is_default)
                                    <button wire:click="setDefault({{ $info->id }})" class="btn-icon btn-default">
                                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        Set Default
                                    </button>
                                @endif
                                <button
                                    wire:click="delete({{ $info->id }})"
                                    wire:confirm="Delete this payout account? This cannot be undone."
                                    class="btn-icon btn-delete">
                                    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                    Delete
                                </button>
                            </div>
                        </div>
                    @endforeach

                    {{-- Add another --}}
                    <div class="add-card" wire:click="openAdd">
                        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        <span>Add {{ $label }}</span>
                    </div>
                </div>

            @else
                <div class="empty-state">
                    <svg viewBox="0 0 24 24">{!! $methodIcons[$key] !!}</svg>
                    <p>No {{ $label }} accounts saved yet</p>
                    <button wire:click="openAdd" class="btn-primary" style="margin-top:1rem;display:inline-flex;">
                        <svg viewBox="0 0 24 24" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Add {{ $label }}
                    </button>
                </div>
            @endif
        </div>
    @endforeach

    {{-- ═══ ADD / EDIT MODAL ═══ --}}
    @if($showModal)
        <div class="modal-overlay" wire:click.self="closeModal">
            <div class="modal-card">

                <div class="modal-header">
                    <div class="modal-title">{{ $editingId ? 'Edit' : 'Add' }} Payout Account</div>
                    <button class="btn-x" wire:click="closeModal">&times;</button>
                </div>

                <div class="modal-body">

                    {{-- Method selector (only on add) --}}
                    @if(!$editingId)
                        <div class="field">
                            <div class="field-label">Payment Method</div>
                            <div class="method-selector">
                                @foreach(['bank' => 'Bank', 'upi' => 'UPI', 'crypto' => 'Crypto'] as $m => $mlabel)
                                    <label class="method-opt {{ $method === $m ? 'active' : '' }}">
                                        <input type="radio" wire:model.live="method" value="{{ $m }}">
                                        <svg viewBox="0 0 24 24">{!! $methodIcons[$m] !!}</svg>
                                        <span>{{ $mlabel }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <span class="method-pill pill-{{ $method }}">{{ strtoupper($method) }}</span>
                            <span style="font-size:.78rem;color:var(--text-faint);">Method cannot be changed after saving</span>
                        </div>
                    @endif

                    {{-- Custom label --}}
                    <div class="field">
                        <label class="field-label" for="label">
                            Account Label <span style="color:var(--text-faint);font-weight:300;font-size:.68rem;">(optional)</span>
                        </label>
                        <input wire:model="label" id="label" type="text"
                               class="field-input" placeholder="e.g. My SBI Account, Personal UPI">
                    </div>

                    {{-- ── BANK FIELDS ── --}}
                    @if($method === 'bank')
                        <div class="field-row-2">
                            <div class="field">
                                <label class="field-label">Bank Name <span style="color:var(--danger)">*</span></label>
                                <input wire:model="bank_name" type="text"
                                       class="field-input @error('bank_name') has-error @enderror"
                                       placeholder="State Bank of India">
                                @error('bank_name') <span class="field-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="field">
                                <label class="field-label">Account Holder <span style="color:var(--danger)">*</span></label>
                                <input wire:model="account_holder" type="text"
                                       class="field-input @error('account_holder') has-error @enderror"
                                       placeholder="Full name as on account">
                                @error('account_holder') <span class="field-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label class="field-label">Account Number <span style="color:var(--danger)">*</span></label>
                            <input wire:model="account_number" type="text"
                                   class="field-input @error('account_number') has-error @enderror"
                                   placeholder="e.g. 00112233445566"
                                   style="font-family:var(--font-mono,monospace);letter-spacing:.04em;">
                            @error('account_number') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field-row-2">
                            <div class="field">
                                <label class="field-label">IFSC Code <span style="color:var(--danger)">*</span></label>
                                <input wire:model="ifsc_code" type="text"
                                       class="field-input @error('ifsc_code') has-error @enderror"
                                       placeholder="SBIN0001234"
                                       style="font-family:var(--font-mono,monospace);text-transform:uppercase;letter-spacing:.06em;">
                                @error('ifsc_code') <span class="field-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="field">
                                <label class="field-label">Branch <span style="color:var(--text-faint);font-weight:300;font-size:.68rem;">(optional)</span></label>
                                <input wire:model="branch" type="text"
                                       class="field-input" placeholder="e.g. Andheri West">
                            </div>
                        </div>
                    @endif

                    {{-- ── UPI FIELDS ── --}}
                    @if($method === 'upi')
                        <div class="field">
                            <label class="field-label">UPI ID <span style="color:var(--danger)">*</span></label>
                            <input wire:model="upi_id" type="text"
                                   class="field-input @error('upi_id') has-error @enderror"
                                   placeholder="name@paytm / name@okicici"
                                   style="font-family:var(--font-mono,monospace);">
                            <span class="field-hint">Enter your full VPA (Virtual Payment Address)</span>
                            @error('upi_id') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    {{-- ── CRYPTO FIELDS ── --}}
                    @if($method === 'crypto')
                        <div class="field">
                            <label class="field-label">Network <span style="color:var(--danger)">*</span></label>
                            <select wire:model="crypto_network"
                                    class="field-select @error('crypto_network') has-error @enderror">
                                <option value="">Select network</option>
                                <option value="BTC">Bitcoin (BTC)</option>
                                <option value="ETH">Ethereum (ETH)</option>
                                <option value="USDT-TRC20">USDT — TRC20 (Tron)</option>
                                <option value="USDT-ERC20">USDT — ERC20 (Ethereum)</option>
                                <option value="BNB">BNB Smart Chain</option>
                                <option value="SOL">Solana (SOL)</option>
                                <option value="TRX">Tron (TRX)</option>
                            </select>
                            @error('crypto_network') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label class="field-label">Wallet Address <span style="color:var(--danger)">*</span></label>
                            <input wire:model="wallet_address" type="text"
                                   class="field-input @error('wallet_address') has-error @enderror"
                                   placeholder="0x... / T... / 1..."
                                   style="font-family:var(--font-mono,monospace);font-size:.82rem;letter-spacing:.03em;">
                            <span class="field-hint">Double-check the address — crypto transfers cannot be reversed</span>
                            @error('wallet_address') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                    @endif

                </div>

                <div class="modal-footer">
                    <button wire:click="closeModal" class="btn-cancel">Cancel</button>
                    <button
                        wire:click="save"
                        wire:loading.attr="disabled"
                        class="btn-primary">
                        <span wire:loading wire:target="save" class="btn-spinner"></span>
                        <svg wire:loading.remove wire:target="save" viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        <span wire:loading.remove wire:target="save">Save Account</span>
                        <span wire:loading wire:target="save">Saving…</span>
                    </button>
                </div>

            </div>
        </div>
    @endif

    <script>
        function switchTab(key) {
            ['bank','upi','crypto'].forEach(k => {
                document.getElementById('tab-' + k)?.classList.toggle('active', k === key);
                const panel = document.getElementById('panel-' + k);
                if (panel) panel.style.display = k === key ? '' : 'none';
            });
        }
    </script>

</div>