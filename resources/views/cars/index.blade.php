<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Cars — A-Rent System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        .cars-page { font-family: 'Poppins', sans-serif; background: #fdf6f6; min-height: 100vh; }

        /* NAVBAR */
        .navbar { background: #0f172a; padding: 16px 40px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        .navbar-brand { color: white; font-weight: 800; font-size: 1.2rem; text-decoration: none; }
        .navbar-links { display: flex; gap: 28px; align-items: center; }
        .nav-link { color: #94a3b8; text-decoration: none; font-size: 0.88rem; font-weight: 500; transition: color 0.2s; }
        .nav-link:hover, .nav-link.active { color: white; }
        .btn-nav { background: #e8b4b8; color: #1a1a2e; padding: 8px 20px; border-radius: 8px; font-weight: 700; text-decoration: none; font-size: 0.88rem; }
        .btn-nav-outline { border: 2px solid #e8b4b8; color: #e8b4b8; padding: 6px 18px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.88rem; }

        .cars-hero { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); color: white; padding: 60px 20px; text-align: center; }
        .cars-hero h1 { font-size: 2.5rem; font-weight: 700; margin-bottom: 10px; }
        .cars-hero p { font-size: 1rem; opacity: 0.8; }
        .filter-bar { background: white; padding: 16px 40px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .filter-bar select, .filter-bar input { padding: 8px 14px; border: 1px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 0.85rem; outline: none; }
        .filter-bar button { background: #e8b4b8; color: #1a1a2e; padding: 8px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-family: 'Poppins', sans-serif; }
        .cars-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; padding: 40px; max-width: 1200px; margin: 0 auto; }
        .car-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.08); transition: transform 0.2s, box-shadow 0.2s; }
        .car-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.14); }
        .car-img { width: 100%; height: 180px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 3rem; }
        .car-img img { width: 100%; height: 100%; object-fit: cover; }
        .car-body { padding: 16px; }
        .car-brand { font-size: 0.75rem; color: #e8b4b8; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .car-name { font-size: 1.1rem; font-weight: 700; color: #1a1a2e; margin: 4px 0 8px; }
        .car-meta { display: flex; gap: 12px; font-size: 0.78rem; color: #6b7280; margin-bottom: 12px; }
        .car-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid #f3f4f6; }
        .car-price { font-size: 1.1rem; font-weight: 700; color: #1a1a2e; }
        .car-price span { font-size: 0.75rem; font-weight: 400; color: #9ca3af; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; }
        .badge-available { background: #dcfce7; color: #16a34a; }
        .badge-rented { background: #fef9c3; color: #ca8a04; }
        .badge-maintenance { background: #fee2e2; color: #dc2626; }
        .rent-btn { background: #e8b4b8; color: #1a1a2e; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 0.82rem; cursor: pointer; font-family: 'Poppins', sans-serif; text-decoration: none; transition: background 0.2s; display: inline-block; }
        .rent-btn:hover { background: #d4929a; }
        .rent-btn-disabled { background: #e5e7eb; color: #9ca3af; cursor: not-allowed; padding: 8px 18px; border-radius: 8px; font-size: 0.82rem; display: inline-block; }
        .empty-state { text-align: center; padding: 80px 20px; color: #9ca3af; }
        .empty-state .icon { font-size: 4rem; margin-bottom: 16px; }
    </style>
</head>
<body>
<div class="cars-page">

    {{-- NAVBAR --}}
    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-brand">A-Rent System</a>
        <div class="navbar-links">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="{{ route('cars.index') }}" class="nav-link active">Our Cars</a>
            <a href="{{ url('/#about') }}" class="nav-link">About Us</a>
            <a href="{{ url('/#contact') }}" class="nav-link">Contact</a>
        </div>
        <div style="display:flex; gap:10px;">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-nav">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-nav-outline">Login</a>
                <a href="{{ route('register') }}" class="btn-nav">Register</a>
            @endauth
        </div>
    </nav>

    {{-- Hero --}}
    <div class="cars-hero">
        <h1>🚗 Our Fleet</h1>
        <p>Choose from our wide selection of well-maintained vehicles</p>
    </div>

    {{-- Filter Bar --}}
    <form method="GET" action="{{ route('cars.index') }}" class="filter-bar">
        <select name="sort">
            <option value="">Sort by</option>
            <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>Price: High to Low</option>
        </select>
        <select name="status">
            <option value="">All Status</option>
            <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
            <option value="Rented" {{ request('status') == 'Rented' ? 'selected' : '' }}>Rented</option>
        </select>
        <button type="submit">Filter</button>
        <a href="{{ route('cars.index') }}" style="font-size:0.82rem; color:#9ca3af; text-decoration:none; margin-left:4px;">Clear</a>
    </form>

    {{-- Grid --}}
    <div class="cars-grid">
        @forelse($vehicles as $vehicle)
        <div class="car-card">
            <div class="car-img">
                @if($vehicle->image_url)
                    <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->brand }} {{ $vehicle->model }}">
                @else
                    🚘
                @endif
            </div>
            <div class="car-body">
                <div class="car-brand">{{ $vehicle->brand }}</div>
                <div class="car-name">{{ $vehicle->model }} <small style="font-weight:400;color:#9ca3af;">{{ $vehicle->year }}</small></div>
                <div class="car-meta">
                    <span>🪪 {{ $vehicle->plate_number }}</span>
                </div>
                <div class="car-footer">
                    <div>
                        <div class="car-price">₱{{ number_format($vehicle->price_per_day, 2) }} <span>/ day</span></div>
                        <div style="margin-top:4px;">
                            @if($vehicle->status === 'Available')
                                <span class="badge badge-available">Available</span>
                            @elseif($vehicle->status === 'Rented')
                                <span class="badge badge-rented">Rented</span>
                            @else
                                <span class="badge badge-maintenance">Maintenance</span>
                            @endif
                        </div>
                    </div>
                    @if($vehicle->status === 'Available')
                        @auth
                            <a href="{{ route('rentals.create', ['vehicle_id' => $vehicle->id]) }}" class="rent-btn">Rent Now</a>
                        @else
                            <a href="{{ route('login') }}" class="rent-btn">Rent Now</a>
                        @endauth
                    @else
                        <span class="rent-btn-disabled">Unavailable</span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state" style="grid-column: 1/-1;">
            <div class="icon">🚗</div>
            <p>No vehicles found.</p>
        </div>
        @endforelse
    </div>

</div>
</body>
</html>