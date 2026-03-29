{{-- Contact details page for sitemap.xml --}}
@extends('layouts.website')

@section('title', 'Contact Us - ' . config('app.name') . ' MLM Software Support')

@section('meta_description', 'Get in touch with our expert team for personalized MLM software solutions, support, and consultations to help scale your network marketing business effectively.')

@section('meta_keywords', 'contact MLM software, MLM software support, MLM software India contact, Micro MLM contact, network marketing software help')

@section('og_title', 'Contact Us - Micro MLM Software Support & Sales')

@section('og_description', 'Reach our team by phone, WhatsApp, or email for MLM software demos, pricing, and dedicated support. Call +91 9101177123.')

{{-- Schema markup --}}
@php
    $contactSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => config('app.name', 'MICRO MLM'),
        'contactPoint' => [
            [
                '@type' => 'ContactPoint',
                'telephone' => '+91-9101177123',
                'contactType' => 'customer support',
                'areaServed' => 'IN',
                'availableLanguage' => ['English', 'Hindi'],
            ],
        ],
        'email' => 'support.micromlm@gmail.com',
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($contactSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
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
        text-align: center;
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
        margin: 0 0 1.25rem;
    }

    .contact-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        background: var(--accentDim);
        border: 1px solid var(--border);
        color: var(--accentLight);
        font-size: 1.25rem;
        margin-bottom: 1.25rem;
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
            We're here to help
        </div>
        <h1>Contact <em>Us</em></h1>
        <p class="hero-sub">
            Have questions about our MLM software? Reach our team by phone, WhatsApp, or email — we're ready to help you get started.
        </p>
    </header>

    {{-- Contact Channels --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Get in <em>Touch</em></h2>
        <p style="color:var(--textMuted); max-width:600px; margin:auto; text-align:center; margin-bottom:2rem;">
            Choose the channel that works best for you — we typically respond within a few hours.
        </p>

        <div class="features-grid" style="max-width:900px; margin:auto;">
            <div class="feat-card reveal">
                <div class="contact-icon">
                    <i class="fa fa-phone"></i>
                </div>
                <h3>Phone Support</h3>
                <p>Call us directly for expert consultation, demos, and sales enquiries.</p>
                <a href="tel:+919101177123" class="btn-primary" style="display:inline-flex; align-items:center; gap:0.5rem; text-decoration:none; justify-content:center;">
                    +91 9101177123
                </a>
            </div>

            <div class="feat-card reveal">
                <div class="contact-icon">
                    <i class="fa fa-whatsapp"></i>
                </div>
                <h3>WhatsApp Support</h3>
                <p>Chat with us on WhatsApp for quick assistance, pricing, and feature questions.</p>
                <a href="https://wa.me/919101177123" target="_blank" rel="noopener" class="btn-primary" style="display:inline-flex; align-items:center; gap:0.5rem; text-decoration:none; justify-content:center;">
                    Chat on WhatsApp
                </a>
            </div>

            <div class="feat-card reveal">
                <div class="contact-icon">
                    <i class="fa fa-envelope"></i>
                </div>
                <h3>Email Support</h3>
                <p>Send us an email for detailed enquiries, technical support, or partnership requests.</p>
                <a href="mailto:support.micromlm@gmail.com" class="btn-primary" style="display:inline-flex; align-items:center; gap:0.5rem; text-decoration:none; justify-content:center;">
                    support.micromlm@gmail.com
                </a>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Ready to Get Started?</h2>
            <p>
                Try a live demo or register now to explore everything Micro MLM has to offer for your network marketing business.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-primary">
                    Get Started
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14m-7-7l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('login') }}" class="btn-ghost">
                    View Demo
                </a>
            </div>
        </div>
    </section>

    {{-- Related Plans Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Explore Our <em>MLM Plans</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Not sure which plan suits your business? Browse our compensation plan options.
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
