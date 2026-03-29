<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Allow pages to override title --}}
    <title>@yield('title', 'Best MLM Software Development Company in India') | {{ config('app.name', 'MICRO MLM') }}</title>

    {{-- Default meta tags that can be overridden --}}
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @else
        <meta name="description" content="Leading MLM software development company in India providing Binary, Matrix, Unilevel, Board, Investment and custom MLM software solutions. Based in Guwahati, Assam serving clients across India.">
    @endif

    @hasSection('meta_keywords')
        <meta name="keywords" content="@yield('meta_keywords')">
    @else
        <meta name="keywords" content="MLM software development company, MLM software India, MLM software Guwahati, MLM software Assam, Binary MLM software, Matrix MLM software, Unilevel MLM software, Network marketing software, custom MLM software development">
    @endif

    <meta name="robots" content="index, follow">
    <meta name="author" content="{{ config('app.name', 'MICRO MLM') }}">

    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('og_title', 'Best MLM Software Development Company in India')">
    <meta property="og:description" content="@yield('og_description', 'Advanced MLM software solutions for Binary, Matrix, Unilevel and custom network marketing plans across India.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Best MLM Software Development Company in India')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Professional MLM software development company serving Guwahati, Assam and all India.')">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700,700i&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=dm-sans:300,400,500&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=syne:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=unbounded:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=instrument-serif:400,400i&display=swap" rel="stylesheet" />

    {{-- Schema.org structured data --}}
    @stack('schema')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Theme System --}}
    @php
        $theme = session('mlm_theme') ?? (request()->cookie('mlm_theme') ?? 'obsidian');

        $themes = [
            'obsidian' => [
                'bg' => '#0A0A0F',
                'bg2' => '#111118',
                'bg3' => '#18181f',
                'accent' => '#8b5cf6',
                'accent2' => '#6d28d9',
                'accentLight' => '#c4b5fd',
                'accentDim' => 'rgba(139,92,246,0.12)',
                'accentGlow' => 'rgba(139,92,246,0.25)',
                'border' => 'rgba(139,92,246,0.18)',
                'borderSoft' => 'rgba(255,255,255,0.06)',
                'text' => '#F0EDE6',
                'textMuted' => 'rgba(240,237,230,0.5)',
                'textFaint' => 'rgba(240,237,230,0.25)',
                'heroFont' => "'Syne', sans-serif",
                'bodyFont' => "'DM Sans', sans-serif",
                'heroWeight' => '700',
                'navStyle' => 'dark',
                'bgPattern' => 'grid',
                'patternColor' => 'rgba(139,92,246,0.06)',
                'glowColor' => 'rgba(139,92,246,0.12)',
                'glow2Color' => 'rgba(109,40,217,0.10)',
            ],
            'arctic' => [
                'bg' => '#F4F6FB',
                'bg2' => '#FFFFFF',
                'bg3' => '#EDF0F7',
                'accent' => '#1A1A2E',
                'accent2' => '#2d2d4e',
                'accentLight' => '#4a4a7a',
                'accentDim' => 'rgba(26,26,46,0.06)',
                'accentGlow' => 'rgba(26,26,46,0.12)',
                'border' => '#DDE1EE',
                'borderSoft' => '#EEF0F8',
                'text' => '#1A1A2E',
                'textMuted' => '#64748b',
                'textFaint' => '#94a3b8',
                'heroFont' => "'Cormorant Garamond', serif",
                'bodyFont' => "'DM Sans', sans-serif",
                'heroWeight' => '600',
                'navStyle' => 'light',
                'bgPattern' => 'dots',
                'patternColor' => 'rgba(26,26,46,0.08)',
                'glowColor' => 'rgba(26,26,46,0.0)',
                'glow2Color' => 'rgba(26,26,46,0.04)',
            ],
            'ember' => [
                'bg' => '#0F0A0A',
                'bg2' => '#160D0D',
                'bg3' => '#1E1212',
                'accent' => '#ef4444',
                'accent2' => '#b91c1c',
                'accentLight' => '#fca5a5',
                'accentDim' => 'rgba(239,68,68,0.12)',
                'accentGlow' => 'rgba(239,68,68,0.28)',
                'border' => 'rgba(239,68,68,0.18)',
                'borderSoft' => 'rgba(255,255,255,0.05)',
                'text' => '#FFF1F1',
                'textMuted' => 'rgba(255,241,241,0.5)',
                'textFaint' => 'rgba(255,241,241,0.22)',
                'heroFont' => "'Unbounded', sans-serif",
                'bodyFont' => "'DM Sans', sans-serif",
                'heroWeight' => '700',
                'navStyle' => 'dark',
                'bgPattern' => 'diagonal',
                'patternColor' => 'rgba(239,68,68,0.04)',
                'glowColor' => 'rgba(239,68,68,0.10)',
                'glow2Color' => 'rgba(185,28,28,0.10)',
            ],
            'forest' => [
                'bg' => '#071009',
                'bg2' => '#0C160F',
                'bg3' => '#111F14',
                'accent' => '#22c55e',
                'accent2' => '#15803d',
                'accentLight' => '#86efac',
                'accentDim' => 'rgba(34,197,94,0.10)',
                'accentGlow' => 'rgba(34,197,94,0.20)',
                'border' => 'rgba(34,197,94,0.16)',
                'borderSoft' => 'rgba(255,255,255,0.05)',
                'text' => '#F0FDF4',
                'textMuted' => 'rgba(240,253,244,0.5)',
                'textFaint' => 'rgba(240,253,244,0.22)',
                'heroFont' => "'Instrument Serif', serif",
                'bodyFont' => "'DM Sans', sans-serif",
                'heroWeight' => '400',
                'navStyle' => 'dark',
                'bgPattern' => 'organic',
                'patternColor' => 'rgba(34,197,94,0.05)',
                'glowColor' => 'rgba(34,197,94,0.08)',
                'glow2Color' => 'rgba(21,128,61,0.08)',
            ],
            'sapphire' => [
                'bg' => '#070B14',
                'bg2' => '#0B1020',
                'bg3' => '#101828',
                'accent' => '#3b82f6',
                'accent2' => '#1d4ed8',
                'accentLight' => '#93c5fd',
                'accentDim' => 'rgba(59,130,246,0.10)',
                'accentGlow' => 'rgba(59,130,246,0.22)',
                'border' => 'rgba(59,130,246,0.18)',
                'borderSoft' => 'rgba(255,255,255,0.05)',
                'text' => '#EFF6FF',
                'textMuted' => 'rgba(239,246,255,0.5)',
                'textFaint' => 'rgba(239,246,255,0.22)',
                'heroFont' => "'Syne', sans-serif",
                'bodyFont' => "'DM Sans', sans-serif",
                'heroWeight' => '600',
                'navStyle' => 'dark',
                'bgPattern' => 'circuit',
                'patternColor' => 'rgba(59,130,246,0.05)',
                'glowColor' => 'rgba(59,130,246,0.10)',
                'glow2Color' => 'rgba(29,78,216,0.0)',
            ],
            'luxe' => [
                'bg' => '#0A0800',
                'bg2' => '#120F02',
                'bg3' => '#1C1900',
                'accent' => '#C9A84C',
                'accent2' => '#92720A',
                'accentLight' => '#E8C97A',
                'accentDim' => 'rgba(201,168,76,0.10)',
                'accentGlow' => 'rgba(201,168,76,0.20)',
                'border' => 'rgba(201,168,76,0.20)',
                'borderSoft' => 'rgba(255,255,255,0.05)',
                'text' => '#FDF6E3',
                'textMuted' => 'rgba(253,246,227,0.5)',
                'textFaint' => 'rgba(253,246,227,0.22)',
                'heroFont' => "'Cormorant Garamond', serif",
                'bodyFont' => "'DM Sans', sans-serif",
                'heroWeight' => '500',
                'navStyle' => 'dark',
                'bgPattern' => 'grid',
                'patternColor' => 'rgba(201,168,76,0.05)',
                'glowColor' => 'rgba(201,168,76,0.10)',
                'glow2Color' => 'rgba(146,114,10,0.10)',
            ],
        ];

        $t = $themes[$theme] ?? $themes['obsidian'];
        $isLight = $t['navStyle'] === 'light';
    @endphp

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: {{ $t['bg'] }};
            --bg2: {{ $t['bg2'] }};
            --bg3: {{ $t['bg3'] }};
            --accent: {{ $t['accent'] }};
            --accent2: {{ $t['accent2'] }};
            --accentLight: {{ $t['accentLight'] }};
            --accentDim: {{ $t['accentDim'] }};
            --accentGlow: {{ $t['accentGlow'] }};
            --border: {{ $t['border'] }};
            --borderSoft: {{ $t['borderSoft'] }};
            --text: {{ $t['text'] }};
            --textMuted: {{ $t['textMuted'] }};
            --textFaint: {{ $t['textFaint'] }};
            --heroFont: {{ $t['heroFont'] }};
            --bodyFont: {{ $t['bodyFont'] }};
            --heroWeight: {{ $t['heroWeight'] }};
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--bodyFont);
            font-weight: 300;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ── Background ── */
        .bg-layer {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;

            @if ($t['bgPattern'] === 'grid' || $t['bgPattern'] === 'luxury')
                background-image:
                    linear-gradient({{ $t['patternColor'] }} 1px, transparent 1px),
                    linear-gradient(90deg, {{ $t['patternColor'] }} 1px, transparent 1px);
                background-size: 64px 64px;
            @elseif($t['bgPattern'] === 'dots')
                background-image: radial-gradient(circle, {{ $t['patternColor'] }} 1px, transparent 1px);
                background-size: 28px 28px;
            @elseif($t['bgPattern'] === 'diagonal')
                background-image: repeating-linear-gradient(-45deg, transparent, transparent 40px,
                        {{ $t['patternColor'] }} 40px, {{ $t['patternColor'] }} 41px);
            @elseif($t['bgPattern'] === 'circuit')
                background-image:
                    linear-gradient({{ $t['patternColor'] }} 1px, transparent 1px),
                    linear-gradient(90deg, {{ $t['patternColor'] }} 1px, transparent 1px),
                    linear-gradient(rgba(59, 130, 246, 0.02) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(59, 130, 246, 0.02) 1px, transparent 1px);
                background-size: 80px 80px, 80px 80px, 20px 20px, 20px 20px;
            @elseif($t['bgPattern'] === 'organic')
                background-image:
                    radial-gradient(ellipse at 20% 50%, {{ $t['patternColor'] }} 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 20%, {{ $t['patternColor'] }} 0%, transparent 40%);
            @endif
        }

        .bg-glow {
            position: fixed;
            pointer-events: none;
            z-index: 0;
            top: -20%;
            left: 50%;
            transform: translateX(-50%);
            width: 900px;
            height: 700px;
            background: radial-gradient(ellipse, {{ $t['glowColor'] }} 0%, transparent 65%);
        }

        .bg-glow-2 {
            position: fixed;
            pointer-events: none;
            z-index: 0;
            bottom: -10%;
            right: -5%;
            width: 600px;
            height: 600px;
            background: radial-gradient(ellipse, {{ $t['glow2Color'] }} 0%, transparent 60%);
        }

        /* ── NAV ── */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 3rem;
            border-bottom: 1px solid transparent;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            transition: background 0.3s, border-color 0.3s;
        }

        .nav.scrolled {
            background: {{ $isLight ? 'rgba(244,246,251,0.95)' : 'rgba(10,10,15,0.92)' }};
            border-color: var(--borderSoft);
        }

        .nav-logo {
            font-family: var(--heroFont);
            font-size: 1.35rem;
            font-weight: var(--heroWeight);
            color: var(--accent);
            letter-spacing: 0.03em;
            text-decoration: none;
            flex-shrink: 0;
        }

        .nav-logo span {
            color: var(--text);
            font-weight: 300;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            margin-left: 3rem;
            list-style: none;
            flex: 1;
        }

        .nav-links a {
            color: var(--textMuted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 400;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--text);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-left: auto;
        }

        /* MOBILE MENU TOGGLE */
        .mobile-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
            z-index: 110;
        }

        .mobile-toggle span {
            width: 24px;
            height: 2px;
            background: var(--text);
            transition: 0.3s;
        }

        @media (max-width: 960px) {
            .nav {
                padding: 0 1.5rem;
            }

            .nav-links {
                display: none;
            }

            .nav-actions {
                display: none;
            }

            .mobile-toggle {
                display: flex;
                margin-left: auto;
            }

            .nav-links.active {
                display: flex;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: var(--bg);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin: 0;
                z-index: 105;
                gap: 2rem;
            }

            .nav-links.active a {
                font-size: 1.5rem;
            }

            .nav-actions.active {
                display: flex;
                position: fixed;
                bottom: 10%;
                left: 50%;
                transform: translateX(-50%);
                z-index: 106;
            }
        }

        .btn-nav-ghost {
            padding: 0.5rem 1.2rem;
            background: transparent;
            color: var(--textMuted);
            border: 1px solid var(--borderSoft);
            border-radius: 6px;
            font-family: var(--bodyFont);
            font-size: 0.82rem;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.2s, border-color 0.2s;
        }

        .btn-nav-ghost:hover {
            color: var(--text);
            border-color: var(--border);
        }

        .btn-nav-primary {
            padding: 0.5rem 1.4rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 6px;
            font-family: var(--bodyFont);
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.15s;
        }

        .btn-nav-primary:hover {
            opacity: 0.88;
            transform: translateY(-1px);
        }

        /* ── Common Buttons ── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.9rem 2.2rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 8px;
            font-family: var(--bodyFont);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 10px 40px var(--accentGlow);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.9rem 2rem;
            background: transparent;
            color: var(--textMuted);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: var(--bodyFont);
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.2s, border-color 0.2s, transform 0.2s;
        }

        .btn-ghost:hover {
            color: var(--text);
            border-color: var(--accentLight);
            transform: translateY(-2px);
        }

        /* ── SECTIONS ── */
        .section {
            position: relative;
            z-index: 1;
            padding: 6rem 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-family: var(--heroFont);
            font-size: clamp(1.8rem, 5vw, 3rem);
            font-weight: var(--heroWeight);
            line-height: 1.15;
            color: var(--text);
            margin-bottom: 0.75rem;
        }

        .section-title em {
            font-style: italic;
            color: var(--accent);
        }

        .text-center {
            text-align: center;
        }

        /* ── FOOTER ── */
        .footer {
            padding: 4rem 1.5rem;
            text-align: center;
            background: var(--bg2);
            border-top: 1px solid var(--borderSoft);
            position: relative;
            z-index: 1;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .footer-links a {
            color: var(--textMuted);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--accentLight);
            transform: translateY(-1px);
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── Content Wrapper ── */
        .content-wrapper {
            position: relative;
            z-index: 1;
            min-height: calc(100vh - 64px);
            padding-top: 64px;
        }
    </style>

    {{-- Additional page-specific styles --}}
    @stack('styles')
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-18048083910"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-18048083910');
</script>

<body>

    {{-- Background Elements --}}
    <div class="bg-layer"></div>
    <div class="bg-glow"></div>
    <div class="bg-glow-2"></div>

    {{-- Navigation --}}
    <nav class="nav" id="nav">
        <a href="{{ route('welcome') }}" class="nav-logo">MLM Pro<span>.</span></a>

        <button class="mobile-toggle" id="mobile-toggle">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-links" id="nav-links">
            <li><a href="{{ route('website.features') }}">Features</a></li>
            <li><a href="{{ route('website.pricing') }}">Pricing</a></li>
            <li><a href="{{ route('website.contact') }}">Contact</a></li>
            <li><a href="tel:9101177123">Call - 9101177123</a></li>
        </ul>
        
        <div class="nav-actions" id="nav-actions">
            <a href="{{ route('login') }}" class="btn-nav-ghost">Demo</a>
            <a href="{{ route('register') }}" class="btn-nav-primary">Join Now</a>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="content-wrapper">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="footer">
        <div style="font-family:var(--heroFont); font-size:1.5rem; color:var(--accent); margin-bottom:1rem;">
            MICRO<span>MLM</span>
        </div>

        <div class="footer-links" style="margin-bottom:2rem;">
            <a href="{{ route('website.pricing') }}">Pricing</a>
            <a href="{{ route('website.features') }}">Features</a>
            <a href="{{ route('website.contact') }}">Contact</a>
            <a href="{{ route('website.binary-plan') }}">Binary Plan</a>
            <a href="{{ route('website.unilevel-plan') }}">Unilevel Plan</a>
            <a href="{{ route('website.matrix-plan') }}">Matrix Plan</a>
        </div>

        <div class="footer-links" style="margin-bottom:2rem;">
            <a href="{{ route('website.mlm-guwahati') }}">MLM Software Guwahati</a>
            <a href="{{ route('website.mlm-kolkata') }}">MLM Software Kolkata</a>
            <a href="{{ route('website.mlm-assam') }}">MLM Software Assam</a>
            <a href="{{ route('website.mlm-india') }}">MLM Software India</a>
        </div>

        <div class="footer-links" style="margin-bottom:2rem;">
            <a href="{{ route('website.mlm-software') }}">MLM Software</a>
            <a href="{{ route('website.custom-mlm-software') }}">Custom MLM Software</a>
            <a href="{{ route('website.buy-mlm-software') }}">Buy MLM Software</a>
            <a href="{{ route('website.network-marketing-software') }}">Network Marketing Software</a>
            <a href="{{ route('website.mlm-software-development') }}">MLM Software Development</a>
        </div>

        <div class="footer-links" style="margin-bottom:2rem;">
            <a href="{{ route('website.blog.legality-of-mlm-in-india') }}">MLM Legality in India</a>
            <a href="{{ route('website.blog.how-to-select-best-mlm-software') }}">Best MLM Software Guide</a>
        </div>

        <div style="font-size:0.75rem; color:var(--textFaint);">
            © {{ date('Y') }} {{ config('app.name', 'MICRO MLM') }}. All Rights Reserved.
        </div>
    </footer>

    {{-- Scripts --}}
    <script>
        // MOBILE TOGGLE LOGIC
        const toggle = document.getElementById('mobile-toggle');
        const links = document.getElementById('nav-links');
        const actions = document.getElementById('nav-actions');

        toggle.addEventListener('click', () => {
            links.classList.toggle('active');
            actions.classList.toggle('active');
        });

        // NAVBAR SCROLL
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('nav');
            nav.classList.toggle('scrolled', window.scrollY > 20);
        });

        // REVEAL ANIMATION
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

    {{-- Additional page-specific scripts --}}
    @stack('scripts')
</body>

</html>