{{-- Custom MLM Software Page --}}
@extends('layouts.website')

@section('title', 'Custom MLM Software - Tailor-Made Network Marketing Solution')

@section('meta_description', 'Custom MLM software development with bespoke plan logic, white-label branding, payment integrations, mobile apps, and enterprise-grade security.')

@section('meta_keywords', 'custom MLM software, bespoke MLM software, white label MLM software, MLM software development India, tailor-made network marketing software')

@section('og_title', 'Custom MLM Software - Built Around Your Business Model')

@section('og_description', 'Get tailor-made MLM software with custom compensation algorithms, white-label branding, API integrations, Android/iOS apps, and enterprise hosting.')

{{-- Schema markup --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Custom MLM Software Development',
        'description' => 'Bespoke MLM software development with custom compensation plan logic, white-label branding, API integrations, and mobile apps for network marketing businesses.',
        'provider' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'areaServed' => 'India',
        'serviceType' => 'Custom MLM Software Development',
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
        <h1>Custom MLM <em>Software</em></h1>
        <p class="hero-sub">
            Tailor-made features and compensation logic built around your exact business model — from bespoke plan algorithms to white-label branding and mobile apps.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; opacity:0; animation: fadeUp 0.7s 0.5s ease forwards;">
            <a href="{{ route('login') }}" class="btn-primary">
                View Demo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
            <a href="https://wa.me/919101177123?text=Looking%20for%20custom%20MLM%20software" target="_blank" rel="noopener" class="btn-ghost">
                Talk to an Expert
            </a>
        </div>
    </header>

    {{-- What's Included --}}
    <section class="section reveal">
        <h2 class="section-title text-center">What's <em>Included</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Every custom build is scoped to your needs — here's what we typically deliver.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>Custom Compensation Logic</h3>
                <p>
                    We implement your exact compensation algorithms — custom rank rules, bonus triggers, capping logic, and payout schedules — no matter how complex your plan is.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>White-Label Branding</h3>
                <p>
                    Full white-label support with your logo, colour palette, domain, and custom theme. Your members see your brand at every touchpoint — not ours.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>API Integrations</h3>
                <p>
                    Connect seamlessly to payment gateways, SMS providers, email services, KYC verification APIs, and any third-party tool your business relies on.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Android & iOS Apps</h3>
                <p>
                    Give your members a native mobile experience with branded Android and iOS apps for dashboards, genealogy tracking, earnings, and notifications.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Enterprise Hosting</h3>
                <p>
                    Scalable cloud infrastructure with high availability, automated backups, and enterprise-grade security — built to handle thousands of concurrent users.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Dedicated Support</h3>
                <p>
                    From kickoff to go-live and beyond, our team provides hands-on development support, training, and ongoing maintenance to keep your platform running smoothly.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Let's Build Your Custom Platform</h2>
            <p>
                Tell us about your business model and we'll scope a solution built exactly around it. Get in touch for a free consultation and custom quote.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="https://wa.me/919101177123?text=Looking%20for%20custom%20MLM%20software" target="_blank" rel="noopener" class="btn-primary">
                    Talk to an Expert
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14m-7-7l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('website.contact') }}" class="btn-ghost">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    {{-- Related Plans Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Supported <em>MLM Plans</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Our custom software supports all major compensation structures. We build around your plan — not the other way around.
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
