{{-- Binary Plan Page for sitemap.xml --}}
@extends('layouts.website')

@section('title', 'Binary MLM Plan - Balanced Growth & Optimized Earnings')

@section('meta_description', 'Discover the advantages of our Binary MLM Plan, designed to maximize your network marketing potential with balanced growth and optimized earnings.')

@section('meta_keywords', 'Binary MLM plan, Binary compensation plan, Binary network marketing, MLM binary structure, two-leg MLM plan')

@section('og_title', 'Binary MLM Plan - Maximize Your Network Marketing Potential')

@section('og_description', 'Learn about our Binary MLM Plan featuring balanced growth, optimized earnings, and team support for network marketing success.')

{{-- Schema markup for Binary Plan --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Binary MLM Plan',
        'description' => 'Binary MLM compensation plan with balanced two-leg structure for network marketing',
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

{{-- Custom styles for Binary Plan page --}}
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
        <h1>Binary MLM <em>Plan</em></h1>
        <p class="hero-sub">
            Maximize your network marketing potential with balanced growth and optimized earnings through our proven Binary MLM compensation structure.
        </p>
    </header>

    {{-- Why Choose Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Why Choose the <em>Binary MLM Plan?</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            The Binary MLM Plan offers a strategic approach to network building with proven benefits for sustainable growth.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>Balanced Growth</h3>
                <p>
                    The Binary MLM Plan encourages members to build two legs, promoting balanced growth and stability within the network. This structure ensures sustainable expansion.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Optimized Earnings</h3>
                <p>
                    With commissions based on the weaker leg, members are motivated to support and grow both sides of their network for maximum profitability and consistent income.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Simple Structure</h3>
                <p>
                    The straightforward two-leg structure makes it easy for new members to understand and engage with the plan, fostering quicker recruitment and retention.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Team Support</h3>
                <p>
                    Members are encouraged to collaborate and support each other, creating a strong sense of community and shared success within the network.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Spillover Benefits</h3>
                <p>
                    When a sponsor's frontline is full, new recruits automatically spill over to the next available position, helping downline members grow their teams effortlessly.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Unlimited Depth</h3>
                <p>
                    Build your network as deep as you want with no limitations, allowing for exponential growth potential and long-term passive income generation.
                </p>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">How the Binary Plan <em>Works</em></h2>
        <p style="color:var(--textMuted); max-width:800px; margin:auto; text-align:center; margin-bottom:3rem;">
            Understanding the mechanics behind the Binary MLM Plan helps you leverage its full potential for building a successful network marketing business.
        </p>

        <div style="max-width:900px; margin:auto;">
            <div class="feat-card reveal" style="margin-bottom:1.5rem;">
                <h3>Two-Leg Structure</h3>
                <p>
                    Each member can have only two direct recruits (left leg and right leg). All additional recruits are placed in the downline of these two legs, creating a binary tree structure.
                </p>
            </div>

            <div class="feat-card reveal" style="margin-bottom:1.5rem;">
                <h3>Commission on Weaker Leg</h3>
                <p>
                    Commissions are typically calculated based on the sales volume of your weaker leg. This encourages members to balance both legs for optimal earnings.
                </p>
            </div>

            <div class="feat-card reveal" style="margin-bottom:1.5rem;">
                <h3>Automatic Placement</h3>
                <p>
                    New members are automatically placed in the next available position in your organization, ensuring continuous growth and helping your entire team succeed.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Matching Bonuses</h3>
                <p>
                    Earn additional bonuses on the commissions earned by your personally sponsored members, rewarding you for building a strong frontline team.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Get Started?</h2>
            <p>
                Launch your Binary MLM business today with our comprehensive software solution designed for growth and success.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-primary">
                    Start Your Binary Plan
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
            Not sure if Binary is right for you? Check out our other compensation plan options.
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:1.5rem; max-width:900px; margin:auto;">
            <a href="{{ route('website.unilevel-plan') }}" class="feat-card" style="text-decoration:none; display:block;">
                <h3>Unilevel Plan</h3>
                <p>Unlimited width, simple structure, direct sponsoring benefits.</p>
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