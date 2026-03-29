{{-- Blog: Legality of MLM in India --}}
@extends('layouts.website')

@section('title', 'Legality of MLM in India - Regulations, Compliance & Best Practices')

@section('meta_description', 'Explore the legal landscape of Multi-Level Marketing (MLM) in India, including regulations, compliance requirements, and best practices for operating within the law.')

@section('meta_keywords', 'MLM legality India, MLM regulations India, direct selling guidelines India, network marketing law India, MLM compliance India')

@section('og_title', 'Legality of MLM in India - Regulations, Compliance & Best Practices')

@section('og_description', 'A comprehensive guide to the Consumer Protection Act, Direct Selling Guidelines 2016, and compliance requirements for legally operating an MLM business in India.')

{{-- Schema markup for Blog Article --}}
@php
    $articleSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => 'Legality of MLM in India - Regulations, Compliance & Best Practices',
        'description' => 'Explore the legal landscape of Multi-Level Marketing (MLM) in India, including regulations, compliance requirements, and best practices for operating within the law.',
        'author' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => config('app.name', 'MICRO MLM'),
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
        ],
        'about' => [
            '@type' => 'Thing',
            'name' => 'Multi-Level Marketing Law in India',
        ],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
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

    .feat-card ul {
        font-size: 0.9rem;
        color: var(--textMuted);
        line-height: 1.9;
        margin: 0;
        padding-left: 1.25rem;
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
            Legal Guide · India
        </div>
        <h1>Legality of MLM <em>in India</em></h1>
        <p class="hero-sub">
            A clear breakdown of the regulatory framework, compliance requirements, and best practices for running a lawful MLM or direct selling business in India.
        </p>
    </header>

    {{-- Overview Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Understanding MLM <em>Regulations in India</em></h2>
        <p style="color:var(--textMuted); max-width:800px; margin:auto; text-align:center; margin-bottom:3rem;">
            Multi-Level Marketing has grown rapidly in India, but its legal standing is shaped by specific consumer protection laws and direct selling guidelines. Here is what every MLM operator needs to know.
        </p>

        <div style="max-width:900px; margin:auto; display:flex; flex-direction:column; gap:1.5rem;">

            <div class="feat-card reveal">
                <h3>Key Regulatory Frameworks</h3>
                <p>
                    The primary law governing MLM in India is the <strong style="color:var(--text);">Consumer Protection Act, 2019</strong>, which safeguards consumer interests across all direct selling activities. Alongside it, the <strong style="color:var(--text);">Direct Selling Guidelines, 2016</strong> issued by the Ministry of Consumer Affairs provide specific rules that MLM companies must follow to operate legally and transparently.
                </p>
            </div>

            <div class="feat-card reveal">
                <h3>Compliance Requirements</h3>
                <p style="margin-bottom:0.75rem;">To stay compliant with Indian law, MLM companies must meet the following requirements:</p>
                <ul>
                    <li>Register as a legal entity with the appropriate government authorities.</li>
                    <li>Provide clear and transparent information about the business model, compensation plan, and product offerings.</li>
                    <li>Avoid pyramid schemes by ensuring income is primarily derived from genuine product sales rather than recruitment.</li>
                    <li>Implement a cooling-off period for new recruits to cancel membership and receive a full refund.</li>
                    <li>Maintain proper records of transactions and member activities for regulatory audits.</li>
                </ul>
            </div>

            <div class="feat-card reveal">
                <h3>Best Practices for MLM Companies</h3>
                <p style="margin-bottom:0.75rem;">To operate successfully and legally in India, MLM companies should follow these best practices:</p>
                <ul>
                    <li>Educate members about the legal aspects of MLM and their rights as consumers.</li>
                    <li>Establish a robust grievance redressal mechanism to address member concerns promptly.</li>
                    <li>Regularly review and update business practices to align with changing regulations.</li>
                    <li>Engage with legal experts to ensure ongoing compliance with Indian laws.</li>
                </ul>
            </div>

            <div class="feat-card reveal">
                <h3>Conclusion</h3>
                <p>
                    The legality of MLM in India is well-defined through regulations aimed at protecting consumers and ensuring ethical business practices. By adhering to these frameworks and implementing best practices, MLM companies can operate with confidence while building trust and long-term credibility in the market.
                </p>
            </div>

        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section reveal">
        <div class="cta-section">
            <h2>Need Help Getting Compliant?</h2>
            <p>
                Micro MLM software is built with compliance in mind — transparent compensation plans, audit-ready records, and member management tools that keep you on the right side of the law.
            </p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-primary">
                    Get Started
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

    {{-- Related Content Section --}}
    <section class="section reveal">
        <h2 class="section-title text-center">Explore Our <em>MLM Plans</em></h2>
        <p style="color:var(--textMuted); max-width:700px; margin:auto; text-align:center; margin-bottom:2rem;">
            Now that you understand the legal landscape, choose a compensation plan that fits your compliant MLM business.
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
