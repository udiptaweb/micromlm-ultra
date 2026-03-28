@extends('layouts.website')

@section('title', 'MLM Software Development | Custom Feature Engineering')
@section('meta_desc', 'MLM software development services: custom plan logic, integrations, mobile apps, performance, and security.')

@section('content')
<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">MLM Software Development</h1>
        <p class="lead opacity-75">End-to-end engineering for complex, scalable MLM systems.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a class="btn btn-gradient btn-lg px-5" href="{{ route('login') }}">View Demo</a>
            <a class="btn btn-outline-light btn-lg" href="https://wa.me/919101177123?text=MLM%20software%20development%20services" target="_blank">Discuss Requirements</a>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Services</h2>
        <ul class="text-muted">
            <li>Architecture, APIs, and integrations</li>
            <li>Custom algorithms and payout logic</li>
            <li>Mobile apps and CI/CD pipelines</li>
            <li>Security hardening and compliance</li>
        </ul>
    </div>
</section>
@endsection