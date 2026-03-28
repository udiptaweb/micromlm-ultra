@extends('layouts.website')
@section('title', 'MLM Software Price in India | Best Investment Plans')

@section('meta_desc', 'Get enterprise-grade MLM software starting at ₹25,000. Free domain, hosting, and automated TDS/GST features included. Compare our Binary and Matrix plan packages.')

@section('content')

    <section class="hero-section text-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Transparent Pricing Plans</h1>
                    <p class="lead mb-4 opacity-75">Invest in a foundation that grows with your network. No hidden costs, just pure performance.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Investment Plans</h2>
                <p class="text-muted">GST Compliant Software for Indian Direct Selling Businesses.</p>
            </div>

            <div class="row g-4 justify-content-center">
                {{-- Essential Starter --}}
                <div class="col-lg-4">
                    <div class="card h-100 shadow-sm border-0 p-4">
                        <div class="card-body d-flex flex-column">
                            <h5 class="text-uppercase text-muted fw-bold small">Essential Starter</h5>
                            <h2 class="display-5 fw-bold my-3">₹25,000</h2>
                            <p class="text-muted small">Ideal for new startups looking for a rapid market entry.</p>
                            <hr>
                            <ul class="list-unstyled mb-auto">
                                <li class="mb-2">✅ <strong>FREE .com or .in Domain</strong></li>
                                <li class="mb-2">✅ <strong>FREE Cloud Hosting (1 Year)</strong></li>
                                <li class="mb-2">✅ Choice of 1 Plan (Binary/Matrix)</li>
                                <li class="mb-2">✅ Member Dashboard & Genealogy</li>
                                <li class="mb-2">✅ Integrated Payment Gateway</li>
                            </ul>
                            <a href="https://wa.me/919101177123?text=I%20am%20interested%20in%20the%20Essential%20Starter%20Plan" class="btn btn-outline-dark w-100 fw-bold py-2 mt-4">Get Started Now</a>
                        </div>
                    </div>
                </div>

                {{-- Business Plus --}}
                <div class="col-lg-4">
                    <div class="card h-100 shadow border-primary border-2 p-4 position-relative">
                        <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-primary px-3">BEST VALUE</span>
                        <div class="card-body d-flex flex-column">
                            <h5 class="text-uppercase text-muted fw-bold small">Business Plus</h5>
                            <h2 class="display-5 fw-bold my-3">₹75,000</h2>
                            <p class="text-muted small">Most popular for companies needing high automation.</p>
                            <hr>
                            <ul class="list-unstyled mb-auto">
                                <li class="mb-2">✅ <strong>High-Speed VPS Hosting</strong></li>
                                <li class="mb-2">✅ Hybrid Compensation Support</li>
                                <li class="mb-2">✅ Automated TDS & Admin Fee Calc</li>
                                <li class="mb-2">✅ SMS Gateway Integration</li>
                                <li class="mb-2">✅ E-Pin & E-Wallet System</li>
                            </ul>
                            <a href="https://wa.me/919101177123?text=I%20am%20interested%20in%20the%20Business%20Plus%20Plan" class="btn btn-primary w-100 fw-bold py-2 shadow-sm mt-4">Inquire Now</a>
                        </div>
                    </div>
                </div>

                {{-- Enterprise Suite --}}
                <div class="col-lg-4">
                    <div class="card h-100 shadow-sm border-0 p-4 bg-dark text-white">
                        <div class="card-body d-flex flex-column">
                            <h5 class="text-uppercase text-light fw-bold small opacity-75">Enterprise Suite</h5>
                            <h2 class="display-6 fw-bold my-3">Custom</h2>
                            <p class="text-light small opacity-75">Tailor-made solutions for massive scaling.</p>
                            <hr class="border-light">
                            <ul class="list-unstyled mb-auto">
                                <li class="mb-2">✅ Custom Plan Logic (Algorithms)</li>
                                <li class="mb-2">✅ Android/iOS App Development</li>
                                <li class="mb-2">✅ Dedicated Server Management</li>
                                <li class="mb-2">✅ Multi-Language Support</li>
                                <li class="mb-2">✅ White-Label Source Code</li>
                            </ul>
                            <a href="{{ route('website.contact') }}" class="btn btn-outline-light w-100 fw-bold py-2 mt-4">Request Quote</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-5 text-center">
                <p class="text-muted small">
                    <i class="bi bi-shield-check text-success me-2"></i>
                    Secure payment via Razorpay, UPI, or Bank Transfer. All payments are 100% secure.
                </p>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3 class="fw-bold mb-4">Have Questions?</h3>
            <a href="{{ route('website.contact') }}" class="btn btn-primary btn-lg">Contact Our Sales Team</a>
        </div>
    </section>
@endsection