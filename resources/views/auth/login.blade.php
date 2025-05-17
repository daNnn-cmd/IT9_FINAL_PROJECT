@extends('template.auth')
@section('title', 'ChrisDanVan Hotel')
@section('content')
    <link href="{{ asset('style/css/stylelogin.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-color:rgb(23, 1, 70);
            --secondary-color:rgb(36, 19, 113);
            --text-color: #333;
            --light-color:rgb(62, 15, 145);
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a2a6c, #b21f1f);
            color: var(--text-color);
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.5;
            filter: blur(30px);
            animation: float 15s ease-in-out infinite alternate;
        }

        .shape1 {
            width: 300px;
            height: 300px;
            background: rgba(0, 153, 255, 0.2);
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape2 {
            width: 200px;
            height: 200px;
            background: rgba(0, 196, 255, 0.15);
            bottom: 10%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape3 {
            width: 250px;
            height: 250px;
            background: rgba(123, 206, 255, 0.15);
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape4 {
            width: 180px;
            height: 180px;
            background: rgba(167, 220, 255, 0.1);
            top: 30%;
            right: 10%;
            animation-delay: 6s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) translateX(0) rotate(0deg) scale(1);
            }
            50% {
                transform: translateY(-20px) translateX(15px) rotate(5deg) scale(1.05);
            }
            100% {
                transform: translateY(10px) translateX(-15px) rotate(-5deg) scale(0.95);
            }
        }

        .wave-container {
            position: absolute;
            width: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .wave-top {
            top: 0;
            left: 0;
        }

        .wave-bottom {
            bottom: 0;
            left: 0;
        }

        .wave-top svg {
            animation: waveTop 15s ease-in-out infinite alternate;
        }

        .wave-bottom svg {
            animation: waveBottom 12s ease-in-out infinite alternate;
        }

        @keyframes waveTop {
            0% {
                transform: translateX(0) translateY(0);
            }
            100% {
                transform: translateX(-5%) translateY(-10px);
            }
        }

        @keyframes waveBottom {
            0% {
                transform: translateX(0) translateY(0);
            }
            100% {
                transform: translateX(5%) translateY(10px);
            }
        }

        /* Floating Particles */
        .particle {
            position: absolute;
            background: rgba(54, 0, 249, 0.5);
            border-radius: 50%;
            pointer-events: none;
            animation: particleFloat linear infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            50% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(-100vh) translateX(20px);
                opacity: 0;
            }
        }

        .card-container {
            padding: 3rem 0;
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            box-shadow: 0 15px 35px var(--shadow-color);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: cardAppear 1s ease-out forwards;
        }

        @keyframes cardAppear {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glassmorphism:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .logo-container {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            width: 110px;
            height: 110px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0, 153, 255, 0.3);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
            animation: logoSpin 2s ease-out;
        }

        @keyframes logoSpin {
            0% {
                transform: scale(0) rotate(-180deg);
                opacity: 0;
            }
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
        }

        .logo-container:hover {
            transform: scale(1.05);
        }

        .logo-container img {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            object-fit: cover;
            background-color: white;
            padding: 5px;
        }

        .card-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            text-shadow: 0 2px 4px var(--shadow-color);
            animation: fadeUp 1s ease-out forwards;
            animation-delay: 0.5s;
            opacity: 0;
        }

        .text-muted {
            animation: fadeUp 1s ease-out forwards;
            animation-delay: 0.1s;
            opacity: 0;
        }

        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1.5rem;
            animation: fadeUp 1s ease-out forwards;
            opacity: 0;
        }

        .form-label-group:nth-of-type(1) {
            animation-delay: 0.9s;
        }

        .form-label-group:nth-of-type(2) {
            animation-delay: 0ms;
        }

        .form-control {
            height: 50px;
            border-radius: 10px;
            padding: 1.2rem 1rem 0.5rem;
            font-size: 1rem;
            border: 2px solid #e1e5eb;
            transition: all 0.3s ease;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(0, 153, 255, 0.2);
        }

        .form-label-group label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            padding: 0.75rem 1rem;
            color: #757575;
            border: 1px solid transparent;
            transition: all 0.25s ease-in-out;
            pointer-events: none;
        }

        .form-label-group input:focus ~ label,
        .form-label-group input:not(:placeholder-shown) ~ label {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
            font-size: 0.75rem;
            color: var(--primary-color);
            font-weight: bold;
        }

        .d-flex.justify-content-between {
            animation: fadeUp 1s ease-out forwards;
            animation-delay: 1.3s;
            opacity: 0;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 50px;
            padding: 300px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 1rem;
            box-shadow: 0 8px 15px rgba(0, 153, 255, 0.3);
            transition: all 0.3s ease;
            min-width: 200px;
            position: relative;
            overflow: hidden;
            z-index: 1;
            animation: fadeUp 1s ease-out forwards;
            animation-delay: 1.5s;
            opacity: 0;
        }

        .btn-login:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0.2), transparent);
            transition: all 0.4s ease;
            z-index: -1;
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

       .btn-login:hover {
    color: #ffffff; /* or any color you prefer */
    background-color: var(--primary-color); /* optional */
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
}


        .btn-login.isLoading {
            width: 50px;
            border-radius: 50px;
        }

        .spinner-border {
            width: 1.5rem;
            height: 1.5rem;
            color: white;
        }

        .hide {
            display: none;
        }

        .separator, .social-login, .text-center.mt-4 {
            animation: fadeUp 1s ease-out forwards;
            opacity: 0;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: #757575;
            animation-delay: 1.7s;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e1e5eb;
        }

        .separator::before {
            margin-right: 1rem;
        }

        .separator::after {
            margin-left: 1rem;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
            animation-delay: 1.9s;
        }

        .text-center.mt-4 {
            animation-delay: 2.1s;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e1e5eb;
            transition: all 0.3s ease;
            background: white;
            color: #757575;
            font-size: 1.2rem;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: block;
            font-weight: 500;
        }

        .forgot-password:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .glassmorphism {
                padding: 1.5rem;
            }
            
            .floating-shape {
                opacity: 0.2;
            }
        }
    </style>
    
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="floating-shape shape1"></div>
        <div class="floating-shape shape2"></div>
        <div class="floating-shape shape3"></div>
        <div class="floating-shape shape4"></div>
    </div>
    
    <!-- Top Wave -->
    <div class="wave-container wave-top">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="var(--primary-color)" fill-opacity="0.3"
                d="M0,224L48,186.7C96,149,192,75,288,42.7C384,11,480,21,576,74.7C672,128,768,224,864,256C960,288,1056,256,1152,234.7C1248,213,1344,203,1392,197.3L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
            </path>
        </svg>
    </div>

    <div class="card-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12 mx-auto">
                    <div class="glassmorphism">
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <div class="logo-container">
                                    <img src="{{ asset('img/logo/1694675477283 (1).png') }}" alt="ChrisDanVan Hotel Logo">
                                </div>
                            </div>
                            <h3 class="card-title">ChrisDanVan Hotel Reservation and Services System</h3>
                            <p class="text-muted mb-4">LOG-IN</p>

                            @if (session('failed'))
    <div class="alert alert-danger text-center" role="alert">
        {{ session('failed') }}
    </div>
