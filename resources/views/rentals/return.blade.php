<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Return & Payment — A-Rent System</title>
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
        .info-box { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 16px 20px; margin-bottom: 20px; }
        .info-row { display: flex; justify-content: space-between; font-size: 0.85rem; padding: 5px 0; }
        .info-row span:first-child { color: #374151; font-weight: 600; }
        .info-row span:last-child { color: #64748b; }
        .info-total { display: flex; justify-content: space-between; font-size: 1rem; font-weight: 800; color: #0f172a; padding-top: 10px; margin-top: 8px; border-top: 1.5px solid #e2e8f0; }
        .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
        .form-label { font-size: 0.82rem; font-weight: 600; color: #374151; }
        .form-input { padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.88rem; font-family: 'Poppins', sans-serif; outline: none; transition: border 0.2s; }
        .form-input:focus { border-color: #e8b4b8; }
        .change-box { background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 10px; padding: 14px 20px; margin-bottom: 20px; display: none; }
        .change-box.error { background: #fef2f2; border-color: #fca5a5; }
        .change-label { font-size: 0.78rem; font-weight: 600; color: #64748b; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px; }
        .change-value { font-size: 1.5rem; font-weight: 800; color: #16a34a; }
        .change-value.error { color: #dc2626; }
        .btn-save { background: #e8b4b8; color: #1a1a2e; padding: 10px 28px; border: none; border-radius: 8px; font-weight: 700; font-size: 0.9rem; cursor: pointer; font-family: 'Poppins', sans-serif; transition: background 0.2s; }
        .btn-save:hover { background: #d4929a; }
        .btn-save:disabled { background: #e2e8f0; color: #94a3b8; cursor: not-allowed; }
        .btn-cancel { background: #f1f5f9; color: #64748b; padding: 10px 28px; border: none; border-radius: 8px; font-weight: 600; font-size: 0.9rem; text-decoration: none; display: inline-block; }
        .btn-cancel:hover { background: #e2e8f0; }
        .tendered-hint { display: none; }
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
        <div class="page-title">Return Vehicle</div>
        <div class="form-card">
            <div class="info-box">
                <div class="info-row"><span>Customer</span><span>{{ $rental->customer->full_name }}</span></div>
                <div class="info-row"><span>Vehicle</span><span>{{ $rental->vehicle->brand }} {{ $rental->vehicle->model }}</span></div>
                <div class="info-row"><span>Rent Date</span><span>{{ \Carbon\Carbon::parse($rental->rent_date)->format('M j, Y') }}</span></div>
                <div class="info-row"><span>Return Date</span><span>{{ \Carbon\Carbon::parse($rental->return_date)->format('M j, Y') }}</span></div>
                <div class="info-row"><span>Duration</span><span>{{ $rental->duration_days }} days</span></div>
                <div class="info-total"><span>Total Amount</span><span>₱{{ number_format($rental->total_amount, 2) }}</span></div>
            </div>

            <form action="{{ route('rentals.process-return', $rental) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-input" onchange="toggleTendered()">
                        <option value="Cash">Cash</option>
                        <option value="GCash">GCash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                    </select>
                </div>

                <div class="form-group" id="tendered-group">
                    <label class="form-label">Amount Tendered (₱)</label>
                    <input type="number" name="amount_tendered" id="amount_tendered"
                           class="form-input" placeholder="Enter amount given by customer"
                           min="{{ $rental->total_amount }}" step="0.01"
                           oninput="computeChange()">
                </div>

                <div class="change-box" id="change-box">
                    <div class="change-label">Change</div>
                    <div class="change-value" id="change-value">₱0.00</div>
                </div>

                <input type="hidden" name="change_amount" id="change_amount" value="0">

                <div style="display:flex; gap:12px; margin-top:8px;">
                    <button type="submit" class="btn-save" id="btn-confirm">Confirm Return & Payment</button>
                    <a href="{{ route('rentals.index') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const total = {{ $rental->total_amount }};

        function toggleTendered() {
            const method = document.getElementById('payment_method').value;
            const group = document.getElementById('tendered-group');
            const changeBox = document.getElementById('change-box');
            const btn = document.getElementById('btn-confirm');

            if (method === 'Cash') {
                group.style.display = 'flex';
                btn.disabled = true;
            } else {
                group.style.display = 'none';
                changeBox.style.display = 'none';
                btn.disabled = false;
                document.getElementById('change_amount').value = 0;
            }
        }

        function computeChange() {
            const tendered = parseFloat(document.getElementById('amount_tendered').value) || 0;
            const change = tendered - total;
            const changeBox = document.getElementById('change-box');
            const changeValue = document.getElementById('change-value');
            const btn = document.getElementById('btn-confirm');

            changeBox.style.display = 'block';

            if (change < 0) {
                changeBox.className = 'change-box error';
                changeValue.className = 'change-value error';
                changeValue.textContent = 'Insufficient amount!';
                btn.disabled = true;
            } else {
                changeBox.className = 'change-box';
                changeValue.className = 'change-value';
                changeValue.textContent = '₱' + change.toLocaleString('en-PH', {minimumFractionDigits: 2});
                document.getElementById('change_amount').value = change.toFixed(2);
                btn.disabled = false;
            }
        }

        // Initialize
        toggleTendered();
    </script>
</body>
</html>