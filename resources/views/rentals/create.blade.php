<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rent Vehicle — A-Rent System</title>
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
        .form-card { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 560px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 18px; }
        .form-label { font-size: 0.82rem; font-weight: 600; color: #374151; }
        .form-input { padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.88rem; font-family: 'Poppins', sans-serif; outline: none; transition: border 0.2s; width: 100%; }
        .form-input:focus { border-color: #e8b4b8; }
        .alert-error { background: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem; }
        .summary-box { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 16px 20px; margin-bottom: 20px; }
        .summary-row { display: flex; justify-content: space-between; font-size: 0.85rem; color: #64748b; padding: 4px 0; }
        .summary-total { display: flex; justify-content: space-between; font-size: 1rem; font-weight: 800; color: #0f172a; padding-top: 10px; margin-top: 8px; border-top: 1.5px solid #e2e8f0; }
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
            <a href="{{ route('customers.index') }}" class="nav-item"><span>👥</span> Customers</a>
            <a href="{{ route('rentals.index') }}" class="nav-item active"><span>📋</span> Rental</a>
            <a href="{{ route('reports.index') }}" class="nav-item"><span>📊</span> Reports</a>
        </nav>
    </div>
    <div class="topbar">
        <div class="topbar-links">
            <a href="{{ url('/dashboard') }}" class="topbar-link">Dashboard</a>
            <a href="{{ route('vehicles.index') }}" class="topbar-link">Vehicles</a>
            <a href="{{ route('customers.index') }}" class="topbar-link">Customers</a>
            <a href="{{ route('rentals.index') }}" class="topbar-link active">Rent</a>
            <a href="{{ route('reports.index') }}" class="topbar-link">Reports</a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="topbar-logout">Logout</button>
        </form>
    </div>
    <div class="main">
        <div class="page-title">Rent Vehicle</div>

        @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <div class="form-card">
            <form action="{{ route('rentals.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Customer</label>
                    <select name="customer_id" class="form-input">
                        <option value="">Select customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Vehicle (Available Only)</label>
                    <select name="vehicle_id" id="vehicle_id" class="form-input" onchange="calculateTotal()">
                        <option value="">Select vehicle</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" data-price="{{ $vehicle->price_per_day }}">
                                {{ $vehicle->brand }} {{ $vehicle->model }} — ₱{{ number_format($vehicle->price_per_day, 2) }}/day
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-grid">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Rent Date</label>
                        <input type="date" name="rent_date" id="rent_date" class="form-input" onchange="calculateTotal()">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Return Date</label>
                        <input type="date" name="return_date" id="return_date" class="form-input" onchange="calculateTotal()">
                    </div>
                </div>
                <div class="summary-box" style="margin-top:18px;">
                    <div class="summary-row">
                        <span>Duration</span>
                        <span id="duration">— days</span>
                    </div>
                    <div class="summary-row">
                        <span>Price per Day</span>
                        <span id="price_display">₱0.00</span>
                    </div>
                    <div class="summary-total">
                        <span>Total Amount</span>
                        <span id="total_display">₱0.00</span>
                    </div>
                </div>
                <div style="display:flex; gap:12px;">
                    <button type="submit" class="btn-save">Confirm Rental</button>
                    <a href="{{ route('rentals.index') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function calculateTotal() {
            const vehicleSelect = document.getElementById('vehicle_id');
            const rentDate = document.getElementById('rent_date').value;
            const returnDate = document.getElementById('return_date').value;
            const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
            const price = parseFloat(selectedOption.dataset.price) || 0;
            if (rentDate && returnDate && price > 0) {
                const rent = new Date(rentDate);
                const ret = new Date(returnDate);
                const duration = Math.ceil((ret - rent) / (1000 * 60 * 60 * 24));
                if (duration > 0) {
                    document.getElementById('duration').textContent = duration + ' days';
                    document.getElementById('price_display').textContent = '₱' + price.toLocaleString('en-PH', {minimumFractionDigits: 2});
                    document.getElementById('total_display').textContent = '₱' + (duration * price).toLocaleString('en-PH', {minimumFractionDigits: 2});
                }
            }
        }
    </script>
</body>
</html>