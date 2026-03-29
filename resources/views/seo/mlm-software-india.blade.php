{{-- MLM Software in India Page --}}
@extends('layouts.website')

@section('title', 'MLM Software in India - GST-Compliant Network Marketing Platform')

@section('meta_description', 'Pan-India MLM software with automated commissions, payouts, KYC/AML, GST/TDS compliance, and scalable cloud infrastructure for direct selling companies.')

@section('meta_keywords', 'MLM software India, network marketing software India, direct selling software India, GST compliant MLM software, best MLM software India')

@section('og_title', 'MLM Software in India - Reliable, Scalable & GST-Compliant')

@section('og_description', 'A trusted MLM platform for Indian companies — Binary, Matrix, Unilevel plans, automated payouts, GST/TDS automation, KYC, fraud controls, and pan-India payment support.')

{{-- Schema markup --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'MLM Software in India',
        'description' => 'Pan-India MLM software platform with automated commissions, GST/TDS compliance, KYC/AML, multi-plan support, and scalable cloud infrastructure for direct selling companies.',
        'provider' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'areaServed' => [
            '@type' => 'Country',
            'name' => 'India',
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
            Pan-India · GST Compliant
        </div>
        <h1>MLM Software <em>in India</em></h1>
        <p class="hero-sub">
            A reliable, scalable, and fully compliant platform for Indian MLM companies — built to handle the regulatory, payment, and operational demands of the Indian market.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; opacity:0; animation: fadeUp 0.7s 0.5s ease forwards;">
            <a href="{{ route('login') }}" class="btn-primary">
                View Demo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
            <a href="https://wa.me/919101177123?text=I%20am%20interested%20in%20MLM%20software%20in%20India" target="_blank" rel="noopener" class="btn-ghost">
                Chat on WhatsApp
            </a>
        </div>
    </header>

    {{-- Key Capabilities --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Key <em>Capabilities</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Everything an Indian MLM company needs — compliance, payments, plans, and controls — in one platform.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>Multi-Plan Support</h3>
                <p>
                    Run Binary, Matrix, Unilevel, or hybrid compensation plans from a single platform — switch or combine plans as your Indian network marketing business evolves.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Automated Payouts & Tax Handling</h3>
                <p>
                    Instant E-Wallet processing with automated GST and TDS deductions on every payout — eliminating manual errors and ensuring every disbursement is tax-compliant.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>KYC / AML Member Onboarding</h3>
                <p>
                    Streamlined member onboarding with integrated KYC and AML checks — document upload, identity verification, and admin approval built directly into the registration flow.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Dashboards & Reports</h3>
                <p>
                    Comprehensive dashboards for admins and members — sales volume, earnings history, downline performance, and audit-ready financial reports at your fingertips.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Fraud Controls</h3>
                <p>
                    Built-in fraud detection, duplicate account prevention, and suspicious activity alerts protect your business and maintain the integrity of your entire network.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Pan-India Payment Support</h3>
                <p>
                    UPI, IMPS, NEFT, bank transfers, and E-Wallet — covering every major payment method used across India for fast, reliable member payouts and deposits.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>DSOP & Regulatory Compliance</h3>
                <p>
                    Aligned with the Direct Selling Order & Protection (DSOP) guidelines and the Consumer Protection Act, 2019 — keeping your operations lawful across all Indian states.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Scalable Cloud Infrastructure</h3>
                <p>
                    Enterprise-grade hosting with high availability, automated backups, and elastic scaling — built to support thousands of concurrent users as your Indian network grows.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Scale Across India?</h2>
            <p>
                Get a live demo or talk to our team about launching your fully compliant, pan-India MLM platform today.
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
            Our India MLM platform supports all major compensation structures — pick the one that fits your business model.
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
