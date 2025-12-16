<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VaxTrack - Vaccination Record Tracker</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #87CEEB;
            --light-blue: #E0F4FF;
            --dark-blue: #4A90A4;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--white) 100%);
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--dark-blue) !important;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--dark-blue) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--primary-blue);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        .btn-custom {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(135, 206, 235, 0.4);
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(135, 206, 235, 0.6);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid var(--primary-blue);
            color: var(--dark-blue);
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.4s ease;
            background: transparent;
        }

        .btn-outline-custom:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(135, 206, 235, 0.4);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: bold;
            color: var(--dark-blue);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: #666;
            margin-bottom: 2rem;
        }

        .hero-image {
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 10px 30px rgba(135, 206, 235, 0.3));
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: var(--white);
        }

        .feature-card {
            background: linear-gradient(135deg, var(--white) 0%, var(--light-blue) 100%);
            border-radius: 20px;
            padding: 40px;
            margin: 20px 0;
            transition: all 0.4s ease;
            border: none;
            box-shadow: 0 5px 20px rgba(135, 206, 235, 0.2);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(135, 206, 235, 0.4);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-blue);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--dark-blue);
            margin-bottom: 15px;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.2);
            animation: modalSlideIn 0.4s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            border: none;
        }

        .modal-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid var(--light-blue);
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(135, 206, 235, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 8px;
        }

        /* Floating Background Elements */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
            opacity: 0.1;
            animation: floatCircle 20s ease-in-out infinite;
        }

        .bg-circle-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            right: 10%;
            animation-delay: 0s;
        }

        .bg-circle-2 {
            width: 200px;
            height: 200px;
            bottom: 20%;
            left: 5%;
            animation-delay: 5s;
        }

        .bg-circle-3 {
            width: 150px;
            height: 150px;
            top: 50%;
            left: 50%;
            animation-delay: 10s;
        }

        @keyframes floatCircle {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            25% {
                transform: translate(30px, -30px) scale(1.1);
            }
            50% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            75% {
                transform: translate(20px, 30px) scale(1.05);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Notification Area -->
    @if (session('success'))
        <div class="alert alert-success text-center mb-0 rounded-0" style="position: fixed; top: 0; left: 0; right: 0; z-index: 1055;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center mb-0 rounded-0" style="position: fixed; top: 0; left: 0; right: 0; z-index: 1055;">
            {{ session('error') }}
        </div>
    @endif
    <div style="height: 56px;"></div> <!-- Spacer for fixed notification -->
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-syringe"></i> VaxTrack
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item ms-3">
                        <button class="btn btn-outline-custom" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-sign-in-alt"></i> Log In
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Background Circles -->
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Track Your Vaccinations With Ease</h1>
                    <p class="hero-subtitle">Keep your family's immunization records organized, secure, and accessible anytime, anywhere.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <button class="btn btn-custom btn-lg" data-bs-toggle="modal" data-bs-target="#registerModal">
                            <i class="fas fa-user-plus"></i> Get Started
                        </button>
                        <button class="btn btn-outline-custom btn-lg">
                            <i class="fas fa-play-circle"></i> Watch Demo
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2913/2913133.png" alt="Vaccination" class="img-fluid hero-image" style="max-width: 500px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold" style="color: var(--dark-blue);">Why Choose VaxTrack?</h2>
                <p class="lead text-muted">Comprehensive vaccination management at your fingertips</p>
            </div>
            <form method="POST" action="{{ route('register.submit') }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="feature-title">Secure & Private</h3>
                        <p class="text-muted">Your health data is encrypted and protected with industry-leading security standards.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="feature-title">Smart Reminders</h3>
                        <p class="text-muted">Never miss a vaccination date with automated reminders and notifications.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="feature-title">Family Management</h3>
                        <p class="text-muted">Manage vaccination records for your entire family in one convenient place.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="feature-title">Access Anywhere</h3>
                        <p class="text-muted">View and update records on any device, anytime, from anywhere in the world.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">Track Progress</h3>
                        <p class="text-muted">Visualize vaccination history and stay on top of upcoming immunizations.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-download"></i>
                        </div>
                        <h3 class="feature-title">Easy Export</h3>
                        <p class="text-muted">Download and share vaccination certificates in multiple formats instantly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">
                        <i class="fas fa-user-plus"></i> Create Your Account
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Full Name</label>
                            <input type="text"  name="name" class="form-control" id="registerName" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="registerEmail" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="registerPassword" placeholder="Create a password" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="registerConfirmPassword" placeholder="Confirm your password" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerRole" class="form-label">Role</label>
                            <select name="role" class="form-control" id="registerRole" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="doctor">Doctor</option>
                                <option value="healthworkers">Health Worker</option>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                I agree to the Terms & Conditions
                            </label>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">
                            <i class="fas fa-rocket"></i> Create Account
                        </button>
                        <div class="text-center mt-3">
                            <p class="text-muted">Already have an account? 
                                <a href="#" style="color: var(--dark-blue); font-weight: 600;" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">
                        <i class="fas fa-sign-in-alt"></i> Welcome Back
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="loginEmail" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginRole" class="form-label">Role</label>
                            <select class="form-control" id="loginRole" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="doctor">Doctor</option>
                                <option value="healthworker">Health Worker</option>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">
                            <i class="fas fa-sign-in-alt"></i> Log In
                        </button>
                        <div class="text-center mt-3">
                            <a href="#" style="color: var(--dark-blue); font-weight: 600;">Forgot Password?</a>
                        </div>
                        <div class="text-center mt-3">
                            <p class="text-muted">Don't have an account? 
                                <a href="#" style="color: var(--dark-blue); font-weight: 600;" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add smooth transition when switching between modals
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(element => {
            element.addEventListener('click', function(e) {
                if (this.hasAttribute('data-bs-dismiss')) {
                    setTimeout(() => {
                        const targetModal = new bootstrap.Modal(document.querySelector(this.getAttribute('data-bs-target')));
                        targetModal.show();
                    }, 300);
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 6px 30px rgba(0, 0, 0, 0.15)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.1)';
            }
        });
    </script>
</body>
</html>