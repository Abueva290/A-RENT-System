<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register — A-Rent System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
        body { margin: 0; background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 60%, #0f172a 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { background: white; border-radius: 20px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .card-title { font-size: 1.5rem; font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 4px; }
        .card-subtitle { font-size: 0.85rem; color: #94a3b8; text-align: center; margin-bottom: 28px; }
        .form-label { font-size: 0.85rem; font-weight: 600; color: #374151; display: block; margin-bottom: 6px; }
        .form-input { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; outline: none; transition: border 0.2s; }
        .form-input:focus { border-color: #e8b4b8; }
        .form-group { margin-bottom: 16px; }
        .btn-register { width: 100%; padding: 12px; background: #e8b4b8; color: #1a1a2e; font-weight: 700; font-size: 1rem; border: none; border-radius: 8px; cursor: pointer; font-family: 'Poppins', sans-serif; transition: background 0.2s; margin-top: 8px; }
        .btn-register:hover { background: #d4929a; }
        .login-link { text-align: center; margin-top: 20px; font-size: 0.85rem; color: #64748b; }
        .login-link a { color: #e8b4b8; font-weight: 700; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }
        .error-msg { color: #ef4444; font-size: 0.78rem; margin-top: 4px; }
        .alert-error { background: #fee2e2; color: #dc2626; padding: 10px 14px; border-radius: 8px; font-size: 0.85rem; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="card">

        <div class="card-title">Create Account</div>
        <div class="card-subtitle">Fill in your details below</div>

        @if ($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Full Name --}}
            <div class="form-group">
                <label class="form-label" for="name">Full Name</label>
                <input id="name" class="form-input" type="text" name="name"
                       value="{{ old('name') }}" placeholder="Enter your full name"
                       required autofocus autocomplete="name">
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input id="email" class="form-input" type="email" name="email"
                       value="{{ old('email') }}" placeholder="Enter your email"
                       required autocomplete="username">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Username --}}
            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input id="username" class="form-input" type="text" name="username"
                       value="{{ old('username') }}" placeholder="Enter username">
                @error('username')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input id="password" class="form-input" type="password" name="password"
                       placeholder="Enter your password"
                       required autocomplete="new-password">
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" class="form-input" type="password"
                       name="password_confirmation"
                       placeholder="Confirm your password"
                       required autocomplete="new-password">
            </div>

            {{-- Role --}}
            <div class="form-group">
                <label class="form-label" for="role">Role</label>
                <select id="role" name="role" class="form-input">
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
            </div>

            <button type="submit" class="btn-register">Register</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</body>
</html>