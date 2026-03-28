<div>
    <style>
        /* ── All colours inherit CSS vars from app.blade.php ── */

        .users-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }
        @media (max-width: 900px) { .users-grid-3 { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .users-grid-3 { grid-template-columns: 1fr; } }

        /* ── Summary stat cards ── */
        .summary-card {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 1.4rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            overflow: hidden;
            transition: border-color 0.25s, transform 0.2s;
        }
        .summary-card:hover { border-color: var(--border); transform: translateY(-2px); }
        .summary-card::after {
            content: '';
            position: absolute;
            top: -30%; right: -10%;
            width: 110px; height: 110px;
            background: radial-gradient(circle, var(--card-glow, var(--accent)) 0%, transparent 70%);
            opacity: 0.07;
            pointer-events: none;
        }

        .summary-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .summary-icon svg {
            width: 20px; height: 20px;
            stroke: var(--accent-text);
            fill: none; stroke-width: 1.8;
        }

        .summary-body { flex: 1; }
        .summary-label {
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.35rem;
        }
        .summary-value {
            font-family: var(--font-display);
            font-size: 1.9rem;
            font-weight: 500;
            line-height: 1;
        }

        /* ── Main panel ── */
        .panel {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .panel-header {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .panel-title {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.02em;
        }

        /* ── Toolbar (search, filter, button) ── */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .search-wrap {
            position: relative;
        }
        .search-wrap svg {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 15px; height: 15px;
            stroke: var(--text-faint);
            fill: none; stroke-width: 2;
            pointer-events: none;
        }
        .search-input {
            background: var(--bg-3);
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
            background: var(--bg-3);
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
        }
        .btn-create:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-create svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2.5; }

        /* ── Loading overlay ── */
        .loading-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.25);
            backdrop-filter: blur(2px);
            z-index: 10;
            display: flex; align-items: center; justify-content: center;
            border-radius: 0 0 12px 12px;
        }
        .spinner {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 3px solid var(--border-soft);
            border-top-color: var(--accent);
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Table ── */
        .users-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .users-table thead th {
            padding: 0.7rem 1.25rem;
            text-align: left;
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-faint);
            border-bottom: 1px solid var(--border-soft);
            background: var(--bg-3);
            white-space: nowrap;
            cursor: pointer;
            user-select: none;
            transition: background 0.15s, color 0.15s;
        }
        .users-table thead th:hover { background: var(--accent-dim); color: var(--text); }
        .users-table thead th.sort-active { color: var(--accent-text); }
        .users-table thead th:last-child { cursor: default; text-align: right; }

        .sort-icon {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .sort-arrow {
            font-size: 0.75rem;
            color: var(--accent);
        }
        .sort-arrow-neutral {
            font-size: 0.75rem;
            color: var(--text-faint);
            opacity: 0.5;
        }

        .users-table tbody td {
            padding: 0.9rem 1.25rem;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
            white-space: nowrap;
        }
        .users-table tbody tr:last-child td { border-bottom: none; }
        .users-table tbody tr:hover td {
            background: var(--accent-dim);
            color: var(--text);
        }

        /* Avatar */
        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--accent-dim);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--accent-text);
            flex-shrink: 0;
        }

        .user-name-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-name {
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--text);
        }

        /* Role badge */
        .role-badge {
            display: inline-block;
            padding: 0.18rem 0.55rem;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }
        .role-admin  { background: var(--accent-dim); color: var(--accent-text); border: 1px solid var(--border); }
        .role-user   { background: rgba(74,222,128,0.1); color: var(--success); border: 1px solid rgba(74,222,128,0.2); }

        /* Action links */
        .action-link {
            font-size: 0.8rem;
            font-weight: 400;
            text-decoration: none;
            transition: color 0.15s;
            background: none;
            border: none;
            cursor: pointer;
            font-family: var(--font-body);
            padding: 0;
        }
        .action-edit   { color: var(--accent-text); }
        .action-edit:hover { color: var(--accent); }
        .action-view   { color: var(--text-faint); }
        .action-view:hover { color: var(--text-muted); }
        .action-delete { color: var(--danger); opacity: 0.7; }
        .action-delete:hover { opacity: 1; }

        /* Actions cell */
        .actions-cell {
            text-align: right;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1rem;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
            color: var(--text-faint);
        }
        .empty-state svg {
            width: 40px; height: 40px;
            stroke: var(--text-faint);
            fill: none; stroke-width: 1.4;
            margin: 0 auto 0.85rem;
            display: block;
            opacity: 0.6;
        }
        .empty-state p { font-size: 0.875rem; margin-bottom: 0.35rem; color: var(--text-muted); }
        .empty-state small { font-size: 0.78rem; color: var(--text-faint); }

        /* Pagination wrapper */
        .pagination-wrap {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-soft);
        }

        /* Override Tailwind pagination to match theme */
        .pagination-wrap nav span[aria-current],
        .pagination-wrap nav span[aria-current] span {
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
        .pagination-wrap nav svg { stroke: currentColor !important; }

        /* Overflow wrapper */
        .table-wrap {
            position: relative;
            overflow-x: auto;
        }

        @media (max-width: 640px) {
            .search-input { width: 100%; }
            .search-input:focus { width: 100%; }
            .toolbar { width: 100%; }
            .search-wrap { flex: 1; }
            .search-input { width: 100%; }
            .users-table thead th:nth-child(1),
            .users-table tbody td:nth-child(1) { display: none; }
        }
    </style>

    {{-- ═══ SUMMARY CARDS ═══ --}}
    <div class="users-grid-3">

        <div class="summary-card" style="--card-glow: var(--accent);">
            <div class="summary-icon">
                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="summary-body">
                <div class="summary-label">Total Users</div>
                <div class="summary-value" style="color: var(--accent);">
                    {{ \App\Models\User::count() }}
                </div>
            </div>
        </div>

        <div class="summary-card" style="--card-glow: var(--success);">
            <div class="summary-icon" style="background: rgba(74,222,128,0.1); border-color: rgba(74,222,128,0.2);">
                <svg viewBox="0 0 24 24" style="stroke: var(--success);">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <div class="summary-body">
                <div class="summary-label">Members</div>
                <div class="summary-value" style="color: var(--success);">
                    {{ \App\Models\User::where('role', 'user')->count() }}
                </div>
            </div>
        </div>

        <div class="summary-card" style="--card-glow: var(--warning);">
            <div class="summary-icon" style="background: rgba(251,191,36,0.1); border-color: rgba(251,191,36,0.2);">
                <svg viewBox="0 0 24 24" style="stroke: var(--warning);">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
            </div>
            <div class="summary-body">
                <div class="summary-label">Admins</div>
                <div class="summary-value" style="color: var(--warning);">
                    {{ \App\Models\User::where('role', 'admin')->count() }}
                </div>
            </div>
        </div>

    </div>

    {{-- ═══ MAIN PANEL ═══ --}}
    <div class="panel">

        {{-- Panel header: title + toolbar --}}
        <div class="panel-header">
            <div class="panel-title">Users</div>
            <div class="toolbar">

                {{-- Search --}}
                <div class="search-wrap">
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search users…"
                        class="search-input"
                    >
                </div>

                {{-- Role filter --}}
                <select wire:model.live="filter" class="filter-select">
                    <option value="all">All Roles</option>
                    <option value="user">Member</option>
                    <option value="admin">Admin</option>
                </select>

                {{-- Create button --}}
                <a href="{{ route('admin.users.create') }}" class="btn-create" wire:navigate>
                    <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Create User
                </a>

            </div>
        </div>

        {{-- Table --}}
        <div class="table-wrap">

            {{-- Livewire loading overlay --}}
            <div wire:loading wire:target="search,filter,setSorting" class="loading-overlay">
                <div class="spinner"></div>
            </div>

            <table class="users-table">
                <thead>
                    <tr>
                        <th wire:click="setSorting('id')"
                            class="{{ $sortBy === 'id' ? 'sort-active' : '' }}">
                            <span class="sort-icon">
                                ID
                                @if($sortBy === 'id')
                                    <span class="sort-arrow">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="sort-arrow-neutral">↕</span>
                                @endif
                            </span>
                        </th>
                        <th wire:click="setSorting('name')"
                            class="{{ $sortBy === 'name' ? 'sort-active' : '' }}">
                            <span class="sort-icon">
                                Name
                                @if($sortBy === 'name')
                                    <span class="sort-arrow">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="sort-arrow-neutral">↕</span>
                                @endif
                            </span>
                        </th>
                        <th wire:click="setSorting('email')"
                            class="{{ $sortBy === 'email' ? 'sort-active' : '' }}">
                            <span class="sort-icon">
                                Email
                                @if($sortBy === 'email')
                                    <span class="sort-arrow">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="sort-arrow-neutral">↕</span>
                                @endif
                            </span>
                        </th>
                        <th wire:click="setSorting('created_at')"
                            class="{{ $sortBy === 'created_at' ? 'sort-active' : '' }}">
                            <span class="sort-icon">
                                Joined
                                @if($sortBy === 'created_at')
                                    <span class="sort-arrow">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="sort-arrow-neutral">↕</span>
                                @endif
                            </span>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td style="color: var(--text-faint); font-size: 0.78rem;">
                                #{{ $user->id }}
                            </td>
                            <td>
                                <div class="user-name-cell">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="user-name">{{ $user->name }}</div>
                                        <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}">
                                            {{ $user->role }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:0.82rem;">{{ $user->email }}</td>
                            <td style="font-size:0.82rem;">{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('member.profile', $user->id) }}"
                                       class="action-link action-view"
                                       wire:navigate>
                                        View
                                    </a>
                                    <a href="{{ route('admin.users.edit', ['userId' => $user->id]) }}"
                                       class="action-link action-edit"
                                       wire:navigate>
                                        Edit
                                    </a>
                                    <button
                                        type="button"
                                        wire:click="deleteUser({{ $user->id }})"
                                        wire:confirm="Are you sure you want to delete {{ $user->name }}?"
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
                                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    <p>No users found</p>
                                    @if($search || $filter !== 'all')
                                        <small>Try adjusting your search or filter</small>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="pagination-wrap">
                {{ $users->links() }}
            </div>
        @endif

    </div>

</div>