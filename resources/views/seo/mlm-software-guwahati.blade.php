{{-- MLM Software in Guwahati Page --}}
@extends('layouts.website')

@section('title', 'MLM Software in Guwahati - Best MLM Platform for Assam')

@section('meta_description', 'MLM software in Guwahati, Assam with automated payouts, genealogy tracking, GST/TDS compliance, UPI integration, and secure cloud infrastructure.')

@section('meta_keywords', 'MLM software Guwahati, network marketing software Guwahati, direct selling software Assam, MLM platform Guwahati, best MLM software Assam')

@section('og_title', 'MLM Software in Guwahati - Scale Your Network Marketing Business in Assam')

@section('og_description', 'GST-compliant MLM software built for Guwahati and Assam — automated payouts, visual genealogy, UPI/bank/wallet integration, and multi-plan support.')

{{-- Schema markup --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'MLM Software in Guwahati',
        'description' => 'MLM software platform for network marketing businesses in Guwahati, Assam with GST/TDS compliance, automated payouts, genealogy tracking, and UPI integration.',
        'provider' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'areaServed' => [
            '@type' => 'City',
            'name' => 'Guwahati',
            'containedInPlace' => [
                '@type' => 'State',
                'name' => 'Assam',
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
            Guwahati · Assam
        </div>
        <h1>MLM Software <em>in Guwahati</em></h1>
        <p class="hero-sub">
            Scale your network marketing business in Guwahati and Assam with GST-compliant MLM software — automated payouts, visual genealogy, and full multi-plan support.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; opacity:0; animation: fadeUp 0.7s 0.5s ease forwards;">
            <a href="{{ route('login') }}" class="btn-primary">
                View Demo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
            <a href="https://wa.me/919101177123?text=I%20am%20interested%20in%20MLM%20software%20for%20Guwahati" target="_blank" rel="noopener" class="btn-ghost">
                Chat on WhatsApp
            </a>
        </div>
    </header>

    {{-- Why Choose Us --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Why Choose Us <em>in Guwahati?</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Purpose-built features for the Guwahati market — compliance, payments, and language support that works for businesses across Assam.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>GST / TDS Automation</h3>
                <p>
                    Automated GST and TDS calculations on every transaction and payout — keeping your Guwahati-based MLM business fully compliant and audit-ready at all times.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Multi-Plan Support</h3>
                <p>
                    Run Binary, Matrix, or Unilevel compensation plans — or a hybrid — from a single platform tailored to however your network marketing business is structured.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Visual Genealogy & Analytics</h3>
                <p>
                    Real-time genealogy tree views with drill-down navigation and performance analytics — track every downline movement and business metric from one dashboard.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>UPI, Bank Transfer & Wallet</h3>
                <p>
                    Flexible, instant payout options through UPI, direct bank transfer, and E-Wallet withdrawals — the payment methods your Guwahati members already rely on.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>KYC & Member Management</h3>
                <p>
                    Integrated KYC with document upload and admin approval workflows — verify your members, manage profiles, and maintain a trustworthy, compliant network.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Secure Cloud Infrastructure</h3>
                <p>
                    Enterprise-grade security with encrypted data storage, secure payment flows, and a scalable cloud setup that grows reliably alongside your Assam network.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Launch in Guwahati?</h2>
            <p>
                Get a live demo or reach our team to set up your MLM platform for the Guwahati and Assam market — fast deployment, full support.
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
            Our Guwahati MLM platform supports all major compensation structures — pick the one that fits your business model.
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
