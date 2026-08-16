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

            <form method="POST" action="{{ route('register') }}" id="registerForm">
              
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="name" name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Jane"
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
                                   placeholder="Cooper"
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
                               placeholder="jane@company.com"
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

                <button type="submit" class="btn-submit" id="registerBtn">
                    <i class="fas fa-user-plus me-2"></i> Create Account
                </button>

                <div class="auth-footer">
                    Already have an account? <a href="{{ route('login') }}">Sign in</a>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // ===== Theme Toggle =====
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

        // ===== Registration Success Alert =====
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const btn = document.getElementById('registerBtn');

          
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('registered') === 'success') {
                showSuccessAlert();
               
                window.history.replaceState({}, document.title, window.location.pathname);
            }

           
            form.addEventListener('submit', function(e) {
                
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Creating Account...';
                btn.disabled = true;
                btn.style.opacity = '0.7';

            
            });
        });

        function showSuccessAlert() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            
            Swal.fire({
                icon: 'success',
                title: '🎉 Registration Successful!',
                text: 'Your account has been created successfully. Welcome aboard!',
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: true,
                confirmButtonText: 'Continue to Login',
                confirmButtonColor: '#4f46e5',
                background: isDark ? '#1e293b' : '#ffffff',
                color: isDark ? '#f1f5f9' : '#0f172a',
                backdrop: 'rgba(0,0,0,0.4)',
                allowOutsideClick: false,
                iconColor: '#22c55e',
                customClass: {
                    popup: 'rounded-3',
                    confirmButton: 'btn btn-primary px-4 py-2',
                },
                didOpen: () => {
                    
                    const popup = Swal.getPopup();
                    popup.style.animation = 'slideUp 0.5s ease-out';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("login") }}';
                } else {
                    window.location.href = '{{ route("login") }}';
                }
            });
        }

        // Add slideUp animation if not exists
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px) scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
        `;
        document.head.appendChild(style);
    </script>

</body>
</html>