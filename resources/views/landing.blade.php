<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MLM Pro') }} — Member Portal</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700,700i&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=dm-sans:300,400,500&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=syne:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=unbounded:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=instrument-serif:400,400i&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
                'tagline' => 'Track Your Success',
                'headline' => 'Accelerate Your<br><em>Growth</em> & Earnings',
                'sub' =>
                    'Your personal command center. Monitor real-time commissions, visualize your growing downline, and unlock your next rank with precision.',
                'feat1t' => 'My Team Viewer',
                'feat1d' => 'Visualize your personal downline and track your team\'s performance in real-time.',
                'feat1i' => 'tree',
                'feat2t' => 'Earnings Wallet',
                'feat2d' => 'Watch your commissions land instantly and withdraw your funds with ease.',
                'feat2i' => 'zap',
                'feat3t' => 'Performance Stats',
                'feat3d' => 'Track your Personal Volume (PV) and Team Volume (TV) to optimize your daily strategy.',
                'feat3i' => 'bar',
                'feat4t' => 'Rank Roadmap',
                'feat4d' => 'See exactly what volume and recruit metrics you need to hit your next tier.',
                'feat4i' => 'lock',
                'ctaPrimary' => 'Go to Dashboard',
                'ctaSecondary' => 'Watch Tutorial',
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
                'tagline' => 'Your Business Portal',
                'headline' => 'The Clear Path to<br><em>Your Success</em>',
                'sub' =>
                    'Distilled to the essentials. See your earnings, manage your team, and track your rank progression without the clutter.',
                'feat1t' => 'My Downline',
                'feat1d' => 'Crisp, zoomable network trees that make tracking your recruits effortless.',
                'feat1i' => 'tree',
                'feat2t' => 'Income Tracker',
                'feat2d' => 'Know exactly where your money comes from with transparent payout breakdowns.',
                'feat2i' => 'zap',
                'feat3t' => 'Clean Dashboard',
                'feat3d' => 'Uncluttered analytics that surface only the goals and numbers that matter to you.',
                'feat3i' => 'bar',
                'feat4t' => 'Marketing Assets',
                'feat4d' => 'Access approved marketing materials and referral links to grow your network.',
                'feat4i' => 'lock',
                'ctaPrimary' => 'Access Dashboard',
                'ctaSecondary' => 'View Resources',
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
                'tagline' => 'Fuel Your Growth',
                'headline' => 'Hustle.<br><em>Earn.</em> Repeat.',
                'sub' =>
                    'Built for top producers. Get the data you need to motivate your team, close more sales, and maximize your payouts.',
                'feat1t' => 'Explosive Growth Tools',
                'feat1d' => 'Track your referral links and monitor new sign-ups the second they join.',
                'feat1i' => 'tree',
                'feat2t' => 'Real-Time Payouts',
                'feat2d' => "Don't wait to see your success. Watch your balance update the moment a sale closes.",
                'feat2i' => 'zap',
                'feat3t' => 'Leaderboards',
                'feat3d' => 'See where you rank against the top earners and push yourself to the next level.',
                'feat3i' => 'bar',
                'feat4t' => 'Rank Accelerator',
                'feat4d' => 'Clear, gamified goals that push you to hit your next bonus milestone fast.',
                'feat4i' => 'lock',
                'ctaPrimary' => 'Enter Portal',
                'ctaSecondary' => 'View Leaderboard',
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
                'tagline' => 'Grow Organically',
                'headline' => 'Cultivate Your<br><em>Personal</em> Network',
                'sub' =>
                    'Like a forest, your strongest income grows from deep roots. Access the tools to nurture your team and build a sustainable business.',
                'feat1t' => 'Downline Cultivation',
                'feat1d' => 'Visualize your personal network like a living tree — watch it branch out and grow.',
                'feat1i' => 'tree',
                'feat2t' => 'Earnings Tracker',
                'feat2d' => 'Transparent tracking of your residual income and direct bonuses.',
                'feat2i' => 'zap',
                'feat3t' => 'Team Health',
                'feat3d' => 'Monitor the activity of your downline so you know who to mentor and support.',
                'feat3i' => 'bar',
                'feat4t' => 'Community Hub',
                'feat4d' => 'Connect with your upline and collaborate with your team in one central space.',
                'feat4i' => 'lock',
                'ctaPrimary' => 'View My Network',
                'ctaSecondary' => 'Learning Center',
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
                'tagline' => 'Professional Growth',
                'headline' => 'Your Professional<br><em>Business</em> Portal',
                'sub' =>
                    'Designed for serious networkers. Track your performance, manage your team, and forecast your earnings with enterprise-grade precision.',
                'feat1t' => 'Network Genealogy',
                'feat1d' => 'Detailed, multi-level views of your organization with comprehensive search and filtering.',
                'feat1i' => 'tree',
                'feat2t' => 'Financial Dashboard',
                'feat2d' => 'Securely track your payout history, tax documents, and direct deposit status.',
                'feat2i' => 'zap',
                'feat3t' => 'Volume Analytics',
                'feat3d' => 'Track your legs, balance your binaries, and ensure you maximize your compensation plan.',
                'feat3i' => 'bar',
                'feat4t' => 'Secure Access',
                'feat4d' => 'Bank-level security protecting your personal data, earnings, and contact lists.',
                'feat4i' => 'lock',
                'ctaPrimary' => 'Login to Portal',
                'ctaSecondary' => 'Support Center',
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
                'tagline' => 'The Premier Experience',
                'headline' => 'Where Your Effort<br><em>Meets</em> Reward',
                'sub' =>
                    'Crafted for the discerning leader. Experience white-glove support, sophisticated commission tracking, and a platform that reflects your achievements.',
                'feat1t' => 'Prestige Network View',
                'feat1d' => 'Beautifully rendered genealogy maps that showcase the caliber of your growing team.',
                'feat1i' => 'tree',
                'feat2t' => 'Elite Earnings Tracker',
                'feat2d' => 'Monitor your luxury bonuses, lifestyle rewards, and high-tier commissions in real-time.',
                'feat2i' => 'zap',
                'feat3t' => 'Executive Insights',
                'feat3d' => 'Concierge-level reporting that highlights your top performers and next rank milestones.',
                'feat3i' => 'bar',
                'feat4t' => 'VIP Resources',
                'feat4d' => 'Exclusive access to premium training, high-converting assets, and private event invites.',
                'feat4i' => 'lock',
                'ctaPrimary' => 'Access Dashboard',
                'ctaSecondary' => 'View Rewards',
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

        /* ── HERO ── */
        .hero {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 8rem 2rem 5rem;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.35rem 1rem;
            background: var(--accentDim);
            border: 1px solid var(--border);
            border-radius: 100px;
            font-size: 0.72rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--accentLight);
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeUp 0.6s 0.1s ease forwards;
        }

        .eyebrow-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            animation: blink 2s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
                transform: scale(1)
            }

            50% {
                opacity: 0.4;
                transform: scale(0.75)
            }
        }

        .hero h1 {
            font-family: var(--heroFont);
            font-size: clamp(2.8rem, 6vw, 5.5rem);
            font-weight: var(--heroWeight);
            line-height: 1.08;
            letter-spacing: -0.02em;
            color: var(--text);
            max-width: 820px;
            margin-bottom: 1.5rem;
            opacity: 0;
            animation: fadeUp 0.7s 0.2s ease forwards;
        }

        .hero h1 em {
            font-style: italic;
            color: var(--accent);
        }

        .hero-sub {
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--textMuted);
            max-width: 560px;
            margin-bottom: 2.5rem;
            opacity: 0;
            animation: fadeUp 0.7s 0.35s ease forwards;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 4rem;
            opacity: 0;
            animation: fadeUp 0.7s 0.5s ease forwards;
        }

        /* Buttons */
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

        .btn-primary svg,
        .btn-primary svg * {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
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

        .btn-ghost svg,
        .btn-ghost svg * {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        /* Stats */
        .hero-stats {
            display: flex;
            align-items: stretch;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            background: var(--bg2);
            opacity: 0;
            animation: fadeUp 0.7s 0.65s ease forwards;
        }

        .stat-item {
            padding: 1.25rem 2.5rem;
            text-align: center;
            border-right: 1px solid var(--border);
            flex: 1;
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-num {
            font-family: var(--heroFont);
            font-size: 1.8rem;
            font-weight: var(--heroWeight);
            color: var(--accent);
            line-height: 1;
            margin-bottom: 0.35rem;
        }

        .stat-lbl {
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--textFaint);
        }

        /* Scroll hint */
        .scroll-hint {
            position: absolute;
            bottom: 2.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: var(--textFaint);
            font-size: 0.68rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            opacity: 0;
            animation: fadeUp 0.6s 1.1s ease forwards;
        }

        .scroll-line {
            width: 1px;
            height: 40px;
            background: linear-gradient(to bottom, var(--accent), transparent);
            animation: lineDown 2s ease infinite;
        }

        @keyframes lineDown {
            0% {
                transform: scaleY(0);
                transform-origin: top;
            }

            50% {
                transform: scaleY(1);
                transform-origin: top;
            }

            51% {
                transform: scaleY(1);
                transform-origin: bottom;
            }

            100% {
                transform: scaleY(0);
                transform-origin: bottom;
            }
        }

        /* ── SECTIONS ── */
        .section {
            position: relative;
            z-index: 1;
            padding: 6rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .eyebrow {
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accentLight);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .eyebrow::before {
            content: '';
            width: 24px;
            height: 1px;
            background: var(--accent);
        }

        .eyebrow-center {
            justify-content: center;
        }

        .eyebrow-center::before {
            display: none;
        }

        .section-title {
            font-family: var(--heroFont);
            font-size: clamp(2rem, 3.5vw, 3rem);
            font-weight: var(--heroWeight);
            line-height: 1.15;
            color: var(--text);
            margin-bottom: 0.75rem;
        }

        .section-title em {
            font-style: italic;
            color: var(--accent);
        }

        .section-desc {
            font-size: 0.95rem;
            color: var(--textMuted);
            max-width: 480px;
            line-height: 1.8;
            margin-bottom: 3rem;
        }

        /* Features grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }

        @media (max-width: 700px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        .feat-card {
            background: var(--bg2);
            border: 1px solid var(--borderSoft);
            border-radius: 12px;
            padding: 1.75rem;
            transition: border-color 0.25s, transform 0.25s;
            position: relative;
            overflow: hidden;
        }

        .feat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .feat-card:hover {
            border-color: var(--border);
            transform: translateY(-4px);
        }

        .feat-card:hover::before {
            opacity: 1;
        }

        .feat-icon {
            width: 40px;
            height: 40px;
            background: var(--accentDim);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.1rem;
        }

        .feat-icon svg {
            width: 18px;
            height: 18px;
            stroke: var(--accentLight);
            fill: none;
            stroke-width: 1.8;
        }

        .feat-title {
            font-family: var(--heroFont);
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 0.6rem;
        }

        .feat-desc {
            font-size: 0.875rem;
            color: var(--textMuted);
            line-height: 1.75;
        }

        /* ── DASHBOARD PREVIEW ── */
        .preview-section {
            position: relative;
            z-index: 1;
            padding: 2rem 2rem 6rem;
        }

        .preview-header {
            text-align: center;
            margin-bottom: 2.5rem;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }

        .preview-wrap {
            max-width: 1100px;
            margin: 0 auto;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.4);
        }

        .mock-chrome {
            background: var(--bg3);
            border-bottom: 1px solid var(--borderSoft);
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .mock-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .dot-r {
            background: #ef4444;
        }

        .dot-y {
            background: #fbbf24;
        }

        .dot-g {
            background: #22c55e;
        }

        .mock-url {
            flex: 1;
            margin: 0 1rem;
            background: var(--bg2);
            border: 1px solid var(--borderSoft);
            border-radius: 6px;
            padding: 0.3rem 1rem;
            font-size: 0.72rem;
            color: var(--textFaint);
            text-align: center;
        }

        .mock-dashboard {
            display: flex;
            background: var(--bg);
            min-height: 420px;
        }

        .mock-sidebar {
            width: 190px;
            flex-shrink: 0;
            background: var(--bg2);
            border-right: 1px solid var(--borderSoft);
            padding: 1.25rem 0;
        }

        .mock-logo-bar {
            padding: 0 1.25rem 1rem;
            font-family: var(--heroFont);
            font-size: 1rem;
            font-weight: 500;
            color: var(--accent);
            border-bottom: 1px solid var(--borderSoft);
            margin-bottom: 0.75rem;
        }

        .mock-nav-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.45rem 1.25rem;
            font-size: 0.72rem;
            color: var(--textFaint);
        }

        .mock-nav-item.active {
            color: var(--accentLight);
            background: var(--accentDim);
            border-left: 2px solid var(--accent);
        }

        .mock-dot-sm {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
        }

        .mock-content {
            flex: 1;
            padding: 1.25rem;
        }

        .mock-toprow {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .mock-stat-card {
            flex: 1;
            background: var(--bg2);
            border: 1px solid var(--borderSoft);
            border-radius: 8px;
            padding: 0.85rem 1rem;
        }

        .mock-stat-num {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--accentLight);
            margin-bottom: 0.2rem;
        }

        .mock-stat-lbl {
            font-size: 0.6rem;
            color: var(--textFaint);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .mock-chart-area {
            background: var(--bg2);
            border: 1px solid var(--borderSoft);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.85rem;
        }

        .mock-chart-title {
            font-size: 0.68rem;
            color: var(--textMuted);
            margin-bottom: 0.65rem;
        }

        .mock-bars {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            height: 72px;
        }

        .mock-bar {
            flex: 1;
            border-radius: 2px 2px 0 0;
            background: var(--accentDim);
            border: 1px solid var(--border);
        }

        .mock-bar.hi {
            background: var(--accent);
            border-color: var(--accent);
        }

        .mock-table-area {
            background: var(--bg2);
            border: 1px solid var(--borderSoft);
            border-radius: 8px;
            overflow: hidden;
        }

        .mock-table-head {
            display: flex;
            padding: 0.55rem 1rem;
            gap: 1rem;
            border-bottom: 1px solid var(--borderSoft);
        }

        .mock-th {
            font-size: 0.58rem;
            color: var(--textFaint);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            flex: 1;
        }

        .mock-tr {
            display: flex;
            padding: 0.55rem 1rem;
            gap: 1rem;
            border-bottom: 1px solid var(--borderSoft);
            font-size: 0.65rem;
            color: var(--text);
        }

        .mock-tr:last-child {
            border-bottom: none;
        }

        .mock-td {
            flex: 1;
        }

        .mock-td-accent {
            color: var(--accentLight);
            font-weight: 500;
        }

        /* ── CTA BANNER ── */
        .cta-banner {
            position: relative;
            z-index: 1;
            padding: 4rem 2rem 8rem;
            display: flex;
            justify-content: center;
        }

        .cta-inner {
            position: relative;
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 4rem 2rem;
            max-width: 800px;
            width: 100%;
            text-align: center;
            overflow: hidden;
        }

        .cta-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, var(--accentGlow) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .cta-title {
            position: relative;
            z-index: 1;
            font-family: var(--heroFont);
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: var(--heroWeight);
            color: var(--text);
            margin-bottom: 1rem;
            line-height: 1.1;
        }

        .cta-title em {
            font-style: italic;
            color: var(--accent);
        }

        .cta-sub {
            position: relative;
            z-index: 1;
            font-size: 1rem;
            color: var(--textMuted);
            max-width: 500px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        .cta-btns {
            position: relative;
            z-index: 1;
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* ── FOOTER ── */
        .footer {
            position: relative;
            z-index: 1;
            border-top: 1px solid var(--borderSoft);
            background: var(--bg2);
            padding: 4rem 2rem;
            text-align: center;
        }

        .footer-logo {
            font-family: var(--heroFont);
            font-size: 1.5rem;
            font-weight: var(--heroWeight);
            color: var(--accent);
            margin-bottom: 1.5rem;
            letter-spacing: 0.03em;
        }

        .footer-logo span {
            color: var(--text);
            font-weight: 300;
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
            font-size: 0.875rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--text);
        }

        .footer-text {
            font-size: 0.75rem;
            color: var(--textFaint);
        }

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

        /* Reveal Animation Styles */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.21, 0.6, 0.35, 1),
                transform 0.8s cubic-bezier(0.21, 0.6, 0.35, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>

    <div class="bg-layer"></div>
    <div class="bg-glow"></div>
    <div class="bg-glow-2"></div>

    <nav class="nav" id="nav">
        <a href="#" class="nav-logo">MLM Pro<span>.</span></a>
        <ul class="nav-links">
            <li><a href="#features">Features</a></li>
            <li><a href="#preview">Dashboard</a></li>
            <li><a href="#">Training</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ route('login') }}" class="btn-nav-ghost">Log in</a>
            <a href="{{ route('register') }}" class="btn-nav-primary">Join Now</a>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-eyebrow">
            <div class="eyebrow-dot"></div>
            {{ $t['tagline'] }}
        </div>

        <h1>{!! $t['headline'] !!}</h1>
        <p class="hero-sub">{{ $t['sub'] }}</p>

        <div class="hero-cta">
            <a href="{{ route('register') }}" class="btn-primary">
                {{ $t['ctaPrimary'] }}
                <svg viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
            <a href="#preview" class="btn-ghost">
                {{ $t['ctaSecondary'] }}
            </a>
        </div>

        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-num">$2.4M+</div>
                <div class="stat-lbl">Commissions Paid</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">10k+</div>
                <div class="stat-lbl">Active Members</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">24/7</div>
                <div class="stat-lbl">Live Tracking</div>
            </div>
        </div>

        <div class="scroll-hint">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </header>

    <section class="section" id="features">
        <div class="eyebrow">Tools for Growth</div>
        <h2 class="section-title">Everything You Need to <em>Succeed</em></h2>
        <p class="section-desc">Access an entire suite of tools designed to help you prospect better, monitor your
            volume, and maximize your compensation plan.</p>

        <div class="features-grid">
            <div class="feat-card">
                <div class="feat-icon">
                    <svg viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                    </svg>
                </div>
                <h3 class="feat-title">{{ $t['feat1t'] }}</h3>
                <p class="feat-desc">{{ $t['feat1d'] }}</p>
            </div>

            <div class="feat-card">
                <div class="feat-icon">
                    <svg viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                    </svg>
                </div>
                <h3 class="feat-title">{{ $t['feat2t'] }}</h3>
                <p class="feat-desc">{{ $t['feat2d'] }}</p>
            </div>

            <div class="feat-card">
                <div class="feat-icon">
                    <svg viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                </div>
                <h3 class="feat-title">{{ $t['feat3t'] }}</h3>
                <p class="feat-desc">{{ $t['feat3d'] }}</p>
            </div>

            <div class="feat-card">
                <div class="feat-icon">
                    <svg viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <h3 class="feat-title">{{ $t['feat4t'] }}</h3>
                <p class="feat-desc">{{ $t['feat4d'] }}</p>
            </div>
        </div>
    </section>

    <section class="preview-section" id="preview">
        <div class="preview-header">
            <div class="eyebrow eyebrow-center">Sneak Peek</div>
            <h2 class="section-title">Your <em>Performance</em> Dashboard</h2>
        </div>

        <div class="preview-wrap">
            <div class="mock-chrome">
                <div class="mock-dot dot-r"></div>
                <div class="mock-dot dot-y"></div>
                <div class="mock-dot dot-g"></div>
                <div class="mock-url">member.mlmpro.com/dashboard</div>
            </div>

            <div class="mock-dashboard">
                <div class="mock-sidebar">
                    <div class="mock-logo-bar">MLM Pro.</div>
                    <div class="mock-nav-item active">
                        <div class="mock-dot-sm"></div> Dashboard
                    </div>
                    <div class="mock-nav-item">
                        <div class="mock-dot-sm"></div> My Network
                    </div>
                    <div class="mock-nav-item">
                        <div class="mock-dot-sm"></div> Earnings
                    </div>
                    <div class="mock-nav-item">
                        <div class="mock-dot-sm"></div> Rank Progress
                    </div>
                    <div class="mock-nav-item">
                        <div class="mock-dot-sm"></div> Marketing
                    </div>
                </div>

                <div class="mock-content">
                    <div class="mock-toprow">
                        <div class="mock-stat-card">
                            <div class="mock-stat-num">$4,250.00</div>
                            <div class="mock-stat-lbl">Total Earnings</div>
                        </div>
                        <div class="mock-stat-card">
                            <div class="mock-stat-num">450 PV</div>
                            <div class="mock-stat-lbl">Personal Volume</div>
                        </div>
                        <div class="mock-stat-card">
                            <div class="mock-stat-num">3,200 TV</div>
                            <div class="mock-stat-lbl">Team Volume</div>
                        </div>
                    </div>

                    <div class="mock-chart-area">
                        <div class="mock-chart-title">Earnings History (Last 7 Days)</div>
                        <div class="mock-bars">
                            <div class="mock-bar" style="height: 30%"></div>
                            <div class="mock-bar" style="height: 50%"></div>
                            <div class="mock-bar hi" style="height: 80%"></div>
                            <div class="mock-bar" style="height: 40%"></div>
                            <div class="mock-bar" style="height: 60%"></div>
                            <div class="mock-bar hi" style="height: 90%"></div>
                            <div class="mock-bar" style="height: 70%"></div>
                        </div>
                    </div>

                    <div class="mock-table-area">
                        <div class="mock-table-head">
                            <div class="mock-th">Date</div>
                            <div class="mock-th">Downline Member</div>
                            <div class="mock-th">Level</div>
                            <div class="mock-th">Commission</div>
                        </div>
                        <div class="mock-tr">
                            <div class="mock-td">Today, 10:42 AM</div>
                            <div class="mock-td">Sarah Jenkins</div>
                            <div class="mock-td">Level 1</div>
                            <div class="mock-td mock-td-accent">+$120.00</div>
                        </div>
                        <div class="mock-tr">
                            <div class="mock-td">Yesterday, 4:15 PM</div>
                            <div class="mock-td">Mike Torres</div>
                            <div class="mock-td">Level 2</div>
                            <div class="mock-td mock-td-accent">+$45.50</div>
                        </div>
                        <div class="mock-tr">
                            <div class="mock-td">Oct 12, 2:00 PM</div>
                            <div class="mock-td">Elena R.</div>
                            <div class="mock-td">Level 1</div>
                            <div class="mock-td mock-td-accent">+$120.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ CTA BANNER ═══ -->
    <section class="cta-banner">
        <div class="cta-inner reveal">
            <div class="cta-glow"></div>
            <!-- Updated Title: Focus on Momentum and Management -->
            <h2 class="cta-title">Fuel your <em>momentum</em> today</h2>

            <!-- Updated Subtext: Focus on the Dashboard and Team Support -->
            <p class="cta-sub">Your downline is waiting. Check your latest commissions, support your top performers,
                and hit your next rank milestone.</p>

            <div class="cta-btns">
                <!-- Updated Primary: Goes straight to the workspace -->
                <a href="{{ Route::has('dashboard') ? route('dashboard') : '#' }}" class="btn-primary">
                    <svg viewBox="0 0 24 24">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" stroke-linejoin="round" />
                    </svg>
                    Open My Dashboard
                </a>

                <!-- Updated Secondary: Focus on Support/Resources -->
                <a href="#resources" class="btn-ghost">
                    <svg viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    View Resources
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
            {{-- <a href="#">Documentation</a> --}}
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
        </div>
        <div class="footer-text">© {{ date('Y') }} {{ config('app.name', 'MLMPro') }}. All rights reserved.</div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('nav');
            if (window.scrollY > 20) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    </script>
    <script>
        // 1. Navbar Scroll Effect
        const nav = document.getElementById('nav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // 2. Scroll Reveal Intersection Observer
        const revealCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    // Optional: Stop observing once revealed (uncomment the line below)
                    // observer.unobserve(entry.target); 
                }
            });
        };

        const revealObserver = new IntersectionObserver(revealCallback, {
            root: null, // use the viewport
            threshold: 0.15 // trigger when 15% of the element is visible
        });

        // Apply the observer to all elements with the 'reveal' class
        document.querySelectorAll('.reveal').forEach(el => {
            revealObserver.observe(el);
        });
    </script>
</body>

</html>
