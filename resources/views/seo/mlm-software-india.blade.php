@extends('layouts.website')

@section('title', 'MLM Software in India | GST-Compliant Network Marketing Platform')
@section('meta_desc', 'Pan-India MLM software with automated commissions, payouts, KYC, GST/TDS, and scalable infrastructure.')

@section('content')
<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">MLM Software in India</h1>
        <p class="lead opacity-75">A reliable, scalable, and compliant platform for Indian MLM companies.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a class="btn btn-gradient btn-lg px-5" href="{{ route('login') }}">View Demo</a>
            <a class="btn btn-outline-light btn-lg" href="https://wa.me/919101177123?text=I%20am%20interested%20in%20MLM%20software%20in%20India" target="_blank">Chat on WhatsApp</a>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Key capabilities</h2>
        <ul class="text-muted">
            <li>Binary, Matrix, Unilevel, and hybrid plans</li>
            <li>Automated payouts and tax handling</li>
            <li>Member onboarding with KYC/AML checks</li>
            <li>Dashboards, reports, and fraud controls</li>
        </ul>
    </div>
</section>
@endsection