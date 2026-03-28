<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Choose Your Theme — {{ config('app.name', 'MLM Pro') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700i&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=dm-sans:300,400,500&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold: #C9A84C;
            --gold-light: #E8C97A;
            --gold-dim: rgba(201,168,76,0.15);
            --surface: #0C0C0E;
            --surface-2: #141416;
            --surface-3: #1C1C20;
            --border: rgba(255,255,255,0.07);
            --text: #F0EDE6;
            --text-muted: rgba(240,237,230,0.45);
            --font-display: 'Cormorant Garamond', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
        }

        html, body {
            background: var(--surface);
            color: var(--text);
            font-family: var(--font-body);
            font-weight: 300;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Background grid ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            top: -30%;
            left: 50%;
            transform: translateX(-50%);
            width: 700px;
            height: 700px;
            background: radial-gradient(ellipse, rgba(201,168,76,0.07) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .page-wrap {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3rem 2rem 5rem;
        }

        /* ── Header ── */
        .header {
            width: 100%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 5rem;
            opacity: 0;
            transform: translateY(-16px);
            animation: fadeUp 0.7s ease forwards;
        }

        .logo {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            color: var(--gold);
        }

        .logo span { color: var(--text); font-weight: 400; }

        .header-nav {
            display: flex;
            gap: 2rem;
            font-size: 0.8rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .header-nav a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }

        .header-nav a:hover { color: var(--gold); }

        /* ── Hero text ── */
        .hero {
            text-align: center;
            max-width: 680px;
            margin-bottom: 4rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.7s 0.15s ease forwards;
        }

        .eyebrow {
            font-size: 0.72rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .eyebrow::before, .eyebrow::after {
            content: '';
            width: 32px;
            height: 1px;
            background: var(--gold);
            opacity: 0.5;
        }

        .hero h1 {
            font-family: var(--font-display);
            font-size: clamp(2.8rem, 5vw, 4.5rem);
            font-weight: 500;
            line-height: 1.1;
            letter-spacing: -0.01em;
            color: var(--text);
            margin-bottom: 1.25rem;
        }

        .hero h1 em {
            font-style: italic;
            color: var(--gold);
        }

        .hero p {
            font-size: 0.95rem;
            line-height: 1.8;
            color: var(--text-muted);
        }

        /* ── Theme grid ── */
        .themes-grid {
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }

        @media (max-width: 900px) { .themes-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .themes-grid { grid-template-columns: 1fr; } }

        /* ── Theme card ── */
        .theme-card {
            position: relative;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            cursor: pointer;
            transition: border-color 0.25s, transform 0.25s;
            opacity: 0;
            transform: translateY(24px);
        }

        .theme-card:nth-child(1) { animation: fadeUp 0.6s 0.25s ease forwards; }
        .theme-card:nth-child(2) { animation: fadeUp 0.6s 0.35s ease forwards; }
        .theme-card:nth-child(3) { animation: fadeUp 0.6s 0.45s ease forwards; }
        .theme-card:nth-child(4) { animation: fadeUp 0.6s 0.55s ease forwards; }
        .theme-card:nth-child(5) { animation: fadeUp 0.6s 0.65s ease forwards; }
        .theme-card:nth-child(6) { animation: fadeUp 0.6s 0.75s ease forwards; }

        .theme-card:hover { border-color: rgba(201,168,76,0.4); transform: translateY(-3px); }

        .theme-card.selected {
            border-color: var(--gold) !important;
            transform: translateY(-3px);
        }

        .theme-card.selected .card-check { opacity: 1; transform: scale(1); }

        /* ── Card preview (mock UI thumbnail) ── */
        .card-preview {
            aspect-ratio: 16/10;
            position: relative;
            overflow: hidden;
        }

        /* Theme 1: Obsidian Dark */
        .preview-obsidian {
            background: #0A0A0F;
        }
        .preview-obsidian .mock-sidebar {
            position: absolute; left: 0; top: 0; bottom: 0; width: 28%;
            background: #111118;
            border-right: 1px solid rgba(139,92,246,0.2);
        }
        .preview-obsidian .mock-sidebar::before {
            content: '';
            position: absolute; top: 20%; left: 12%; width: 76%; height: 6px;
            background: rgba(139,92,246,0.6); border-radius: 3px;
        }
        .preview-obsidian .mock-sidebar::after {
            content: '';
            position: absolute; top: calc(20% + 20px); left: 12%; width: 55%; height: 4px;
            background: rgba(255,255,255,0.1); border-radius: 2px;
            box-shadow: 0 14px 0 rgba(255,255,255,0.07), 0 28px 0 rgba(255,255,255,0.07);
        }
        .preview-obsidian .mock-main { position: absolute; left: 28%; right: 0; top: 0; bottom: 0; }
        .preview-obsidian .mock-topbar {
            position: absolute; top: 0; left: 0; right: 0; height: 20%;
            background: rgba(139,92,246,0.08);
            border-bottom: 1px solid rgba(139,92,246,0.15);
        }
        .preview-obsidian .mock-cards {
            position: absolute; top: 28%; left: 5%; right: 5%;
            display: grid; grid-template-columns: repeat(3,1fr); gap: 4%;
        }
        .preview-obsidian .mock-card {
            aspect-ratio: 2/1;
            background: #16161E;
            border-radius: 4px;
            border: 1px solid rgba(139,92,246,0.2);
        }
        .preview-obsidian .mock-card:first-child { background: rgba(139,92,246,0.2); }

        /* Theme 2: Arctic Minimal */
        .preview-arctic {
            background: #F8F9FC;
        }
        .preview-arctic .mock-sidebar {
            position: absolute; left: 0; top: 0; bottom: 0; width: 28%;
            background: #FFFFFF; border-right: 1px solid #E8EAF0;
        }
        .preview-arctic .mock-sidebar::before {
            content: ''; position: absolute; top: 20%; left: 12%; width: 76%; height: 6px;
            background: #1A1A2E; border-radius: 3px;
        }
        .preview-arctic .mock-sidebar::after {
            content: ''; position: absolute; top: calc(20% + 18px); left: 12%; width: 55%; height: 3px;
            background: #E0E3EC; border-radius: 2px;
            box-shadow: 0 12px 0 #E0E3EC, 0 24px 0 #E0E3EC;
        }
        .preview-arctic .mock-main { position: absolute; left: 28%; right: 0; top: 0; bottom: 0; }
        .preview-arctic .mock-topbar {
            position: absolute; top: 0; left: 0; right: 0; height: 18%;
            background: white; border-bottom: 1px solid #E8EAF0;
        }
        .preview-arctic .mock-cards {
            position: absolute; top: 26%; left: 5%; right: 5%;
            display: grid; grid-template-columns: repeat(3,1fr); gap: 4%;
        }
        .preview-arctic .mock-card {
            aspect-ratio: 2/1; background: #fff;
            border-radius: 4px; border: 1px solid #E8EAF0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }
        .preview-arctic .mock-card:first-child { background: #1A1A2E; }

        /* Theme 3: Ember */
        .preview-ember { background: #0F0A0A; }
        .preview-ember .mock-sidebar {
            position: absolute; left: 0; top: 0; bottom: 0; width: 28%;
            background: #150D0D; border-right: 1px solid rgba(239,68,68,0.15);
        }
        .preview-ember .mock-sidebar::before {
            content: ''; position: absolute; top: 20%; left: 12%; width: 76%; height: 6px;
            background: rgba(239,68,68,0.7); border-radius: 3px;
        }
        .preview-ember .mock-sidebar::after {
            content: ''; position: absolute; top: calc(20% + 18px); left: 12%; width: 55%; height: 3px;
            background: rgba(255,255,255,0.08); border-radius: 2px;
            box-shadow: 0 12px 0 rgba(255,255,255,0.06), 0 24px 0 rgba(255,255,255,0.05);
        }
        .preview-ember .mock-main { position: absolute; left: 28%; right: 0; top: 0; bottom: 0; }
        .preview-ember .mock-topbar {
            position: absolute; top: 0; left: 0; right: 0; height: 18%;
            background: rgba(239,68,68,0.06); border-bottom: 1px solid rgba(239,68,68,0.12);
        }
        .preview-ember .mock-cards {
            position: absolute; top: 26%; left: 5%; right: 5%;
            display: grid; grid-template-columns: repeat(3,1fr); gap: 4%;
        }
        .preview-ember .mock-card {
            aspect-ratio: 2/1; background: #1A1010;
            border-radius: 4px; border: 1px solid rgba(239,68,68,0.15);
        }
        .preview-ember .mock-card:first-child { background: rgba(239,68,68,0.25); }

        /* Theme 4: Forest */
        .preview-forest { background: #07100C; }
        .preview-forest .mock-sidebar {
            position: absolute; left: 0; top: 0; bottom: 0; width: 28%;
            background: #0C1610; border-right: 1px solid rgba(34,197,94,0.15);
        }
        .preview-forest .mock-sidebar::before {
            content: ''; position: absolute; top: 20%; left: 12%; width: 76%; height: 6px;
            background: rgba(34,197,94,0.65); border-radius: 3px;
        }
        .preview-forest .mock-sidebar::after {
            content: ''; position: absolute; top: calc(20% + 18px); left: 12%; width: 55%; height: 3px;
            background: rgba(255,255,255,0.07); border-radius: 2px;
            box-shadow: 0 12px 0 rgba(255,255,255,0.05), 0 24px 0 rgba(255,255,255,0.04);
        }
        .preview-forest .mock-main { position: absolute; left: 28%; right: 0; top: 0; bottom: 0; }
        .preview-forest .mock-topbar {
            position: absolute; top: 0; left: 0; right: 0; height: 18%;
            background: rgba(34,197,94,0.05); border-bottom: 1px solid rgba(34,197,94,0.12);
        }
        .preview-forest .mock-cards {
            position: absolute; top: 26%; left: 5%; right: 5%;
            display: grid; grid-template-columns: repeat(3,1fr); gap: 4%;
        }
        .preview-forest .mock-card {
            aspect-ratio: 2/1; background: #111A14;
            border-radius: 4px; border: 1px solid rgba(34,197,94,0.12);
        }
        .preview-forest .mock-card:first-child { background: rgba(34,197,94,0.2); }

        /* Theme 5: Sapphire */
        .preview-sapphire { background: #070B14; }
        .preview-sapphire .mock-sidebar {
            position: absolute; left: 0; top: 0; bottom: 0; width: 28%;
            background: #0B1020; border-right: 1px solid rgba(59,130,246,0.18);
        }
        .preview-sapphire .mock-sidebar::before {
            content: ''; position: absolute; top: 20%; left: 12%; width: 76%; height: 6px;
            background: rgba(59,130,246,0.7); border-radius: 3px;
        }
        .preview-sapphire .mock-sidebar::after {
            content: ''; position: absolute; top: calc(20% + 18px); left: 12%; width: 55%; height: 3px;
            background: rgba(255,255,255,0.07); border-radius: 2px;
            box-shadow: 0 12px 0 rgba(255,255,255,0.05), 0 24px 0 rgba(255,255,255,0.04);
        }
        .preview-sapphire .mock-main { position: absolute; left: 28%; right: 0; top: 0; bottom: 0; }
        .preview-sapphire .mock-topbar {
            position: absolute; top: 0; left: 0; right: 0; height: 18%;
            background: rgba(59,130,246,0.05); border-bottom: 1px solid rgba(59,130,246,0.12);
        }
        .preview-sapphire .mock-cards {
            position: absolute; top: 26%; left: 5%; right: 5%;
            display: grid; grid-template-columns: repeat(3,1fr); gap: 4%;
        }
        .preview-sapphire .mock-card {
            aspect-ratio: 2/1; background: #101828;
            border-radius: 4px; border: 1px solid rgba(59,130,246,0.14);
        }
        .preview-sapphire .mock-card:first-child { background: rgba(59,130,246,0.25); }

        /* Theme 6: Luxe Gold */
        .preview-luxe { background: #0A0800; }
        .preview-luxe .mock-sidebar {
            position: absolute; left: 0; top: 0; bottom: 0; width: 28%;
            background: #120F02; border-right: 1px solid rgba(201,168,76,0.2);
        }
        .preview-luxe .mock-sidebar::before {
            content: ''; position: absolute; top: 20%; left: 12%; width: 76%; height: 6px;
            background: rgba(201,168,76,0.75); border-radius: 3px;
        }
        .preview-luxe .mock-sidebar::after {
            content: ''; position: absolute; top: calc(20% + 18px); left: 12%; width: 55%; height: 3px;
            background: rgba(255,255,255,0.07); border-radius: 2px;
            box-shadow: 0 12px 0 rgba(255,255,255,0.05), 0 24px 0 rgba(255,255,255,0.04);
        }
        .preview-luxe .mock-main { position: absolute; left: 28%; right: 0; top: 0; bottom: 0; }
        .preview-luxe .mock-topbar {
            position: absolute; top: 0; left: 0; right: 0; height: 18%;
            background: rgba(201,168,76,0.06); border-bottom: 1px solid rgba(201,168,76,0.15);
        }
        .preview-luxe .mock-cards {
            position: absolute; top: 26%; left: 5%; right: 5%;
            display: grid; grid-template-columns: repeat(3,1fr); gap: 4%;
        }
        .preview-luxe .mock-card {
            aspect-ratio: 2/1; background: #1A1500;
            border-radius: 4px; border: 1px solid rgba(201,168,76,0.15);
        }
        .preview-luxe .mock-card:first-child { background: rgba(201,168,76,0.2); }

        /* ── Chart strip in previews ── */
        .mock-chart-strip {
            position: absolute; bottom: 8%; left: 33%; right: 5%; height: 18%;
            display: flex; align-items: flex-end; gap: 3%;
        }
        .mock-bar {
            flex: 1; border-radius: 2px 2px 0 0;
            background: currentColor; opacity: 0.35;
        }

        /* ── Card info bar ── */
        .card-info {
            padding: 1rem 1.25rem;
            background: var(--surface-3);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-name {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        .card-tag {
            font-size: 0.68rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.25rem 0.6rem;
            border-radius: 3px;
            border: 1px solid;
        }

        .tag-dark { color: #a78bfa; border-color: rgba(167,139,250,0.3); background: rgba(167,139,250,0.08); }
        .tag-light { color: #94a3b8; border-color: rgba(148,163,184,0.3); background: rgba(148,163,184,0.08); }
        .tag-bold { color: #f87171; border-color: rgba(248,113,113,0.3); background: rgba(248,113,113,0.08); }
        .tag-nature { color: #4ade80; border-color: rgba(74,222,128,0.3); background: rgba(74,222,128,0.08); }
        .tag-pro { color: #60a5fa; border-color: rgba(96,165,250,0.3); background: rgba(96,165,250,0.08); }
        .tag-premium { color: var(--gold); border-color: rgba(201,168,76,0.3); background: rgba(201,168,76,0.08); }

        /* ── Check indicator ── */
        .card-check {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            width: 28px; height: 28px;
            border-radius: 50%;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            opacity: 0;
            transform: scale(0.7);
            transition: opacity 0.2s, transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .card-check svg { width: 14px; height: 14px; stroke: #0A0800; fill: none; stroke-width: 2.5; }

        /* ── Colour swatch row ── */
        .card-swatches {
            display: flex;
            gap: 5px;
            padding: 0.6rem 1.25rem;
            background: var(--surface-2);
            border-top: 1px solid var(--border);
        }

        .swatch {
            width: 14px; height: 14px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.15);
        }

        /* ── Action bar ── */
        .action-bar {
            width: 100%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem 2rem;
            background: var(--surface-3);
            border: 1px solid var(--border);
            border-radius: 12px;
            opacity: 0;
            animation: fadeUp 0.6s 0.85s ease forwards;
        }

        .selection-status {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .selection-status strong {
            color: var(--gold);
            font-weight: 500;
        }

        .btn-apply {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.75rem 2rem;
            background: var(--gold);
            color: #0A0800;
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-apply:hover { background: var(--gold-light); transform: translateY(-1px); }
        .btn-apply:active { transform: translateY(0); }

        .btn-apply svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }

        .btn-preview {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: transparent;
            color: var(--text-muted);
            font-family: var(--font-body);
            font-size: 0.85rem;
            letter-spacing: 0.06em;
            border: 1px solid var(--border);
            border-radius: 6px;
            cursor: pointer;
            transition: color 0.2s, border-color 0.2s;
            margin-right: 0.75rem;
        }

        .btn-preview:hover { color: var(--text); border-color: rgba(255,255,255,0.2); }
        .btn-preview svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 1.8; }

        /* ── Animations ── */
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Toast notification ── */
        .toast {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: var(--surface-3);
            border: 1px solid var(--gold);
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 0.85rem;
            color: var(--text);
            opacity: 0;
            transition: opacity 0.3s, transform 0.3s;
            pointer-events: none;
            z-index: 100;
            white-space: nowrap;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .toast-dot {
            display: inline-block;
            width: 8px; height: 8px;
            background: var(--gold);
            border-radius: 50%;
            margin-right: 8px;
        }
    </style>
</head>
<body>

<div class="page-wrap">

    <!-- Header -->
    <header class="header">
        <div class="logo">MLM<span>Pro</span></div>
        <nav class="header-nav">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
            <a href="#">Documentation</a>
        </nav>
    </header>

    <!-- Hero -->
    <div class="hero">
        <div class="eyebrow">Personalise Your Platform</div>
        <h1>Choose Your <em>Interface</em> Theme</h1>
        <p>Select a visual theme for your MLM dashboard. Each theme can be changed at any time from your settings panel.</p>
    </div>

    <!-- Theme Grid -->
    <div class="themes-grid" id="themeGrid">

        <!-- 1. Obsidian Dark -->
        <div class="theme-card" data-theme="obsidian" onclick="selectTheme(this, 'Obsidian Dark')">
            <div class="card-preview preview-obsidian">
                <div class="mock-sidebar"></div>
                <div class="mock-main">
                    <div class="mock-topbar"></div>
                    <div class="mock-cards">
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                    </div>
                    <div class="mock-chart-strip" style="color:#8b5cf6">
                        <div class="mock-bar" style="height:40%"></div>
                        <div class="mock-bar" style="height:65%"></div>
                        <div class="mock-bar" style="height:50%"></div>
                        <div class="mock-bar" style="height:80%"></div>
                        <div class="mock-bar" style="height:60%"></div>
                        <div class="mock-bar" style="height:90%"></div>
                        <div class="mock-bar" style="height:70%"></div>
                    </div>
                </div>
            </div>
            <div class="card-swatches">
                <div class="swatch" style="background:#8b5cf6"></div>
                <div class="swatch" style="background:#6d28d9"></div>
                <div class="swatch" style="background:#111118"></div>
                <div class="swatch" style="background:#0A0A0F"></div>
                <div class="swatch" style="background:#1e1e2e"></div>
            </div>
            <div class="card-info">
                <span class="card-name">Obsidian Dark</span>
                <span class="card-tag tag-dark">Dark</span>
            </div>
            <div class="card-check">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

        <!-- 2. Arctic Minimal -->
        <div class="theme-card" data-theme="arctic" onclick="selectTheme(this, 'Arctic Minimal')">
            <div class="card-preview preview-arctic">
                <div class="mock-sidebar"></div>
                <div class="mock-main">
                    <div class="mock-topbar"></div>
                    <div class="mock-cards">
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                    </div>
                    <div class="mock-chart-strip" style="color:#1A1A2E">
                        <div class="mock-bar" style="height:40%"></div>
                        <div class="mock-bar" style="height:65%"></div>
                        <div class="mock-bar" style="height:50%"></div>
                        <div class="mock-bar" style="height:80%"></div>
                        <div class="mock-bar" style="height:60%"></div>
                        <div class="mock-bar" style="height:90%"></div>
                        <div class="mock-bar" style="height:70%"></div>
                    </div>
                </div>
            </div>
            <div class="card-swatches">
                <div class="swatch" style="background:#1A1A2E"></div>
                <div class="swatch" style="background:#475569"></div>
                <div class="swatch" style="background:#F8F9FC"></div>
                <div class="swatch" style="background:#FFFFFF"></div>
                <div class="swatch" style="background:#E8EAF0"></div>
            </div>
            <div class="card-info">
                <span class="card-name">Arctic Minimal</span>
                <span class="card-tag tag-light">Light</span>
            </div>
            <div class="card-check">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

        <!-- 3. Ember -->
        <div class="theme-card" data-theme="ember" onclick="selectTheme(this, 'Ember')">
            <div class="card-preview preview-ember">
                <div class="mock-sidebar"></div>
                <div class="mock-main">
                    <div class="mock-topbar"></div>
                    <div class="mock-cards">
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                    </div>
                    <div class="mock-chart-strip" style="color:#ef4444">
                        <div class="mock-bar" style="height:40%"></div>
                        <div class="mock-bar" style="height:65%"></div>
                        <div class="mock-bar" style="height:50%"></div>
                        <div class="mock-bar" style="height:80%"></div>
                        <div class="mock-bar" style="height:60%"></div>
                        <div class="mock-bar" style="height:90%"></div>
                        <div class="mock-bar" style="height:70%"></div>
                    </div>
                </div>
            </div>
            <div class="card-swatches">
                <div class="swatch" style="background:#ef4444"></div>
                <div class="swatch" style="background:#b91c1c"></div>
                <div class="swatch" style="background:#150D0D"></div>
                <div class="swatch" style="background:#0F0A0A"></div>
                <div class="swatch" style="background:#2a1010"></div>
            </div>
            <div class="card-info">
                <span class="card-name">Ember</span>
                <span class="card-tag tag-bold">Bold</span>
            </div>
            <div class="card-check">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

        <!-- 4. Forest -->
        <div class="theme-card" data-theme="forest" onclick="selectTheme(this, 'Forest')">
            <div class="card-preview preview-forest">
                <div class="mock-sidebar"></div>
                <div class="mock-main">
                    <div class="mock-topbar"></div>
                    <div class="mock-cards">
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                    </div>
                    <div class="mock-chart-strip" style="color:#22c55e">
                        <div class="mock-bar" style="height:40%"></div>
                        <div class="mock-bar" style="height:65%"></div>
                        <div class="mock-bar" style="height:50%"></div>
                        <div class="mock-bar" style="height:80%"></div>
                        <div class="mock-bar" style="height:60%"></div>
                        <div class="mock-bar" style="height:90%"></div>
                        <div class="mock-bar" style="height:70%"></div>
                    </div>
                </div>
            </div>
            <div class="card-swatches">
                <div class="swatch" style="background:#22c55e"></div>
                <div class="swatch" style="background:#15803d"></div>
                <div class="swatch" style="background:#0C1610"></div>
                <div class="swatch" style="background:#07100C"></div>
                <div class="swatch" style="background:#162814"></div>
            </div>
            <div class="card-info">
                <span class="card-name">Forest</span>
                <span class="card-tag tag-nature">Nature</span>
            </div>
            <div class="card-check">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

        <!-- 5. Sapphire -->
        <div class="theme-card" data-theme="sapphire" onclick="selectTheme(this, 'Sapphire')">
            <div class="card-preview preview-sapphire">
                <div class="mock-sidebar"></div>
                <div class="mock-main">
                    <div class="mock-topbar"></div>
                    <div class="mock-cards">
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                    </div>
                    <div class="mock-chart-strip" style="color:#3b82f6">
                        <div class="mock-bar" style="height:40%"></div>
                        <div class="mock-bar" style="height:65%"></div>
                        <div class="mock-bar" style="height:50%"></div>
                        <div class="mock-bar" style="height:80%"></div>
                        <div class="mock-bar" style="height:60%"></div>
                        <div class="mock-bar" style="height:90%"></div>
                        <div class="mock-bar" style="height:70%"></div>
                    </div>
                </div>
            </div>
            <div class="card-swatches">
                <div class="swatch" style="background:#3b82f6"></div>
                <div class="swatch" style="background:#1d4ed8"></div>
                <div class="swatch" style="background:#0B1020"></div>
                <div class="swatch" style="background:#070B14"></div>
                <div class="swatch" style="background:#0f1e38"></div>
            </div>
            <div class="card-info">
                <span class="card-name">Sapphire</span>
                <span class="card-tag tag-pro">Professional</span>
            </div>
            <div class="card-check">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

        <!-- 6. Luxe Gold -->
        <div class="theme-card" data-theme="luxe" onclick="selectTheme(this, 'Luxe Gold')">
            <div class="card-preview preview-luxe">
                <div class="mock-sidebar"></div>
                <div class="mock-main">
                    <div class="mock-topbar"></div>
                    <div class="mock-cards">
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                        <div class="mock-card"></div>
                    </div>
                    <div class="mock-chart-strip" style="color:#C9A84C">
                        <div class="mock-bar" style="height:40%"></div>
                        <div class="mock-bar" style="height:65%"></div>
                        <div class="mock-bar" style="height:50%"></div>
                        <div class="mock-bar" style="height:80%"></div>
                        <div class="mock-bar" style="height:60%"></div>
                        <div class="mock-bar" style="height:90%"></div>
                        <div class="mock-bar" style="height:70%"></div>
                    </div>
                </div>
            </div>
            <div class="card-swatches">
                <div class="swatch" style="background:#C9A84C"></div>
                <div class="swatch" style="background:#92720A"></div>
                <div class="swatch" style="background:#120F02"></div>
                <div class="swatch" style="background:#0A0800"></div>
                <div class="swatch" style="background:#241E00"></div>
            </div>
            <div class="card-info">
                <span class="card-name">Luxe Gold</span>
                <span class="card-tag tag-premium">Premium</span>
            </div>
            <div class="card-check">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

    </div>

    <!-- Action bar -->
    <div class="action-bar" id="actionBar">
        <div class="selection-status" id="selectionStatus">
            Select a theme to get started
        </div>
        <div style="display:flex;align-items:center;">
            <button class="btn-preview" id="previewBtn" onclick="previewTheme()" style="display:none;">
                <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Preview
            </button>
            <button class="btn-apply" id="applyBtn" onclick="applyTheme()" disabled style="opacity:0.4;cursor:not-allowed;">
                <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Apply Theme
            </button>
        </div>
    </div>

</div>

<!-- Toast -->
<div class="toast" id="toast">
    <span class="toast-dot"></span>
    <span id="toastText"></span>
</div>

<script>
    let selected = null;
    let selectedName = null;

    function selectTheme(card, name) {
        document.querySelectorAll('.theme-card').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        selected = card.dataset.theme;
        selectedName = name;

        const status = document.getElementById('selectionStatus');
        status.innerHTML = `Theme selected: <strong>${name}</strong>`;

        const applyBtn = document.getElementById('applyBtn');
        applyBtn.disabled = false;
        applyBtn.style.opacity = '1';
        applyBtn.style.cursor = 'pointer';

        document.getElementById('previewBtn').style.display = 'inline-flex';
    }

    function applyTheme() {
        if (!selected) return;

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("theme.set") }}';

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;

        const themeInput = document.createElement('input');
        themeInput.type = 'hidden';
        themeInput.name = 'theme';
        themeInput.value = selected;

        form.appendChild(csrf);
        form.appendChild(themeInput);
        document.body.appendChild(form);
        form.submit();
    }

    function previewTheme() {
        showToast(`Previewing ${selectedName} — changes not saved yet`);
    }

    function showToast(msg) {
        const toast = document.getElementById('toast');
        document.getElementById('toastText').textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }
</script>

</body>
</html>