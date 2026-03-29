{{-- Landing Page --}}
@extends('layouts.website')

@section('title', 'Best MLM Software Development Company in India | Binary, Matrix, Unilevel MLM Software | ' . config('app.name', 'MICRO MLM'))

@section('meta_description', 'Leading MLM software development company in India providing Binary, Matrix, Unilevel, Board, Investment and custom MLM software solutions. Based in Guwahati, Assam serving clients across India.')

@section('meta_keywords', 'MLM software development company, MLM software India, MLM software Guwahati, MLM software Assam, Binary MLM software, Matrix MLM software, Unilevel MLM software, Network marketing software, custom MLM software development')

@section('og_title', 'Best MLM Software Development Company in India')

@section('og_description', 'Advanced MLM software solutions for Binary, Matrix, Unilevel and custom network marketing plans across India.')

{{-- Schema markup --}}
@php
    $softwareSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'MLM Software',
        'operatingSystem' => 'Web-Based',
        'applicationCategory' => 'BusinessApplication',
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'reviewCount' => '124',
        ],
        'offers' => [
            '@type' => 'Offer',
            'price' => '0.00',
            'priceCurrency' => 'INR',
        ],
    ];

    $companySchema = [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareCompany',
        'name' => config('app.name', 'MICRO MLM'),
        'url' => url('/'),
        'logo' => asset('images/logo.png'),
        'description' => 'Professional MLM software development company providing Binary, Matrix, Unilevel and custom network marketing software solutions.',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Guwahati',
            'addressRegion' => 'Assam',
            'addressCountry' => 'India',
        ],
        'areaServed' => 'India',
        'sameAs' => [url('/')],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($softwareSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode($companySchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

{{-- Landing-specific styles with extended theme data --}}
@push('styles')
@php
    $theme = session('mlm_theme') ?? (request()->cookie('mlm_theme') ?? 'obsidian');

    $themes = [
        'obsidian' => [
            'bg' => '#0A0A0F', 'bg2' => '#111118', 'bg3' => '#18181f',
            'accent' => '#8b5cf6', 'accent2' => '#6d28d9', 'accentLight' => '#c4b5fd',
            'accentDim' => 'rgba(139,92,246,0.12)', 'accentGlow' => 'rgba(139,92,246,0.25)',
            'border' => 'rgba(139,92,246,0.18)', 'borderSoft' => 'rgba(255,255,255,0.06)',
            'text' => '#F0EDE6', 'textMuted' => 'rgba(240,237,230,0.5)', 'textFaint' => 'rgba(240,237,230,0.25)',
            'heroFont' => "'Syne', sans-serif", 'bodyFont' => "'DM Sans', sans-serif", 'heroWeight' => '700',
            'navStyle' => 'dark', 'bgPattern' => 'grid',
            'patternColor' => 'rgba(139,92,246,0.06)', 'glowColor' => 'rgba(139,92,246,0.12)', 'glow2Color' => 'rgba(109,40,217,0.10)',
            'tagline' => 'Call - 9101177123',
            'headline' => 'Accelerate Your<br><em>Growth</em> & Earnings',
            'sub' => 'Your personal command center. Monitor real-time commissions, visualize your growing downline, and unlock your next rank with precision.',
            'feat1t' => 'My Team Viewer', 'feat1d' => 'Visualize your personal downline and track your team\'s performance in real-time.', 'feat1i' => 'tree',
            'feat2t' => 'Earnings Wallet', 'feat2d' => 'Watch your commissions land instantly and withdraw your funds with ease.', 'feat2i' => 'zap',
            'feat3t' => 'Performance Stats', 'feat3d' => 'Track your Personal Volume (PV) and Team Volume (TV) to optimize your daily strategy.', 'feat3i' => 'bar',
            'feat4t' => 'Rank Roadmap', 'feat4d' => 'See exactly what volume and recruit metrics you need to hit your next tier.', 'feat4i' => 'lock',
            'ctaPrimary' => 'Go to Dashboard', 'ctaSecondary' => 'Watch Tutorial',
        ],
        'arctic' => [
            'bg' => '#F4F6FB', 'bg2' => '#FFFFFF', 'bg3' => '#EDF0F7',
            'accent' => '#1A1A2E', 'accent2' => '#2d2d4e', 'accentLight' => '#4a4a7a',
            'accentDim' => 'rgba(26,26,46,0.06)', 'accentGlow' => 'rgba(26,26,46,0.12)',
            'border' => '#DDE1EE', 'borderSoft' => '#EEF0F8',
            'text' => '#1A1A2E', 'textMuted' => '#64748b', 'textFaint' => '#94a3b8',
            'heroFont' => "'Cormorant Garamond', serif", 'bodyFont' => "'DM Sans', sans-serif", 'heroWeight' => '600',
            'navStyle' => 'light', 'bgPattern' => 'dots',
            'patternColor' => 'rgba(26,26,46,0.08)', 'glowColor' => 'rgba(26,26,46,0.0)', 'glow2Color' => 'rgba(26,26,46,0.04)',
            'tagline' => 'Your Business Portal',
            'headline' => 'The Clear Path to<br><em>Your Success</em>',
            'sub' => 'Distilled to the essentials. See your earnings, manage your team, and track your rank progression without the clutter.',
            'feat1t' => 'My Downline', 'feat1d' => 'Crisp, zoomable network trees that make tracking your recruits effortless.', 'feat1i' => 'tree',
            'feat2t' => 'Income Tracker', 'feat2d' => 'Know exactly where your money comes from with transparent payout breakdowns.', 'feat2i' => 'zap',
            'feat3t' => 'Clean Dashboard', 'feat3d' => 'Uncluttered analytics that surface only the goals and numbers that matter to you.', 'feat3i' => 'bar',
            'feat4t' => 'Marketing Assets', 'feat4d' => 'Access approved marketing materials and referral links to grow your network.', 'feat4i' => 'lock',
            'ctaPrimary' => 'Access Dashboard', 'ctaSecondary' => 'View Resources',
        ],
        'ember' => [
            'bg' => '#0F0A0A', 'bg2' => '#160D0D', 'bg3' => '#1E1212',
            'accent' => '#ef4444', 'accent2' => '#b91c1c', 'accentLight' => '#fca5a5',
            'accentDim' => 'rgba(239,68,68,0.12)', 'accentGlow' => 'rgba(239,68,68,0.28)',
            'border' => 'rgba(239,68,68,0.18)', 'borderSoft' => 'rgba(255,255,255,0.05)',
            'text' => '#FFF1F1', 'textMuted' => 'rgba(255,241,241,0.5)', 'textFaint' => 'rgba(255,241,241,0.22)',
            'heroFont' => "'Unbounded', sans-serif", 'bodyFont' => "'DM Sans', sans-serif", 'heroWeight' => '700',
            'navStyle' => 'dark', 'bgPattern' => 'diagonal',
            'patternColor' => 'rgba(239,68,68,0.04)', 'glowColor' => 'rgba(239,68,68,0.10)', 'glow2Color' => 'rgba(185,28,28,0.10)',
            'tagline' => 'Fuel Your Growth',
            'headline' => 'Hustle.<br><em>Earn.</em> Repeat.',
            'sub' => 'Built for top producers. Get the data you need to motivate your team, close more sales, and maximize your payouts.',
            'feat1t' => 'Explosive Growth Tools', 'feat1d' => 'Track your referral links and monitor new sign-ups the second they join.', 'feat1i' => 'tree',
            'feat2t' => 'Real-Time Payouts', 'feat2d' => "Don't wait to see your success. Watch your balance update the moment a sale closes.", 'feat2i' => 'zap',
            'feat3t' => 'Leaderboards', 'feat3d' => 'See where you rank against the top earners and push yourself to the next level.', 'feat3i' => 'bar',
            'feat4t' => 'Rank Accelerator', 'feat4d' => 'Clear, gamified goals that push you to hit your next bonus milestone fast.', 'feat4i' => 'lock',
            'ctaPrimary' => 'Enter Portal', 'ctaSecondary' => 'View Leaderboard',
        ],
        'forest' => [
            'bg' => '#071009', 'bg2' => '#0C160F', 'bg3' => '#111F14',
            'accent' => '#22c55e', 'accent2' => '#15803d', 'accentLight' => '#86efac',
            'accentDim' => 'rgba(34,197,94,0.10)', 'accentGlow' => 'rgba(34,197,94,0.20)',
            'border' => 'rgba(34,197,94,0.16)', 'borderSoft' => 'rgba(255,255,255,0.05)',
            'text' => '#F0FDF4', 'textMuted' => 'rgba(240,253,244,0.5)', 'textFaint' => 'rgba(240,253,244,0.22)',
            'heroFont' => "'Instrument Serif', serif", 'bodyFont' => "'DM Sans', sans-serif", 'heroWeight' => '400',
            'navStyle' => 'dark', 'bgPattern' => 'organic',
            'patternColor' => 'rgba(34,197,94,0.05)', 'glowColor' => 'rgba(34,197,94,0.08)', 'glow2Color' => 'rgba(21,128,61,0.08)',
            'tagline' => 'Grow Organically',
            'headline' => 'Cultivate Your<br><em>Personal</em> Network',
            'sub' => 'Like a forest, your strongest income grows from deep roots. Access the tools to nurture your team and build a sustainable business.',
            'feat1t' => 'Downline Cultivation', 'feat1d' => 'Visualize your personal network like a living tree — watch it branch out and grow.', 'feat1i' => 'tree',
            'feat2t' => 'Earnings Tracker', 'feat2d' => 'Transparent tracking of your residual income and direct bonuses.', 'feat2i' => 'zap',
            'feat3t' => 'Team Health', 'feat3d' => 'Monitor the activity of your downline so you know who to mentor and support.', 'feat3i' => 'bar',
            'feat4t' => 'Community Hub', 'feat4d' => 'Connect with your upline and collaborate with your team in one central space.', 'feat4i' => 'lock',
            'ctaPrimary' => 'View My Network', 'ctaSecondary' => 'Learning Center',
        ],
        'sapphire' => [
            'bg' => '#070B14', 'bg2' => '#0B1020', 'bg3' => '#101828',
            'accent' => '#3b82f6', 'accent2' => '#1d4ed8', 'accentLight' => '#93c5fd',
            'accentDim' => 'rgba(59,130,246,0.10)', 'accentGlow' => 'rgba(59,130,246,0.22)',
            'border' => 'rgba(59,130,246,0.18)', 'borderSoft' => 'rgba(255,255,255,0.05)',
            'text' => '#EFF6FF', 'textMuted' => 'rgba(239,246,255,0.5)', 'textFaint' => 'rgba(239,246,255,0.22)',
            'heroFont' => "'Syne', sans-serif", 'bodyFont' => "'DM Sans', sans-serif", 'heroWeight' => '600',
            'navStyle' => 'dark', 'bgPattern' => 'circuit',
            'patternColor' => 'rgba(59,130,246,0.05)', 'glowColor' => 'rgba(59,130,246,0.10)', 'glow2Color' => 'rgba(29,78,216,0.0)',
            'tagline' => 'Professional Growth',
            'headline' => 'Your Professional<br><em>Business</em> Portal',
            'sub' => 'Designed for serious networkers. Track your performance, manage your team, and forecast your earnings with enterprise-grade precision.',
            'feat1t' => 'Network Genealogy', 'feat1d' => 'Detailed, multi-level views of your organization with comprehensive search and filtering.', 'feat1i' => 'tree',
            'feat2t' => 'Financial Dashboard', 'feat2d' => 'Securely track your payout history, tax documents, and direct deposit status.', 'feat2i' => 'zap',
            'feat3t' => 'Volume Analytics', 'feat3d' => 'Track your legs, balance your binaries, and ensure you maximize your compensation plan.', 'feat3i' => 'bar',
            'feat4t' => 'Secure Access', 'feat4d' => 'Bank-level security protecting your personal data, earnings, and contact lists.', 'feat4i' => 'lock',
            'ctaPrimary' => 'Login to Portal', 'ctaSecondary' => 'Support Center',
        ],
        'luxe' => [
            'bg' => '#0A0800', 'bg2' => '#120F02', 'bg3' => '#1C1900',
            'accent' => '#C9A84C', 'accent2' => '#92720A', 'accentLight' => '#E8C97A',
            'accentDim' => 'rgba(201,168,76,0.10)', 'accentGlow' => 'rgba(201,168,76,0.20)',
            'border' => 'rgba(201,168,76,0.20)', 'borderSoft' => 'rgba(255,255,255,0.05)',
            'text' => '#FDF6E3', 'textMuted' => 'rgba(253,246,227,0.5)', 'textFaint' => 'rgba(253,246,227,0.22)',
            'heroFont' => "'Cormorant Garamond', serif", 'bodyFont' => "'DM Sans', sans-serif", 'heroWeight' => '500',
            'navStyle' => 'dark', 'bgPattern' => 'grid',
            'patternColor' => 'rgba(201,168,76,0.05)', 'glowColor' => 'rgba(201,168,76,0.10)', 'glow2Color' => 'rgba(146,114,10,0.10)',
            'tagline' => 'The Premier Experience',
            'headline' => 'Where Your Effort<br><em>Meets</em> Reward',
            'sub' => 'Crafted for the discerning leader. Experience white-glove support, sophisticated commission tracking, and a platform that reflects your achievements.',
            'feat1t' => 'Prestige Network View', 'feat1d' => 'Beautifully rendered genealogy maps that showcase the caliber of your growing team.', 'feat1i' => 'tree',
            'feat2t' => 'Elite Earnings Tracker', 'feat2d' => 'Monitor your luxury bonuses, lifestyle rewards, and high-tier commissions in real-time.', 'feat2i' => 'zap',
            'feat3t' => 'Executive Insights', 'feat3d' => 'Concierge-level reporting that highlights your top performers and next rank milestones.', 'feat3i' => 'bar',
            'feat4t' => 'VIP Resources', 'feat4d' => 'Exclusive access to premium training, high-converting assets, and private event invites.', 'feat4i' => 'lock',
            'ctaPrimary' => 'Access Dashboard', 'ctaSecondary' => 'View Rewards',
        ],
    ];

    $t = $themes[$theme] ?? $themes['obsidian'];
    $isLight = $t['navStyle'] === 'light';
@endphp
<style>
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
        padding: 8rem 1rem 5rem;
    }

    .hero h1 {
        font-family: var(--heroFont);
        font-size: clamp(2.2rem, 8vw, 5.5rem);
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
        font-size: clamp(0.9rem, 2.5vw, 1.05rem);
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
        width: 100%;
        max-width: 800px;
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

    @media (max-width: 600px) {
        .hero-stats { flex-direction: column; }
        .stat-item { border-right: none; border-bottom: 1px solid var(--border); padding: 1rem; }
        .stat-item:last-child { border-bottom: none; }
    }

    .stat-num {
        font-family: var(--heroFont);
        font-size: clamp(1.4rem, 5vw, 1.8rem);
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

    /* Features */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }

    @media (max-width: 768px) {
        .features-grid { grid-template-columns: 1fr; }
    }

    .feat-card {
        background: var(--bg2);
        border: 1px solid var(--borderSoft);
        border-radius: 12px;
        padding: 1.75rem;
        transition: border-color 0.25s, transform 0.25s;
    }

    /* ── DASHBOARD PREVIEW ── */
    .preview-section {
        padding: 2rem 1rem 6rem;
        overflow: hidden;
    }

    .preview-wrap {
        max-width: 1100px;
        margin: 0 auto;
        border: 1px solid var(--border);
        border-radius: 16px;
        background: var(--bg);
        box-shadow: 0 32px 80px rgba(0, 0, 0, 0.4);
    }

    .mock-dashboard {
        display: flex;
        min-height: 420px;
    }

    .mock-sidebar {
        width: 190px;
        flex-shrink: 0;
        background: var(--bg2);
        border-right: 1px solid var(--borderSoft);
        padding: 1.25rem 0;
    }

    @media (max-width: 850px) {
        .mock-dashboard { flex-direction: column; }
        .mock-sidebar { width: 100%; display: flex; overflow-x: auto; padding: 0.5rem; border-right: none; border-bottom: 1px solid var(--borderSoft); }
        .mock-nav-item { flex-shrink: 0; white-space: nowrap; }
        .mock-logo-bar { display: none; }
        .mock-toprow { flex-direction: column; }
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

    .mock-table-area {
        overflow-x: auto;
    }

    .mock-table-head,
    .mock-tr {
        min-width: 500px;
    }
</style>
@endpush

@section('content')

    {{-- Hero --}}
    <header class="hero">
        <div class="hero-eyebrow"
            style="display:inline-flex; align-items:center; gap:0.6rem; padding:0.35rem 1rem; background:var(--accentDim); border:1px solid var(--border); border-radius:100px; font-size:0.72rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--accentLight); margin-bottom:2rem;">
            <div style="width:6px; height:6px; border-radius:50%; background:var(--accent);"></div>
            {{ $t['tagline'] }}
        </div>

        <h1>{!! $t['headline'] !!}</h1>
        <p class="hero-sub">{{ $t['sub'] }}</p>

        <div class="hero-cta">
            <a href="{{ route('register') }}" class="btn-primary">
                {{ $t['ctaPrimary'] }}
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:5px;">
                    <path d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
            <a href="{{ route('login') }}" class="btn-ghost">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 3l14 9-14 9V3z" />
                </svg>
                Try Demo
            </a>
        </div>

        <div class="hero-stats reveal">
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
    </header>

    {{-- Features --}}
    <section class="section" id="features">
        <h2 class="section-title">Everything You Need to <em>Succeed</em></h2>
        <div class="features-grid">
            <div class="feat-card reveal">
                <h3 style="font-size:1.1rem; color:var(--text); margin-bottom:0.6rem;">{{ $t['feat1t'] }}</h3>
                <p style="font-size:0.875rem; color:var(--textMuted);">{{ $t['feat1d'] }}</p>
            </div>
            <div class="feat-card reveal">
                <h3 style="font-size:1.1rem; color:var(--text); margin-bottom:0.6rem;">{{ $t['feat2t'] }}</h3>
                <p style="font-size:0.875rem; color:var(--textMuted);">{{ $t['feat2d'] }}</p>
            </div>
            <div class="feat-card reveal">
                <h3 style="font-size:1.1rem; color:var(--text); margin-bottom:0.6rem;">{{ $t['feat3t'] }}</h3>
                <p style="font-size:0.875rem; color:var(--textMuted);">{{ $t['feat3d'] }}</p>
            </div>
            <div class="feat-card reveal">
                <h3 style="font-size:1.1rem; color:var(--text); margin-bottom:0.6rem;">{{ $t['feat4t'] }}</h3>
                <p style="font-size:0.875rem; color:var(--textMuted);">{{ $t['feat4d'] }}</p>
            </div>
        </div>
    </section>

    {{-- Dashboard Preview --}}
    <section class="preview-section" id="preview">
        <div class="preview-wrap reveal">
            <div class="mock-dashboard">
                <div class="mock-sidebar">
                    <div class="mock-logo-bar" style="padding:0 1.25rem 1rem; color:var(--accent);">MLM Pro.</div>
                    <div class="mock-nav-item" style="padding:0.5rem 1.25rem; font-size:0.7rem; color:var(--accentLight);">Dashboard</div>
                    <div class="mock-nav-item" style="padding:0.5rem 1.25rem; font-size:0.7rem; color:var(--textFaint);">My Network</div>
                    <div class="mock-nav-item" style="padding:0.5rem 1.25rem; font-size:0.7rem; color:var(--textFaint);">Earnings</div>
                    <div class="mock-nav-item" style="padding:0.5rem 1.25rem; font-size:0.7rem; color:var(--textFaint);">Marketing</div>
                </div>

                <div class="mock-content">
                    <div class="mock-toprow">
                        <div class="mock-stat-card">
                            <div style="font-size:1.1rem; color:var(--accentLight);">$4,250.00</div>
                            <div style="font-size:0.6rem; color:var(--textFaint);">Total Earnings</div>
                        </div>
                        <div class="mock-stat-card">
                            <div style="font-size:1.1rem; color:var(--accentLight);">3,200 TV</div>
                            <div style="font-size:0.6rem; color:var(--textFaint);">Team Volume</div>
                        </div>
                    </div>

                    <div class="mock-table-area">
                        <div class="mock-table-head" style="display:flex; border-bottom:1px solid var(--borderSoft); padding-bottom:5px;">
                            <div style="flex:1; font-size:0.6rem; color:var(--textFaint);">Member</div>
                            <div style="flex:1; font-size:0.6rem; color:var(--textFaint);">Level</div>
                            <div style="flex:1; font-size:0.6rem; color:var(--textFaint);">Commission</div>
                        </div>
                        <div class="mock-tr" style="display:flex; padding:8px 0; border-bottom:1px solid var(--borderSoft);">
                            <div style="flex:1; font-size:0.7rem;">Sarah J.</div>
                            <div style="flex:1; font-size:0.7rem;">Level 1</div>
                            <div style="flex:1; font-size:0.7rem; color:var(--accentLight);">+$120.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SEO Text Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Our MLM Software Solutions</h2>
        <p style="color:var(--textMuted); max-width:900px; margin:auto; text-align:center;">
            We provide Binary MLM Software, Matrix MLM Software, Unilevel MLM Software,
            Board MLM Software, Custom MLM Software Development and Network Marketing Software
            services across Guwahati, Assam and India.
        </p>
    </section>

@endsection
