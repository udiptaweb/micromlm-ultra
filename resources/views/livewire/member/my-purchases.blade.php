<div>
    <style>
        /* ── Page header ── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .page-title {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.01em;
            margin-bottom: 0.25rem;
        }
        .page-sub { font-size: 0.82rem; color: var(--text-faint); }

        /* ── Toolbar ── */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .search-wrap { position: relative; }
        .search-wrap svg {
            position: absolute; left: 0.75rem; top: 50%;
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
            width: 200px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, width 0.2s;
        }
        .search-input::placeholder { color: var(--text-faint); }
        .search-input:focus {
            border-color: var(--border);
            box-shadow: 0 0 0 3px var(--accent-dim);
            width: 240px;
        }

        .filter-select {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 0.6rem 0.9rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            font-family: var(--font-body);
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .filter-select:focus { border-color: var(--border); }

        /* ── Orders grid ── */
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }
        @media (max-width: 1000px) { .orders-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px)  { .orders-grid { grid-template-columns: 1fr; } }

        /* ── Order card ── */
        .order-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: border-color 0.25s, transform 0.2s;
        }
        .order-card:hover { border-color: var(--border); transform: translateY(-2px); }

        /* Status stripe at top */
        .order-card::before {
            content: '';
            display: block;
            height: 3px;
            background: var(--stripe, var(--border-soft));
        }
        .order-card.completed::before  { --stripe: var(--success); }
        .order-card.pending::before    { --stripe: var(--warning); }
        .order-card.cancelled::before  { --stripe: var(--danger); }
        .order-card.processing::before { --stripe: var(--accent); }

        /* ── Product image strip ── */
        .order-image {
            height: 140px;
            background: var(--bg-3);
            overflow: hidden;
            flex-shrink: 0;
            position: relative;
        }
        .order-image img {
            width: 100%; height: 100%;
            object-fit: cover; object-position: center;
            transition: transform 0.4s ease;
        }
        .order-card:hover .order-image img { transform: scale(1.04); }
        .order-image-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
        }
        .order-image-placeholder svg {
            width: 36px; height: 36px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            opacity: 0.35;
        }

        /* ── Card body ── */
        .order-body {
            flex: 1;
            padding: 1rem 1.1rem 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .order-product-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .order-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }

        .order-amount {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text);
        }

        /* Status badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.67rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            white-space: nowrap;
        }
        .status-badge::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.7;
            flex-shrink: 0;
        }
        .badge-completed  { background: rgba(74,222,128,0.1);  color: var(--success); border: 1px solid rgba(74,222,128,0.22); }
        .badge-pending    { background: rgba(251,191,36,0.1);  color: var(--warning); border: 1px solid rgba(251,191,36,0.22); }
        .badge-cancelled  { background: rgba(248,113,113,0.1); color: var(--danger);  border: 1px solid rgba(248,113,113,0.22); }
        .badge-processing { background: var(--accent-dim);     color: var(--accent-text); border: 1px solid var(--border); }

        .order-qty-date {
            font-size: 0.72rem;
            color: var(--text-faint);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }

        /* ── Card footer ── */
        .order-footer {
            display: flex;
            gap: 0.6rem;
            padding: 0.75rem 1.1rem;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-3);
        }

        .order-id-pill {
            flex: 1;
            display: flex;
            align-items: center;
            font-size: 0.7rem;
            color: var(--text-faint);
            font-family: var(--font-mono, monospace);
            letter-spacing: 0.04em;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .btn-view {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.85rem;
            background: var(--accent-dim);
            color: var(--accent-text);
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: var(--font-body);
            font-size: 0.75rem;
            font-weight: 500;
            text-decoration: none;
            white-space: nowrap;
            transition: background 0.2s, color 0.2s;
            flex-shrink: 0;
        }
        .btn-view:hover { background: var(--border); color: var(--text); }
        .btn-view svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Empty state ── */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 1.5rem;
            background: var(--bg-2);
            border: 1px dashed var(--border-soft);
            border-radius: 12px;
        }
        .empty-state svg {
            width: 42px; height: 42px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            margin: 0 auto 0.85rem; display: block; opacity: 0.5;
        }
        .empty-state p       { font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem; }
        .empty-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.82rem;
            color: var(--accent-text);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .empty-link:hover { color: var(--accent); }
        .empty-link svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Pagination ── */
        .pagination-wrap { margin-top: 1.5rem; }
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
    <div class="page-header">
        <div>
            <div class="page-title">My Purchases</div>
            <div class="page-sub">All your product orders in one place</div>
        </div>
        <div class="toolbar">
            <div class="search-wrap">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="Search by order ID…"
                    class="search-input"
                >
            </div>
            <select wire:model.live="filter" class="filter-select">
                <option value="all">All Orders</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>

    {{-- ═══ ORDERS GRID ═══ --}}
    <div class="orders-grid">
        @forelse($orders as $order)
            @php
                $status     = $order->status ?? 'pending';
                $firstItem  = $order->items->first();
                $firstProd  = $firstItem?->product;
                $itemCount  = $order->items->count();
            @endphp
            <div class="order-card {{ $status }}">

                {{-- Product image — show first item's product image --}}
                <div class="order-image">
                    @if($firstProd?->image)
                        <img src="{{ asset('storage/' . $firstProd->image) }}"
                             alt="{{ $firstProd->name }}">
                    @else
                        <div class="order-image-placeholder">
                            <svg viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif

                    {{-- Badge if multiple items --}}
                    @if($itemCount > 1)
                        <div style="position:absolute;bottom:0.5rem;right:0.5rem;background:rgba(0,0,0,0.55);color:#fff;font-size:0.65rem;font-weight:600;padding:0.2rem 0.5rem;border-radius:4px;backdrop-filter:blur(4px);">
                            +{{ $itemCount - 1 }} more
                        </div>
                    @endif
                </div>

                {{-- Body --}}
                <div class="order-body">

                    {{-- First product name; indicate if multiple items --}}
                    <div class="order-product-name">
                        {{ $firstProd?->name ?? 'Product unavailable' }}
                        @if($itemCount > 1)
                            <span style="font-size:0.7rem;color:var(--text-faint);font-weight:400;">
                                &amp; {{ $itemCount - 1 }} other{{ $itemCount > 2 ? 's' : '' }}
                            </span>
                        @endif
                    </div>

                    {{-- Items summary pills --}}
                    @if($itemCount > 1)
                        <div style="display:flex;flex-wrap:wrap;gap:0.3rem;margin-top:0.1rem;">
                            @foreach($order->items->skip(1)->take(2) as $item)
                                <span style="font-size:0.65rem;padding:0.15rem 0.45rem;border-radius:4px;background:var(--bg-3);color:var(--text-faint);border:1px solid var(--border-soft);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100px;">
                                    {{ $item->product?->name ?? '—' }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <div class="order-meta-row">
                        <div class="order-amount">
                            ₹{{ number_format($order->total_amount ?? $order->amount ?? 0, 2) }}
                        </div>
                        <span class="status-badge
                            @if($status === 'completed')  badge-completed
                            @elseif($status === 'pending')   badge-pending
                            @elseif($status === 'cancelled') badge-cancelled
                            @else badge-processing
                            @endif">
                            {{ ucfirst($status) }}
                        </span>
                    </div>

                    <div class="order-qty-date">
                        <span>{{ $itemCount }} item{{ $itemCount !== 1 ? 's' : '' }}</span>
                        <span>{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="order-footer">
                    <span class="order-id-pill">#{{ $order->id }}</span>
                    <a href="#" class="btn-view">
                        <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        View
                    </a>
                </div>

            </div>
        @empty
            <div class="empty-state">
                <svg viewBox="0 0 24 24">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
                <p>
                    @if($search || $filter !== 'all')
                        No orders match your current filters
                    @else
                        You haven't made any purchases yet
                    @endif
                </p>
                @if(!$search && $filter === 'all')
                    <a href="{{ route('product.catalog') }}" wire:navigate class="empty-link">
                        Browse products
                        <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrap">
        {{ $orders->links() }}
    </div>

</div>