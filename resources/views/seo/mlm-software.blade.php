{{-- MLM Software Page --}}
@extends('layouts.website')

@section('title', 'MLM Software - GST-Compliant Network Marketing Platform')

@section('meta_description', 'MLM software with automated commissions, payouts, genealogy tracking, KYC, GST/TDS compliance, and scalable cloud infrastructure for network marketing businesses.')

@section('meta_keywords', 'MLM software, network marketing software, direct selling software, MLM platform, best MLM software India, MLM software GST compliant')

@section('og_title', 'MLM Software - Launch & Scale Your Network Marketing Business')

@section('og_description', 'Automate commissions, manage genealogy, handle GST/TDS, and support Binary, Matrix, or Unilevel plans — everything in one robust MLM platform.')

{{-- Schema markup --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'MLM Software',
        'description' => 'MLM software platform with automated commissions, genealogy tracking, KYC, GST/TDS compliance, multi-plan support, and scalable cloud infrastructure.',
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
        <h1>MLM <em>Software</em></h1>
        <p class="hero-sub">
            Launch and scale your network marketing business with full automation, compliance, and multi-plan support — everything you need in one platform.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; opacity:0; animation: fadeUp 0.7s 0.5s ease forwards;">
            <a href="{{ route('login') }}" class="btn-primary">
                View Demo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
            <a href="https://wa.me/919101177123?text=I%20want%20MLM%20software%20details" target="_blank" rel="noopener" class="btn-ghost">
                Chat on WhatsApp
            </a>
        </div>
    </header>

    {{-- Highlights Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Platform <em>Highlights</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            A complete, production-ready MLM platform with every feature your business needs from day one.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>Multi-Plan Support</h3>
                <p>
                    Binary, Matrix, Unilevel, and hybrid compensation plans — all supported out of the box. Run the plan that fits your business model or combine multiple structures seamlessly.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Automated Payouts</h3>
                <p>
                    Instant commission calculations and automated withdrawal processing eliminate manual errors, ensuring every member gets paid accurately and on time, every time.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>GST / TDS Compliance</h3>
                <p>
                    Built-in GST and TDS handling on all transactions and payouts — automated, accurate, and audit-ready so your business stays compliant with Indian tax regulations.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Real-Time Genealogy</h3>
                <p>
                    Interactive genealogy tree with live updates — visualise your entire downline structure, track member activity, and monitor team performance across all levels.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Analytics Dashboards</h3>
                <p>
                    Comprehensive dashboards for admins and members — sales volume, earnings history, rank progression, and network growth metrics all in one place.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Payment Gateways</h3>
                <p>
                    UPI, IMPS, NEFT, bank transfers, and E-Wallet support — covering every major Indian payment method for fast, reliable deposits and member withdrawals.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>KYC & Member Management</h3>
                <p>
                    Integrated KYC verification, member onboarding workflows, and profile management — keeping your network verified, organised, and compliant from the start.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Secure & Scalable Infrastructure</h3>
                <p>
                    Enterprise-grade encryption, MFA, fraud controls, and elastic cloud hosting — a platform that protects your data and scales reliably as your network grows.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Launch Your MLM Business?</h2>
            <p>
                Get a live demo or register today — a fully compliant, production-ready MLM platform is just a few clicks away.
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
            Not sure which compensation plan is right for you? Explore your options below.
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
