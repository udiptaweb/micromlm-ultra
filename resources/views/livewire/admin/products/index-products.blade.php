<div>
    <style>
        /* ── Page header ── */
        .page-header {
            display: flex;
            align-items: center;
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
        .page-sub {
            font-size: 0.82rem;
            color: var(--text-faint);
        }

        .btn-create {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            flex-shrink: 0;
        }
        .btn-create:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-create svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2.5; }

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

        /* ── Toolbar ── */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-bottom: 1.1rem;
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
            width: 220px;
            outline: none;
            transition: border-color 0.2s, width 0.2s;
        }
        .search-input::placeholder { color: var(--text-faint); }
        .search-input:focus { border-color: var(--border); width: 260px; }

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

        /* ── Panel ── */
        .panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        /* ── Loading overlay ── */
        .loading-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.25);
            backdrop-filter: blur(2px);
            z-index: 10;
            display: flex; align-items: center; justify-content: center;
        }
        .spinner {
            width: 34px; height: 34px;
            border-radius: 50%;
            border: 3px solid var(--border-soft);
            border-top-color: var(--accent);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Table ── */
        .prod-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .prod-table thead th {
            padding: 0.7rem 1rem;
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
        .prod-table thead th.th-center { text-align: center; }
        .prod-table thead th.th-right  { text-align: right; }

        .prod-table tbody td {
            padding: 0.9rem 1rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
        }
        .prod-table tbody tr:last-child td { border-bottom: none; }
        .prod-table tbody tr:hover td { background: var(--accent-dim); color: var(--text); }

        /* Product name cell */
        .prod-name {
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--text);
            margin-bottom: 0.2rem;
        }
        .prod-date {
            font-size: 0.7rem;
            color: var(--text-faint);
        }

        /* Price */
        .price-cell {
            font-size: 0.875rem;
            color: var(--text);
            white-space: nowrap;
        }

        /* Commission */
        .commission-on {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--success);
        }
        .commission-on svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2.5; }
        .commission-off {
            font-size: 0.78rem;
            color: var(--text-faint);
        }

        /* Status toggle button */
        .status-toggle {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.7rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            cursor: pointer;
            border: 1px solid;
            background: none;
            font-family: var(--font-body);
            transition: background 0.2s;
        }
        .status-toggle svg { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
        .status-active {
            color: var(--success);
            border-color: rgba(74,222,128,0.25);
            background: rgba(74,222,128,0.1);
        }
        .status-active:hover { background: rgba(74,222,128,0.2); }
        .status-inactive {
            color: var(--text-faint);
            border-color: var(--border-soft);
            background: var(--bg-3);
        }
        .status-inactive:hover { border-color: var(--border); color: var(--text-muted); }

        /* Action links */
        .actions-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.85rem;
        }
        .action-link {
            font-size: 0.8rem;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-family: var(--font-body);
            padding: 0;
            transition: color 0.15s;
        }
        .action-edit   { color: var(--accent-text); }
        .action-edit:hover { color: var(--accent); }
        .action-delete { color: var(--danger); opacity: 0.7; }
        .action-delete:hover { opacity: 1; }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
            color: var(--text-faint);
        }
        .empty-state svg {
            width: 38px; height: 38px;
            stroke: var(--text-faint); fill: none; stroke-width: 1.4;
            margin: 0 auto 0.85rem; display: block; opacity: 0.6;
        }
        .empty-state p { font-size: 0.875rem; color: var(--text-muted); }

        /* Pagination */
        .pagination-wrap {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-soft);
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
            .search-input { width: 100%; }
            .search-input:focus { width: 100%; }
            .prod-table thead th:nth-child(3),
            .prod-table tbody td:nth-child(3) { display: none; }
        }
    </style>

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="page-header">
        <div>
            <div class="page-title">Products</div>
            <div class="page-sub">Manage products and commission settings</div>
        </div>
        <a href="{{ route('admin.products.create') }}" wire:navigate class="btn-create">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Product
        </a>
    </div>

    {{-- Flash --}}
    @if(session()->has('message'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- ═══ TOOLBAR ═══ --}}
    <div class="toolbar">
        <div class="search-wrap">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search products…"
                class="search-input"
            >
        </div>
        <select wire:model.live="status" class="filter-select">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    {{-- ═══ TABLE PANEL ═══ --}}
    <div class="panel">

        {{-- Loading overlay --}}
        <div wire:loading wire:target="search,status" class="loading-overlay">
            <div class="spinner"></div>
        </div>

        <div class="table-wrap">
            <table class="prod-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Commission</th>
                        <th class="th-center">Status</th>
                        <th class="th-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <div class="prod-name">{{ $product->name }}</div>
                                <div class="prod-date">{{ $product->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="price-cell">
                                ₹{{ number_format($product->price, 2) }}
                            </td>
                            <td>
                                @if($product->commission_enabled)
                                    <span class="commission-on">
                                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                        {{ $product->commission_percent }}%
                                    </span>
                                @else
                                    <span class="commission-off">Disabled</span>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                <button
                                    wire:click="toggleStatus({{ $product->id }})"
                                    class="status-toggle {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                                    <svg viewBox="0 0 10 10" fill="{{ $product->is_active ? 'var(--success)' : 'var(--text-faint)' }}" stroke="none">
                                        <circle cx="5" cy="5" r="4"/>
                                    </svg>
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       wire:navigate
                                       class="action-link action-edit">
                                        Edit
                                    </a>
                                    <button
                                        wire:click="delete({{ $product->id }})"
                                        wire:confirm="Delete {{ $product->name }}? This cannot be undone."
                                        class="action-link action-delete">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                    <p>No products found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="pagination-wrap">
                {{ $products->links() }}
            </div>
        @endif

    </div>

</div>