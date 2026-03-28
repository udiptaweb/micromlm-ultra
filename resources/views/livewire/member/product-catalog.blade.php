<div>
    <style>
        /* ── Page header ── */
        .catalog-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
        }
        .catalog-title {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.01em;
            margin-bottom: 0.3rem;
        }
        .catalog-sub {
            font-size: 0.82rem;
            color: var(--text-faint);
        }

        /* ── Search ── */
        .search-wrap {
            position: relative;
            flex-shrink: 0;
        }
        .search-wrap svg {
            position: absolute;
            left: 0.75rem; top: 50%;
            transform: translateY(-50%);
            width: 15px; height: 15px;
            stroke: var(--text-faint); fill: none; stroke-width: 2;
            pointer-events: none;
        }
        .search-input {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.6rem 0.9rem 0.6rem 2.2rem;
            font-size: 0.85rem;
            color: var(--text);
            font-family: var(--font-body);
            width: 240px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-input::placeholder { color: var(--text-faint); }
        .search-input:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
            width: 280px;
        }

        /* ── Product grid ── */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }
        @media (max-width: 1100px) { .product-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 760px)  { .product-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 480px)  { .product-grid { grid-template-columns: 1fr; } }

        /* ── Product card ── */
        .product-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: border-color 0.25s, transform 0.2s, box-shadow 0.2s;
        }
        .product-card:hover {
            border-color: var(--border);
            transform: translateY(-3px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }

        /* ── Image area ── */
        .product-image {
            position: relative;
            height: 180px;
            background: var(--bg-3);
            overflow: hidden;
            flex-shrink: 0;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.4s ease;
        }
        .product-card:hover .product-image img { transform: scale(1.04); }

        /* No image placeholder */
        .product-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .product-image-placeholder svg {
            width: 40px; height: 40px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            opacity: 0.4;
        }

        /* Commission badge */
        .commission-badge {
            position: absolute;
            top: 0.6rem;
            right: 0.6rem;
            background: var(--success);
            color: var(--bg);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            padding: 0.25rem 0.55rem;
            border-radius: 4px;
            z-index: 2;
            white-space: nowrap;
        }

        /* ── Card body ── */
        .product-body {
            flex: 1;
            padding: 1rem 1.1rem 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .product-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text);
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
            transition: color 0.2s;
        }
        .product-name:hover { color: var(--accent-text); }

        .product-desc {
            font-size: 0.78rem;
            color: var(--text-faint);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.55;
            flex: 1;
        }

        .product-price {
            font-family: var(--font-display);
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--text);
            margin-top: auto;
            padding-top: 0.5rem;
        }

        /* ── Card footer ── */
        .product-footer {
            display: flex;
            gap: 0.6rem;
            padding: 0.75rem 1.1rem;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-3);
        }

        .btn-details {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0.75rem;
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-soft);
            border-radius: 7px;
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 400;
            text-decoration: none;
            transition: color 0.2s, border-color 0.2s, background 0.2s;
            white-space: nowrap;
        }
        .btn-details:hover {
            color: var(--text);
            border-color: var(--border);
            background: var(--accent-dim);
        }

        .btn-buy {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.5rem 0.75rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 7px;
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 500;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.15s;
            white-space: nowrap;
        }
        .btn-buy:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-buy svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2.5; }

        /* ── Empty state ── */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 1rem;
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
        }
        .empty-state svg {
            width: 40px; height: 40px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            margin: 0 auto 0.85rem; display: block; opacity: 0.5;
        }
        .empty-state p { font-size: 0.875rem; color: var(--text-muted); }

        /* ── Pagination ── */
        .pagination-wrap {
            margin-top: 1.5rem;
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
    </style>

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="catalog-header">
        <div>
            <div class="catalog-title">Available Products</div>
            <div class="catalog-sub">Browse and purchase products from our catalog</div>
        </div>
        <div class="search-wrap">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Search products…"
                class="search-input"
            >
        </div>
    </div>

    {{-- ═══ PRODUCT GRID ═══ --}}
    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-card">

                {{-- Image --}}
                <div class="product-image">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}">
                    @else
                        <div class="product-image-placeholder">
                            <svg viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif

                    @if($product->commission_enabled)
                        <div class="commission-badge">
                            {{ $product->commission_percent }}% Earn
                        </div>
                    @endif
                </div>

                {{-- Body --}}
                <div class="product-body">
                    <a href="{{ route('member.products.show', $product->id) }}"
                       wire:navigate
                       class="product-name">
                        {{ $product->name }}
                    </a>
                    @if($product->description)
                        <p class="product-desc">{{ $product->description }}</p>
                    @endif
                    <div class="product-price">
                        ₹{{ number_format($product->price, 2) }}
                    </div>
                </div>

                {{-- Footer actions --}}
                <div class="product-footer">
                    <a href="{{ route('member.products.show', $product->id) }}"
                       wire:navigate
                       class="btn-details">
                        Details
                    </a>
                    <a href="{{ route('member.product.checkout', $product->id) }}"
                       wire:navigate
                       class="btn-buy">
                        <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                        Buy Now
                    </a>
                </div>

            </div>
        @empty
            <div class="empty-state">
                <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                <p>No products found{{ $search ? ' matching "' . $search . '"' : '' }}</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrap">
        {{ $products->links() }}
    </div>

</div>