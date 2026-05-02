<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt — A-Rent System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f1f5f9; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 40px 20px; }
        .receipt { background: white; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 8px 32px rgba(0,0,0,0.1); }
        .receipt-header { text-align: center; margin-bottom: 24px; }
        .receipt-logo { font-size: 1.3rem; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .receipt-subtitle { font-size: 0.8rem; color: #94a3b8; }
        .receipt-no { margin-top: 10px; font-size: 0.75rem; color: #94a3b8; }
        .section-title { font-size: 0.78rem; font-weight: 700; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin: 18px 0 8px; padding-bottom: 6px; border-bottom: 1.5px dashed #e2e8f0; }
        .receipt-row { display: flex; justify-content: space-between; padding: 5px 0; font-size: 0.83rem; }
        .receipt-row .label { color: #64748b; }
        .receipt-row .value { color: #0f172a; font-weight: 600; text-align: right; }
        .receipt-total { display: flex; justify-content: space-between; padding: 12px 0 0; margin-top: 10px; border-top: 2px solid #0f172a; font-size: 1rem; font-weight: 800; color: #0f172a; }
        .receipt-tendered { display: flex; justify-content: space-between; padding: 6px 0; font-size: 0.9rem; }
        .receipt-tendered .label { color: #64748b; font-weight: 500; }
        .receipt-tendered .value { font-weight: 700; color: #0f172a; }
        .receipt-change { display: flex; justify-content: space-between; padding: 6px 0; font-size: 1rem; font-weight: 800; }
        .receipt-change .label { color: #16a34a; }
        .receipt-change .value { color: #16a34a; }
        .badge-paid { text-align: center; margin: 18px 0; }
        .badge-paid span { background: #dcfce7; color: #15803d; padding: 6px 24px; border-radius: 20px; font-size: 0.82rem; font-weight: 700; display: inline-block; }
        .receipt-footer { text-align: center; font-size: 0.73rem; color: #94a3b8; margin-top: 20px; padding-top: 14px; border-top: 1px dashed #e2e8f0; line-height: 1.6; }
        .btn-print { width: 100%; padding: 12px; background: #e8b4b8; color: #1a1a2e; border: none; border-radius: 8px; font-weight: 700; font-size: 0.95rem; cursor: pointer; font-family: 'Poppins', sans-serif; margin-top: 20px; }
        .btn-print:hover { background: #d4929a; }
        .btn-back { display: block; text-align: center; margin-top: 10px; color: #94a3b8; font-size: 0.82rem; text-decoration: none; }
        .btn-back:hover { color: #0f172a; }
        @media print {
            body { background: white; padding: 0; }
            .receipt { box-shadow: none; border-radius: 0; max-width: 100%; }
            .btn-print, .btn-back { display: none; }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <div class="receipt-logo">🚗 A-Rent System</div>
            <div class="receipt-subtitle">Car Rental — Davao City</div>
            <div class="receipt-no">
                Receipt #{{ str_pad($rental->id, 5, '0', STR_PAD_LEFT) }}<br>
                {{ now()->format('F j, Y — g:i A') }}
            </div>
        </div>

        <div class="section-title">Customer</div>
        <div class="receipt-row">
            <span class="label">Name</span>
            <span class="value">{{ $rental->customer->full_name }}</span>
        </div>
        <div class="receipt-row">
            <span class="label">Contact</span>
            <span class="value">{{ $rental->customer->contact_number }}</span>
        </div>
        <div class="receipt-row">
            <span class="label">License No.</span>
            <span class="value">{{ $rental->customer->driver_license_number }}</span>
        </div>

        <div class="section-title">Vehicle</div>
        <div class="receipt-row">
            <span class="label">Vehicle</span>
            <span class="value">{{ $rental->vehicle->brand }} {{ $rental->vehicle->model }}</span>
        </div>
        <div class="receipt-row">
            <span class="label">Plate No.</span>
            <span class="value">{{ $rental->vehicle->plate_number }}</span>
        </div>
        <div class="receipt-row">
            <span class="label">Price/Day</span>
            <span class="value">₱{{ number_format($rental->vehicle->price_per_day, 2) }}</span>
        </div>

        <div class="section-title">Rental Details</div>
        <div class="receipt-row">
            <span class="label">Rent Date</span>
            <span class="value">{{ \Carbon\Carbon::parse($rental->rent_date)->format('M j, Y') }}</span>
        </div>
        <div class="receipt-row">
            <span class="label">Return Date</span>
            <span class="value">{{ \Carbon\Carbon::parse($rental->return_date)->format('M j, Y') }}</span>
        </div>
        <div class="receipt-row">
            <span class="label">Duration</span>
            <span class="value">{{ $rental->duration_days }} days</span>
        </div>

        <div class="section-title">Payment</div>
        <div class="receipt-row">
            <span class="label">Payment Method</span>
            <span class="value">{{ $rental->payment_method }}</span>
        </div>

        <div class="receipt-total">
            <span>Total Amount</span>
            <span>₱{{ number_format($rental->total_amount, 2) }}</span>
        </div>

        @if($rental->payment_method === 'Cash')
        <div class="receipt-tendered" style="margin-top: 8px;">
            <span class="label">Amount Tendered</span>
            <span class="value">₱{{ number_format($rental->amount_tendered, 2) }}</span>
        </div>
        <div class="receipt-change">
            <span class="label">Change</span>
            <span class="value">₱{{ number_format($rental->change_amount, 2) }}</span>
        </div>
        @endif

        <div class="badge-paid">
            <span>✓ PAID</span>
        </div>

        <div class="receipt-footer">
            Thank you for choosing A-Rent System!<br>
            Please keep this receipt for your records.
        </div>

        <button class="btn-print" onclick="window.print()">🖨 Print Receipt</button>
        <a href="{{ route('rentals.index') }}" class="btn-back">← Back to Rentals</a>
    </div>
</body>
</html>