@endif

                        </div>
                        
                        <form id="form-login" class="form-signin" action="/login" method="POST">
                            @csrf
                            <div class="form-label-group">
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                    value="{{ old('email') }}" required autofocus>
                                <label for="email">Email</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-label-group">
                                <input type="password" id="password" name="password" autocomplete="new-password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" required>
                                <label for="password">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            
                            
                            <div class="d-flex justify-content-center">
                                <button id="btn_submit" class="btn btn-login w-100" type="submit">

                                    <span id="loading_submit" class="spinner-border hide" role="status"></span>
                                    <span id="text_submit">Sign In</span>
                                </button>
                            </div>
                            
                            <div class="separator">Or continue with</div>
                            
                            <div class="social-login">
                                <button type="button" class="social-btn">
                                    <i class="fab fa-google"></i>
                                </button>
                               <button type="button" class="social-btn" onclick="window.open('https://www.facebook.com/daniel.pelpinosas')">
    <i class="fab fa-facebook-f"></i>
</button>
                                <button type="button" class="social-btn">
                                    <i class="fab fa-twitter"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Wave -->
    <div class="wave-container wave-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="var(--primary-color)" fill-opacity="0.3"
                d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,122.7C672,149,768,235,864,234.7C960,235,1056,149,1152,117.3C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-login');
            const btnSubmit = document.getElementById('btn_submit');
            const loadingSubmit = document.getElementById('loading_submit');
            const textSubmit = document.getElementById('text_submit');

            form.addEventListener('submit', function() {
                btnSubmit.classList.add('isLoading');
                textSubmit.classList.add('hide');
                loadingSubmit.classList.remove('hide');
            });
            
            // Create floating particles
            createParticles();
        });
        
        function createParticles() {
            const animatedBg = document.querySelector('.animated-bg');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random particle properties
                const size = Math.random() * 5 + 2; // 2-7px
                const posX = Math.random() * 100; // 0-100%
                const duration = Math.random() * 20 + 10; // 10-30s
                const delay = Math.random() * 5; // 0-5s
                
                // Set particle styles
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}%`;
                particle.style.bottom = '-5%';
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${delay}s`;
                
                animatedBg.appendChild(particle);
            }
        }
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-login');
        const submitBtn = document.getElementById('btn_submit');
        const loadingIcon = document.getElementById('loading_submit');
        const submitText = document.getElementById('text_submit');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            submitBtn.classList.add('isLoading');
            loadingIcon.classList.remove('hide');
            submitText.classList.add('hide');
           
            setTimeout(() => {
                form.submit(); 
            }, 100); 
        });
    });
</script>

@endsection