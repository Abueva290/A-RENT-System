<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — A-Rent System</title>
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
        .form-group { margin-bottom: 18px; }
        .input-wrapper { position: relative; }
        .toggle-pw { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #94a3b8; font-size: 1rem; background: none; border: none; }
        .btn-login { width: 100%; padding: 12px; background: #e8b4b8; color: #1a1a2e; font-weight: 700; font-size: 1rem; border: none; border-radius: 8px; cursor: pointer; font-family: 'Poppins', sans-serif; transition: background 0.2s; margin-top: 8px; }
        .btn-login:hover { background: #d4929a; }
        .register-link { text-align: center; margin-top: 20px; font-size: 0.85rem; color: #64748b; }
        .register-link a { color: #e8b4b8; font-weight: 700; text-decoration: none; }
        .register-link a:hover { text-decoration: underline; }
        .error-msg { color: #ef4444; font-size: 0.78rem; margin-top: 4px; }
        .alert-error { background: #fee2e2; color: #dc2626; padding: 10px 14px; border-radius: 8px; font-size: 0.85rem; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="card">

        {{-- Logo / Title --}}
        <div class="card-title">A-Rent System</div>
        <div class="card-subtitle">Sign in to continue</div>

        {{-- Session Status --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input id="email" class="form-input" type="email" name="email"
                       value="{{ old('email') }}" placeholder="Enter your email"
                       required autofocus autocomplete="username">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrapper">
                    <input id="password" class="form-input" type="password" name="password"
                           placeholder="Enter your password"
                           required autocomplete="current-password" style="padding-right: 40px;">
                    <button type="button" class="toggle-pw" onclick="togglePassword()">👁</button>
                </div>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Role --}}
            <div class="form-group">
                <label class="form-label" for="role">Role</label>
                <select id="role" name="role" class="form-input">
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="customer">Customer</option>
                </select>
            </div>

            {{-- Login Button --}}
            <button type="submit" class="btn-login">Login</button>
        </form>

        {{-- Register Link --}}
        <div class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pw = document.getElementById('password');
            pw.type = pw.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>