{{-- Buy MLM Software Page --}}
@extends('layouts.website')

@section('title', 'Buy MLM Software - Ready-to-Launch Platform for Network Marketing')

@section('meta_description', 'Buy MLM software with quick setup, secure payouts, genealogy tree, KYC, GST/TDS compliance, and e-commerce integration. Get a production-ready platform today.')

@section('meta_keywords', 'buy MLM software, MLM software India, network marketing software, MLM platform, direct selling software, MLM software price')

@section('og_title', 'Buy MLM Software - Ready-to-Launch Network Marketing Platform')

@section('og_description', 'Get a production-ready MLM platform with fast onboarding, E-Pin/E-Wallet automation, GST/TDS compliance, and dedicated support. Call 9101177123.')

{{-- Schema markup --}}
@php
    $productSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => 'Micro MLM Software',
        'description' => 'Ready-to-launch MLM software platform with genealogy tree, KYC, GST/TDS compliance, E-Wallet, and e-commerce integration.',
        'brand' => [
            '@type' => 'Brand',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'offers' => [
            '@type' => 'Offer',
            'priceCurrency' => 'INR',
            'availability' => 'https://schema.org/InStock',
            'seller' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'MICRO MLM'),
            ],
        ],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($productSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

{{-- Custom styles --}}
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
        <h1>Buy MLM <em>Software</em></h1>
        <p class="hero-sub">
            Get a production-ready MLM platform with fast onboarding, automated payouts, full compliance, and dedicated support — launch your network marketing business today.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; opacity:0; animation: fadeUp 0.7s 0.5s ease forwards;">
            <a href="{{ route('login') }}" class="btn-primary">
                View Demo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
            <a href="https://wa.me/919101177123?text=I%20want%20to%20buy%20MLM%20software" target="_blank" rel="noopener" class="btn-ghost">
                Get Pricing
            </a>
        </div>
    </header>

    {{-- Why Buy From Us --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Why Buy From <em>Us?</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Everything you need to launch, manage, and scale your MLM business — built in from day one.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>Rapid Deployment</h3>
                <p>
                    Go live fast with our streamlined onboarding process. We handle setup, configuration, and training so your team can start operating without delay.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>E-Pin & E-Wallet Automation</h3>
                <p>
                    Fully automated E-Pin generation, E-Wallet management, and withdrawal processing — eliminating manual work and ensuring accurate, on-time payouts for your members.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Compliance Ready</h3>
                <p>
                    Built-in GST/TDS calculations and adherence to DSOP direct selling guidelines keep your business on the right side of Indian regulations from day one.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Secure Cloud Infrastructure</h3>
                <p>
                    Your data is protected by enterprise-grade security — encrypted storage, secure payment gateways, and a scalable cloud architecture that grows with your network.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Genealogy Tree & KYC</h3>
                <p>
                    Visualize your entire downline with an interactive genealogy tree and manage member identity verification through integrated KYC workflows.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>E-Commerce Integration</h3>
                <p>
                    Sell products directly through the platform with built-in e-commerce support — product catalogues, order management, and inventory tracking included.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Launch Your MLM Business?</h2>
            <p>
                Talk to our team today for a live demo, custom pricing, and a plan tailored to your network marketing goals.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-primary">
                    Get Started Now
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
        <h2 class="section-title text-center">Choose Your <em>MLM Plan</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Our software supports all major compensation plans. Pick the one that fits your business model.
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

            <a href="{{ route('website.unilevel-plan') }}" class="feat-card" style="text-decoration:none; display:block;">
                <h3>Unilevel Plan</h3>
                <p>Unlimited width, simple structure, direct sponsoring benefits.</p>
            </a>
        </div>
    </section>
@endsection
