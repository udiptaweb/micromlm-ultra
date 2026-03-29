{{-- MLM Software in Assam Page --}}
@extends('layouts.website')

@section('title', 'MLM Software in Assam - Direct Selling Solution for Northeast India')

@section('meta_description', 'Assam-focused MLM software with DSOP-aligned compliance, GST/TDS automation, payouts, KYC, and e-commerce integration. Built for direct selling companies across Northeast India.')

@section('meta_keywords', 'MLM software Assam, network marketing software Assam, direct selling software Northeast India, MLM software Guwahati, MLM platform Assam')

@section('og_title', 'MLM Software in Assam - Empower Your Direct Selling Business')

@section('og_description', 'Purpose-built MLM software for Assam and Northeast India — GST/TDS compliance, UPI payouts, Assamese/Hindi/English UI, KYC, genealogy, and e-commerce.')

{{-- Schema markup --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'MLM Software in Assam',
        'description' => 'MLM software platform built for direct selling companies in Assam and Northeast India, with DSOP compliance, GST/TDS automation, UPI payouts, and KYC.',
        'provider' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'areaServed' => [
            '@type' => 'State',
            'name' => 'Assam',
            'containedInPlace' => [
                '@type' => 'Country',
                'name' => 'India',
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
            Assam · Northeast India
        </div>
        <h1>MLM Software <em>in Assam</em></h1>
        <p class="hero-sub">
            Empower your direct selling company across Northeast India with a fully compliant, localised MLM platform built for the Assam market.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; opacity:0; animation: fadeUp 0.7s 0.5s ease forwards;">
            <a href="{{ route('login') }}" class="btn-primary">
                View Demo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
            <a href="https://wa.me/919101177123?text=I%20am%20interested%20in%20MLM%20software%20for%20Assam" target="_blank" rel="noopener" class="btn-ghost">
                Chat on WhatsApp
            </a>
        </div>
    </header>

    {{-- Built for Assam --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Built for <em>Assam</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Every feature is tailored to meet the operational, compliance, and language needs of direct selling businesses in Assam and across Northeast India.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>GST / TDS & DSOP Compliance</h3>
                <p>
                    Automated GST and TDS calculations on every payout, fully aligned with Direct Selling Order & Protection (DSOP) guidelines — stay compliant without the manual work.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Multi-Language UI</h3>
                <p>
                    Serve your members in the language they prefer — Assamese, Hindi, and English UI options ensure your platform is accessible to every corner of your network.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>UPI, Bank Transfer & Wallet</h3>
                <p>
                    Flexible payout options covering UPI, direct bank transfers, and E-Wallet withdrawals — fast, reliable, and familiar to members across Northeast India.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Visual Genealogy Tree</h3>
                <p>
                    Real-time genealogy tracking across Binary, Matrix, and Unilevel structures — giving you and your members a clear view of every downline movement.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>KYC Verification</h3>
                <p>
                    Integrated KYC workflows with document upload and admin approval — keep your Assam network verified, trustworthy, and regulatory-compliant.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>E-Commerce & Analytics</h3>
                <p>
                    Sell products directly through the platform and track performance with built-in analytics — member activity, sales volume, and payout summaries at a glance.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Launch in Assam?</h2>
            <p>
                Get a live demo or talk to our team about setting up your MLM platform for the Assam and Northeast India market today.
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
            Our Assam MLM platform supports all major compensation structures — pick the one that fits your business.
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
