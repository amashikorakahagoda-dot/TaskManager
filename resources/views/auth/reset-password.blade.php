<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hrivo') }} - Reset Password</title>

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

        /* Key icon */
        .key-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 28px;
            color: white;
        }

        .reset-info {
            background: rgba(245, 158, 11, 0.08);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            border-left: 4px solid #f59e0b;
        }

        .reset-info i {
            color: #f59e0b;
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

        .password-requirements {
            margin-top: 8px;
            padding: 12px 16px;
            background: rgba(79, 70, 229, 0.05);
            border-radius: 8px;
        }

        .password-requirements .req {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--text-muted);
            padding: 2px 0;
        }

        .password-requirements .req i {
            font-size: 10px;
            width: 16px;
        }

        .password-requirements .req .text-success {
            color: #22c55e;
        }

        .password-requirements .req .text-danger {
            color: #ef4444;
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
                <div class="key-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h1>Set New Password</h1>
                <p>Create a new password for your account</p>
            </div>

            <div class="reset-info">
                <p>
                    <i class="fas fa-info-circle"></i>
                    {{ __('Please enter your email address and choose a new password.') }}
                </p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope me-1"></i> Email Address
                    </label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" 
                               value="{{ old('email', $request->email) }}" 
                               placeholder="jane@company.com"
                               class="@error('email') is-invalid @enderror"
                               required autofocus autocomplete="username">
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock me-1"></i> New Password
                    </label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" 
                               placeholder="Create a strong password"
                               class="@error('password') is-invalid @enderror"
                               required autocomplete="new-password">
                    </div>
                   
                    <div class="password-requirements">
                        <div class="req">
                            <i class="fas fa-circle text-success"></i>
                            <span>Use 8+ characters</span>
                        </div>
                        <div class="req">
                            <i class="fas fa-circle text-success"></i>
                            <span>Include letters &amp; numbers</span>
                        </div>
                        <div class="req">
                            <i class="fas fa-circle text-success"></i>
                            <span>Include at least 1 special character</span>
                        </div>
                    </div>
                    
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="fas fa-check-circle me-1"></i> Confirm Password
                    </label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                               placeholder="Re-enter your new password"
                               class="@error('password_confirmation') is-invalid @enderror"
                               required autocomplete="new-password">
                    </div>
                    @error('password_confirmation')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="fas fa-key me-2"></i> Reset Password
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

        // Real-time password validation
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const requirements = document.querySelectorAll('.password-requirements .req i');
            
            password.addEventListener('input', function() {
                const val = this.value;
                const hasLength = val.length >= 8;
                const hasLetter = /[a-zA-Z]/.test(val);
                const hasNumber = /[0-9]/.test(val);
                const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(val);
                
                const checks = [hasLength, (hasLetter && hasNumber), hasSpecial];
                requirements.forEach((icon, index) => {
                    if (checks[index]) {
                        icon.className = 'fas fa-check-circle text-success';
                    } else {
                        icon.className = 'fas fa-circle text-danger';
                    }
                });
            });
        });
    </script>

</body>
</html>