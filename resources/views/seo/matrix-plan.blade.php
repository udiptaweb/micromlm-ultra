{{-- Matrix Plan Page for sitemap.xml --}}
@extends('layouts.website')

@section('title', 'Matrix MLM Plan - Structured Growth & Balanced Team Development')

@section('meta_description', 'Discover the advantages of our Matrix MLM Plan, designed for structured growth and balanced team development in your network marketing business.')

@section('meta_keywords', 'Matrix MLM plan, Matrix compensation plan, Matrix network marketing, MLM matrix structure, forced matrix plan')

@section('og_title', 'Matrix MLM Plan - Structured Growth for Network Marketing')

@section('og_description', 'Learn about our Matrix MLM Plan featuring fixed width and depth, balanced team development, and predictable earnings for network marketing success.')

{{-- Schema markup for Matrix Plan --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Matrix MLM Plan',
        'description' => 'Matrix MLM compensation plan with fixed width and depth structure for balanced network marketing growth',
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

{{-- Custom styles for Matrix Plan page --}}
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
        <h1>Matrix MLM <em>Plan</em></h1>
        <p class="hero-sub">
            Build a structured and balanced network with our Matrix MLM Plan — fixed width and depth for predictable growth and sustainable team development.
        </p>
    </header>

    {{-- Why Choose Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Why Choose the <em>Matrix MLM Plan?</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            The Matrix MLM Plan offers a disciplined, structured approach to network building with proven benefits for long-term stability and growth.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>Structured Growth</h3>
                <p>
                    The Matrix MLM Plan provides a fixed width and depth, encouraging members to focus on building a well-structured team for sustainable and predictable growth.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Balanced Team Development</h3>
                <p>
                    With defined levels, members are motivated to develop their teams evenly, fostering collaboration and strong support among downlines at every tier.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Predictable Earnings</h3>
                <p>
                    The fixed structure allows members to anticipate their earnings based on team performance, making it easier to set and consistently achieve financial goals.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Enhanced Focus</h3>
                <p>
                    The Matrix structure helps members concentrate on quality recruitment and team building, leading to a more engaged and productive network overall.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Spillover Benefits</h3>
                <p>
                    When a member's frontline positions are filled, new recruits automatically spill over to the next available spot, passively growing your downline team.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Forced Matrix Advantage</h3>
                <p>
                    The forced matrix structure incentivizes sponsors to actively support their downline, creating a cooperative environment where everyone benefits from team success.
                </p>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">How the Matrix Plan <em>Works</em></h2>
        <p style="color:var(--textMuted); max-width:800px; margin:auto; text-align:center; margin-bottom:3rem;">
            Understanding the mechanics behind the Matrix MLM Plan helps you leverage its full potential for building a structured and profitable network marketing business.
        </p>

        <div style="max-width:900px; margin:auto;">
            <div class="feat-card reveal" style="margin-bottom:1.5rem;">
                <h3>Fixed Width & Depth</h3>
                <p>
                    Each member can sponsor a limited number of direct recruits per level (width) across a defined number of levels (depth), creating a predictable and manageable matrix structure.
                </p>
            </div>

            <div class="feat-card reveal" style="margin-bottom:1.5rem;">
                <h3>Level-Based Commissions</h3>
                <p>
                    Earn commissions from every active member within your matrix levels. As your downline fills up, your earnings grow steadily across each defined depth level.
                </p>
            </div>

            <div class="feat-card reveal" style="margin-bottom:1.5rem;">
                <h3>Automatic Spillover Placement</h3>
                <p>
                    When a level is full, new recruits are automatically placed into the next available position in your matrix, ensuring continuous passive growth for every member.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Re-entry & Cycling Bonuses</h3>
                <p>
                    Once a matrix is complete, members can re-enter or cycle into a new matrix, unlocking additional bonuses and continuing to build their income pipeline.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Get Started?</h2>
            <p>
                Launch your Matrix MLM business today with our comprehensive software solution designed for structured growth and success.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-primary">
                    Start Your Matrix Plan
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
            Not sure if Matrix is right for you? Check out our other compensation plan options.
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:1.5rem; max-width:900px; margin:auto;">
            <a href="{{ route('website.binary-plan') }}" class="feat-card" style="text-decoration:none; display:block;">
                <h3>Binary Plan</h3>
                <p>Two-leg structure, spillover benefits, commission on weaker leg.</p>
            </a>

            <a href="{{ route('website.unilevel-plan') }}" class="feat-card" style="text-decoration:none; display:block;">
                <h3>Unilevel Plan</h3>
                <p>Unlimited width, simple structure, direct sponsoring benefits.</p>
            </a>

            <a href="{{ route('website.features') }}" class="feat-card" style="text-decoration:none; display:block;">
                <h3>All Features</h3>
                <p>Explore all features of our MLM software platform.</p>
            </a>
        </div>
    </section>
@endsection
