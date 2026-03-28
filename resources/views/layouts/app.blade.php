<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700i&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=dm-sans:300,400,500&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    {{--
        ╔═══════════════════════════════════════════╗
        ║  THEME CSS VARIABLES                      ║
        ║  To wire this up to a real theme system:  ║
        ║  1. Store theme in Auth user model or     ║
        ║     session: Auth::user()->theme          ║
        ║  2. Replace $theme below with that value  ║
        ╚═══════════════════════════════════════════╝
    --}}
    @php
        $theme = session('mlm_theme') ?? (request()->cookie('mlm_theme') ?? 'obsidian');
        // Also accept from user model: $theme = auth()->user()?->theme ?? 'obsidian';

        $themes = [
            'obsidian' => [
                '--bg' => '#0A0A0F',
                '--bg-2' => '#111118',
                '--bg-3' => '#1C1C24',
                '--sidebar-bg' => '#111118',
                '--topbar-bg' => '#0F0F15',
                '--accent' => '#8b5cf6',
                '--accent-dim' => 'rgba(139,92,246,0.12)',
                '--accent-text' => '#c4b5fd',
                '--border' => 'rgba(139,92,246,0.15)',
                '--border-soft' => 'rgba(255,255,255,0.06)',
                '--text' => '#F0EDE6',
                '--text-muted' => 'rgba(240,237,230,0.45)',
                '--text-faint' => 'rgba(240,237,230,0.25)',
                '--success' => '#4ade80',
                '--warning' => '#fbbf24',
                '--danger' => '#f87171',
                '--shadow' => '0 4px 24px rgba(0,0,0,0.5)',
            ],
            'arctic' => [
                '--bg' => '#F8F9FC',
                '--bg-2' => '#FFFFFF',
                '--bg-3' => '#F0F2F7',
                '--sidebar-bg' => '#FFFFFF',
                '--topbar-bg' => '#FFFFFF',
                '--accent' => '#1A1A2E',
                '--accent-dim' => 'rgba(26,26,46,0.08)',
                '--accent-text' => '#1A1A2E',
                '--border' => '#E2E5F0',
                '--border-soft' => '#EEF0F7',
                '--text' => '#1A1A2E',
                '--text-muted' => '#64748b',
                '--text-faint' => '#94a3b8',
                '--success' => '#16a34a',
                '--warning' => '#d97706',
                '--danger' => '#dc2626',
                '--shadow' => '0 2px 12px rgba(26,26,46,0.08)',
            ],
            'ember' => [
                '--bg' => '#0F0A0A',
                '--bg-2' => '#150D0D',
                '--bg-3' => '#1E1212',
                '--sidebar-bg' => '#130B0B',
                '--topbar-bg' => '#0F0A0A',
                '--accent' => '#ef4444',
                '--accent-dim' => 'rgba(239,68,68,0.12)',
                '--accent-text' => '#fca5a5',
                '--border' => 'rgba(239,68,68,0.15)',
                '--border-soft' => 'rgba(255,255,255,0.05)',
                '--text' => '#FFF1F1',
                '--text-muted' => 'rgba(255,241,241,0.45)',
                '--text-faint' => 'rgba(255,241,241,0.22)',
                '--success' => '#4ade80',
                '--warning' => '#fbbf24',
                '--danger' => '#f87171',
                '--shadow' => '0 4px 24px rgba(0,0,0,0.55)',
            ],
            'forest' => [
                '--bg' => '#07100C',
                '--bg-2' => '#0C1610',
                '--bg-3' => '#111F15',
                '--sidebar-bg' => '#0B150E',
                '--topbar-bg' => '#08110C',
                '--accent' => '#22c55e',
                '--accent-dim' => 'rgba(34,197,94,0.12)',
                '--accent-text' => '#86efac',
                '--border' => 'rgba(34,197,94,0.14)',
                '--border-soft' => 'rgba(255,255,255,0.05)',
                '--text' => '#F0FAF3',
                '--text-muted' => 'rgba(240,250,243,0.45)',
                '--text-faint' => 'rgba(240,250,243,0.22)',
                '--success' => '#4ade80',
                '--warning' => '#fbbf24',
                '--danger' => '#f87171',
                '--shadow' => '0 4px 24px rgba(0,0,0,0.55)',
            ],
            'sapphire' => [
                '--bg' => '#070B14',
                '--bg-2' => '#0B1020',
                '--bg-3' => '#111828',
                '--sidebar-bg' => '#0A1020',
                '--topbar-bg' => '#080D18',
                '--accent' => '#3b82f6',
                '--accent-dim' => 'rgba(59,130,246,0.12)',
                '--accent-text' => '#93c5fd',
                '--border' => 'rgba(59,130,246,0.15)',
                '--border-soft' => 'rgba(255,255,255,0.05)',
                '--text' => '#EFF6FF',
                '--text-muted' => 'rgba(239,246,255,0.45)',
                '--text-faint' => 'rgba(239,246,255,0.22)',
                '--success' => '#4ade80',
                '--warning' => '#fbbf24',
                '--danger' => '#f87171',
                '--shadow' => '0 4px 24px rgba(0,0,0,0.55)',
            ],
            'luxe' => [
                '--bg' => '#0A0800',
                '--bg-2' => '#120F02',
                '--bg-3' => '#1A1500',
                '--sidebar-bg' => '#100D00',
                '--topbar-bg' => '#0D0A00',
                '--accent' => '#C9A84C',
                '--accent-dim' => 'rgba(201,168,76,0.12)',
                '--accent-text' => '#E8C97A',
                '--border' => 'rgba(201,168,76,0.18)',
                '--border-soft' => 'rgba(255,255,255,0.05)',
                '--text' => '#FDF6E3',
                '--text-muted' => 'rgba(253,246,227,0.45)',
                '--text-faint' => 'rgba(253,246,227,0.22)',
                '--success' => '#4ade80',
                '--warning' => '#fbbf24',
                '--danger' => '#f87171',
                '--shadow' => '0 4px 24px rgba(0,0,0,0.55)',
            ],
        ];

        $vars = $themes[$theme] ?? $themes['obsidian'];
        $cssVars = collect($vars)->map(fn($v, $k) => "$k: $v")->implode('; ');
    @endphp

    {{-- Theme variables only — all structural/visual CSS lives in theme.css --}}
    <style>
        :root {
            {{ $cssVars }};
            --font-display: 'Cormorant Garamond', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
            --font-mono: 'Fira Code', 'Cascadia Code', monospace;
        }
    </style>
