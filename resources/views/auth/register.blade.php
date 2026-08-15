<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hrivo') }} - Register</title>

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
                    <span class="logo-text">H</span>
                </div>
                <h1>Create your account</h1>
                <p>Start managing your team in minutes</p>
            </div>

            <div class="social-buttons">
                <button class="social-btn" onclick="alert('Google login coming soon!')">
                    <i class="fab fa-google" style="color: #ea4335;"></i>
                    Google
                </button>
                <button class="social-btn" onclick="alert('Facebook login coming soon!')">
                    <i class="fab fa-facebook" style="color: #1877f2;"></i>
                    Facebook
                </button>
            </div>

            <div class="divider">
                <span>Or sign up with email</span>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="name" name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="ama"
                                   required autofocus>
                        </div>
                        @error('name')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="last_name" name="last_name" 
                                   placeholder=""
                                   disabled style="opacity: 0.6; cursor: not-allowed;">
                        </div>
                        <div style="font-size: 11px; color: var(--text-muted); margin-top: 4px;">
                            <i class="fas fa-info-circle"></i> Coming soon
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Work Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" 
                               value="{{ old('email') }}" 
                               placeholder="ama@company.com"
                               class="@error('email') is-invalid @enderror"
                               required>
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
                               placeholder="Create a password"
                               class="@error('password') is-invalid @enderror"
                               required>
                    </div>
                    <div class="password-hint">
                        <i class="fas fa-info-circle"></i>
                        Use 8+ characters with letters, numbers &amp; symbols.
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                               placeholder="Re-enter your password"
                               required>
                    </div>
                    @error('password_confirmation')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-user-plus me-2"></i> Create Account
                </button>

                <div class="auth-footer">
                    Already have an account? <a href="{{ route('login') }}">Sign in</a>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript  -->
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