{{-- Network Marketing Software Page --}}
@extends('layouts.website')

@section('title', 'Network Marketing Software - Direct Selling Platform for India')

@section('meta_description', 'Network marketing software for direct selling businesses — distributor onboarding, KYC, compensation engine, real-time reporting, fraud checks, and e-commerce integration.')

@section('meta_keywords', 'network marketing software, direct selling software, MLM platform India, distributor management software, network marketing platform India')

@section('og_title', 'Network Marketing Software - Manage Distributors, Payouts & Growth')

@section('og_description', 'A complete direct selling platform — distributor onboarding, KYC, compensation engine with bonuses, real-time reporting, fraud controls, and product e-commerce.')

{{-- Schema markup --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Network Marketing Software',
        'description' => 'Network marketing and direct selling software platform with distributor onboarding, KYC, compensation engine, real-time reporting, fraud checks, and e-commerce integration.',
        'provider' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'areaServed' => 'India',
        'serviceType' => 'Network Marketing Software Solution',
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
        <h1>Network Marketing <em>Software</em></h1>
        <p class="hero-sub">
            Manage distributors, payouts, and growth with full transparency — a complete direct selling platform built for compliance and scale.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; opacity:0; animation: fadeUp 0.7s 0.5s ease forwards;">
            <a href="{{ route('login') }}" class="btn-primary">
                View Demo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
            <a href="https://wa.me/919101177123?text=Network%20marketing%20software%20details" target="_blank" rel="noopener" class="btn-ghost">
                Chat on WhatsApp
            </a>
        </div>
    </header>

    {{-- Core Modules --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Core <em>Modules</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Every module your direct selling business needs — integrated, automated, and ready to use from day one.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>Distributor Onboarding & KYC</h3>
                <p>
                    Streamlined distributor registration with integrated KYC document upload and admin approval workflows — onboard new members quickly while staying fully compliant.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Compensation Engine & Bonuses</h3>
                <p>
                    A powerful, configurable compensation engine supporting Binary, Matrix, Unilevel, and hybrid plans — rank bonuses, performance rewards, and matching bonuses all automated.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Real-Time Reporting</h3>
                <p>
                    Live dashboards and detailed reports for admins and distributors — sales volume, earnings, downline activity, rank progress, and payout history always up to date.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Fraud Detection & Controls</h3>
                <p>
                    Automated fraud checks, duplicate account prevention, suspicious activity alerts, and role-based access controls to protect the integrity of your entire network.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>E-Commerce Product Management</h3>
                <p>
                    Sell products directly through the platform with a built-in catalogue, order management, inventory tracking, and commission integration tied to every product sale.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Automated Payouts & GST/TDS</h3>
                <p>
                    Instant E-Wallet disbursements with automated GST and TDS calculations on every transaction — accurate, on-time payouts with zero manual processing required.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Visual Genealogy Tree</h3>
                <p>
                    Interactive real-time genealogy views across all supported plan structures — drill down into any part of your distributor network and track growth at every level.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Multi-Channel Payments</h3>
                <p>
                    UPI, IMPS, NEFT, bank transfers, and E-Wallet support — giving your distributors flexible, familiar payment options for both deposits and withdrawals across India.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Scale Your Network?</h2>
            <p>
                Get a live demo or register today — a fully compliant, production-ready network marketing platform is just a few clicks away.
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
            Our network marketing platform supports all major compensation structures — pick the one that fits your business model.
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
