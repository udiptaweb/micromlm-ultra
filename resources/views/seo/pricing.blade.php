{{-- Pricing Page --}}
@extends('layouts.website')

@section('title', 'MLM Software Price in India - Transparent Pricing Plans')

@section('meta_description', 'Get enterprise-grade MLM software starting at ₹25,000. Free domain, hosting, and automated GST/TDS features included. Compare Essential, Business Plus, and Enterprise plans.')

@section('meta_keywords', 'MLM software price India, MLM software cost, MLM software packages, buy MLM software India, MLM software pricing')

@section('og_title', 'MLM Software Pricing - Transparent Plans Starting at ₹25,000')

@section('og_description', 'Compare our MLM software plans — Essential Starter at ₹25,000, Business Plus at ₹75,000, and custom Enterprise Suite. Free domain and hosting included.')

{{-- Schema markup --}}
@php
    $offerSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'MLM Software Pricing Plans',
        'itemListElement' => [
            [
                '@type' => 'Offer',
                'position' => 1,
                'name' => 'Essential Starter',
                'description' => 'MLM software for new startups with free domain, hosting, and payment gateway.',
                'price' => '25000',
                'priceCurrency' => 'INR',
                'seller' => ['@type' => 'Organization', 'name' => config('app.name', 'MICRO MLM')],
            ],
            [
                '@type' => 'Offer',
                'position' => 2,
                'name' => 'Business Plus',
                'description' => 'MLM software with VPS hosting, hybrid compensation, TDS automation, and E-Wallet.',
                'price' => '75000',
                'priceCurrency' => 'INR',
                'seller' => ['@type' => 'Organization', 'name' => config('app.name', 'MICRO MLM')],
            ],
            [
                '@type' => 'Offer',
                'position' => 3,
                'name' => 'Enterprise Suite',
                'description' => 'Custom MLM software with bespoke plan logic, Android/iOS apps, and white-label source code.',
                'priceCurrency' => 'INR',
                'seller' => ['@type' => 'Organization', 'name' => config('app.name', 'MICRO MLM')],
            ],
        ],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($offerSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
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

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }

    .pricing-card {
        background: var(--bg2);
        border: 1px solid var(--borderSoft);
        border-radius: 16px;
        padding: 2.5rem 2rem;
        display: flex;
        flex-direction: column;
        transition: border-color 0.25s, transform 0.25s, box-shadow 0.25s;
        position: relative;
    }

    .pricing-card:hover {
        border-color: var(--border);
        transform: translateY(-4px);
        box-shadow: 0 8px 24px var(--accentGlow);
    }

    .pricing-card.featured {
        border-color: var(--accent);
        box-shadow: 0 0 0 1px var(--accent), 0 8px 32px var(--accentGlow);
    }

    .pricing-badge {
        position: absolute;
        top: -0.75rem;
        left: 50%;
        transform: translateX(-50%);
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 1rem;
        background: var(--accent);
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #fff;
        white-space: nowrap;
    }

    .plan-label {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--textMuted);
        margin-bottom: 0.75rem;
    }

    .plan-price {
        font-family: var(--heroFont);
        font-size: clamp(2rem, 5vw, 2.8rem);
        font-weight: var(--heroWeight);
        color: var(--text);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .plan-desc {
        font-size: 0.85rem;
        color: var(--textMuted);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .plan-divider {
        border: none;
        border-top: 1px solid var(--borderSoft);
        margin: 1.25rem 0;
    }

    .plan-features {
        list-style: none;
        padding: 0;
        margin: 0 0 2rem;
        flex: 1;
    }

    .plan-features li {
        font-size: 0.875rem;
        color: var(--textMuted);
        padding: 0.4rem 0;
        display: flex;
        align-items: flex-start;
        gap: 0.6rem;
        line-height: 1.5;
    }

    .plan-features li::before {
        content: '✓';
        color: var(--accent);
        font-weight: 700;
        flex-shrink: 0;
        margin-top: 0.05rem;
    }

    .plan-features li strong {
        color: var(--text);
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

    .secure-note {
        font-size: 0.8rem;
        color: var(--textMuted);
        text-align: center;
        margin-top: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .secure-note::before {
        content: '🔒';
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <header class="hero">
        <div class="benefit-badge">
            No hidden costs
        </div>
        <h1>Transparent <em>Pricing Plans</em></h1>
        <p class="hero-sub">
            Invest in a foundation that grows with your network — GST-compliant MLM software with clear pricing and no surprises.
        </p>
    </header>

    {{-- Pricing Plans --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Choose Your <em>Investment Plan</em></h2>
        <p style="color:var(--textMuted); max-width:600px; margin:auto; text-align:center; margin-bottom:1rem;">
            GST-compliant software for Indian direct selling businesses. All plans include full setup support.
        </p>

        <div class="pricing-grid">

            {{-- Essential Starter --}}
            <div class="pricing-card reveal">
                <div class="plan-label">Essential Starter</div>
                <div class="plan-price">₹25,000</div>
                <p class="plan-desc">Ideal for new startups looking for a rapid market entry.</p>
                <hr class="plan-divider">
                <ul class="plan-features">
                    <li><strong>FREE .com or .in Domain</strong></li>
                    <li><strong>FREE Cloud Hosting (1 Year)</strong></li>
                    <li>Choice of 1 Plan (Binary / Matrix)</li>
                    <li>Member Dashboard & Genealogy</li>
                    <li>Integrated Payment Gateway</li>
                </ul>
                <a href="https://wa.me/919101177123?text=I%20am%20interested%20in%20the%20Essential%20Starter%20Plan" target="_blank" rel="noopener" class="btn-ghost" style="display:block; text-align:center; text-decoration:none; padding:0.75rem 1rem; border-radius:8px;">
                    Get Started
                </a>
            </div>

            {{-- Business Plus --}}
            <div class="pricing-card featured reveal">
                <div class="pricing-badge">Best Value</div>
                <div class="plan-label">Business Plus</div>
                <div class="plan-price">₹75,000</div>
                <p class="plan-desc">Most popular for companies needing high automation and performance.</p>
                <hr class="plan-divider">
                <ul class="plan-features">
                    <li><strong>High-Speed VPS Hosting</strong></li>
                    <li>Hybrid Compensation Support</li>
                    <li>Automated TDS & Admin Fee Calc</li>
                    <li>SMS Gateway Integration</li>
                    <li>E-Pin & E-Wallet System</li>
                </ul>
                <a href="https://wa.me/919101177123?text=I%20am%20interested%20in%20the%20Business%20Plus%20Plan" target="_blank" rel="noopener" class="btn-primary" style="display:block; text-align:center; text-decoration:none; padding:0.75rem 1rem; border-radius:8px;">
                    Inquire Now
                </a>
            </div>

            {{-- Enterprise Suite --}}
            <div class="pricing-card reveal">
                <div class="plan-label">Enterprise Suite</div>
                <div class="plan-price" style="font-size:clamp(1.6rem,4vw,2.2rem);">Custom</div>
                <p class="plan-desc">Tailor-made solutions for large-scale operations and massive growth.</p>
                <hr class="plan-divider">
                <ul class="plan-features">
                    <li>Custom Plan Logic (Algorithms)</li>
                    <li>Android / iOS App Development</li>
                    <li>Dedicated Server Management</li>
                    <li>Multi-Language Support</li>
                    <li>White-Label Source Code</li>
                </ul>
                <a href="{{ route('website.contact') }}" class="btn-ghost" style="display:block; text-align:center; text-decoration:none; padding:0.75rem 1rem; border-radius:8px;">
                    Request Quote
                </a>
            </div>

        </div>

        <p class="secure-note">Secure payment via Razorpay, UPI, or Bank Transfer. All payments are 100% secure.</p>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Have Questions?</h2>
            <p>
                Not sure which plan is right for your business? Our sales team will help you pick the best fit — no pressure, just honest advice.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="{{ route('website.contact') }}" class="btn-primary">
                    Contact Sales Team
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14m-7-7l7 7-7 7"/>
                    </svg>
                </a>
                <a href="https://wa.me/919101177123?text=I%20need%20help%20choosing%20an%20MLM%20software%20plan" target="_blank" rel="noopener" class="btn-ghost">
                    Chat on WhatsApp
                </a>
            </div>
        </div>
    </section>

    {{-- Related Plans Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Explore Our <em>MLM Plans</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            All pricing tiers support these compensation plan structures — choose what fits your business model.
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
