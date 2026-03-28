{{-- Binary Plan Page for sitemap.xml  --}}
@extends('layouts.website')
@section('title', 'Binary Plan - ' . config('app.name'))
@section('meta_desc', 'Discover the advantages of our Binary MLM Plan, designed to maximize your network marketing
    potential with balanced growth and optimized earnings.')
@section('content')
    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Binary MLM Plan</h1>
                    <p class="lead mb-5 opacity-75">Discover the advantages of our Binary MLM Plan, designed to maximize your
                        network marketing potential with balanced growth and optimized earnings.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="binary-plan-details" class="py-5">
        <div class="container py-5">
            <h2 class="fw-bold mb-4 text-center">Why Choose the Binary MLM Plan?</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Balanced Growth</h4>
                        <p class="text-muted">The Binary MLM Plan encourages members to build two legs, promoting balanced
                            growth and stability within the network.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Optimized Earnings</h4>
                        <p class="text-muted">With commissions based on the weaker leg, members are motivated to support and
                            grow both sides of their network for maximum profitability.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Simple Structure</h4>
                        <p class="text-muted">The straightforward two-leg structure makes it easy for new members to
                            understand and engage with the plan, fostering quicker recruitment and retention.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Team Support</h4>
                        <p class="text-muted">Members are encouraged to collaborate and support each other, creating a
                            strong sense of community and shared success within the network.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3 class="fw-bold mb-4">Ready to Get Started?</h3>
            <a href="{{ route('welcome') }}" class="btn btn-primary btn-lg">Get the Binary Plan MLM</a>
        </div>
    </section>
@endsection
