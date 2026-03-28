{{--contact details page for sitemap.xml --}}
@extends('layouts.website')
@section('title', 'Contact Us - '.config('app.name'))
@section('meta_desc', 'Get in touch with our expert team for personalized MLM software solutions, support, and consultations to help scale your network marketing business effectively.')
@section('content')
    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Contact Us</h1>
                    <p class="lead mb-5 opacity-75">We're here to help you with any questions or support you need regarding our MLM software solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact-info" class="py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6">
                    <div class="card h-100 p-4 text-center">
                        <div class="mb-3 text-primary">
                            <i class="fa fa-phone fa-2x"></i>
                        </div>
                        <h4>Phone Support</h4>
                        <p class="text-muted">Call us for expert consultation and support.</p>
                        <a href="tel:+919101177123" class="btn btn-outline-primary mt-2">+91 9101177123</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4 text-center">
                        <div class="mb-3 text-primary">
                            <i class="fa fa-whatsapp fa-2x"></i>
                        </div>
                        <h4>WhatsApp Support</h4>
                        <p class="text-muted">Chat with us on WhatsApp for quick assistance.</p>
                        <a href="https://wa.me/919101177123" target="_blank" class="btn btn-outline-primary mt-2">Chat on WhatsApp</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4 text-center">
                        <div class="mb-3 text-primary">
                            <i class="fa fa-envelope fa-2x"></i>
                        </div>
                        <h4>Email Support</h4>
                        <p class="text-muted">Reach out to us via email for any inquiries.</p>
                        <a href="mailto:support.micromlm@gmail.com" class="btn btn-outline-primary mt-2">support.micromlm@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection