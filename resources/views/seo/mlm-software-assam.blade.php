@extends('layouts.website')

@section('title', 'MLM Software in Assam | Direct Selling Solution')
@section('meta_desc', 'Assam-focused MLM software with DSOP-aligned compliance, payouts automation, KYC, and e-commerce integration.')

@section('content')
<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">MLM Software in Assam</h1>
        <p class="lead opacity-75">Empower your direct-selling company across Northeast India.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a class="btn btn-gradient btn-lg px-5" href="{{ route('login') }}">View Demo</a>
            <a class="btn btn-outline-light btn-lg" href="https://wa.me/919101177123?text=I%20am%20interested%20in%20MLM%20software%20for%20Assam" target="_blank">Chat on WhatsApp</a>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Built for Assam</h2>
        <ul class="text-muted">
            <li>GST/TDS automation and DSOP-aligned features</li>
            <li>Assamese/Hindi/English UI options</li>
            <li>UPI, bank transfer, and wallet support</li>
            <li>Genealogy, KYC, e-commerce, analytics</li>
        </ul>
    </div>
</section>
@endsection