<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <title>TaskMaster</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/icon.png">
    <link rel="apple-touch-icon" href="/images/icon.png">


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        .logo-text {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating-dot {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .reset-info {
            background: rgba(79, 70, 229, 0.05);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            border-left: 4px solid var(--input-focus);
        }

        .reset-info i {
            color: var(--input-focus);
            margin-right: 8px;
        }

        .reset-info p {
            margin: 0;
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .back-to-login {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
            margin-top: 4px;
        }

        .back-to-login:hover {
            color: var(--input-focus);
        }

        .back-to-login i {
            font-size: 14px;
        }
         
        .logo-img {
            width: 80px !important;  
            height: 80px !important; 
            object-fit: contain;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="floating-dot" style="width: 200px; height: 200px; background: rgba(255,255,255,0.08); top: -50px; right: -50px;"></div>
        <div class="floating-dot" style="width: 300px; height: 300px; background: rgba(255,255,255,0.05); bottom: -80px; left: -80px;"></div>
        <div class="floating-dot" style="width: 100px; height: 100px; background: rgba(255,255,255,0.06); top: 50%; left: -30px;"></div>

        <div class="auth-card">

            <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
                <i class="fas fa-moon" id="themeIcon"></i>
            </button>

            <div class="auth-header">
                 <div class="logo">
        <img src="/images/icon.png" alt="Task Manager Logo" class="logo-img">
    </div>
                <h1>Reset Password</h1>
                <p>We'll send you a reset link</p>
            </div>

            <div class="reset-info">
                <p>
                    <i class="fas fa-info-circle"></i>
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope me-1"></i> Work Email
                    </label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" 
                               value="{{ old('email') }}" 
                               placeholder="jane@company.com"
                               class="@error('email') is-invalid @enderror"
                               required autofocus>
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane me-2"></i> Send Reset Link
                </button>

        
                <div style="text-align: center; margin-top: 16px;">
                    <a href="{{ route('login') }}" class="back-to-login">
                        <i class="fas fa-arrow-left"></i>
                        Back to Sign In
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Dark/Light Mode -->
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;

        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        updateIcon(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            themeIcon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
        }
    </script>

</body>
</html>