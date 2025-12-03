<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UniDesk</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            /* Light */
            --bg-body: #FAFAFA; --bg-card: #FFFFFF; --border-color: #E5E5E5;
            --text-main: #171717; --text-sub: #737373;
            --primary: #4F46E5; --bg-input: #FAFAFA;
        }
        [data-theme="dark"] {
            /* Dark */
            --bg-body: #0a0a0a; --bg-card: #171717; --border-color: #262626;
            --text-main: #FAFAFA; --text-sub: #A3A3A3;
            --primary: #818CF8; --bg-input: #0a0a0a;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-body); color: var(--text-main); height: 100vh; display: flex; align-items: center; justify-content: center; }
        
        .login-card { 
            width: 100%; max-width: 380px; padding: 40px; 
            background: var(--bg-card); border-radius: 24px; 
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px -2px rgba(0,0,0,0.05);
        }
        [data-theme="dark"] .login-card { box-shadow: none; }

        .form-label { font-size: 0.75rem; font-weight: 700; color: var(--text-sub); margin-bottom: 6px; letter-spacing: 0.5px; text-transform: uppercase; }
        
        .form-control {
            background-color: var(--bg-input);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 12px;
            font-size: 0.95rem;
            border-radius: 10px;
        }
        .form-control:focus {
            background-color: var(--bg-input);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            color: var(--text-main);
            border-color: var(--primary);
        }
        .form-control::placeholder { color: var(--text-sub); opacity: 0.6; }

        .btn-modern {
            background-color: var(--primary); color: #fff; width: 100%;
            border-radius: 12px; padding: 12px; font-weight: 600; border: none;
            transition: all 0.2s;
        }
        .btn-modern:hover { opacity: 0.9; transform: translateY(-1px); }
        [data-theme="dark"] .btn-modern { color: #0a0a0a; font-weight: 700; }
        
        /* Autofill */
        input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus, input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px var(--bg-input) inset !important;
            -webkit-text-fill-color: var(--text-main) !important;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-3" 
                 style="width: 56px; height: 56px; background-color: var(--primary); color: #fff; font-size: 1.8rem;">
                <i class="bi bi-person-fill"></i>
            </div>
            <h3 class="fw-bold mb-1" style="color: var(--text-main)">Admin Login</h3>
            <p class="small mb-0" style="color: var(--text-sub)">Masuk untuk mengelola sistem</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger border-0 rounded-3 py-2 px-3 small mb-4 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/admin/login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="admin@unidesk.com" required value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button class="btn-modern mb-4">Masuk Sistem</button>
            <div class="text-center">
                <a href="{{ route('home') }}" class="text-decoration-none small fw-bold" style="color: var(--text-sub)">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Website
                </a>
            </div>
        </form>
    </div>

    <div class="fixed-bottom text-center pb-4 small" style="color: var(--text-sub); opacity: 0.7;">
        &copy; 2025 UniDesk Campus
    </div>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
</body>
</html>