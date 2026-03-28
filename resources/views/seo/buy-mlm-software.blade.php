@extends('layouts.website')

@section('title', 'Buy MLM Software | Ready-to-Launch Platform')
@section('meta_desc', 'Buy MLM software with quick setup, secure payouts, genealogy, KYC, GST/TDS, and e-commerce integration.')

@section('content')
<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">Buy MLM Software</h1>
        <p class="lead opacity-75">Get a production-ready platform with fast onboarding and support.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a class="btn btn-gradient btn-lg px-5" href="{{ route('login') }}">View Demo</a>
            <a class="btn btn-outline-light btn-lg" href="https://wa.me/919101177123?text=I%20want%20to%20buy%20MLM%20software" target="_blank">Get Pricing</a>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Why buy from us?</h2>
        <ul class="text-muted">
            <li>Rapid deployment and training</li>
            <li>E-Pin, E-Wallet, withdrawals automation</li>
            <li>Compliance-ready (GST/TDS, DSOP guidelines)</li>
            <li>Secure, scalable cloud infrastructure</li>
        </ul>
    </div>
</section>
@endsection