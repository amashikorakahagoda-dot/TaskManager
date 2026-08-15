<nav class="navbar navbar-expand-md" style="background: linear-gradient(135deg, #0a0a1a 0%, #0f1a2e 40%, #0a0a1a 100%) !important; border-bottom: 1px solid rgba(96, 165, 250, 0.08); padding: 8px 0; box-shadow: 0 4px 30px rgba(0,0,0,0.5); position: relative; margin-left: 0; width: 100%;">
    
    <!-- Premium Glow Line at Bottom -->
    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, rgba(96, 165, 250, 0.15), rgba(167, 139, 250, 0.15), transparent); animation: lineGlow 4s ease-in-out infinite alternate;"></div>
    
    <div class="container-fluid px-3">
        <div class="d-flex align-items-center w-100">
            
           
            
            <!-- ===== RIGHT SIDE: User Section ===== -->
            <div class="ms-auto d-flex align-items-center gap-2">
                @auth
                    <!-- Welcome Badge -->
                    <div class="welcome-badge d-none d-md-flex align-items-center" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06); border-radius: 30px; padding: 4px 14px 4px 10px; gap: 6px; transition: all 0.3s ease;">
                        <span class="welcome-dot" style="width: 6px; height: 6px; background: #4ade80; border-radius: 50%; display: inline-block; box-shadow: 0 0 12px rgba(74, 222, 128, 0.3); animation: pulse-dot 2s ease-in-out infinite;"></span>
                        <i class="fas fa-user-circle d-none d-lg-inline" style="color: #60a5fa; font-size: 0.8rem;"></i>
                        <span style="color: rgba(255,255,255,0.4); font-size: 0.65rem; font-weight: 400;">Welcome,</span>
                        <span style="color: #ffffff; font-weight: 600; font-size: 0.75rem; max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->name }}</span>
                    </div>
                    
                    <!-- Theme Toggle -->
                    <button class="theme-toggle-premium" id="themeToggle" aria-label="Toggle theme" style="width: 34px; height: 34px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.06); background: rgba(255,255,255,0.02); color: rgba(255,255,255,0.5); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; font-size: 14px;">
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; padding: 2px; border-radius: 30px; border: 1px solid rgba(255,255,255,0.06); transition: all 0.3s ease;">
                            <div class="user-avatar" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #60a5fa, #a78bfa); color: white; font-weight: 600; font-size: 11px; border-radius: 50%; transition: all 0.3s ease;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-premium" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item dropdown-item-premium" href="{{ route('profile.edit') }}"><i class="fas fa-user-circle me-2" style="color: #60a5fa;"></i> Profile</a></li>
                            <li><a class="dropdown-item dropdown-item-premium" href="{{ route('projects.index') }}"><i class="fas fa-folder me-2" style="color: #fbbf24;"></i> My Projects</a></li>
                            <li><a class="dropdown-item dropdown-item-premium" href="{{ route('tasks.create') }}"><i class="fas fa-plus-circle me-2" style="color: #4ade80;"></i> New Task</a></li>
                            <li><hr class="dropdown-divider" style="border-color: rgba(255,255,255,0.05);"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-item-premium text-danger" style="color: #ef4444 !important;"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm rounded-3" style="background: rgba(255,255,255,0.04); color: rgba(255,255,255,0.7); border: 1px solid rgba(255,255,255,0.06); font-weight: 500; transition: all 0.3s ease;">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-sm rounded-3" style="background: linear-gradient(135deg, #60a5fa, #a78bfa); color: #ffffff; border: none; font-weight: 500; transition: all 0.3s ease;">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                @endauth
            </div>
            
        </div>
    </div>
</nav>

<!-- ============================================= -->
<!-- ===== STYLES ===== -->
<!-- ============================================= -->
<style>
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.7); }
    }
    
    @keyframes lineGlow {
        0% { opacity: 0.3; }
        50% { opacity: 1; }
        100% { opacity: 0.3; }
    }
    
    .navbar-brand:hover {
        transform: scale(1.02);
        transition: all 0.3s ease;
    }
    
    .navbar-brand:hover i {
        color: #a78bfa !important;
        transform: rotate(-5deg) scale(1.1);
    }
    
    .user-avatar:hover {
        transform: scale(1.05);
        border-color: rgba(96, 165, 250, 0.3) !important;
    }
    
    .welcome-badge:hover {
        background: rgba(255,255,255,0.06) !important;
        border-color: rgba(255,255,255,0.08) !important;
    }
    
    .theme-toggle-premium:hover {
        background: rgba(255,255,255,0.06) !important;
        color: #ffffff !important;
        transform: rotate(30deg);
        border-color: rgba(255,255,255,0.12) !important;
    }
    
    .dropdown-premium {
        background: rgba(10, 10, 26, 0.95) !important;
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 14px;
        padding: 6px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        min-width: 200px;
        animation: dropdownFade 0.25s ease-out;
    }
    
    @keyframes dropdownFade {
        from { opacity: 0; transform: translateY(-8px) scale(0.96); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    
    .dropdown-item-premium {
        color: rgba(255,255,255,0.6) !important;
        padding: 8px 14px;
        border-radius: 10px;
        transition: all 0.2s ease;
        font-weight: 500;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
    }
    
    .dropdown-item-premium:hover {
        background: rgba(255,255,255,0.04);
        color: #ffffff !important;
        transform: translateX(4px);
    }
    
    .dropdown-item-premium i {
        width: 20px;
        font-size: 0.85rem;
    }
    
    .dropdown-divider {
        border-color: rgba(255,255,255,0.04);
    }
    
    .navbar-toggler {
        display: none !important;
    }
    
    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .navbar {
            padding: 4px 0 !important;
        }
        
        .welcome-badge {
            display: none !important;
        }
        
        .theme-toggle-premium {
            width: 32px !important;
            height: 32px !important;
            font-size: 13px !important;
        }
        
        .user-avatar {
            width: 28px !important;
            height: 28px !important;
            font-size: 10px !important;
        }
    }
</style>