{{-- MLM Software in Kolkata Page --}}
@extends('layouts.website')

@section('title', 'MLM Software in Kolkata - Network Marketing Platform for West Bengal')

@section('meta_description', 'Top MLM software in Kolkata with secure payouts, genealogy visualization, automated commissions, GST/TDS compliance, and regional payment gateway support.')

@section('meta_keywords', 'MLM software Kolkata, network marketing software Kolkata, direct selling software West Bengal, MLM platform Kolkata, best MLM software West Bengal')

@section('og_title', 'MLM Software in Kolkata - Robust & Compliant Network Marketing Platform')

@section('og_description', 'Grow your MLM business in Kolkata and West Bengal with enterprise-grade security, automated commissions, visual genealogy, and local payment gateway support.')

{{-- Schema markup --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'MLM Software in Kolkata',
        'description' => 'MLM software platform for network marketing businesses in Kolkata, West Bengal with automated commissions, GST/TDS compliance, genealogy tracking, and regional payment support.',
        'provider' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'areaServed' => [
            '@type' => 'City',
            'name' => 'Kolkata',
            'containedInPlace' => [
                '@type' => 'State',
                'name' => 'West Bengal',
            ],
        ],
        'serviceType' => 'MLM Software Solution',
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
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
            Kolkata · West Bengal
        </div>
        <h1>MLM Software <em>in Kolkata</em></h1>
        <p class="hero-sub">
            Grow your network marketing operations in Kolkata and West Bengal with a robust, secure, and fully compliant MLM platform built for the Indian market.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; opacity:0; animation: fadeUp 0.7s 0.5s ease forwards;">
            <a href="{{ route('login') }}" class="btn-primary">
                View Demo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
            <a href="https://wa.me/919101177123?text=I%20am%20interested%20in%20MLM%20software%20for%20Kolkata" target="_blank" rel="noopener" class="btn-ghost">
                Chat on WhatsApp
            </a>
        </div>
    </header>

    {{-- Highlights Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Built for <em>Kolkata Businesses</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            A feature-complete MLM platform tailored to the operational and compliance needs of network marketing businesses in Kolkata and West Bengal.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>Enterprise Security & MFA</h3>
                <p>
                    State-of-the-art encryption, multi-factor authentication, and role-based access controls protect your business data and every member account from unauthorised access.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Scalable Cloud Architecture</h3>
                <p>
                    Elastic cloud infrastructure with high availability and automated backups — handles thousands of concurrent Kolkata users reliably as your network expands across West Bengal.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Automated Commissions & Withdrawals</h3>
                <p>
                    Fully automated commission calculations and withdrawal processing — accurate, instant payouts for every member with no manual intervention or calculation errors.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Regional Payment Gateways</h3>
                <p>
                    UPI, IMPS, NEFT, bank transfers, and E-Wallet support — covering every major payment method popular among Kolkata and West Bengal members for fast, hassle-free transactions.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Visual Genealogy Tree</h3>
                <p>
                    Interactive real-time genealogy views for Binary, Matrix, and Unilevel structures — track every downline movement and team performance at a glance.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>GST / TDS & Indian Compliance</h3>
                <p>
                    Built-in GST and TDS automation on all payouts, fully aligned with DSOP guidelines and the Consumer Protection Act — keeping your Kolkata MLM business audit-ready.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Launch in Kolkata?</h2>
            <p>
                Get a live demo or talk to our team about setting up your MLM platform for the Kolkata and West Bengal market — fast deployment, full support.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-primary">
                    Get Started
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
            Our Kolkata MLM platform supports all major compensation structures — pick the one that fits your business model.
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
