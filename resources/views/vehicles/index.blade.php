<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicles — A-Rent System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f1f5f9; display: flex; min-height: 100vh; }
        .sidebar { width: 220px; background: #0f172a; min-height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 50; }
        .sidebar-brand { padding: 22px 20px; color: white; font-weight: 800; font-size: 1.05rem; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .sidebar-nav { padding: 12px 0; flex: 1; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 11px 20px; color: #94a3b8; text-decoration: none; font-size: 0.85rem; font-weight: 500; transition: all 0.2s; }
        .nav-item:hover { background: rgba(255,255,255,0.07); color: white; }
        .nav-item.active { background: rgba(255,255,255,0.1); color: white; border-left: 3px solid #e8b4b8; }
        .nav-icon { font-size: 1rem; width: 20px; text-align: center; }
        .topbar { background: #1e3a5f; padding: 0 28px; height: 56px; display: flex; align-items: center; justify-content: space-between; position: fixed; top: 0; left: 220px; right: 0; z-index: 40; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .topbar-links { display: flex; gap: 24px; }
        .topbar-link { color: #94a3b8; text-decoration: none; font-size: 0.85rem; font-weight: 500; transition: color 0.2s; }
        .topbar-link:hover { color: white; }
        .topbar-link.active { color: white; font-weight: 700; }
        .topbar-logout { background: none; border: none; cursor: pointer; color: #e8b4b8; font-size: 0.85rem; font-weight: 600; font-family: 'Poppins', sans-serif; }
        .main { margin-left: 220px; margin-top: 56px; padding: 28px 32px; flex: 1; width: calc(100% - 220px); }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-title { font-size: 1.6rem; font-weight: 800; color: #0f172a; }
        .btn-add { background: #e8b4b8; color: #1a1a2e; padding: 10px 20px; border-radius: 8px; font-weight: 700; text-decoration: none; font-size: 0.88rem; transition: background 0.2s; }
        .btn-add:hover { background: #d4929a; }
        .alert-success { background: #dcfce7; color: #15803d; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.88rem; font-weight: 500; }
        .table-card { background: white; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #0f172a; }
        th { text-align: left; font-size: 0.78rem; color: white; font-weight: 600; padding: 14px 16px; text-transform: uppercase; letter-spacing: 0.5px; }
        td { padding: 13px 16px; font-size: 0.85rem; color: #334155; border-bottom: 1px solid #f8fafc; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }
        .badge { padding: 3px 12px; border-radius: 20px; font-size: 0.73rem; font-weight: 600; display: inline-block; }
        .badge-available { background: #dcfce7; color: #15803d; }
        .badge-rented { background: #fef9c3; color: #a16207; }
        .badge-maintenance { background: #fee2e2; color: #dc2626; }
        .action-btns { display: flex; gap: 8px; align-items: center; }
        .btn-edit { background: #fef9c3; color: #a16207; border: none; padding: 6px 14px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; cursor: pointer; text-decoration: none; font-family: 'Poppins', sans-serif; transition: background 0.2s; }
        .btn-edit:hover { background: #fde047; }
        .btn-delete { background: #fee2e2; color: #dc2626; border: none; padding: 6px 14px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; cursor: pointer; font-family: 'Poppins', sans-serif; transition: background 0.2s; }
        .btn-delete:hover { background: #fca5a5; }
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="sidebar-brand">A-Rent-System</div>
        <nav class="sidebar-nav">
            <a href="{{ url('/dashboard') }}" class="nav-item">
                <span class="nav-icon">⊞</span> Dashboard
            </a>
            <a href="{{ route('vehicles.index') }}" class="nav-item active">
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
            <a href="{{ url('/dashboard') }}" class="topbar-link">Dashboard</a>
            <a href="{{ route('vehicles.index') }}" class="topbar-link active">Vehicles</a>
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

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="page-header">
            <div class="page-title">Vehicles</div>
            <a href="{{ route('vehicles.create') }}" class="btn-add">+ Add Vehicle</a>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Plate No.</th>
                        <th>Price/Day</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                    <tr>
                        <td>{{ str_pad($vehicle->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $vehicle->brand }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->year }}</td>
                        <td>{{ $vehicle->plate_number }}</td>
                        <td>₱{{ number_format($vehicle->price_per_day, 2) }}</td>
                        <td>
                            @if($vehicle->status === 'Available')
                                <span class="badge badge-available">Available</span>
                            @elseif($vehicle->status === 'Rented')
                                <span class="badge badge-rented">Rented</span>
                            @else
                                <span class="badge badge-maintenance">Maintenance</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn-edit">✏️ Edit</a>
                                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST"
                                      onsubmit="return confirm('Delete this vehicle?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">🗑 Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center; color:#94a3b8; padding:40px;">No vehicles found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>