<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MLM Pro') }} — Build Your Empire</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700,700i&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=dm-sans:300,400,500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=syne:400,500,600,700,800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=unbounded:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=instrument-serif:400,400i&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $theme = session('mlm_theme') ?? request()->cookie('mlm_theme') ?? 'obsidian';

        $themes = [
            'obsidian' => [
                'bg'           => '#0A0A0F',
                'bg2'          => '#111118',
                'bg3'          => '#18181f',
                'accent'       => '#8b5cf6',
                'accent2'      => '#6d28d9',
                'accentLight'  => '#c4b5fd',
                'accentDim'    => 'rgba(139,92,246,0.12)',
                'accentGlow'   => 'rgba(139,92,246,0.25)',
                'border'       => 'rgba(139,92,246,0.18)',
                'borderSoft'   => 'rgba(255,255,255,0.06)',
                'text'         => '#F0EDE6',
                'textMuted'    => 'rgba(240,237,230,0.5)',
                'textFaint'    => 'rgba(240,237,230,0.25)',
                'heroFont'     => "'Syne', sans-serif",
                'bodyFont'     => "'DM Sans', sans-serif",
                'heroWeight'   => '700',
                'tagline'      => 'Architect Your Network',
                'headline'     => 'Build Unstoppable<br><em>Downlines</em> That Scale',
                'sub'          => 'The most powerful MLM platform engineered for serious network builders. Real-time genealogy, automated commissions, and predictive analytics in one command center.',
                'feat1t' => 'Binary & Matrix Trees',      'feat1d' => 'Visualise every node of your downline in real time with our interactive genealogy engine.',        'feat1i' => 'tree',
                'feat2t' => 'Instant Commissions',        'feat2d' => 'Automated payout calculations across unlimited plan types — binary, unilevel, board, and more.',   'feat2i' => 'zap',
                'feat3t' => 'Deep Analytics',             'feat3d' => 'Predictive dashboards that surface your best performers and flag at-risk legs before they go cold.','feat3i' => 'bar',
                'feat4t' => 'Rank & Reward Engine',       'feat4d' => 'Configure unlimited ranks, badges and incentive triggers without writing a single line of code.',   'feat4i' => 'lock',
                'ctaPrimary'   => 'Start Building Free',
                'ctaSecondary' => 'Watch Demo',
                'navStyle'     => 'dark',
                'bgPattern'    => 'grid',
                'patternColor' => 'rgba(139,92,246,0.06)',
                'glowColor'    => 'rgba(139,92,246,0.12)',
                'glow2Color'   => 'rgba(109,40,217,0.10)',
            ],
            'arctic' => [
                'bg'           => '#F4F6FB',
                'bg2'          => '#FFFFFF',
                'bg3'          => '#EDF0F7',
                'accent'       => '#1A1A2E',
                'accent2'      => '#2d2d4e',
                'accentLight'  => '#4a4a7a',
                'accentDim'    => 'rgba(26,26,46,0.06)',
                'accentGlow'   => 'rgba(26,26,46,0.12)',
                'border'       => '#DDE1EE',
                'borderSoft'   => '#EEF0F8',
                'text'         => '#1A1A2E',
                'textMuted'    => '#64748b',
                'textFaint'    => '#94a3b8',
                'heroFont'     => "'Cormorant Garamond', serif",
                'bodyFont'     => "'DM Sans', sans-serif",
                'heroWeight'   => '600',
                'tagline'      => 'Precision Network Management',
                'headline'     => 'The Clean,<br><em>Intelligent</em> MLM Platform',
                'sub'          => 'A refined approach to network marketing software. Distilled to its essentials — fast, clear, and beautifully organised for teams who value clarity over chaos.',
                'feat1t' => 'Structured Genealogy',  'feat1d' => 'Crisp, zoomable network trees that make onboarding and auditing effortless.',                'feat1i' => 'tree',
                'feat2t' => 'Automated Payouts',     'feat2d' => 'Set your plan rules once. Commissions calculate and queue automatically every cycle.',       'feat2i' => 'zap',
                'feat3t' => 'Clean Dashboards',      'feat3d' => 'Uncluttered analytics that surface only the numbers that matter, when they matter.',         'feat3i' => 'bar',
                'feat4t' => 'Role-Based Access',     'feat4d' => 'Granular permission layers so every member sees exactly what they need — nothing more.',     'feat4i' => 'lock',
                'ctaPrimary'   => 'Get Started Free',
                'ctaSecondary' => 'See How It Works',
                'navStyle'     => 'light',
                'bgPattern'    => 'dots',
                'patternColor' => 'rgba(26,26,46,0.08)',
                'glowColor'    => 'rgba(26,26,46,0.0)',
                'glow2Color'   => 'rgba(26,26,46,0.04)',
            ],
            'ember' => [
                'bg'           => '#0F0A0A',
                'bg2'          => '#160D0D',
                'bg3'          => '#1E1212',
                'accent'       => '#ef4444',
                'accent2'      => '#b91c1c',
                'accentLight'  => '#fca5a5',
                'accentDim'    => 'rgba(239,68,68,0.12)',
                'accentGlow'   => 'rgba(239,68,68,0.28)',
                'border'       => 'rgba(239,68,68,0.18)',
                'borderSoft'   => 'rgba(255,255,255,0.05)',
                'text'         => '#FFF1F1',
                'textMuted'    => 'rgba(255,241,241,0.5)',
                'textFaint'    => 'rgba(255,241,241,0.22)',
                'heroFont'     => "'Unbounded', sans-serif",
                'bodyFont'     => "'DM Sans', sans-serif",
                'heroWeight'   => '700',
                'tagline'      => 'Ignite Your Network',
                'headline'     => 'Dominate.<br><em>Expand.</em> Repeat.',
                'sub'          => 'Built for relentless growth. MLMPro gives you the firepower to recruit faster, pay instantly, and track every gain across your entire downline.',
                'feat1t' => 'Aggressive Scaling Tools', 'feat1d' => 'Multi-level trees built to handle explosive growth — thousands of nodes, zero lag.',           'feat1i' => 'tree',
                'feat2t' => 'Instant Commission Fire',  'feat2d' => "Don't wait for payroll. Trigger real-time payouts the moment a sale closes.",               'feat2i' => 'zap',
                'feat3t' => 'War Room Analytics',       'feat3d' => 'Live leaderboards, leg performance heat maps, and daily battle stats for your team.',        'feat3i' => 'bar',
                'feat4t' => 'Rank Acceleration',        'feat4d' => 'Gamified rank ladders that push every member to hit the next level — fast.',                 'feat4i' => 'lock',
                'ctaPrimary'   => 'Ignite Now — Free',
                'ctaSecondary' => 'See the Platform',
                'navStyle'     => 'dark',
                'bgPattern'    => 'diagonal',
                'patternColor' => 'rgba(239,68,68,0.04)',
                'glowColor'    => 'rgba(239,68,68,0.10)',
                'glow2Color'   => 'rgba(185,28,28,0.10)',
            ],
            'forest' => [
                'bg'           => '#071009',
                'bg2'          => '#0C160F',
                'bg3'          => '#111F14',
                'accent'       => '#22c55e',
                'accent2'      => '#15803d',
                'accentLight'  => '#86efac',
                'accentDim'    => 'rgba(34,197,94,0.10)',
                'accentGlow'   => 'rgba(34,197,94,0.20)',
                'border'       => 'rgba(34,197,94,0.16)',
                'borderSoft'   => 'rgba(255,255,255,0.05)',
                'text'         => '#F0FDF4',
                'textMuted'    => 'rgba(240,253,244,0.5)',
                'textFaint'    => 'rgba(240,253,244,0.22)',
                'heroFont'     => "'Instrument Serif', serif",
                'bodyFont'     => "'DM Sans', sans-serif",
                'heroWeight'   => '400',
                'tagline'      => 'Grow Organically',
                'headline'     => 'Nurture Every Branch<br>of Your <em>Network</em>',
                'sub'          => 'Like a forest, the strongest networks grow from deep roots. MLMPro gives you the tools to cultivate lasting relationships and a downline that thrives long-term.',
                'feat1t' => 'Organic Network Growth',   'feat1d' => 'Visualise your downline like a living tree — watch it branch, grow, and bear fruit over time.',        'feat1i' => 'tree',
                'feat2t' => 'Sustainable Commissions',  'feat2d' => 'Fair, transparent payout structures that reward consistency and long-term member retention.',          'feat2i' => 'zap',
                'feat3t' => 'Growth Tracking',          'feat3d' => 'Monitor the health of each branch, spot weak spots early, and nurture your best growers.',            'feat3i' => 'bar',
                'feat4t' => 'Community Tools',          'feat4d' => 'Built-in communication and mentoring features that help your network support each other.',            'feat4i' => 'lock',
                'ctaPrimary'   => 'Plant Your Network',
                'ctaSecondary' => 'Explore Features',
                'navStyle'     => 'dark',
                'bgPattern'    => 'organic',
                'patternColor' => 'rgba(34,197,94,0.05)',
                'glowColor'    => 'rgba(34,197,94,0.08)',
                'glow2Color'   => 'rgba(21,128,61,0.08)',
            ],
            'sapphire' => [
                'bg'           => '#070B14',
                'bg2'          => '#0B1020',
                'bg3'          => '#101828',
                'accent'       => '#3b82f6',
                'accent2'      => '#1d4ed8',
                'accentLight'  => '#93c5fd',
                'accentDim'    => 'rgba(59,130,246,0.10)',
                'accentGlow'   => 'rgba(59,130,246,0.22)',
                'border'       => 'rgba(59,130,246,0.18)',
                'borderSoft'   => 'rgba(255,255,255,0.05)',
                'text'         => '#EFF6FF',
                'textMuted'    => 'rgba(239,246,255,0.5)',
                'textFaint'    => 'rgba(239,246,255,0.22)',
                'heroFont'     => "'Syne', sans-serif",
                'bodyFont'     => "'DM Sans', sans-serif",
                'heroWeight'   => '600',
                'tagline'      => 'Enterprise-Grade MLM',
                'headline'     => 'The Professional<br><em>Network</em> Operating System',
                'sub'          => 'Designed for serious enterprise MLM operations. Compliance-ready, audit-friendly, and built to scale from startup to multinational without changing platforms.',
                'feat1t' => 'Enterprise Genealogy',   'feat1d' => 'Multi-country, multi-currency network trees with full audit trails and compliance reporting.',       'feat1i' => 'tree',
                'feat2t' => 'Payroll Integration',    'feat2d' => 'Connect to your existing payroll and banking infrastructure via secure REST APIs.',                   'feat2i' => 'zap',
                'feat3t' => 'Executive Dashboards',   'feat3d' => 'Board-level reporting with KPI tracking, forecasting models, and exportable compliance reports.',    'feat3i' => 'bar',
                'feat4t' => 'Compliance & Security',  'feat4d' => 'SOC 2 ready architecture, 2FA enforcement, and full transaction audit logs built in.',               'feat4i' => 'lock',
                'ctaPrimary'   => 'Request Enterprise Demo',
                'ctaSecondary' => 'View Pricing',
                'navStyle'     => 'dark',
                'bgPattern'    => 'circuit',
                'patternColor' => 'rgba(59,130,246,0.05)',
                'glowColor'    => 'rgba(59,130,246,0.10)',
                'glow2Color'   => 'rgba(29,78,216,0.0)',
            ],
            'luxe' => [
                'bg'           => '#0A0800',
                'bg2'          => '#120F02',
                'bg3'          => '#1C1900',
                'accent'       => '#C9A84C',
                'accent2'      => '#92720A',
                'accentLight'  => '#E8C97A',
                'accentDim'    => 'rgba(201,168,76,0.10)',
                'accentGlow'   => 'rgba(201,168,76,0.20)',
                'border'       => 'rgba(201,168,76,0.20)',
                'borderSoft'   => 'rgba(255,255,255,0.05)',
                'text'         => '#FDF6E3',
                'textMuted'    => 'rgba(253,246,227,0.5)',
                'textFaint'    => 'rgba(253,246,227,0.22)',
                'heroFont'     => "'Cormorant Garamond', serif",
                'bodyFont'     => "'DM Sans', sans-serif",
                'heroWeight'   => '500',
                'tagline'      => 'The Premier Choice',
                'headline'     => 'Where Wealth<br><em>Multiplies</em> With Elegance',
                'sub'          => 'MLMPro Luxe is crafted for the discerning network leader. Sophisticated commission structures, white-glove onboarding, and a platform that reflects the prestige of your brand.',
                'feat1t' => 'Prestige Network Trees',   'feat1d' => 'Beautifully rendered genealogy maps that reflect the calibre of your distribution network.',        'feat1i' => 'tree',
                'feat2t' => 'Bespoke Commission Plans', 'feat2d' => 'Craft intricate, multi-tier commission structures tailored precisely to your business model.',       'feat2i' => 'zap',
                'feat3t' => 'Private Analytics Suite',  'feat3d' => 'Exclusive reporting dashboards with concierge-level insight into every facet of your network.',     'feat3i' => 'bar',
                'feat4t' => 'White-Label Platform',     'feat4d' => 'Deploy under your own brand with custom domains, logos, and fully bespoke styling.',                'feat4i' => 'lock',
                'ctaPrimary'   => 'Request Private Access',
                'ctaSecondary' => 'Discover More',
                'navStyle'     => 'dark',
                'bgPattern'    => 'grid',
                'patternColor' => 'rgba(201,168,76,0.05)',
                'glowColor'    => 'rgba(201,168,76,0.10)',
                'glow2Color'   => 'rgba(146,114,10,0.10)',
            ],
        ];

        $t = $themes[$theme] ?? $themes['obsidian'];
        $isLight = $t['navStyle'] === 'light';
    @endphp

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:          {{ $t['bg'] }};
            --bg2:         {{ $t['bg2'] }};
            --bg3:         {{ $t['bg3'] }};
            --accent:      {{ $t['accent'] }};
            --accent2:     {{ $t['accent2'] }};
            --accentLight: {{ $t['accentLight'] }};
            --accentDim:   {{ $t['accentDim'] }};
            --accentGlow:  {{ $t['accentGlow'] }};
            --border:      {{ $t['border'] }};
            --borderSoft:  {{ $t['borderSoft'] }};
            --text:        {{ $t['text'] }};
            --textMuted:   {{ $t['textMuted'] }};
            --textFaint:   {{ $t['textFaint'] }};
            --heroFont:    {{ $t['heroFont'] }};
            --bodyFont:    {{ $t['bodyFont'] }};
            --heroWeight:  {{ $t['heroWeight'] }};
        }

        html { scroll-behavior: smooth; }

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
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
            @if($t['bgPattern'] === 'grid' || $t['bgPattern'] === 'luxury')
            background-image:
                linear-gradient({{ $t['patternColor'] }} 1px, transparent 1px),
                linear-gradient(90deg, {{ $t['patternColor'] }} 1px, transparent 1px);
            background-size: 64px 64px;
            @elseif($t['bgPattern'] === 'dots')
            background-image: radial-gradient(circle, {{ $t['patternColor'] }} 1px, transparent 1px);
            background-size: 28px 28px;
            @elseif($t['bgPattern'] === 'diagonal')
            background-image: repeating-linear-gradient(
                -45deg, transparent, transparent 40px,
                {{ $t['patternColor'] }} 40px, {{ $t['patternColor'] }} 41px
            );
            @elseif($t['bgPattern'] === 'circuit')
            background-image:
                linear-gradient({{ $t['patternColor'] }} 1px, transparent 1px),
                linear-gradient(90deg, {{ $t['patternColor'] }} 1px, transparent 1px),
                linear-gradient(rgba(59,130,246,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.02) 1px, transparent 1px);
            background-size: 80px 80px, 80px 80px, 20px 20px, 20px 20px;
            @elseif($t['bgPattern'] === 'organic')
            background-image:
                radial-gradient(ellipse at 20% 50%, {{ $t['patternColor'] }} 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, {{ $t['patternColor'] }} 0%, transparent 40%);
            @endif
        }

        .bg-glow {
            position: fixed; pointer-events: none; z-index: 0;
            top: -20%; left: 50%; transform: translateX(-50%);
            width: 900px; height: 700px;
            background: radial-gradient(ellipse, {{ $t['glowColor'] }} 0%, transparent 65%);
        }

        .bg-glow-2 {
            position: fixed; pointer-events: none; z-index: 0;
            bottom: -10%; right: -5%;
            width: 600px; height: 600px;
            background: radial-gradient(ellipse, {{ $t['glow2Color'] }} 0%, transparent 60%);
        }

        /* ── NAV ── */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            height: 64px;
            display: flex; align-items: center;
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
            font-size: 1.35rem; font-weight: var(--heroWeight);
            color: var(--accent); letter-spacing: 0.03em;
            text-decoration: none; flex-shrink: 0;
        }
        .nav-logo span { color: var(--text); font-weight: 300; }
        .nav-links {
            display: flex; gap: 2.5rem; margin-left: 3rem;
            list-style: none; flex: 1;
        }
        .nav-links a {
            color: var(--textMuted); text-decoration: none;
            font-size: 0.875rem; font-weight: 400;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--text); }
        .nav-actions { display: flex; align-items: center; gap: 0.75rem; margin-left: auto; }
        .btn-nav-ghost {
            padding: 0.5rem 1.2rem;
            background: transparent; color: var(--textMuted);
            border: 1px solid var(--borderSoft); border-radius: 6px;
            font-family: var(--bodyFont); font-size: 0.82rem;
            cursor: pointer; text-decoration: none; transition: color 0.2s, border-color 0.2s;
        }
        .btn-nav-ghost:hover { color: var(--text); border-color: var(--border); }
        .btn-nav-primary {
            padding: 0.5rem 1.4rem;
            background: var(--accent); color: var(--bg);
            border: none; border-radius: 6px;
            font-family: var(--bodyFont); font-size: 0.82rem; font-weight: 500;
            cursor: pointer; text-decoration: none; transition: opacity 0.2s, transform 0.15s;
        }
        .btn-nav-primary:hover { opacity: 0.88; transform: translateY(-1px); }

        /* ── HERO ── */
        .hero {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center;
            padding: 8rem 2rem 5rem;
        }
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 0.6rem;
            padding: 0.35rem 1rem;
            background: var(--accentDim); border: 1px solid var(--border);
            border-radius: 100px;
            font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase;
            color: var(--accentLight);
            margin-bottom: 2rem;
            opacity: 0; animation: fadeUp 0.6s 0.1s ease forwards;
        }
        .eyebrow-dot {
            width: 6px; height: 6px; border-radius: 50%; background: var(--accent);
            animation: blink 2s infinite;
        }
        @keyframes blink { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.4;transform:scale(0.75)} }
        .hero h1 {
            font-family: var(--heroFont);
            font-size: clamp(2.8rem, 6vw, 5.5rem);
            font-weight: var(--heroWeight);
            line-height: 1.08; letter-spacing: -0.02em;
            color: var(--text); max-width: 820px;
            margin-bottom: 1.5rem;
            opacity: 0; animation: fadeUp 0.7s 0.2s ease forwards;
        }
        .hero h1 em { font-style: italic; color: var(--accent); }
        .hero-sub {
            font-size: 1.05rem; line-height: 1.8;
            color: var(--textMuted); max-width: 560px;
            margin-bottom: 2.5rem;
            opacity: 0; animation: fadeUp 0.7s 0.35s ease forwards;
        }
        .hero-cta {
            display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;
            margin-bottom: 4rem;
            opacity: 0; animation: fadeUp 0.7s 0.5s ease forwards;
        }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 0.6rem;
            padding: 0.9rem 2.2rem;
            background: var(--accent); color: var(--bg);
            border: none; border-radius: 8px;
            font-family: var(--bodyFont); font-size: 0.9rem; font-weight: 500;
            cursor: pointer; text-decoration: none;
            transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 10px 40px var(--accentGlow); }
        .btn-primary svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: 0.6rem;
            padding: 0.9rem 2rem;
            background: transparent; color: var(--textMuted);
            border: 1px solid var(--border); border-radius: 8px;
            font-family: var(--bodyFont); font-size: 0.9rem;
            cursor: pointer; text-decoration: none;
            transition: color 0.2s, border-color 0.2s, transform 0.2s;
        }
        .btn-ghost:hover { color: var(--text); border-color: var(--accentLight); transform: translateY(-2px); }
        .btn-ghost svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* Stats */
        .hero-stats {
            display: flex; align-items: stretch;
            border: 1px solid var(--border); border-radius: 12px;
            overflow: hidden; background: var(--bg2);
            opacity: 0; animation: fadeUp 0.7s 0.65s ease forwards;
        }
        .stat-item {
            padding: 1.25rem 2.5rem; text-align: center;
            border-right: 1px solid var(--border); flex: 1;
        }
        .stat-item:last-child { border-right: none; }
        .stat-num {
            font-family: var(--heroFont); font-size: 1.8rem;
            font-weight: var(--heroWeight); color: var(--accent);
            line-height: 1; margin-bottom: 0.35rem;
        }
        .stat-lbl { font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--textFaint); }

        /* Scroll hint */
        .scroll-hint {
            position: absolute; bottom: 2.5rem; left: 50%; transform: translateX(-50%);
            display: flex; flex-direction: column; align-items: center; gap: 0.5rem;
            color: var(--textFaint); font-size: 0.68rem; letter-spacing: 0.12em; text-transform: uppercase;
            opacity: 0; animation: fadeUp 0.6s 1.1s ease forwards;
        }
        .scroll-line {
            width: 1px; height: 40px;
            background: linear-gradient(to bottom, var(--accent), transparent);
            animation: lineDown 2s ease infinite;
        }
        @keyframes lineDown {
            0%   { transform: scaleY(0); transform-origin: top; }
            50%  { transform: scaleY(1); transform-origin: top; }
            51%  { transform: scaleY(1); transform-origin: bottom; }
            100% { transform: scaleY(0); transform-origin: bottom; }
        }

        /* ── SECTIONS ── */
        .section {
            position: relative; z-index: 1;
            padding: 6rem 2rem;
            max-width: 1200px; margin: 0 auto;
        }
        .eyebrow {
            font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--accentLight); margin-bottom: 0.75rem;
            display: flex; align-items: center; gap: 0.75rem;
        }
        .eyebrow::before { content: ''; width: 24px; height: 1px; background: var(--accent); }
        .eyebrow-center { justify-content: center; }
        .eyebrow-center::before { display: none; }
        .section-title {
            font-family: var(--heroFont); font-size: clamp(2rem, 3.5vw, 3rem);
            font-weight: var(--heroWeight); line-height: 1.15; color: var(--text);
            margin-bottom: 0.75rem;
        }
        .section-title em { font-style: italic; color: var(--accent); }
        .section-desc { font-size: 0.95rem; color: var(--textMuted); max-width: 480px; line-height: 1.8; margin-bottom: 3rem; }

        /* Features grid */
        .features-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; }
        @media (max-width: 700px) { .features-grid { grid-template-columns: 1fr; } }
        .feat-card {
            background: var(--bg2); border: 1px solid var(--borderSoft);
            border-radius: 12px; padding: 1.75rem;
            transition: border-color 0.25s, transform 0.25s;
            position: relative; overflow: hidden;
        }
        .feat-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            opacity: 0; transition: opacity 0.3s;
        }
        .feat-card:hover { border-color: var(--border); transform: translateY(-4px); }
        .feat-card:hover::before { opacity: 1; }
        .feat-icon {
            width: 40px; height: 40px;
            background: var(--accentDim); border: 1px solid var(--border);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.1rem;
        }
        .feat-icon svg { width: 18px; height: 18px; stroke: var(--accentLight); fill: none; stroke-width: 1.8; }
        .feat-title { font-family: var(--heroFont); font-size: 1.1rem; font-weight: 500; color: var(--text); margin-bottom: 0.6rem; }
        .feat-desc { font-size: 0.875rem; color: var(--textMuted); line-height: 1.75; }

        /* ── DASHBOARD PREVIEW ── */
        .preview-section {
            position: relative; z-index: 1;
            padding: 2rem 2rem 6rem;
        }
        .preview-header { text-align: center; margin-bottom: 2.5rem; max-width: 1100px; margin-left: auto; margin-right: auto; }
        .preview-wrap {
            max-width: 1100px; margin: 0 auto;
            border: 1px solid var(--border); border-radius: 16px;
            overflow: hidden; box-shadow: 0 32px 80px rgba(0,0,0,0.4);
        }
        .mock-chrome {
            background: var(--bg3); border-bottom: 1px solid var(--borderSoft);
            padding: 0.75rem 1.25rem; display: flex; align-items: center; gap: 0.5rem;
        }
        .mock-dot { width: 10px; height: 10px; border-radius: 50%; }
        .dot-r { background: #ef4444; } .dot-y { background: #fbbf24; } .dot-g { background: #22c55e; }
        .mock-url {
            flex: 1; margin: 0 1rem;
            background: var(--bg2); border: 1px solid var(--borderSoft);
            border-radius: 6px; padding: 0.3rem 1rem;
            font-size: 0.72rem; color: var(--textFaint); text-align: center;
        }
        .mock-dashboard { display: flex; background: var(--bg); min-height: 420px; }
        .mock-sidebar {
            width: 190px; flex-shrink: 0;
            background: var(--bg2); border-right: 1px solid var(--borderSoft);
            padding: 1.25rem 0;
        }
        .mock-logo-bar {
            padding: 0 1.25rem 1rem;
            font-family: var(--heroFont); font-size: 1rem; font-weight: 500; color: var(--accent);
            border-bottom: 1px solid var(--borderSoft); margin-bottom: 0.75rem;
        }
        .mock-nav-item {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.45rem 1.25rem; font-size: 0.72rem; color: var(--textFaint);
        }
        .mock-nav-item.active { color: var(--accentLight); background: var(--accentDim); border-left: 2px solid var(--accent); }
        .mock-dot-sm { width: 5px; height: 5px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
        .mock-content { flex: 1; padding: 1.25rem; }
        .mock-toprow { display: flex; gap: 0.75rem; margin-bottom: 1rem; }
        .mock-stat-card {
            flex: 1; background: var(--bg2); border: 1px solid var(--borderSoft);
            border-radius: 8px; padding: 0.85rem 1rem;
        }
        .mock-stat-num { font-size: 1.1rem; font-weight: 500; color: var(--accentLight); margin-bottom: 0.2rem; }
        .mock-stat-lbl { font-size: 0.6rem; color: var(--textFaint); text-transform: uppercase; letter-spacing: 0.08em; }
        .mock-chart-area {
            background: var(--bg2); border: 1px solid var(--borderSoft);
            border-radius: 8px; padding: 1rem; margin-bottom: 0.85rem;
        }
        .mock-chart-title { font-size: 0.68rem; color: var(--textMuted); margin-bottom: 0.65rem; }
        .mock-bars { display: flex; align-items: flex-end; gap: 4px; height: 72px; }
        .mock-bar {
            flex: 1; border-radius: 2px 2px 0 0;
            background: var(--accentDim); border: 1px solid var(--border);
        }
        .mock-bar.hi { background: var(--accent); border-color: var(--accent); }
        .mock-table-area { background: var(--bg2); border: 1px solid var(--borderSoft); border-radius: 8px; overflow: hidden; }
        .mock-table-head { display: flex; padding: 0.55rem 1rem; gap: 1rem; border-bottom: 1px solid var(--borderSoft); }
        .mock-th { font-size: 0.58rem; color: var(--textFaint); text-transform: uppercase; letter-spacing: 0.1em; flex: 1; }
        .mock-tr { display: flex; padding: 0.5rem 1rem; gap: 1rem; border-bottom: 1px solid var(--borderSoft); }
        .mock-tr:last-child { border-bottom: none; }
        .mock-td { font-size: 0.65rem; color: var(--textMuted); flex: 1; }
        .mock-badge { display: inline-block; padding: 0.12rem 0.4rem; border-radius: 3px; font-size: 0.58rem; background: var(--accentDim); color: var(--accentLight); }

        /* ── PRICING ── */
        .plans-section {
            position: relative; z-index: 1;
            padding: 4rem 2rem 6rem;
            border-top: 1px solid var(--borderSoft);
        }
        .plans-inner { max-width: 1100px; margin: 0 auto; }
        .plans-header { text-align: center; margin-bottom: 3rem; }
        .plans-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }
        @media (max-width: 800px) { .plans-grid { grid-template-columns: 1fr; max-width: 380px; margin: 0 auto; } }
        .plan-card {
            background: var(--bg2); border: 1px solid var(--borderSoft);
            border-radius: 14px; padding: 2rem 1.75rem;
            transition: border-color 0.25s, transform 0.25s;
            position: relative;
        }
        .plan-card:hover { transform: translateY(-4px); border-color: var(--border); }
        .plan-card.featured { border-color: var(--accent); background: var(--bg3); }
        .plan-featured-badge {
            position: absolute; top: -12px; left: 50%; transform: translateX(-50%);
            background: var(--accent); color: var(--bg);
            font-size: 0.63rem; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;
            padding: 0.25rem 0.85rem; border-radius: 100px; white-space: nowrap;
        }
        .plan-name { font-size: 0.72rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--accentLight); margin-bottom: 0.75rem; }
        .plan-price { font-family: var(--heroFont); font-size: 2.4rem; font-weight: var(--heroWeight); color: var(--text); line-height: 1; margin-bottom: 0.25rem; }
        .plan-price span { font-size: 1rem; font-weight: 300; color: var(--textMuted); }
        .plan-desc { font-size: 0.8rem; color: var(--textMuted); margin-bottom: 1.5rem; line-height: 1.6; }
        .plan-divider { height: 1px; background: var(--borderSoft); margin-bottom: 1.25rem; }
        .plan-features { list-style: none; display: flex; flex-direction: column; gap: 0.55rem; margin-bottom: 1.75rem; }
        .plan-feature { display: flex; align-items: flex-start; gap: 0.6rem; font-size: 0.82rem; color: var(--textMuted); }
        .plan-check { color: var(--accent); flex-shrink: 0; margin-top: 1px; }
        .btn-plan {
            display: block; width: 100%; padding: 0.75rem; text-align: center;
            border-radius: 8px; font-family: var(--bodyFont); font-size: 0.85rem; font-weight: 500;
            cursor: pointer; text-decoration: none; transition: opacity 0.2s, transform 0.15s;
        }
        .btn-plan-solid { background: var(--accent); color: var(--bg); border: none; }
        .btn-plan-solid:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-plan-outline { background: transparent; color: var(--textMuted); border: 1px solid var(--border); }
        .btn-plan-outline:hover { color: var(--text); border-color: var(--accentLight); }

        /* ── CTA BANNER ── */
        .cta-banner { position: relative; z-index: 1; padding: 2rem 2rem 6rem; }
        .cta-inner {
            max-width: 1100px; margin: 0 auto;
            background: var(--bg2); border: 1px solid var(--border);
            border-radius: 20px; padding: 4.5rem 3rem;
            text-align: center; overflow: hidden; position: relative;
        }
        .cta-inner::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent 5%, var(--accent) 50%, transparent 95%);
        }
        .cta-glow {
            position: absolute; top: -40%; left: 50%; transform: translateX(-50%);
            width: 700px; height: 500px;
            background: radial-gradient(ellipse, var(--accentGlow) 0%, transparent 65%);
            pointer-events: none;
        }
        .cta-title {
            font-family: var(--heroFont); font-size: clamp(2rem, 3.5vw, 3rem);
            font-weight: var(--heroWeight); color: var(--text); margin-bottom: 1rem; position: relative;
        }
        .cta-title em { color: var(--accent); font-style: italic; }
        .cta-sub { font-size: 0.95rem; color: var(--textMuted); max-width: 460px; margin: 0 auto 2rem; line-height: 1.8; }
        .cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; position: relative; }

        /* ── FOOTER ── */
        .footer {
            position: relative; z-index: 1;
            border-top: 1px solid var(--borderSoft);
            padding: 2.5rem 3rem;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
        }
        .footer-logo { font-family: var(--heroFont); font-size: 1.1rem; font-weight: 500; color: var(--accent); }
        .footer-logo span { color: var(--textFaint); font-weight: 300; }
        .footer-text { font-size: 0.78rem; color: var(--textFaint); }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { font-size: 0.78rem; color: var(--textFaint); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--accentLight); }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.65s ease, transform 0.65s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .hero { padding-top: 6rem; }
            .hero-stats { flex-direction: column; }
            .stat-item { border-right: none; border-bottom: 1px solid var(--border); }
            .stat-item:last-child { border-bottom: none; }
            .mock-sidebar { display: none; }
            .footer { flex-direction: column; text-align: center; }
            .footer-links { justify-content: center; }
            .cta-inner { padding: 3rem 1.5rem; }
        }
    </style>
