<div>
    <style>
        /* ── Breadcrumb ── */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-bottom: 1.75rem;
            font-size: 0.8rem;
            flex-wrap: wrap;
        }
        .breadcrumb a {
            color: var(--accent-text);
            text-decoration: none;
            transition: color 0.2s;
        }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb-sep {
            width: 14px; height: 14px;
            stroke: var(--text-faint); fill: none; stroke-width: 2;
        }
        .breadcrumb-current {
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 220px;
        }

        /* ── Two-column layout ── */
        .product-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
            align-items: start;
        }
        @media (max-width: 820px) {
            .product-detail-grid { grid-template-columns: 1fr; gap: 1.5rem; }
        }

        /* ── Image panel ── */
        .product-image-panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            overflow: hidden;
            aspect-ratio: 1 / 1;
            position: relative;
        }
        .product-image-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .product-image-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            background: var(--bg-3);
        }
        .product-image-placeholder svg {
            width: 64px; height: 64px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.2;
            opacity: 0.35;
        }

        /* Commission overlay badge on image */
        .image-commission-badge {
            position: absolute;
            top: 1rem; right: 1rem;
            background: var(--success);
            color: var(--bg);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            padding: 0.3rem 0.75rem;
            border-radius: 5px;
            z-index: 2;
        }

        /* ── Info panel ── */
        .product-info { display: flex; flex-direction: column; gap: 1.25rem; }

        .product-name {
            font-family: var(--font-display);
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 500;
            color: var(--text);
            line-height: 1.15;
            letter-spacing: -0.01em;
        }

        .product-price {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 500;
            color: var(--accent-text);
            line-height: 1;
        }

        /* ── Commission earn box ── */
        .earn-box {
            background: rgba(74,222,128,0.07);
            border: 1px solid rgba(74,222,128,0.22);
            border-radius: 10px;
            padding: 1rem 1.15rem;
        }
        .earn-box-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.6rem;
        }
        .earn-box-icon {
            width: 28px; height: 28px;
            border-radius: 7px;
            background: rgba(74,222,128,0.12);
            border: 1px solid rgba(74,222,128,0.2);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .earn-box-icon svg { width: 14px; height: 14px; stroke: var(--success); fill: none; stroke-width: 2; }
        .earn-box-title { font-size: 0.82rem; font-weight: 500; color: var(--success); }
        .earn-box-desc {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.6;
        }
        .earn-box-desc strong { color: var(--success); font-weight: 600; }

        /* ── Description section ── */
        .desc-label {
            font-size: 0.7rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.5rem;
        }
        .desc-text {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.75;
        }

        /* ── Divider ── */
        .product-divider {
            height: 1px;
            background: var(--border-soft);
        }

        /* ── Action row ── */
        .product-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-buy-now {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.85rem 1.5rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 10px;
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-buy-now:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 8px 28px var(--accentGlow, rgba(0,0,0,0.25));
        }
        .btn-buy-now svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }

        .btn-wishlist {
            width: 44px; height: 44px;
            display: flex; align-items: center; justify-content: center;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            color: var(--text-faint);
            cursor: pointer;
            transition: color 0.2s, border-color 0.2s, background 0.2s;
            flex-shrink: 0;
        }
        .btn-wishlist:hover { color: var(--danger); border-color: rgba(248,113,113,0.3); background: rgba(248,113,113,0.06); }
        .btn-wishlist svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 1.8; }

        /* ── Back link ── */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            color: var(--text-faint);
            text-decoration: none;
            transition: color 0.2s;
            margin-top: 1.5rem;
        }
        .back-link:hover { color: var(--accent-text); }
        .back-link svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }
    </style>

    {{-- ═══ BREADCRUMB ═══ --}}
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('product.catalog') }}" wire:navigate>Products</a>
        <svg class="breadcrumb-sep" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
        <span class="breadcrumb-current">{{ $product->name }}</span>
    </nav>

    {{-- ═══ PRODUCT DETAIL GRID ═══ --}}
    <div class="product-detail-grid">

        {{-- ── LEFT: Image ── --}}
        <div class="product-image-panel">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}">
            @else
                <div class="product-image-placeholder">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif

            @if($product->commission_enabled)
                <div class="image-commission-badge">
                    {{ $product->commission_percent }}% Earn
                </div>
            @endif
        </div>

        {{-- ── RIGHT: Info ── --}}
        <div class="product-info">

            {{-- Name --}}
            <h1 class="product-name">{{ $product->name }}</h1>

            {{-- Price --}}
            <div class="product-price">
                ₹{{ number_format($product->price, 2) }}
            </div>

            {{-- Commission earn box --}}
            @if($product->commission_enabled)
                <div class="earn-box">
                    <div class="earn-box-header">
                        <div class="earn-box-icon">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        </div>
                        <span class="earn-box-title">Earning Potential</span>
                    </div>
                    <p class="earn-box-desc">
                        Earn a <strong>{{ $product->commission_percent }}%</strong> commission on this purchase —
                        that's <strong>₹{{ number_format(($product->price * $product->commission_percent) / 100, 2) }}</strong> back in your wallet.
                    </p>
                </div>
            @endif

            <div class="product-divider"></div>

            {{-- Description --}}
            <div>
                <div class="desc-label">Description</div>
                <p class="desc-text">
                    {{ $product->description ?? 'No description provided for this product.' }}
                </p>
            </div>

            <div class="product-divider"></div>

            {{-- Actions --}}
            <div class="product-actions">
                <a href="{{ route('member.product.checkout', $product->id) }}"
                   wire:navigate
                   class="btn-buy-now">
                    <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    Buy Now
                </a>
                <button class="btn-wishlist" title="Add to favourites">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Back link --}}
    <a href="{{ route('product.catalog') }}" wire:navigate class="back-link">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Back to Products
    </a>

</div>