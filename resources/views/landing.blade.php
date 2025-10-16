<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts / Styles via Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Page-specific tweaks */
        .topbar { font-size: 0.9rem; }
        .variety-card img { object-fit: contain; height: 160px; }
        .hero {
            background: url('{{ asset('images/img/cashew1.jpg') }}') center/cover no-repeat;
            color: #fff;
            min-height: 320px;
            position: relative;
        }
        .hero::after { /* dark overlay for readability */
            content: '';
            position: absolute; inset: 0; background: rgba(0,0,0,0.45);
        }
        .hero-content { position: relative; z-index: 1; }
        footer a { text-decoration: none; }

        .truck-icon {
            font-size: 5rem;
            color: #639b33;
            display: inline-block;
            animation: moveTruck 3s linear infinite;
        }

        @keyframes moveTruck {
            0%   { transform: translateX(0); }
            50%  { transform: translateX(15px); }
            100% { transform: translateX(0); }
        }

        .order-text {
            font-size: 1.1rem;
            font-weight: 800;
            margin-left: 1em;
            color: #e77a29;

        }
    </style>
</head>
<body>
<div id="app">
    <!-- Top bar with contact snippets (no auth links) -->
    <div class="topbar bg-dark text-white py-1">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <small><i class="bi bi-geo-alt me-1"></i> Cuddalore, Tamil Nadu</small>
            </div>
            <div class="d-flex gap-3">
                <small><i class="bi bi-telephone me-1"></i> +91 74182 77696</small>
                <small><i class="bi bi-envelope me-1"></i> akcashews.nut@gmail.com</small>
            </div>
        </div>
    </div>

    <!-- Branding navbar (no login/register) -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('images/img/akcashewslogo.png') }}" alt="AK Cashews" style="height:38px;">
               <span>AK Cashews</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#varieties">Varieties</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/shop') }}">Buy</a></li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ url('/cart') }}">
                            <i class="bi bi-cart"></i> Cart
                            @php($cartCount = collect(session('cart', []))->sum('qty'))
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero banner -->
    <!-- <section class="hero d-flex align-items-center">
        <div class="container hero-content py-5">
            <h1 class="display-5 fw-bold">Premium Cashew Varieties</h1>
            <p class="lead mb-4">Handpicked quality, rich flavor, and consistent grading for your needs.</p>
            <a href="#varieties" class="btn btn-primary btn-lg">Explore Varieties</a>
        </div>
    </section> -->
    <section class="hero d-flex align-items-center">
        <div class="container hero-content py-5">
            <h1 class="display-5 fw-bold">Premium Cashew Varieties</h1>
            <p class="lead mb-4">{{ $heroMessage }}</p>
            <a href="#varieties" class="btn btn-primary btn-lg">Explore Varieties</a>
        </div>
    </section>

    <!-- Varieties grid -->
    <main class="py-5" id="varieties">
        <div class="container">
            <div class="d-flex align-items-center mt-3">
                <i class="bi bi-truck truck-icon me-2"></i>
                <span class="order-text">
                    Place your order effortlessly through call or WhatsApp, and we’ll deliver it straight to you via courier.
                </span>
            </div>
            <h2 class="mb-4 fw-semibold">Our Cashew Varieties</h2>
            <div class="row g-4">
                

                @foreach($varieties as $item)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card h-100 variety-card shadow-sm">
                            <div class="p-3 text-center bg-light">
                                <img src="{{ asset($item['img']) }}" class="img-fluid" alt="{{ $item['label'] }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mb-2">{{ $item['label'] }}</h5>
                                <p class="card-text text-muted mb-0">High-grade {{ $item['label'] }} cashews with excellent taste and texture.</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- About section (brief) -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <h3 class="fw-semibold">About AK Cashews</h3>
                    <p class="mb-0">We specialize in premium cashew sourcing and processing, ensuring consistent grading and freshness for our customers worldwide.</p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/img/cashew2.jpg') }}" alt="Cashews" class="img-fluid rounded shadow-sm">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer with contact details -->
    <footer id="contact" class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Contact Us</h5>
                    <p class="mb-1"><i class="bi bi-telephone me-2"></i> +91 74182 77696 / +91 96883 33868</p>
                    <p class="mb-1"><i class="bi bi-envelope me-2"></i> akcashews.nut@gmail.com</p>
                    <p class="mb-0"><i class="bi bi-geo-alt me-2"></i> Cuddalore, Tamil Nadu, India</p>
                    <!-- <p class="mb-0"><i><i class="bi bi-clock me-2"></i> Mon-Sun: 9am - 6pm</i></p> -->
                    <p class="mb-0"><i class="bi bi-whatsapp me-2"></i> <a href="https://wa.link/khv55i" class="text-white" target="_blank">+91 88389 65378</a></p>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-1"><a class="text-white-50" href="#varieties">Varieties</a></li>
                        <li class="mb-1"><a class="text-white-50" href="#about">About</a></li>
                        <li class="mb-1"><a class="text-white-50" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center text-white-50 mt-4">
                <small>&copy; {{ date('Y') }} AK Cashews. All rights reserved.</small>
            </div>
        </div>
    </footer>
</div>

<!-- Optional Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>
</html>