</head>
<body>

<div class="bg-layer"></div>
<div class="bg-glow"></div>
<div class="bg-glow-2"></div>

<!-- ═══ NAV ═══ -->
<nav class="nav" id="mainNav">
    <a href="#" class="nav-logo">MLM<span>Pro</span></a>
    <ul class="nav-links">
        <li><a href="#features">Features</a></li>
        <li><a href="#platform">Platform</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="#">Docs</a></li>
    </ul>
    <div class="nav-actions">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-nav-ghost">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-nav-ghost">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-nav-primary">{{ $t['ctaPrimary'] }}</a>
                @endif
            @endauth
        @endif
    </div>
</nav>

<!-- ═══ HERO ═══ -->
<section class="hero">
    <div class="hero-eyebrow">
        <span class="eyebrow-dot"></span>
        {{ $t['tagline'] }}
    </div>
    <h1>{!! $t['headline'] !!}</h1>
    <p class="hero-sub">{{ $t['sub'] }}</p>
    <div class="hero-cta">
        <a href="{{ Route::has('register') ? route('register') : '#' }}" class="btn-primary">
            <svg viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" stroke-linejoin="round"/></svg>
            {{ $t['ctaPrimary'] }}
        </a>
        <a href="#platform" class="btn-ghost">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8" stroke-linejoin="round"/></svg>
            {{ $t['ctaSecondary'] }}
        </a>
    </div>
    <div class="hero-stats">
        <div class="stat-item">
            <div class="stat-num">2.4M+</div>
            <div class="stat-lbl">Active Members</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">₹180Cr+</div>
            <div class="stat-lbl">Commissions Paid</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">99.9%</div>
            <div class="stat-lbl">Uptime SLA</div>
        </div>
    </div>
    <div class="scroll-hint">
        <div class="scroll-line"></div>
        Scroll
    </div>
