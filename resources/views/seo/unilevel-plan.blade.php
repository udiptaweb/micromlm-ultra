{{-- Unilevel Plan Page for sitemap.xml --}}
@extends('layouts.website')

@section('title', 'Unilevel MLM Plan - Unlimited Width & Simple Commission Structure')

@section('meta_description', 'Explore the benefits of our Unilevel MLM Plan, offering unlimited width and straightforward commission structures to grow your network marketing business effectively.')

@section('meta_keywords', 'Unilevel MLM plan, Unilevel compensation plan, Unilevel network marketing, MLM unilevel structure, unlimited width MLM plan')

@section('og_title', 'Unilevel MLM Plan - Unlimited Width for Network Marketing Growth')

@section('og_description', 'Learn about our Unilevel MLM Plan featuring unlimited width, simple commissions, and flexible team building for network marketing success.')

{{-- Schema markup for Unilevel Plan --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Unilevel MLM Plan',
        'description' => 'Unilevel MLM compensation plan with unlimited width and straightforward level-based commission structure for network marketing',
        'provider' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'areaServed' => 'India',
        'serviceType' => 'MLM Software Solution',
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

{{-- Custom styles for Unilevel Plan page --}}
@push('styles')
<style>
    .hero {
        position: relative;
        z-index: 1;
        min-height: 60vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 8rem 1rem 5rem;
    }

    .hero h1 {
        font-family: var(--heroFont);
        font-size: clamp(2.2rem, 8vw, 4.5rem);
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
        max-width: 600px;
        margin-bottom: 2.5rem;
        opacity: 0;
        animation: fadeUp 0.7s 0.35s ease forwards;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .feat-card {
        background: var(--bg2);
        border: 1px solid var(--borderSoft);
        border-radius: 12px;
        padding: 2rem;
        transition: border-color 0.25s, transform 0.25s, box-shadow 0.25s;
    }

    .feat-card:hover {
        border-color: var(--border);
        transform: translateY(-4px);
        box-shadow: 0 8px 24px var(--accentGlow);
    }

    .feat-card h3 {
        font-size: 1.25rem;
        color: var(--text);
        margin-bottom: 0.75rem;
        font-weight: 500;
        font-family: var(--heroFont);
    }

    .feat-card p {
        font-size: 0.9rem;
        color: var(--textMuted);
        line-height: 1.7;
        margin: 0;
    }

    .cta-section {
        background: var(--bg2);
        border: 1px solid var(--borderSoft);
        border-radius: 16px;
        padding: 4rem 2rem;
        text-align: center;
        margin: 4rem auto;
        max-width: 800px;
    }

    .cta-section h2 {
        font-family: var(--heroFont);
        font-size: clamp(1.8rem, 5vw, 2.5rem);
        font-weight: var(--heroWeight);
        color: var(--text);
        margin-bottom: 1.5rem;
    }

    .cta-section p {
        color: var(--textMuted);
        font-size: 1rem;
        margin-bottom: 2rem;
    }

    .benefit-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        background: var(--accentDim);
        border: 1px solid var(--border);
        border-radius: 100px;
        font-size: 0.75rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--accentLight);
        margin-bottom: 2rem;
    }

    .benefit-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--accent);
    }
</style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <header class="hero">
        <div class="benefit-badge">
            Call - 9101177123
        </div>
        <h1>Unilevel MLM <em>Plan</em></h1>
        <p class="hero-sub">
            Grow your network without limits — our Unilevel MLM Plan offers unlimited width, simple commissions, and flexible team building for maximum network marketing potential.
        </p>
    </header>

    {{-- Why Choose Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Why Choose the <em>Unilevel MLM Plan?</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            The Unilevel MLM Plan offers a simple yet powerful approach to network building with clear benefits for rapid and scalable growth.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>Unlimited Width</h3>
                <p>
                    The Unilevel MLM Plan allows members to recruit an unlimited number of direct referrals, providing maximum flexibility and growth potential for your network.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Straightforward Commissions</h3>
                <p>
                    With a simple level-based commission structure, members can easily understand and maximize their earnings without complex calculations or confusing rules.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Enhanced Team Building</h3>
                <p>
                    The Unilevel structure encourages members to focus on building strong frontline teams, fostering collaboration and support among downlines for collective success.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Flexibility in Growth</h3>
                <p>
                    Members can expand their networks without restrictions on width, allowing for diverse recruitment strategies and rapid business expansion at any stage.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Easy to Understand</h3>
                <p>
                    The straightforward structure makes it ideal for new members, lowering the learning curve and enabling faster onboarding and quicker path to first earnings.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Transparent Payouts</h3>
                <p>
                    Every member earns based on clearly defined level commissions, making income tracking transparent and building trust throughout the entire downline network.
                </p>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">How the Unilevel Plan <em>Works</em></h2>
        <p style="color:var(--textMuted); max-width:800px; margin:auto; text-align:center; margin-bottom:3rem;">
            Understanding the mechanics behind the Unilevel MLM Plan helps you leverage its full potential for building a wide and profitable network marketing business.
        </p>

        <div style="max-width:900px; margin:auto;">
            <div class="feat-card reveal" style="margin-bottom:1.5rem;">
                <h3>Single-Level Sponsorship</h3>
                <p>
                    Each member sponsors recruits directly onto their frontline with no width limit. Every person you personally recruit becomes a Level 1 member in your Unilevel tree.
                </p>
            </div>

            <div class="feat-card reveal" style="margin-bottom:1.5rem;">
                <h3>Level-Based Commission Payouts</h3>
                <p>
                    Commissions are paid out across multiple levels of your downline. The deeper your network grows, the more levels of earnings become available to you.
                </p>
            </div>

            <div class="feat-card reveal" style="margin-bottom:1.5rem;">
                <h3>Direct Sponsoring Rewards</h3>
                <p>
                    Members earn a higher commission percentage on their direct recruits, incentivizing active personal sponsoring and frontline growth for sustained income.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Rank & Leadership Bonuses</h3>
                <p>
                    As your network grows and you hit rank milestones, unlock additional leadership bonuses and overrides on deeper levels of your organization for compounding rewards.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Get Started?</h2>
            <p>
                Launch your Unilevel MLM business today with our comprehensive software solution designed for unlimited growth and success.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-primary">
                    Start Your Unilevel Plan
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14m-7-7l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('website.contact') }}" class="btn-ghost">
                    Contact Sales
                </a>
            </div>
        </div>
    </section>

    {{-- Related Plans Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Explore Other <em>MLM Plans</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Not sure if Unilevel is right for you? Check out our other compensation plan options.
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:1.5rem; max-width:900px; margin:auto;">
            <a href="{{ route('website.binary-plan') }}" class="feat-card" style="text-decoration:none; display:block;">
                <h3>Binary Plan</h3>
                <p>Two-leg structure, spillover benefits, commission on weaker leg.</p>
            </a>

            <a href="{{ route('website.matrix-plan') }}" class="feat-card" style="text-decoration:none; display:block;">
                <h3>Matrix Plan</h3>
                <p>Fixed width and depth, forced matrix spillover benefits.</p>
            </a>

            <a href="{{ route('website.features') }}" class="feat-card" style="text-decoration:none; display:block;">
                <h3>All Features</h3>
                <p>Explore all features of our MLM software platform.</p>
            </a>
        </div>
    </section>
@endsection
