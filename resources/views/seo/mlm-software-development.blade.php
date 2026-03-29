{{-- MLM Software Development Page --}}
@extends('layouts.website')

@section('title', 'MLM Software Development - Custom Feature Engineering & Scalable Systems')

@section('meta_description', 'End-to-end MLM software development services — custom plan logic, API integrations, mobile apps, CI/CD pipelines, security hardening, and compliance.')

@section('meta_keywords', 'MLM software development, MLM software development India, custom MLM development, network marketing software development, MLM app development')

@section('og_title', 'MLM Software Development - End-to-End Engineering for MLM Systems')

@section('og_description', 'From architecture and custom algorithms to mobile apps and security hardening — we build complex, scalable MLM software tailored to your exact requirements.')

{{-- Schema markup --}}
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'MLM Software Development',
        'description' => 'End-to-end MLM software development services including custom compensation logic, API integrations, mobile apps, CI/CD pipelines, security hardening, and compliance.',
        'provider' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'areaServed' => 'India',
        'serviceType' => 'Software Development',
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
        <h1>MLM Software <em>Development</em></h1>
        <p class="hero-sub">
            End-to-end engineering for complex, scalable MLM systems — from architecture and custom algorithms to mobile apps, CI/CD pipelines, and security hardening.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; opacity:0; animation: fadeUp 0.7s 0.5s ease forwards;">
            <a href="{{ route('login') }}" class="btn-primary">
                View Demo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
            <a href="https://wa.me/919101177123?text=MLM%20software%20development%20services" target="_blank" rel="noopener" class="btn-ghost">
                Discuss Requirements
            </a>
        </div>
    </header>

    {{-- Services Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Our Development <em>Services</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            From greenfield builds to extending existing platforms — we cover the full engineering lifecycle of MLM software.
        </p>

        <div class="features-grid">
            <div class="feat-card reveal">
                <h3>System Architecture & APIs</h3>
                <p>
                    We design scalable, maintainable architectures and build robust RESTful APIs that integrate cleanly with payment gateways, KYC providers, SMS services, and third-party tools.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Custom Compensation Algorithms</h3>
                <p>
                    Your plan logic implemented precisely — rank qualifications, capping rules, bonus triggers, carry-forward volumes, and multi-tier payout calculations, no matter the complexity.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Mobile Apps (Android & iOS)</h3>
                <p>
                    Branded native apps for your members — dashboards, genealogy trees, earnings history, withdrawal requests, and real-time notifications on both Android and iOS.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>CI/CD Pipelines & DevOps</h3>
                <p>
                    Automated build, test, and deployment pipelines that reduce release risk and keep your platform up-to-date with zero-downtime deployments on cloud infrastructure.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Security Hardening</h3>
                <p>
                    Penetration-tested codebases, end-to-end encryption, role-based access controls, and secure payment flows — protecting your business and every member's data.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Compliance Engineering</h3>
                <p>
                    Built-in GST/TDS automation, DSOP-aligned workflows, audit-ready transaction logs, and KYC integration to keep your platform on the right side of Indian regulations.
                </p>
            </div>
        </div>
    </section>

    {{-- How We Work Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">How We <em>Work</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:3rem;">
            A structured, transparent development process from first call to go-live — and beyond.
        </p>

        <div style="max-width:900px; margin:auto; display:flex; flex-direction:column; gap:1.5rem;">
            <div class="feat-card reveal">
                <h3>Discovery & Scoping</h3>
                <p>
                    We start by understanding your business model, compensation plan, and technical requirements in detail — then deliver a clear scope, timeline, and fixed quote.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Design & Development</h3>
                <p>
                    Iterative development with regular milestone reviews. You see working software early and often — not just at the end — so feedback is incorporated throughout.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Testing & Launch</h3>
                <p>
                    Comprehensive QA including functional, performance, and security testing before go-live. We manage the deployment and train your team for a smooth handover.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Ongoing Support & Maintenance</h3>
                <p>
                    Post-launch support packages cover bug fixes, feature additions, security patches, and infrastructure scaling as your network grows.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Let's Build Your MLM Platform</h2>
            <p>
                Share your requirements and we'll put together a detailed proposal — timeline, tech stack, and cost — at no obligation.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="https://wa.me/919101177123?text=MLM%20software%20development%20services" target="_blank" rel="noopener" class="btn-primary">
                    Discuss Requirements
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
            We develop software for all major compensation structures — tell us your plan and we'll build it.
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
