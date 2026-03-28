@extends('layouts.website')

@section('title', 'MLM Software | GST-Compliant Network Marketing Platform')
@section('meta_desc', 'MLM software with automated commissions, payouts, genealogy, KYC, GST/TDS, and scalable infrastructure for network marketing.')

@section('content')
<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">MLM Software</h1>
        <p class="lead opacity-75">Launch and scale your network marketing business with automation and compliance.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a class="btn btn-gradient btn-lg px-5" href="{{ route('login') }}">View Demo</a>
            <a class="btn btn-outline-light btn-lg" href="https://wa.me/919101177123?text=I%20want%20MLM%20software%20details" target="_blank">Chat on WhatsApp</a>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Highlights</h2>
        <ul class="text-muted">
            <li>Binary, Matrix, Unilevel, and hybrid plans</li>
            <li>Automated payouts, GST/TDS handling</li>
            <li>Real-time genealogy and analytics dashboards</li>
            <li>Payment gateways: UPI, bank transfer, wallets</li>
        </ul>
    </div>
</section>
@endsection