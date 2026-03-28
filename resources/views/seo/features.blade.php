{{--features page for sitemap.xml --}}
@extends('layouts.website')
@section('title', 'Features - '.config('app.name'))
@section('meta_desc', 'Explore the powerful features of our MLM software, including automated payouts, real-time genealogy tracking, and multi-currency support to scale your network marketing business.')
@section('content')
    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">MLM Software Features</h1>
                    <p class="lead mb-5 opacity-75">Discover the robust features that make our MLM software the ideal choice for scaling your network marketing business.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-5">
        <div class="container text-center py-5">
            <h2 class="fw-bold mb-5">Key Features</h2>
            <div class="row g-4 text-start">
                <div class="col-md-4">
                    <div class="card h-100 p-4 feature-card">
                        <div class="mb-3 text-success">
                            <svg width="40" height="40" fill="currentColor" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zM1 13.5A1.5 1.5 0 1 0 1 11a1.5 1.5 0 0 0 0 3z"/></svg>
                        </div>
                        <h4>Visual Genealogy</h4>
                        <p class="text-muted">Dynamic tree views for Binary, Matrix, and Unilevel structures. Track every downline movement in real-time.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 p-4 feature-card">
                        <div class="mb-3 text-success">
                            <svg width="40" height="40" fill="currentColor" viewBox="0 0 16 16"><path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/></svg>
                        </div>
                        <h4>Automated Payouts</h4>
                        <p class="text-muted">Eliminate manual calculation errors. Instant E-wallet processing with support for Crypto and Fiat gateways.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 p-4 feature-card">
                        <div class="mb-3 text-success">
                            <svg width="40" height="40" fill="currentColor" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                        </div>
                        <h4>Secure Platform</h4>
                        <p class="text-muted">State-of-the-art encryption and multi-factor authentication to protect your business and member data.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3 class="fw-bold mb-4">Ready to Elevate Your MLM Business?</h3>
            <a href="{{ route('welcome') }}" class="btn btn-primary btn-lg">Get Started Now</a>
        </div>
    </section>
@endsection