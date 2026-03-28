{{-- Unilevel Plan Page for sitemap.xml  --}}
@extends('layouts.website')
@section('title', 'Unilevel Plan - '.config('app.name'))
@section('meta_desc', 'Explore the benefits of our Unilevel MLM Plan, offering unlimited width and straightforward commission structures to help you grow your network marketing business effectively.')
@section('content')
    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Unilevel MLM Plan</h1>
                    <p class="lead mb-5 opacity-75">Explore the benefits of our Unilevel MLM Plan, offering unlimited width and straightforward commission structures to help you grow your network marketing business effectively.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="unilevel-plan-details" class="py-5">
        <div class="container py-5">
            <h2 class="fw-bold mb-4 text-center">Why Choose the Unilevel MLM Plan?</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Unlimited Width</h4>
                        <p class="text-muted">The Unilevel MLM Plan allows members to recruit an unlimited number of direct referrals, providing greater flexibility and growth potential for your network.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Straightforward Commissions</h4>
                        <p class="text-muted">With a simple commission structure based on levels, members can easily understand and maximize their earnings without complex calculations.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Enhanced Team Building</h4>
                        <p class="text-muted">The Unilevel structure encourages members to focus on building strong teams, fostering collaboration and support among downlines for collective success.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4">
                        <h4>Flexibility in Growth</h4>
                        <p class="text-muted">Members can expand their networks without restrictions on width, allowing for diverse recruitment strategies and rapid business expansion.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3 class="fw-bold mb-4">Ready to Get Started?</h3>
            <a href="{{ route('welcome') }}" class="btn btn-primary btn-lg">Get the Unilevel Plan MLM</a>
        </div>
    </section>
@endsection