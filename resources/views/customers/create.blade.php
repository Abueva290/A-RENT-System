<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Customer — A-Rent System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f1f5f9; display: flex; min-height: 100vh; }
        .sidebar { width: 220px; background: #0f172a; min-height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 50; }
        .sidebar-brand { padding: 22px 20px; color: white; font-weight: 800; font-size: 1.05rem; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .sidebar-nav { padding: 12px 0; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 11px 20px; color: #94a3b8; text-decoration: none; font-size: 0.85rem; font-weight: 500; transition: all 0.2s; }
        .nav-item:hover { background: rgba(255,255,255,0.07); color: white; }
        .nav-item.active { background: rgba(255,255,255,0.1); color: white; border-left: 3px solid #e8b4b8; }
        .topbar { background: #1e3a5f; padding: 0 28px; height: 56px; display: flex; align-items: center; justify-content: space-between; position: fixed; top: 0; left: 220px; right: 0; z-index: 40; }
        .topbar-links { display: flex; gap: 24px; }
        .topbar-link { color: #94a3b8; text-decoration: none; font-size: 0.85rem; font-weight: 500; }
        .topbar-link:hover, .topbar-link.active { color: white; font-weight: 700; }
        .topbar-logout { background: none; border: none; cursor: pointer; color: #e8b4b8; font-size: 0.85rem; font-weight: 600; font-family: 'Poppins', sans-serif; }
        .main { margin-left: 220px; margin-top: 56px; padding: 28px 32px; flex: 1; }
        .page-title { font-size: 1.4rem; font-weight: 800; color: #0f172a; margin-bottom: 24px; }
        .form-card { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 520px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
        .form-label { font-size: 0.82rem; font-weight: 600; color: #374151; }
        .form-input { padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.88rem; font-family: 'Poppins', sans-serif; outline: none; transition: border 0.2s; }
        .form-input:focus { border-color: #e8b4b8; }
        .alert-error { background: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem; }
        .btn-save { background: #e8b4b8; color: #1a1a2e; padding: 10px 28px; border: none; border-radius: 8px; font-weight: 700; font-size: 0.9rem; cursor: pointer; font-family: 'Poppins', sans-serif; transition: background 0.2s; }
        .btn-save:hover { background: #d4929a; }
        .btn-cancel { background: #f1f5f9; color: #64748b; padding: 10px 28px; border: none; border-radius: 8px; font-weight: 600; font-size: 0.9rem; text-decoration: none; display: inline-block; }
        .btn-cancel:hover { background: #e2e8f0; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">A-Rent-System</div>
        <nav class="sidebar-nav">
            <a href="{{ url('/dashboard') }}" class="nav-item"><span>⊞</span> Dashboard</a>
            <a href="{{ route('vehicles.index') }}" class="nav-item"><span>🚗</span> Vehicles</a>
            <a href="{{ route('customers.index') }}" class="nav-item active"><span>👥</span> Customers</a>
            <a href="{{ route('rentals.index') }}" class="nav-item"><span>📋</span> Rental</a>
            <a href="{{ route('reports.index') }}" class="nav-item"><span>📊</span> Reports</a>
        </nav>
    </div>
    <div class="topbar">
        <div class="topbar-links">
            <a href="{{ url('/dashboard') }}" class="topbar-link">Dashboard</a>
            <a href="{{ route('vehicles.index') }}" class="topbar-link">Vehicles</a>
            <a href="{{ route('customers.index') }}" class="topbar-link active">Customers</a>
            <a href="{{ route('rentals.index') }}" class="topbar-link">Rent</a>
            <a href="{{ route('reports.index') }}" class="topbar-link">Reports</a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="topbar-logout">Logout</button>
        </form>
    </div>
    <div class="main">
        <div class="page-title">Add Customer</div>

        @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <div class="form-card">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-input"
                           placeholder="Enter full name" value="{{ old('full_name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Contact Number</label>
                    <input type="text" name="contact_number" class="form-input"
                           placeholder="e.g. 09171234567" value="{{ old('contact_number') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-input"
                           placeholder="Enter address" value="{{ old('address') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Driver License Number</label>
                    <input type="text" name="driver_license_number" class="form-input"
                           placeholder="e.g. N01-23-456789" value="{{ old('driver_license_number') }}">
                </div>
                <div style="display:flex; gap:12px; margin-top:8px;">
                    <button type="submit" class="btn-save">Save Customer</button>
                    <a href="{{ route('customers.index') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>