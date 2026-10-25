<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <style>
        body { background: #f4f6f9; display: flex; align-items: center; min-height: 100vh; }
        .login-box { width: 400px; margin: auto; }
        .card { border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="card">
            <div class="card-body p-4">
                <h4 class="text-center mb-4">Admin Login</h4>
                <form action="{{ route('admin.login.submit') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Username / Phone / Email</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" required>
                        @error('username') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block w-100">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
