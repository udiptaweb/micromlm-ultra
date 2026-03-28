{{-- Matrix Plan Page for sitemap.xml  --}}
@extends('layouts.website')
@section('title', 'Matrix Plan - '.config('app.name'))
@section('meta_desc', 'Learn about our Matrix MLM Plan, designed to provide structured growth and balanced team development for your network marketing business.')
@section('content')
    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Matrix MLM Plan</h1>
                    <p class="lead mb-5 opacity-75">Learn about our Matrix MLM Plan, designed to provide structured growth and balanced team development for your network marketing business.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="matrix-plan-details" class="py-5">
        <div class="container py-5">
            <h2 class="fw-bold mb-4 text-center">Why Choose the Matrix MLM Plan?</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Structured Growth</h4>
                        <p class="text-muted">The Matrix MLM Plan provides a fixed width and depth, encouraging members to focus on building a well-structured team for sustainable growth.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Balanced Team Development</h4>
                        <p class="text-muted">With defined levels, members are motivated to develop their teams evenly, fostering collaboration and support among downlines.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Predictable Earnings</h4>
                        <p class="text-muted">The fixed structure allows members to anticipate their earnings based on team performance, making it easier to set and achieve financial goals.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Enhanced Focus</h4>
                        <p class="text-muted">The Matrix structure helps members concentrate on quality recruitment and team building, leading to a more engaged and productive network.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3 class="fw-bold mb-4">Ready to Get Started?</h3>
            <a href="{{ route('welcome') }}" class="btn btn-primary btn-lg">Get the Matrix Plan MLM</a>
        </div>
    </section>
@endsection