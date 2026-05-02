<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — A-Rent System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f1f5f9; display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: 220px; background: #0f172a; min-height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 50; }
        .sidebar-brand { padding: 22px 20px; color: white; font-weight: 800; font-size: 1.05rem; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .sidebar-nav { padding: 12px 0; flex: 1; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 11px 20px; color: #94a3b8; text-decoration: none; font-size: 0.85rem; font-weight: 500; transition: all 0.2s; }
        .nav-item:hover { background: rgba(255,255,255,0.07); color: white; }
        .nav-item.active { background: rgba(255,255,255,0.1); color: white; border-left: 3px solid #e8b4b8; }
        .nav-icon { font-size: 1rem; width: 20px; text-align: center; }

        /* TOPBAR */
        .topbar { background: #1e3a5f; padding: 0 28px; height: 56px; display: flex; align-items: center; justify-content: space-between; position: fixed; top: 0; left: 220px; right: 0; z-index: 40; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .topbar-links { display: flex; gap: 24px; }
        .topbar-link { color: #94a3b8; text-decoration: none; font-size: 0.85rem; font-weight: 500; transition: color 0.2s; }
        .topbar-link:hover { color: white; }
        .topbar-link.active { color: white; font-weight: 700; }
        .topbar-logout { background: none; border: none; cursor: pointer; color: #e8b4b8; font-size: 0.85rem; font-weight: 600; font-family: 'Poppins', sans-serif; }
        .topbar-logout:hover { text-decoration: underline; }

        /* MAIN */
        .main { margin-left: 220px; margin-top: 56px; padding: 28px 32px; flex: 1; width: calc(100% - 220px); }
        .page-title { font-size: 1.6rem; font-weight: 800; color: #0f172a; margin-bottom: 24px; }

        /* STAT CARDS */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 28px; }
        .stat-card { background: white; border-radius: 14px; padding: 22px 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .stat-label { font-size: 0.78rem; color: #64748b; font-weight: 500; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-value { font-size: 2.2rem; font-weight: 800; color: #0f172a; }

        /* TABLE CARD */
        .table-card { background: white; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); overflow: hidden; }
        .table-header { padding: 18px 24px; border-bottom: 1px solid #f1f5f9; }
        .table-title { font-size: 1rem; font-weight: 700; color: #0f172a; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 0.78rem; color: #64748b; font-weight: 600; padding: 12px 20px; background: #f8fafc; border-bottom: 1px solid #f1f5f9; text-transform: uppercase; letter-spacing: 0.5px; }
        td { padding: 13px 20px; font-size: 0.85rem; color: #334155; border-bottom: 1px solid #f8fafc; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }

        /* BADGES */
        .badge { padding: 3px 12px; border-radius: 20px; font-size: 0.73rem; font-weight: 600; display: inline-block; }
        .badge-ongoing { background: #fef9c3; color: #a16207; }
        .badge-returned { background: #dcfce7; color: #15803d; }
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="sidebar-brand">A-Rent-System</div>
        <nav class="sidebar-nav">
            <a href="{{ url('/dashboard') }}" class="nav-item active">
                <span class="nav-icon">⊞</span> Dashboard
            </a>
            <a href="{{ route('vehicles.index') }}" class="nav-item">
                <span class="nav-icon">🚗</span> Vehicles
            </a>
            <a href="{{ route('customers.index') }}" class="nav-item">
                <span class="nav-icon">👥</span> Customers
            </a>
            <a href="{{ route('rentals.index') }}" class="nav-item">
                <span class="nav-icon">📋</span> Rental
            </a>
            <a href="{{ route('reports.index') }}" class="nav-item">
                <span class="nav-icon">📊</span> Reports
            </a>
        </nav>
    </div>

    {{-- TOPBAR --}}
    <div class="topbar">
        <div class="topbar-links">
            <a href="{{ url('/dashboard') }}" class="topbar-link active">Dashboard</a>
            <a href="{{ route('vehicles.index') }}" class="topbar-link">Vehicles</a>
            <a href="{{ route('customers.index') }}" class="topbar-link">Customers</a>
            <a href="{{ route('rentals.index') }}" class="topbar-link">Rent</a>
            <a href="{{ route('reports.index') }}" class="topbar-link">Reports</a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="topbar-logout">Logout</button>
        </form>
    </div>

    {{-- MAIN --}}
    <div class="main">
        <div class="page-title">Dashboard</div>

        {{-- STAT CARDS --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Vehicles</div>
                <div class="stat-value">{{ $totalVehicles }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Available Cars</div>
                <div class="stat-value" style="color: #16a34a;">{{ $availableCars }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Rented Cars</div>
                <div class="stat-value" style="color: #d97706;">{{ $rentedCars }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Customers</div>
                <div class="stat-value">{{ $totalCustomers }}</div>
            </div>
        </div>

        {{-- RECENT RENTALS --}}
        <div class="table-card">
            <div class="table-header">
                <div class="table-title">Recent Rentals</div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Vehicle</th>
                        <th>Rent Date</th>
                        <th>Return Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRentals as $rental)
                    <tr>
                        <td>{{ $rental->customer->full_name ?? '—' }}</td>
                        <td>{{ $rental->vehicle->brand ?? '' }} {{ $rental->vehicle->model ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($rental->rent_date)->format('M j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($rental->return_date)->format('M j, Y') }}</td>
                        <td>₱{{ number_format($rental->total_amount, 2) }}</td>
                        <td>
                            <span class="badge {{ $rental->status === 'Returned' ? 'badge-returned' : 'badge-ongoing' }}">
                                {{ $rental->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:#94a3b8; padding: 40px;">No rentals yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>