</head>

<body>

    <div class="app-shell">

        {{-- ═══ SIDEBAR ═══ --}}
        <aside class="app-sidebar" id="appSidebar">

            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" class="sidebar-logo" wire:navigate>
                MLM<span>Pro</span>
            </a>

            <nav class="sidebar-nav">

                @auth

                    {{-- ───────────────────────────────
                     MEMBER NAV
                ─────────────────────────────── --}}
                    @if (auth()->user()->role === 'user')
                        <div class="nav-section-label">Overview</div>

                        <a href="{{ route('dashboard') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" rx="1" />
                                <rect x="14" y="3" width="7" height="7" rx="1" />
                                <rect x="3" y="14" width="7" height="7" rx="1" />
                                <rect x="14" y="14" width="7" height="7" rx="1" />
                            </svg>
                            Dashboard
                        </a>

                        <div class="nav-section-label">Network</div>

                        <a href="{{ route('genealogy') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('genealogy') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="5" r="2" />
                                <circle cx="5" cy="19" r="2" />
                                <circle cx="19" cy="19" r="2" />
                                <line x1="12" y1="7" x2="12" y2="12" />
                                <line x1="12" y1="12" x2="5" y2="17" />
                                <line x1="12" y1="12" x2="19" y2="17" />
                            </svg>
                            Genealogy
                        </a>


                        <div class="nav-section-label">Finance</div>

                        <a href="{{ route('commissions') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('commissions') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                            </svg>
                            Commissions
                        </a>

                        <div class="nav-section-label">Shop</div>

                        <a href="{{ route('product.catalog') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('product.catalog') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                <line x1="3" y1="6" x2="21" y2="6" />
                                <path d="M16 10a4 4 0 0 1-8 0" />
                            </svg>
                            Buy Product
                        </a>
                        <a href="{{ route('member.purchases') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('member.purchases') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                <line x1="3" y1="6" x2="21" y2="6" />
                                <path d="M16 10a4 4 0 0 1-8 0" />
                            </svg>
                            My Purchases
                        </a>

                        <div class="nav-section-label">E-Pins</div>

                        <a href="{{ route('member.epin.request') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('member.epin.request') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="7" width="20" height="14" rx="2" />
                                <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                <line x1="12" y1="12" x2="12" y2="16" />
                                <line x1="10" y1="14" x2="14" y2="14" />
                            </svg>
                            Request E-Pin
                        </a>

                        <a href="{{ route('member.epins') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('member.epins') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <rect x="1" y="4" width="22" height="16" rx="2" />
                                <line x1="1" y1="10" x2="23" y2="10" />
                            </svg>
                            My E-Pins
                        </a>
                    @endif

                    {{-- ───────────────────────────────
                     ADMIN NAV
                ─────────────────────────────── --}}
                    @if (auth()->user()->role === 'admin')
                        <div class="nav-section-label">Management</div>

                        <a href="{{ route('admin.users.index') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            User Management
                        </a>

                        <a href="{{ route('admin.user-commissions') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('admin.user-commissions') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                            </svg>
                            User Commissions
                        </a>

                        <a href="{{ route('admin.withdraw-requests') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('admin.withdraw-requests') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                                <polyline points="17 6 23 6 23 12" />
                            </svg>
                            Withdraw Requests
                        </a>
                        {{-- Placements — only visible when auto_placement is off --}}
                        @if (config('mlm.genealogy.type') == 'binary' && !config('mlm.commission.binary.auto_placement'))
                            <div class="nav-section-label">Binary Tree</div>

                            <a href="{{ route('admin.placements') }}" wire:navigate
                                class="nav-item {{ request()->routeIs('admin.placements') ? 'active' : '' }}">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="2" />
                                    <circle cx="5" cy="19" r="2" />
                                    <circle cx="19" cy="19" r="2" />
                                    <line x1="12" y1="7" x2="12" y2="12" />
                                    <line x1="12" y1="12" x2="5" y2="17" />
                                    <line x1="12" y1="12" x2="19" y2="17" />
                                </svg>
                                Placements
                                @php
                                    $pendingPlacements = \App\Models\User::where('role', 'user')
                                        ->whereNull('binary_parent_id')
                                        ->whereNull('binary_position')
                                        ->count();
                                @endphp
                                @if ($pendingPlacements > 0)
                                    <span
                                        style="margin-left:auto;font-size:.62rem;padding:.15rem .45rem;border-radius:3px;background:rgba(251,191,36,.1);color:var(--warning);border:1px solid rgba(251,191,36,.2);">
                                        {{ $pendingPlacements }}
                                    </span>
                                @endif
                            </a>
                        @endif

                        {{-- Products collapsible --}}
                        <div class="nav-section-label">Products</div>

                        <a href="{{ route('admin.products.index') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <line x1="8" y1="6" x2="21" y2="6" />
                                <line x1="8" y1="12" x2="21" y2="12" />
                                <line x1="8" y1="18" x2="21" y2="18" />
                                <line x1="3" y1="6" x2="3.01" y2="6" />
                                <line x1="3" y1="12" x2="3.01" y2="12" />
                                <line x1="3" y1="18" x2="3.01" y2="18" />
                            </svg>
                            View Products
                        </a>

                        <a href="{{ route('admin.products.create') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="16" />
                                <line x1="8" y1="12" x2="16" y2="12" />
                            </svg>
                            Add Product
                        </a>

                        {{-- E-Pins --}}
                        <div class="nav-section-label">E-Pins</div>

                        <a href="{{ route('admin.e-pins.requests') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('admin.e-pins.requests') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="12" y1="18" x2="12" y2="12" />
                                <line x1="9" y1="15" x2="15" y2="15" />
                            </svg>
                            E-Pin Requests
                        </a>

                        <a href="{{ route('admin.e-pins') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('admin.e-pins') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <rect x="1" y="4" width="22" height="16" rx="2" />
                                <line x1="1" y1="10" x2="23" y2="10" />
                            </svg>
                            E-Pin Inventory
                        </a>
                        <div class="nav-section-label">System Settings</div>
                        <a href="{{ route('admin.theme-settings') }}" wire:navigate
                            class="nav-item {{ request()->is('theme-settings') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="3" />
                                <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14" />
                            </svg>
                            Change Theme
                        </a>
                        <a href="{{ route('admin.mlm-settings') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('admin.mlm-settings') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="3" />
                                <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14" />
                            </svg>
                            MLM Settings
                        </a>
                        <a href="{{ route('admin.mlm-docs') }}" wire:navigate
                            class="nav-item {{ request()->routeIs('admin.mlm-docs') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                            Config Guide
                        </a>
                    @endif

                    {{-- ───────────────────────────────
                     SHARED BOTTOM LINKS
                ─────────────────────────────── --}}
                    <div class="nav-section-label">Account</div>

                    <a href="{{ route('profile') }}" wire:navigate
                        class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Account Settings
                    </a>

                    <a href="{{ route('wallets') }}" wire:navigate
                        class="nav-item {{ request()->routeIs('wallets') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 12V22H4V12" />
                            <path d="M22 7H2v5h20V7z" />
                            <path d="M12 22V7" />
                            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z" />
                            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z" />
                        </svg>
                        Wallet
                    </a>
                    <a href="{{ route('member.payout-info') }}" wire:navigate
                        class="nav-item {{ request()->routeIs('member.payout-info') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <rect x="1" y="4" width="22" height="16" rx="2" />
                            <line x1="1" y1="10" x2="23" y2="10" />
                        </svg>
                        Payout Accounts
                    </a>
                    <a href="{{ route('member.profile', auth()->id()) }}" wire:navigate
                        class="nav-item {{ request()->routeIs('member.profile') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        My Profile
                    </a>


                @endauth

            </nav>

            {{-- Sidebar footer: user info + logout --}}
            @auth
                <div class="sidebar-footer" x-data="{ open: false }" style="position:relative;">
                    <button @click="open = !open"
                        style="width:100%; display:flex; align-items:center; gap:0.65rem; background:none; border:none; cursor:pointer; text-align:left; padding:0; color:var(--text-muted);">
                        <div
                            style="width:30px;height:30px;border-radius:50%;background:var(--accent-dim);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:0.72rem;font-weight:500;color:var(--accent-text);flex-shrink:0;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div style="flex:1;overflow:hidden;">
                            <div
                                style="font-size:0.8rem;font-weight:500;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                {{ Auth::user()->name }}
                            </div>
                            <div style="font-size:0.68rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                {{ Auth::user()->email }}
                            </div>
                        </div>
                        {{-- <svg viewBox="0 0 24 24"
                            style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;transition:transform 0.2s;"
                            :style="open ? 'transform:rotate(180deg)' : ''">
                            <polyline points="18 15 12 9 6 15" />
                        </svg> --}}
                    </button>

                    {{-- Popup menu --}}
                    <div x-show="open" @click.outside="open = false" x-transition
                        style="position:absolute;bottom:calc(100% + 8px);left:0;right:0;background:var(--bg-3);border:1px solid var(--border);border-radius:8px;overflow:hidden;z-index:200;">
                        <a href="{{ route('profile') }}" wire:navigate
                            style="display:flex;align-items:center;gap:0.6rem;padding:0.65rem 1rem;font-size:0.8rem;color:var(--text-muted);text-decoration:none;transition:background 0.15s,color 0.15s;"
                            onmouseover="this.style.background='var(--accent-dim)';this.style.color='var(--text)'"
                            onmouseout="this.style.background='';this.style.color='var(--text-muted)'">
                            <svg viewBox="0 0 24 24"
                                style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            Account Settings
                        </a>
                        <a href="{{ route('wallets') }}" wire:navigate
                            style="display:flex;align-items:center;gap:0.6rem;padding:0.65rem 1rem;font-size:0.8rem;color:var(--text-muted);text-decoration:none;transition:background 0.15s,color 0.15s;"
                            onmouseover="this.style.background='var(--accent-dim)';this.style.color='var(--text)'"
                            onmouseout="this.style.background='';this.style.color='var(--text-muted)'">
                            <svg viewBox="0 0 24 24"
                                style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;">
                                <path d="M20 12V22H4V12" />
                                <path d="M22 7H2v5h20V7z" />
                            </svg>
                            Wallet
                        </a>
                        <div style="height:1px;background:var(--border-soft);margin:0.25rem 0;"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                style="width:100%;display:flex;align-items:center;gap:0.6rem;padding:0.65rem 1rem;font-size:0.8rem;color:var(--danger);background:none;border:none;cursor:pointer;text-align:left;transition:background 0.15s;"
                                onmouseover="this.style.background='rgba(248,113,113,0.08)'"
                                onmouseout="this.style.background=''">
                                <svg viewBox="0 0 24 24"
                                    style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    <polyline points="16 17 21 12 16 7" />
                                    <line x1="21" y1="12" x2="9" y2="12" />
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

        </aside>

        {{-- ═══ MOBILE OVERLAY ═══ --}}
        <div id="sidebarOverlay" onclick="closeSidebar()"
            style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:39;backdrop-filter:blur(2px);">
        </div>

        {{-- ═══ MAIN ═══ --}}
        <div class="app-main">

            {{-- Top bar --}}
            <header class="app-topbar">

                {{-- Mobile hamburger --}}
                <button class="topbar-btn" id="hamburgerBtn" onclick="openSidebar()" style="display:none;"
                    title="Menu">
                    <svg viewBox="0 0 24 24">
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="18" x2="21" y2="18" />
                    </svg>
                </button>

                <div class="topbar-heading">
                    @isset($header)
                        {{ $header }}
                    @else
                        {{ config('app.name', 'MLM Pro') }}
                    @endisset
                </div>

                <div class="topbar-actions">
                    {{-- Notifications --}}
                    <button class="topbar-btn" title="Notifications">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                    </button>

                    {{-- Avatar + role badge --}}
                    @auth
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <div
                                style="font-size:0.7rem;padding:0.2rem 0.55rem;border-radius:4px;background:var(--accent-dim);color:var(--accent-text);letter-spacing:0.06em;text-transform:uppercase;">
                                {{ auth()->user()->role }}
                            </div>
                            <div class="topbar-avatar" title="{{ Auth::user()->name }}">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        </div>
                    @endauth
                </div>
            </header>

            {{-- Page header slot --}}
            @isset($pageHeader)
                <div class="page-header">
                    <div class="page-header-inner">
                        {{ $pageHeader }}
                    </div>
                </div>
            @endisset

            {{-- Main content --}}
            <main class="app-content">
                {{ $slot }}
            </main>

        </div>
    </div>

    <script>
        function openSidebar() {
            document.getElementById('appSidebar').classList.add('open');
            document.getElementById('sidebarOverlay').style.display = 'block';
        }

        function closeSidebar() {
            document.getElementById('appSidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').style.display = 'none';
        }

        // Show hamburger on mobile
        function checkMobile() {
            const isMobile = window.innerWidth <= 768;
            document.getElementById('hamburgerBtn').style.display = isMobile ? 'inline-flex' : 'none';
        }
        checkMobile();
        window.addEventListener('resize', checkMobile);
    </script>

</body>

</html>
