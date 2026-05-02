<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A-Rent System — Car Rental Davao</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .hero-bg { background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 60%, #0f172a 100%); }
        .nav-link { color: #cbd5e1; text-decoration: none; font-size: 0.9rem; transition: color 0.2s; }
        .nav-link:hover { color: white; }
        .btn-primary { background: #e8b4b8; color: #1a1a2e; padding: 12px 28px; border-radius: 8px; font-weight: 700; text-decoration: none; display: inline-block; transition: background 0.2s; border: none; cursor: pointer; }
        .btn-primary:hover { background: #d4929a; }
        .btn-outline { border: 2px solid #e8b4b8; color: #e8b4b8; padding: 10px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-block; transition: all 0.2s; }
        .btn-outline:hover { background: #e8b4b8; color: #1a1a2e; }
        .trust-strip { background: rgba(255,255,255,0.05); border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1); }
        .feature-card { background: white; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center; transition: transform 0.2s; }
        .feature-card:hover { transform: translateY(-4px); }
        .feature-icon { width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 28px; }
        .car-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.08); transition: transform 0.2s, box-shadow 0.2s; }
        .car-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.14); }
        .badge-available { background: #dcfce7; color: #16a34a; padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .cta-bg { background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%); }
    </style>
</head>
<body style="margin:0; background:#f8fafc;">

    {{-- NAVBAR --}}
    <nav style="background: #0f172a; padding: 16px 40px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100;">
        <div style="color: white; font-weight: 800; font-size: 1.3rem; letter-spacing: -0.5px;">
            A-Rent System
        </div>
        <div style="display: flex; gap: 32px; align-items: center;">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="{{ route('cars.index') }}" class="nav-link">Our Cars</a>
            <a href="#about" class="nav-link">About Us</a>
            <a href="#contact" class="nav-link">Contact</a>
        </div>
        <div style="display: flex; gap: 12px;">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-outline">Login</a>
                <a href="{{ route('register') }}" class="btn-primary">Register</a>
            @endauth
        </div>
    </nav>

    {{-- HERO --}}
    <section class="hero-bg" style="padding: 80px 40px; display: flex; align-items: center; justify-content: space-between; min-height: 520px;">
        <div style="max-width: 540px; color: white;">
            <span style="background: #e8b4b8; color: #1a1a2e; padding: 6px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; margin-bottom: 20px; display: inline-block;">
                #1 Trusted in Davao
            </span>
            <h1 style="font-size: 3rem; font-weight: 800; line-height: 1.1; margin: 16px 0;">
                Rent a Car with<br>Ease — Anytime,<br><span style="color: #e8b4b8;">Anywhere</span>
            </h1>
            <p style="color: #94a3b8; font-size: 1rem; line-height: 1.7; margin-bottom: 32px;">
                Browse our wide selection of vehicles, well-maintained fleet, hassle-free booking. Self-drive or with driver available.
            </p>
            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                <a href="{{ route('cars.index') }}" class="btn-primary" style="font-size: 1rem; padding: 14px 32px;">Book Now</a>
                <a href="{{ route('cars.index') }}" class="btn-outline" style="font-size: 1rem; padding: 14px 32px;">View Cars</a>
            </div>
        </div>
        <div style="flex-shrink: 0;">
            <img src="/images/cars/Toyota-Fw.webp" alt="Featured Car"
                 style="width: 500px; height: 320px; object-fit: cover; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.4);">
            <div style="margin-top: 12px; background: rgba(255,255,255,0.1); border-radius: 12px; padding: 12px 20px; color: white; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 0.75rem; color: #94a3b8;">FEATURED</div>
                    <div style="font-weight: 700;">Toyota Fortuner</div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 0.75rem; color: #94a3b8;">FROM</div>
                    <div style="font-weight: 700; color: #e8b4b8;">₱3,500.00/day</div>
                </div>
            </div>
        </div>
    </section>

    {{-- TRUST STRIP --}}
    <section class="trust-strip hero-bg" style="padding: 24px 40px;">
        <div style="display: flex; justify-content: center; gap: 80px; color: white; text-align: center;">
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #e8b4b8;">50+</div>
                <div style="font-size: 0.8rem; color: #94a3b8;">Vehicles Available</div>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #e8b4b8;">1,200+</div>
                <div style="font-size: 0.8rem; color: #94a3b8;">Happy Customers</div>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #e8b4b8;">5+</div>
                <div style="font-size: 0.8rem; color: #94a3b8;">Years of Service</div>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #e8b4b8;">24/7</div>
                <div style="font-size: 0.8rem; color: #94a3b8;">Customer Support</div>
            </div>
        </div>
    </section>

    {{-- WHY CHOOSE US --}}
    <section id="about" style="padding: 80px 40px; background: #f8fafc;">
        <div style="text-align: center; margin-bottom: 48px;">
            <h2 style="font-size: 2rem; font-weight: 800; color: #0f172a;">Why choose us?</h2>
            <p style="color: #64748b;">We provide the best car rental experience in Davao</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; max-width: 1000px; margin: 0 auto;">
            <div class="feature-card">
                <div class="feature-icon" style="background: #fce7f3;">📅</div>
                <h3 style="font-weight: 700; margin-bottom: 8px;">Easy Booking</h3>
                <p style="color: #64748b; font-size: 0.9rem;">Book your car online in just a few clicks. Simple form, instant confirmation.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: #dcfce7;">✅</div>
                <h3 style="font-weight: 700; margin-bottom: 8px;">Safe and Reliable</h3>
                <p style="color: #64748b; font-size: 0.9rem;">All our vehicles are well-maintained and regularly inspected for your safety.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: #fef3c7;">💰</div>
                <h3 style="font-weight: 700; margin-bottom: 8px;">Affordable Rates</h3>
                <p style="color: #64748b; font-size: 0.9rem;">Competitive pricing with no hidden charges. Pay only for what you need.</p>
            </div>
        </div>
    </section>

    {{-- FEATURED VEHICLES --}}
    <section style="padding: 80px 40px; background: white;">
        <div style="text-align: center; margin-bottom: 48px;">
            <h2 style="font-size: 2rem; font-weight: 800; color: #0f172a;">Featured Vehicles</h2>
            <p style="color: #64748b;">Choose from our wide selection of well-maintained cars</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; max-width: 1100px; margin: 0 auto 40px;">

            {{-- Card 1 --}}
            <div class="car-card">
                <img src="/images/cars/vios.png" alt="Toyota Vios" style="width:100%; height:180px; object-fit:cover;">
                <div style="padding: 16px;">
                    <div style="font-size:0.75rem; color:#e8b4b8; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Toyota</div>
                    <div style="font-weight:700; font-size:1rem; color:#0f172a; margin:4px 0 8px;">Vios <span style="font-weight:400; color:#94a3b8; font-size:0.85rem;">2022</span></div>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:12px; padding-top:12px; border-top:1px solid #f1f5f9;">
                        <div>
                            <div style="font-weight:700; color:#0f172a;">₱1,000.00<span style="font-weight:400; color:#94a3b8; font-size:0.8rem;">/day</span></div>
                            <span class="badge-available">Available</span>
                        </div>
                        <a href="{{ route('cars.index') }}" class="btn-primary" style="padding:8px 16px; font-size:0.82rem;">Rent Now</a>
                    </div>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="car-card">
                <img src="/images/cars/Toyota-Fw.webp" alt="Toyota Fortuner" style="width:100%; height:180px; object-fit:cover;">
                <div style="padding: 16px;">
                    <div style="font-size:0.75rem; color:#e8b4b8; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Toyota</div>
                    <div style="font-weight:700; font-size:1rem; color:#0f172a; margin:4px 0 8px;">Fortuner <span style="font-weight:400; color:#94a3b8; font-size:0.85rem;">2024</span></div>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:12px; padding-top:12px; border-top:1px solid #f1f5f9;">
                        <div>
                            <div style="font-weight:700; color:#0f172a;">₱3,500.00<span style="font-weight:400; color:#94a3b8; font-size:0.8rem;">/day</span></div>
                            <span class="badge-available">Available</span>
                        </div>
                        <a href="{{ route('cars.index') }}" class="btn-primary" style="padding:8px 16px; font-size:0.82rem;">Rent Now</a>
                    </div>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="car-card">
                <img src="/images/cars/civic.jpg" alt="Honda Civic" style="width:100%; height:180px; object-fit:cover;">
                <div style="padding: 16px;">
                    <div style="font-size:0.75rem; color:#e8b4b8; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Honda</div>
                    <div style="font-weight:700; font-size:1rem; color:#0f172a; margin:4px 0 8px;">Civic <span style="font-weight:400; color:#94a3b8; font-size:0.85rem;">2023</span></div>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:12px; padding-top:12px; border-top:1px solid #f1f5f9;">
                        <div>
                            <div style="font-weight:700; color:#0f172a;">₱1,200.00<span style="font-weight:400; color:#94a3b8; font-size:0.8rem;">/day</span></div>
                            <span class="badge-available">Available</span>
                        </div>
                        <a href="{{ route('cars.index') }}" class="btn-primary" style="padding:8px 16px; font-size:0.82rem;">Rent Now</a>
                    </div>
                </div>
            </div>

        </div>
        <div style="text-align: center;">
            <a href="{{ route('cars.index') }}" class="btn-primary" style="font-size: 1rem; padding: 14px 40px;">View All Cars</a>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta-bg" style="padding: 80px 40px; text-align: center;" id="contact">
        <h2 style="font-size: 2.2rem; font-weight: 800; color: white; margin-bottom: 16px;">Ready to hit the Road?</h2>
        <p style="color: #94a3b8; margin-bottom: 32px; font-size: 1rem;">Create an account here and Start renting your favorite Car today!</p>
        <div style="display: flex; gap: 16px; justify-content: center;">
            <a href="{{ route('register') }}" class="btn-primary" style="font-size: 1rem; padding: 14px 32px;">Get Started — Register</a>
            <a href="{{ route('login') }}" class="btn-outline" style="font-size: 1rem; padding: 14px 32px;">Login To my account</a>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer style="background: #0f172a; color: #64748b; padding: 32px 40px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div style="color: white; font-weight: 700; margin-bottom: 4px;">A-RENT SYSTEM — Davao City, Philippines</div>
            <div style="font-size: 0.8rem;">© 2026 A-RENT SYSTEM. All rights reserved.</div>
        </div>
        <div style="display: flex; gap: 24px;">
            <a href="{{ url('/') }}" style="color: #64748b; text-decoration: none; font-size: 0.85rem;">Home</a>
            <a href="{{ route('cars.index') }}" style="color: #64748b; text-decoration: none; font-size: 0.85rem;">Our Cars</a>
            <a href="#contact" style="color: #64748b; text-decoration: none; font-size: 0.85rem;">Contact Us</a>
            <a href="{{ route('login') }}" style="color: #64748b; text-decoration: none; font-size: 0.85rem;">Terms</a>
        </div>
    </footer>

</body>
</html>