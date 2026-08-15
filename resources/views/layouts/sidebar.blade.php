<!-- ============================================= -->
<!-- ===== SIDEBAR ===== -->
<!-- ============================================= -->
<div class="sidebar" id="sidebar">
    
    <!-- Brand -->
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">
            <i class="fas fa-code"></i>
            <span>Task Manager</span>
        </a>
    </div>
    
    <!-- Menu -->
    <ul class="sidebar-menu">
        <li class="menu-divider">Main Menu</li>
        
        <!-- Dashboard -->
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
        </li>
        
        <!-- Projects -->
        <li>
            <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">
                <i class="fas fa-folder"></i> Projects
            </a>
        </li>
        
        <!-- Tasks -->
        <li>
            <a href="{{ route('tasks.create') }}" class="{{ request()->routeIs('tasks.create') ? 'active' : '' }}">
                <i class="fas fa-tasks"></i> Tasks
            </a>
        </li>
        
        <li class="menu-divider">Account</li>
        
        <!-- Profile -->
        <li>
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i> Profile
            </a>
        </li>
        
        <!-- Logout -->
        <li>
            <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                @csrf
                <a href="#" onclick="this.closest('form').submit(); return false;" style="color: rgba(255,255,255,0.5);">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </li>
    </ul>
</div>

<style>
    /* Sidebar scroll */
    .sidebar::-webkit-scrollbar {
        width: 4px;
    }
    
    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.08);
        border-radius: 4px;
    }
</style>