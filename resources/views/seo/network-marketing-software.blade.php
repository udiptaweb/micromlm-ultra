@extends('layouts.website')

@section('title', 'Network Marketing Software | Direct Selling Platform')
@section('meta_desc', 'Network marketing software for direct selling: commissions, genealogy, dashboards, payouts, and compliance.')

@section('content')
<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">Network Marketing Software</h1>
        <p class="lead opacity-75">Manage distributors, payouts, and growth with full transparency.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a class="btn btn-gradient btn-lg px-5" href="{{ route('login') }}">View Demo</a>
            <a class="btn btn-outline-light btn-lg" href="https://wa.me/919101177123?text=Network%20marketing%20software%20details" target="_blank">Chat on WhatsApp</a>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Core modules</h2>
        <ul class="text-muted">
            <li>Distributor onboarding and KYC</li>
            <li>Compensation engine with bonuses</li>
            <li>Real-time reporting and fraud checks</li>
            <li>E-commerce product management</li>
        </ul>
    </div>
</section>
@endsection