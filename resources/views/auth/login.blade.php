<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">  <!-- Changed to dark -->
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <i class="fas fa-sun" id="themeIcon"></i>  <!-- Changed to sun icon -->
            </button>

           <div class="auth-header">
                <div class="logo">
                    <img src="/images/icon.png" alt="Task Manager Logo" class="logo-img">
                </div>
                <h1>Welcome back</h1>
                <p>Sign in to your account to continue</p>
            </div>
        
           

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Work Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" 
                               value="{{ old('email') }}" 
                               placeholder="ama@company.com"
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

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" 
                               placeholder="Enter your password"
                               class="@error('password') is-invalid @enderror"
                               required>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-sign-in-alt me-2"></i> Sign In
                </button>

                <div class="auth-footer">
                    Don't have an account? <a href="{{ route('register') }}">Create one</a>
                </div>

            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Force dark mode on login page
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;

        // Update icon for dark mode
        themeIcon.className = 'fas fa-sun';

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            if (newTheme === 'dark') {
                themeIcon.className = 'fas fa-sun';
            } else {
                themeIcon.className = 'fas fa-moon';
            }
        });

        @if(session('registration_success'))
            document.addEventListener('DOMContentLoaded', function() {
                const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                
                Swal.fire({
                    icon: 'success',
                    title: '🎉 Registration Successful!',
                    text: '{{ session('registration_success') }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonText: 'Login Now',
                    confirmButtonColor: '#4f46e5',
                    background: isDark ? '#1e293b' : '#ffffff',
                    color: isDark ? '#f1f5f9' : '#0f172a',
                    backdrop: 'rgba(0,0,0,0.4)',
                    iconColor: '#22c55e',
                    allowOutsideClick: false,
                    customClass: {
                        popup: 'rounded-3',
                        confirmButton: 'px-4 py-2 rounded-lg',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                    
                    }
                });
            });
        @endif
    </script>

</body>
</html>