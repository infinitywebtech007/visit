<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetPass - Smart Meeting & Visitor Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        :root {
            --gradient-primary: linear-gradient(135deg, #14DE3E 0%, #00b8d4 100%);
            --gradient-secondary: linear-gradient(135deg, #14DE3E 0%, #00acc1 50%, #0097a7 100%);
            --emerald-green: #14DE3E;
            --blue-green: #00b8d4;
            --teal: #00acc1;
            --cyan: #0097a7;
            --dark-green: #0f9d33;
            --light-green: #e8f8f0;
            --text-on-green: #ffffff;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            overflow-x: hidden;
        }

        /* Header Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--emerald-green) !important;
        }

        .btn-gradient {
            background: var(--gradient-primary);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 30px;
            padding: 12px 24px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(20, 222, 62, 0.3);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            background: var(--gradient-secondary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)" /></svg>');
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding-top: 100px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .btn-hero-primary {
            background: white;
            color: var(--emerald-green);
            padding: 15px 30px;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            margin-right: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(255, 255, 255, 0.3);
            color: var(--dark-green);
        }

        .btn-hero-secondary {
            background: transparent;
            color: white;
            padding: 15px 30px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
            color: white;
        }

        /* Dashboard Mockup */
        .dashboard-mockup {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
            transform: perspective(1000px) rotateY(-15deg) rotateX(10deg);
            transition: transform 0.3s ease;
            animation: float 6s ease-in-out infinite;
        }

        .dashboard-mockup:hover {
            transform: perspective(1000px) rotateY(-10deg) rotateX(5deg);
        }

        .mockup-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .mockup-dots {
            display: flex;
            gap: 6px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .dot:nth-child(1) { background: #ff5f57; }
        .dot:nth-child(2) { background: #ffbd2e; }
        .dot:nth-child(3) { background: #28ca42; }

        .meeting-card {
            background: linear-gradient(135deg, var(--light-green), #e0f7fa);
            padding: 15px;
            border-radius: 12px;
            border-left: 4px solid var(--emerald-green);
            margin-bottom: 10px;
        }

        .meeting-time {
            font-weight: 600;
            color: var(--emerald-green);
            font-size: 0.9rem;
        }

        .meeting-title {
            font-weight: 600;
            color: #333;
            margin: 5px 0;
        }

        .meeting-guest {
            color: #666;
            font-size: 0.9rem;
        }

        @keyframes float {
            0%, 100% { transform: perspective(1000px) rotateY(-15deg) rotateX(10deg) translateY(0px); }
            50% { transform: perspective(1000px) rotateY(-15deg) rotateX(10deg) translateY(-20px); }
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: #f8fffe;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 4rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(29, 209, 161, 0.1);
            height: 100%;
            margin-bottom: 2rem;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(20, 222, 62, 0.12);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* How it Works */
        .how-it-works {
            background: linear-gradient(135deg, #f0fff4, #e0f8ff);
            padding: 100px 0;
        }

        .step {
            text-align: center;
            margin-bottom: 3rem;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 1.5rem;
        }

        .step h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }

        .step p {
            color: #666;
            margin-bottom: 0;
        }

        /* Final CTA */
        .final-cta {
            background: var(--gradient-secondary);
            padding: 100px 0;
            color: white;
        }

        .final-cta h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .final-cta p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 50px 0 20px;
        }

        .footer h5 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: white;
        }

        .footer a {
            color: #ccc;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--emerald-green);
        }

        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 2rem;
            margin-top: 2rem;
            text-align: center;
            color: #999;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .dashboard-mockup {
                transform: none;
                margin-top: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .final-cta h2 {
                font-size: 2rem;
            }
        }

        /* Animation delays for feature cards */
        .feature-card:nth-child(1) { animation-delay: 0.1s; }
        .feature-card:nth-child(2) { animation-delay: 0.2s; }
        .feature-card:nth-child(3) { animation-delay: 0.3s; }
        .feature-card:nth-child(4) { animation-delay: 0.4s; }
        .feature-card:nth-child(5) { animation-delay: 0.5s; }
        .feature-card:nth-child(6) { animation-delay: 0.6s; }

        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">MeetPass</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-4">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                @if (Route::has('login'))
                    @auth                        
                            <a href="{{ url('/home') }}" class=" btn-gradient mx-1"> Dashboard </a>
                    @else                        
                            <a href="{{ route('login') }}" class="btn-gradient mx-1" >Log in</a>
                    
                        @if (Route::has('register'))                            
                                <a href="{{ route('register') }}" class="btn-gradient mx-1" >Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="hero-title">Smart Meeting Management Made Simple</h1>
                        <p class="hero-subtitle">Streamline visitor registration, generate digital passes, and schedule meetings without conflicts. Perfect for busy professionals and teams.</p>
                        <div class="hero-buttons">
                            <a href="#" class="btn-hero-primary">Start Free Trial</a>
                            <a href="#" class="btn-hero-secondary">Watch Demo</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard-mockup">
                            <div class="mockup-header">
                                <div class="mockup-dots">
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                </div>
                            </div>
                            <div class="mockup-content">
                                <div class="meeting-card">
                                    <div class="meeting-time">9:00 AM - 10:00 AM</div>
                                    <div class="meeting-title">Client Consultation</div>
                                    <div class="meeting-guest">John Smith • john@example.com</div>
                                </div>
                                <div class="meeting-card">
                                    <div class="meeting-time">11:30 AM - 12:30 PM</div>
                                    <div class="meeting-title">Team Standup</div>
                                    <div class="meeting-guest">Sarah Johnson • sarah@company.com</div>
                                </div>
                                <div class="meeting-card">
                                    <div class="meeting-time">2:00 PM - 3:00 PM</div>
                                    <div class="meeting-title">Project Review</div>
                                    <div class="meeting-guest">Mike Chen • mike@startup.io</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Powerful Features</h2>
                    <p class="section-subtitle">Everything you need to manage meetings and visitors efficiently</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h3>Smart Scheduling</h3>
                        <p>Automatic conflict detection ensures no overlapping meetings. Visitors can book available slots in real-time.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-ticket-perforated"></i>
                        </div>
                        <h3>Digital Visitor Passes</h3>
                        <p>Generate secure digital passes with QR codes. Visitors receive passes via email with all meeting details.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3>Team Dashboard</h3>
                        <p>View all meetings organized by day and client. Perfect for team coordination and client management.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h3>Easy Registration</h3>
                        <p>Simple form for visitors to register with just name, email, and phone number. No complicated sign-ups.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-bell"></i>
                        </div>
                        <h3>Notifications</h3>
                        <p>Automated email confirmations and reminders keep everyone informed about upcoming meetings.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3>Secure & Private</h3>
                        <p>Enterprise-grade security ensures visitor data and meeting information remain protected.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="how-it-works">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">How It Works</h2>
                    <p class="section-subtitle">Get started in three simple steps</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3>Visitor Registers</h3>
                        <p>Anyone can easily register for a meeting by providing their basic contact details and preferred time slots.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <div class="step-number">2</div>
                        <h3>System Schedules</h3>
                        <p>Our smart algorithm checks for conflicts and automatically schedules the meeting at the best available time.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <div class="step-number">3</div>
                        <h3>Digital Pass Sent</h3>
                        <p>Visitor receives a digital pass with QR code via email, and you get notified about the new meeting.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="final-cta">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Ready to Streamline Your Meetings?</h2>
                    <p>Join thousands of professionals who trust MeetPass for their meeting management</p>
                    <a href="#" class="btn-hero-primary" style="font-size: 1.2rem; padding: 18px 36px;">Start Your Free Trial</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5>Product</h5>
                    <a href="#">Features</a>
                    <a href="#">Pricing</a>
                    <a href="#">API</a>
                    <a href="#">Security</a>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Company</h5>
                    <a href="#">About</a>
                    <a href="#">Blog</a>
                    <a href="#">Careers</a>
                    <a href="#">Press</a>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Support</h5>
                    <a href="#">Help Center</a>
                    <a href="#">Documentation</a>
                    <a href="#">Contact</a>
                    <a href="#">System Status</a>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Legal</h5>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 MeetPass. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navbarHeight = document.querySelector('.navbar').offsetHeight;
                    const targetPosition = target.offsetTop - navbarHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.05)';
            }
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        // Observe feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });

        // Add click handlers for demo buttons
        document.querySelectorAll('.btn-hero-primary, .btn-hero-secondary, .btn-gradient').forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                    // Add your functionality here
                    console.log('Button clicked:', this.textContent.trim());
                    
                    // Example: Show alert for demo purposes
                    if (this.textContent.includes('Start Free Trial')) {
                        alert('Redirecting to sign-up page...');
                    } else if (this.textContent.includes('Watch Demo')) {
                        alert('Opening demo video...');
                    } else if (this.textContent.includes('Get Started')) {
                        alert('Getting started...');
                    }
                }
            });
        });

        // Mobile menu close on link click
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    bootstrap.Collapse.getInstance(navbarCollapse).hide();
                }
            });
        });
    </script>
</body>
</html>