</section>

<!-- ═══ FEATURES ═══ -->
<section class="section" id="features">
    <div class="reveal">
        <div class="eyebrow">Core Capabilities</div>
        <h2 class="section-title">Everything your network<br><em>needs to grow</em></h2>
        <p class="section-desc">A complete suite of tools purpose-built for MLM operations of any scale and structure.</p>
    </div>
    @php
        $iconPaths = [
            'tree' => '<circle cx="12" cy="5" r="2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="5" y2="17"/><line x1="12" y1="12" x2="19" y2="17"/>',
            'zap'  => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
            'bar'  => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
            'lock' => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
        ];
        $feats = [
            ['i'=>$t['feat1i'],'t'=>$t['feat1t'],'d'=>$t['feat1d']],
            ['i'=>$t['feat2i'],'t'=>$t['feat2t'],'d'=>$t['feat2d']],
            ['i'=>$t['feat3i'],'t'=>$t['feat3t'],'d'=>$t['feat3d']],
            ['i'=>$t['feat4i'],'t'=>$t['feat4t'],'d'=>$t['feat4d']],
        ];
    @endphp
    <div class="features-grid">
        @foreach($feats as $idx => $f)
        <div class="feat-card reveal" style="transition-delay:{{ $idx * 0.1 }}s">
            <div class="feat-icon">
                <svg viewBox="0 0 24 24">{!! $iconPaths[$f['i']] !!}</svg>
            </div>
            <div class="feat-title">{{ $f['t'] }}</div>
            <p class="feat-desc">{{ $f['d'] }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- ═══ PLATFORM PREVIEW ═══ -->
<section class="preview-section" id="platform">
    <div class="preview-header reveal">
        <div class="eyebrow eyebrow-center">Live Platform</div>
        <h2 class="section-title" style="text-align:center;">Your command center,<br><em>always in control</em></h2>
    </div>
    <div class="preview-wrap reveal" style="transition-delay:0.15s">
        <div class="mock-chrome">
            <div class="mock-dot dot-r"></div>
            <div class="mock-dot dot-y"></div>
            <div class="mock-dot dot-g"></div>
            <div class="mock-url">app.mlmpro.com/dashboard</div>
        </div>
        <div class="mock-dashboard">
            <div class="mock-sidebar">
                <div class="mock-logo-bar">MLMPro</div>
                <div class="mock-nav-item active"><span class="mock-dot-sm"></span> Dashboard</div>
                <div class="mock-nav-item"><span class="mock-dot-sm"></span> Network Tree</div>
                <div class="mock-nav-item"><span class="mock-dot-sm"></span> Commissions</div>
                <div class="mock-nav-item"><span class="mock-dot-sm"></span> Members</div>
                <div class="mock-nav-item"><span class="mock-dot-sm"></span> Payouts</div>
                <div class="mock-nav-item"><span class="mock-dot-sm"></span> Analytics</div>
                <div class="mock-nav-item"><span class="mock-dot-sm"></span> Settings</div>
            </div>
            <div class="mock-content">
                <div class="mock-toprow">
                    <div class="mock-stat-card">
                        <div class="mock-stat-num">₹2,84,320</div>
                        <div class="mock-stat-lbl">Total Earnings</div>
                    </div>
                    <div class="mock-stat-card">
                        <div class="mock-stat-num">1,247</div>
                        <div class="mock-stat-lbl">Downline Members</div>
                    </div>
                    <div class="mock-stat-card">
                        <div class="mock-stat-num">Gold IV</div>
                        <div class="mock-stat-lbl">Current Rank</div>
                    </div>
                    <div class="mock-stat-card">
                        <div class="mock-stat-num">₹18,400</div>
                        <div class="mock-stat-lbl">This Month</div>
                    </div>
                </div>
                <div class="mock-chart-area">
                    <div class="mock-chart-title">Monthly Commission Trend</div>
                    <div class="mock-bars">
                        <div class="mock-bar" style="height:30%"></div>
                        <div class="mock-bar" style="height:48%"></div>
                        <div class="mock-bar" style="height:38%"></div>
                        <div class="mock-bar" style="height:62%"></div>
                        <div class="mock-bar hi" style="height:55%"></div>
                        <div class="mock-bar" style="height:78%"></div>
                        <div class="mock-bar" style="height:68%"></div>
                        <div class="mock-bar hi" style="height:88%"></div>
                        <div class="mock-bar" style="height:74%"></div>
                        <div class="mock-bar" style="height:82%"></div>
                        <div class="mock-bar hi" style="height:95%"></div>
                        <div class="mock-bar" style="height:90%"></div>
                    </div>
                </div>
                <div class="mock-table-area">
                    <div class="mock-table-head">
                        <div class="mock-th">Member</div>
                        <div class="mock-th">Level</div>
                        <div class="mock-th">Commission</div>
                        <div class="mock-th">Status</div>
                    </div>
                    <div class="mock-tr">
                        <div class="mock-td">Priya Sharma</div>
                        <div class="mock-td">L1</div>
                        <div class="mock-td">₹4,200</div>
                        <div class="mock-td"><span class="mock-badge">Active</span></div>
                    </div>
                    <div class="mock-tr">
                        <div class="mock-td">Rahul Verma</div>
                        <div class="mock-td">L1</div>
                        <div class="mock-td">₹3,800</div>
                        <div class="mock-td"><span class="mock-badge">Active</span></div>
                    </div>
                    <div class="mock-tr">
                        <div class="mock-td">Anita Nair</div>
                        <div class="mock-td">L2</div>
                        <div class="mock-td">₹1,950</div>
                        <div class="mock-td"><span class="mock-badge">Active</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══ PRICING ═══ -->
<section class="plans-section" id="pricing">
    <div class="plans-inner">
        <div class="plans-header reveal">
            <div class="eyebrow eyebrow-center">Simple Pricing</div>
            <h2 class="section-title" style="text-align:center;">Choose your <em>plan</em></h2>
            <p style="font-size:0.88rem;color:var(--textMuted);margin-top:0.6rem;">No hidden fees. Cancel anytime.</p>
        </div>
        <div class="plans-grid">
            <div class="plan-card reveal">
                <div class="plan-name">Starter</div>
                <div class="plan-price">₹999 <span>/ month</span></div>
                <p class="plan-desc">For new network builders getting started with their first downline.</p>
                <div class="plan-divider"></div>
                <ul class="plan-features">
                    <li class="plan-feature"><span class="plan-check">✓</span> Up to 500 members</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> Binary & Unilevel plans</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> Basic commission engine</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> Email support</li>
                </ul>
                <a href="#" class="btn-plan btn-plan-outline">Get Started</a>
            </div>
            <div class="plan-card featured reveal" style="transition-delay:0.1s">
                <div class="plan-featured-badge">Most Popular</div>
                <div class="plan-name">Professional</div>
                <div class="plan-price">₹2,999 <span>/ month</span></div>
                <p class="plan-desc">For growing networks that need advanced tools and full automation.</p>
                <div class="plan-divider"></div>
                <ul class="plan-features">
                    <li class="plan-feature"><span class="plan-check">✓</span> Unlimited members</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> All plan types incl. Board & Matrix</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> Automated payouts</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> Advanced analytics</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> Priority support</li>
                </ul>
                <a href="{{ Route::has('register') ? route('register') : '#' }}" class="btn-plan btn-plan-solid">{{ $t['ctaPrimary'] }}</a>
            </div>
            <div class="plan-card reveal" style="transition-delay:0.2s">
                <div class="plan-name">Enterprise</div>
                <div class="plan-price">Custom</div>
                <p class="plan-desc">For large MLM organisations with custom compliance and integration needs.</p>
                <div class="plan-divider"></div>
                <ul class="plan-features">
                    <li class="plan-feature"><span class="plan-check">✓</span> Everything in Pro</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> White-label branding</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> Custom integrations</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> Dedicated account manager</li>
                    <li class="plan-feature"><span class="plan-check">✓</span> SLA & compliance reports</li>
                </ul>
                <a href="#" class="btn-plan btn-plan-outline">Contact Sales</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══ CTA BANNER ═══ -->
<section class="cta-banner">
    <div class="cta-inner reveal">
        <div class="cta-glow"></div>
        <h2 class="cta-title">Ready to <em>build</em> your<br>empire?</h2>
        <p class="cta-sub">Join thousands of network leaders who trust MLMPro to power their downlines. Start free, scale without limits.</p>
        <div class="cta-btns">
            <a href="{{ Route::has('register') ? route('register') : '#' }}" class="btn-primary">
                <svg viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" stroke-linejoin="round"/></svg>
                {{ $t['ctaPrimary'] }}
            </a>
            <a href="{{ Route::has('login') ? route('login') : '#' }}" class="btn-ghost">
                <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Log in
            </a>
        </div>
    </div>
</section>

<!-- ═══ FOOTER ═══ -->
<footer class="footer">
    <div class="footer-logo">MLM<span>Pro</span></div>
    <div class="footer-links">
        <a href="#features">Features</a>
        <a href="#pricing">Pricing</a>
        <a href="#">Documentation</a>
        <a href="{{ url('/theme-settings') }}">Change Theme</a>
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
    </div>
    <div class="footer-text">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</div>
</footer>

<script>
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>