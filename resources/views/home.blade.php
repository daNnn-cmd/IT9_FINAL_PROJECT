@extends('layouts.app')

@section('content')
<div class="landing-page">
    <!-- Hero Section with Background Image -->
    <div class="hero-section" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');">
        <div class="container">
            <div class="hero-content text-center text-white">
                <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">Welcome to <span class="text-gradient">HotelEase</span></h1>
                <p class="lead mb-4 animate__animated animate__fadeIn animate__delay-1s">Your premium hotel room reservation and service system</p>
                <div class="d-flex justify-content-center gap-3 animate__animated animate__fadeIn animate__delay-2s">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-pill shadow">
                        <i class="fas fa-tachometer-alt me-2"></i>Enter Dashboard
                    </a>
                    <a href="#features" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill shadow">
                        <i class="fas fa-info-circle me-2"></i>Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Why Choose HotelEase?</h2>
                <p class="text-muted">Experience seamless hotel management with our premium features</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm h-100">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h4>Easy Reservations</h4>
                        <p class="text-muted">Book rooms in just a few clicks with our intuitive interface.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm h-100">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Real-time Analytics</h4>
                        <p class="text-muted">Get insights into your bookings and revenue with powerful dashboards.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 rounded-4 shadow-sm h-100">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4>24/7 Support</h4>
                        <p class="text-muted">Our dedicated team is always ready to assist you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Preview -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Powerful Management Dashboard</h2>
                    <p class="lead mb-4">Take full control of your hotel operations with our comprehensive dashboard.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> View and manage all reservations</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Track room availability in real-time</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Generate detailed reports</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Manage staff permissions</li>
                    </ul>
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-pill shadow mt-3">
                        Explore Dashboard <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="dashboard-preview shadow-lg rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Dashboard Preview" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">What Our Clients Say</h2>
                <p>Trusted by hotels worldwide</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card p-4 rounded-4 h-100">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="mb-4">"HotelEase transformed our reservation process. Bookings are up 30% since we implemented their system."</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson" class="rounded-circle" width="50">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-white-50">Hotel Manager, Grand Plaza</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card p-4 rounded-4 h-100">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="mb-4">"The analytics dashboard alone is worth the investment. We've optimized our pricing strategy based on the data."</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael Chen" class="rounded-circle" width="50">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-white-50">Operations Director, Urban Suites</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card p-4 rounded-4 h-100">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                        </div>
                        <p class="mb-4">"Customer support is exceptional. They helped us customize the system to our unique needs."</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emma Rodriguez" class="rounded-circle" width="50">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Emma Rodriguez</h6>
                                <small class="text-white-50">Owner, Beachside Resort</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5">
        <div class="container">
            <div class="cta-card bg-gradient p-5 rounded-4 shadow-lg">
                <div class="row align-items-center">
                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <h2 class="fw-bold text-white mb-3">Ready to Transform Your Hotel Management?</h2>
                        <p class="text-white-50 mb-0">Join thousands of hotels already using HotelEase to streamline their operations.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ url('/dashboard') }}" class="btn btn-light btn-lg px-4 py-3 rounded-pill shadow">
                            Get Started Now <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Custom Styles -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
    .landing-page {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .hero-section {
        background-size: cover;
        background-position: center;
        padding: 120px 0;
        position: relative;
    }
    
    .hero-content {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .text-gradient {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    
    .feature-card {
        background: white;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0,0,0,0.1);
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .dashboard-preview {
        position: relative;
        overflow: hidden;
        border: 8px solid white;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .dashboard-preview img {
        transition: transform 0.5s ease;
    }
    
    .dashboard-preview:hover img {
        transform: scale(1.03);
    }
    
    .testimonial-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }
    
    .cta-card {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .btn-outline-light:hover {
        background: rgba(255,255,255,0.1);
    }
</style>
@endpush

@endsection