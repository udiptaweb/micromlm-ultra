<div>
    <style>
        .form-wrap {
            max-width: 560px;
            margin: 0 auto;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.82rem;
            color: var(--text-faint);
            text-decoration: none;
            transition: color 0.2s;
            margin-bottom: 1.5rem;
        }
        .back-link:hover { color: var(--accent-text); }
        .back-link svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }

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

        /* ── Flash ── */
        .alert-success {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.9rem 1.1rem;
            background: rgba(74,222,128,0.08);
            border: 1px solid rgba(74,222,128,0.25);
            border-radius: 8px;
            font-size: 0.85rem;
            color: var(--success);
            margin-bottom: 1.25rem;
        }
        .alert-success svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }

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
        .field-textarea { resize: vertical; min-height: 90px; }
        .field-input::placeholder,
        .field-textarea::placeholder { color: var(--text-faint); }
        .field-input:focus,
        .field-textarea:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }
        .field-input.has-error,
        .field-textarea.has-error {
            border-color: rgba(248,113,113,0.5);
            box-shadow: 0 0 0 3px rgba(248,113,113,0.08);
        }

        .field-hint  { font-size: 0.72rem; color: var(--text-faint); }
        .field-error { font-size: 0.72rem; color: var(--danger); }

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
            transition: background 0.2s;
        }
        .file-input-wrap input[type="file"]::file-selector-button:hover {
            background: var(--accentDim, var(--accent-dim));
            opacity: 0.85;
        }

        /* ── Commission box ── */
        .commission-box {
            background: var(--accent-dim);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        /* ── Toggle checkbox rows ── */
        .check-row {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            cursor: pointer;
        }
        .check-row input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--accent);
            cursor: pointer;
            flex-shrink: 0;
        }
        .check-row-label {
            font-size: 0.85rem;
            font-weight: 400;
            color: var(--text);
            cursor: pointer;
            user-select: none;
        }
        .check-row-sub {
            font-size: 0.72rem;
            color: var(--text-faint);
            margin-top: 0.15rem;
        }

        /* Status row */
        .status-check-box {
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.85rem 1rem;
        }

        /* ── Form footer ── */
        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-3);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            padding: 0.6rem 1.2rem;
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.82rem;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.2s, border-color 0.2s;
        }
        .btn-cancel:hover { color: var(--text); border-color: var(--border); }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.4rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-submit:hover:not(:disabled) { opacity: 0.88; transform: translateY(-1px); }
        .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; }

        .btn-spinner {
            width: 14px; height: 14px;
            border-radius: 50%;
            border: 2px solid rgba(0,0,0,0.2);
            border-top-color: var(--bg);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>

    <div class="form-wrap">

        {{-- Back link --}}
        <a href="{{ route('admin.products.index') }}" wire:navigate class="back-link">
            <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Products
        </a>

        {{-- Page title --}}
        <div class="form-page-title">Create Product</div>
        <div class="form-page-sub">Add a new product and configure commission settings.</div>

        {{-- Flash --}}
        @if(session()->has('message'))
            <div class="alert-success">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('message') }}
            </div>
        @endif

        <div class="form-card">
            <form wire:submit.prevent="createProduct">

                {{-- ── Product Details ── --}}
                <div class="form-section-label">Product Details</div>
                <div class="form-fields">

                    <div class="field">
                        <label class="field-label">
                            Product Name <span class="req">*</span>
                        </label>
                        <input
                            type="text"
                            wire:model.defer="name"
                            class="field-input @error('name') has-error @enderror"
                            placeholder="e.g. Premium Membership"
                        >
                        @error('name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="field-label">
                            Description <span class="opt">(optional)</span>
                        </label>
                        <textarea
                            wire:model.defer="description"
                            class="field-textarea"
                            placeholder="Short product description…"
                        ></textarea>
                    </div>

                    <div class="field">
                        <label class="field-label">
                            Price <span class="req">*</span>
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            wire:model.defer="price"
                            class="field-input @error('price') has-error @enderror"
                            placeholder="0.00"
                        >
                        @error('price')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                {{-- ── Media ── --}}
                <div class="form-section-label">Media</div>
                <div class="form-fields">

                    <div class="field">
                        <label class="field-label">
                            Product Image <span class="opt">(optional)</span>
                        </label>
                        <div class="file-input-wrap">
                            <input
                                type="file"
                                wire:model="image"
                                accept="image/*"
                            >
                        </div>
                        @error('image')
                            <span class="field-error">{{ $message }}</span>
                        @else
                            <span class="field-hint">JPG, PNG or WEBP — max 2MB</span>
                        @enderror

                        {{-- Live preview --}}
                        @if($image)
                            <div style="margin-top:0.5rem;">
                                <img src="{{ $image->temporaryUrl() }}"
                                     alt="Preview"
                                     style="max-height:120px; border-radius:6px; border:1px solid var(--border-soft);">
                            </div>
                        @endif
                    </div>

                </div>

                {{-- ── Commission ── --}}
                <div class="form-section-label">Commission Settings</div>
                <div class="form-fields">

                    <div class="commission-box">
                        <label class="check-row">
                            <input
                                type="checkbox"
                                wire:model.live="commission_enabled"
                            >
                            <div>
                                <div class="check-row-label">Enable Commission</div>
                                <div class="check-row-sub">Distribute commission to upline when this product is purchased</div>
                            </div>
                        </label>

                        @if($commission_enabled)
                            <div class="field">
                                <label class="field-label">
                                    Commission Percentage <span class="req">*</span>
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    max="100"
                                    wire:model.defer="commission_percent"
                                    class="field-input @error('commission_percent') has-error @enderror"
                                    placeholder="e.g. 10"
                                >
                                @error('commission_percent')
                                    <span class="field-error">{{ $message }}</span>
                                @else
                                    <span class="field-hint">Enter a value between 0 and 100</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                </div>

                {{-- ── Visibility ── --}}
                <div class="form-section-label">Visibility</div>
                <div class="form-fields">

                    <div class="status-check-box">
                        <label class="check-row">
                            <input
                                type="checkbox"
                                wire:model.defer="is_active"
                            >
                            <div>
                                <div class="check-row-label">Product is Active</div>
                                <div class="check-row-sub">Visible and purchasable by members immediately</div>
                            </div>
                        </label>
                    </div>

                </div>

                {{-- ── Footer ── --}}
                <div class="form-footer">
                    <a href="{{ route('admin.products.index') }}"
                       wire:navigate
                       wire:loading.attr="disabled"
                       class="btn-cancel">
                        Cancel
                    </a>
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="btn-submit">
                        <span wire:loading wire:target="createProduct" class="btn-spinner"></span>
                        <span wire:loading.remove wire:target="createProduct">Create Product</span>
                        <span wire:loading wire:target="createProduct">Creating…</span>
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>