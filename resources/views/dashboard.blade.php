@extends('layouts.app')

@section('content')

<!-- ===== DEFINE VARIABLES ===== -->
@php
    $projects = Auth::user()->projects;
    $totalProjects = $projects->count();
    $totalTasks = $projects->flatMap->tasks->count();
    $completedTasks = $projects->flatMap->tasks->where('status', 'completed')->count();
    $pendingTasks = $projects->flatMap->tasks->where('status', 'pending')->count();
    $inProgressTasks = $projects->flatMap->tasks->where('status', 'in_progress')->count();
    $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
    $recentProjects = $projects->take(5);
    $recentTasks = $projects->flatMap->tasks->sortByDesc('created_at')->take(5);
    
    $chartLabels = ['Pending', 'In Progress', 'Completed'];
    $chartData = [$pendingTasks, $inProgressTasks, $completedTasks];
    $chartColors = ['#fbbf24', '#60a5fa', '#34d399'];
    
    $projectStatusLabels = ['Pending', 'In Progress', 'Completed'];
    $projectStatusData = [
        $projects->where('status', 'pending')->count(),
        $projects->where('status', 'in_progress')->count(),
        $projects->where('status', 'completed')->count()
    ];
    $projectStatusColors = ['#fbbf24', '#60a5fa', '#34d399'];
    
    // Monthly tasks data (last 6 months)
    $months = [];
    $monthlyTasks = [];
    for ($i = 5; $i >= 0; $i--) {
        $month = now()->subMonths($i);
        $months[] = $month->format('M');
        $count = $projects->flatMap->tasks->filter(function($task) use ($month) {
            return $task->created_at->month == $month->month && $task->created_at->year == $month->year;
        })->count();
        $monthlyTasks[] = $count;
    }
@endphp

<!-- ============================================= -->
<!-- ===== WELCOME BANNER ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4 mt-3">
    <div class="row">
        <div class="col-12">
            <div class="hero-banner rounded-3 mb-4 p-4" 
                 style="background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
                        min-height: 160px;
                        position: relative;
                        overflow: hidden;">
                
                <!-- Decorative Circles -->
                <div class="position-absolute" style="top: -50px; right: -20px; width: 150px; height: 150px; background: rgba(96, 165, 250, 0.05); border-radius: 50%;"></div>
                <div class="position-absolute" style="bottom: -60px; left: -10px; width: 180px; height: 180px; background: rgba(167, 139, 250, 0.04); border-radius: 50%;"></div>
                
                <!-- Content -->
                <div class="position-relative d-flex flex-wrap align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.85); font-size: 0.7rem;">
                                <i class="fas fa-crown text-warning me-1"></i> 
                                Welcome, <span style="color: #ffffff; font-weight: 600;">{{ Auth::user()->name }}</span>
                            </span>
                        </div>
                        <h1 class="fw-bold mb-1" style="font-size: 1.8rem; color: #ffffff; text-shadow: 0 2px 30px rgba(0,0,0,0.3);">
                            WELCOME TO <span style="color: #60a5fa; text-shadow: 0 0 30px rgba(96,165,250,0.2);">TASK MANAGER</span>
                        </h1>
                        <p class="text-white mb-0" style="font-size: 0.85rem; max-width: 550px; text-shadow: 0 1px 10px rgba(0,0,0,0.2);">
                            Manage your projects and tasks efficiently.
                        </p>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="d-flex gap-3 mt-3 mt-md-0">
                        <div class="text-center" style="background: rgba(255,255,255,0.04); backdrop-filter: blur(5px); border-radius: 12px; padding: 10px 18px; border: 1px solid rgba(255,255,255,0.04); min-width: 70px;">
                            <p class="text-white small mb-0" style="font-size: 0.5rem; text-transform: uppercase; letter-spacing: 0.3px;">Projects</p>
                            <h5 class="fw-bold mb-0" style="color: #ffffff; font-size: 1.2rem;">{{ $totalProjects }}</h5>
                        </div>
                        <div class="text-center" style="background: rgba(255,255,255,0.04); backdrop-filter: blur(5px); border-radius: 12px; padding: 10px 18px; border: 1px solid rgba(255,255,255,0.04); min-width: 70px;">
                            <p class="text-white small mb-0" style="font-size: 0.5rem; text-transform: uppercase; letter-spacing: 0.3px;">Tasks</p>
                            <h5 class="fw-bold mb-0" style="color: #ffffff; font-size: 1.2rem;">{{ $totalTasks }}</h5>
                        </div>
                        <div class="text-center" style="background: rgba(255,255,255,0.04); backdrop-filter: blur(5px); border-radius: 12px; padding: 10px 18px; border: 1px solid rgba(255,255,255,0.04); min-width: 70px;">
                            <p class="text-white small mb-0" style="font-size: 0.5rem; text-transform: uppercase; letter-spacing: 0.3px;">Completed</p>
                            <h5 class="fw-bold mb-0" style="color: #34d399; font-size: 1.2rem;">{{ $completedTasks }}</h5>
                        </div>
                        <div class="text-center" style="background: rgba(255,255,255,0.04); backdrop-filter: blur(5px); border-radius: 12px; padding: 10px 18px; border: 1px solid rgba(255,255,255,0.04); min-width: 70px;">
                            <p class="text-white small mb-0" style="font-size: 0.5rem; text-transform: uppercase; letter-spacing: 0.3px;">Pending</p>
                            <h5 class="fw-bold mb-0" style="color: #fbbf24; font-size: 1.2rem;">{{ $pendingTasks }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== STATS CARDS ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4">
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 rounded-3 p-3 h-100" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04); transition: all 0.3s ease;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-0" style="color: #6c757d; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600;">Projects</p>
                        <h3 class="fw-bold mb-0" style="color: #111827; font-size: 1.5rem;">{{ $totalProjects }}</h3>
                        <small style="color: #6c757d; font-size: 0.55rem;">
                            <i class="fas fa-arrow-up text-success"></i> +{{ $totalProjects > 0 ? round($totalProjects / 2) : 0 }}%
                        </small>
                    </div>
                    <div class="rounded-3 p-2" style="background: rgba(79, 70, 229, 0.08);">
                        <i class="fas fa-folder-open" style="color: #4f46e5; font-size: 1.2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card border-0 rounded-3 p-3 h-100" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04); transition: all 0.3s ease;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-0" style="color: #6c757d; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600;">Tasks</p>
                        <h3 class="fw-bold mb-0" style="color: #111827; font-size: 1.5rem;">{{ $totalTasks }}</h3>
                        <small style="color: #6c757d; font-size: 0.55rem;">
                            <i class="fas fa-arrow-up text-success"></i> +{{ $totalTasks > 0 ? round($totalTasks / 3) : 0 }}%
                        </small>
                    </div>
                    <div class="rounded-3 p-2" style="background: rgba(139, 92, 246, 0.08);">
                        <i class="fas fa-tasks" style="color: #8b5cf6; font-size: 1.2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card border-0 rounded-3 p-3 h-100" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04); transition: all 0.3s ease;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-0" style="color: #6c757d; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600;">Completed</p>
                        <h3 class="fw-bold mb-0" style="color: #111827; font-size: 1.5rem;">{{ $completedTasks }}</h3>
                        <div class="mt-1">
                            <div class="progress" style="height: 3px; background: #e5e7eb; border-radius: 10px; max-width: 80px;">
                                <div class="progress-bar" style="width: {{ $completionRate }}%; background: linear-gradient(90deg, #4f46e5, #22c55e); border-radius: 10px;"></div>
                            </div>
                            <small class="small" style="color: #6b7280; font-size: 0.55rem;">{{ $completionRate }}% done</small>
                        </div>
                    </div>
                    <div class="rounded-3 p-2" style="background: rgba(34, 197, 94, 0.08);">
                        <i class="fas fa-check-circle" style="color: #22c55e; font-size: 1.2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card border-0 rounded-3 p-3 h-100" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04); transition: all 0.3s ease;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-0" style="color: #6c757d; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600;">Pending</p>
                        <h3 class="fw-bold mb-0" style="color: #111827; font-size: 1.5rem;">{{ $pendingTasks }}</h3>
                        <small style="color: #6c757d; font-size: 0.55rem;">
                            <i class="fas fa-exclamation-triangle text-warning"></i> Needs attention
                        </small>
                    </div>
                    <div class="rounded-3 p-2" style="background: rgba(234, 179, 8, 0.08);">
                        <i class="fas fa-clock" style="color: #eab308; font-size: 1.2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== CHARTS SECTION ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4">
    <div class="row g-4 mb-4">
        <!-- Line Chart - Task Trends -->
        <div class="col-lg-8">
            <div class="card border-0 rounded-3 h-100" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-bold mb-0" style="color: #111827; font-size: 0.95rem;">
                                <i class="fas fa-chart-line me-2" style="color: #4f46e5;"></i> Task Trends
                            </h6>
                            <small class="text-muted" style="color: #6c757d; font-size: 0.7rem;">Monthly task creation overview</small>
                        </div>
                        <span class="badge rounded-pill" style="background: rgba(79,70,229,0.08); color: #4f46e5; font-size: 0.6rem;">
                            Last 6 months
                        </span>
                    </div>
                    <div style="position: relative; height: 250px;">
                        <canvas id="taskLineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pie Chart - Task Status Distribution -->
        <div class="col-lg-4">
            <div class="card border-0 rounded-3 h-100" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-bold mb-0" style="color: #111827; font-size: 0.95rem;">
                                <i class="fas fa-chart-pie me-2" style="color: #8b5cf6;"></i> Task Status
                            </h6>
                            <small class="text-muted" style="color: #6c757d; font-size: 0.7rem;">Distribution by status</small>
                        </div>
                    </div>
                    <div style="position: relative; height: 220px;">
                        <canvas id="taskPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== QUICK ACTIONS ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4">
    <div class="card border-0 rounded-3 mb-4" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-0" style="color: #111827; font-size: 0.9rem;">
                        <i class="fas fa-bolt text-warning me-2"></i> Quick Actions
                    </h6>
                </div>
                <div class="d-flex gap-2 flex-wrap mt-2 mt-sm-0">
                    <a href="{{ route('projects.create') }}" class="btn btn-sm rounded-3 px-3" style="background: linear-gradient(135deg, #4f46e5, #6366f1); color: #ffffff; border: none; font-weight: 500; font-size: 0.75rem;">
                        <i class="fas fa-plus-circle me-1"></i> New Project
                    </a>
                    <a href="{{ route('tasks.create') }}" class="btn btn-sm rounded-3 px-3" style="background: linear-gradient(135deg, #22c55e, #16a34a); color: #ffffff; border: none; font-weight: 500; font-size: 0.75rem;">
                        <i class="fas fa-plus-circle me-1"></i> New Task
                    </a>
                    <a href="{{ route('projects.index') }}" class="btn btn-sm rounded-3 px-3" style="background: #111827; color: #ffffff; border: none; font-weight: 500; font-size: 0.75rem;">
                        <i class="fas fa-folder-open me-1"></i> View Projects
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== RECENT PROJECTS & TASKS ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4">
    <div class="row g-4">
        <!-- Recent Projects -->
        <div class="col-lg-6">
            <div class="card border-0 rounded-3 h-100" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0" style="color: #111827; font-size: 0.9rem;">
                            <i class="fas fa-folder-open me-2" style="color: #4f46e5;"></i> Recent Projects
                        </h6>
                        <a href="{{ route('projects.index') }}" class="btn btn-sm rounded-3" style="color: #4f46e5; border: 1px solid #e5e7eb; font-size: 0.65rem; transition: all 0.3s ease;">
                            View All →
                        </a>
                    </div>
                    
                    @if($recentProjects->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentProjects as $project)
                                <a href="{{ route('projects.show', $project) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 px-0 py-1" style="background: transparent !important; color: #4a5568 !important; border-bottom: 1px solid #f1f3f5 !important;">
                                    <div>
                                        <i class="fas fa-folder me-2" style="color: #fbbf24; font-size: 0.75rem;"></i>
                                        <span class="fw-medium" style="color: #111827; font-size: 0.8rem;">{{ Str::limit($project->name, 25) }}</span>
                                        <br>
                                        <small style="color: #6c757d !important; font-size: 0.6rem;">
                                            <i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($project->created_at)->format('d M Y') }}
                                            <span class="mx-1">·</span>
                                            <i class="fas fa-tasks me-1"></i> {{ $project->tasks->count() }}
                                        </small>
                                    </div>
                                    <span class="badge rounded-pill 
                                        @if($project->status == 'completed')" style="background: #d4edda; color: #155724; font-weight: 500; font-size: 0.55rem;"
                                        @elseif($project->status == 'in_progress')" style="background: #cce5ff; color: #004085; font-weight: 500; font-size: 0.55rem;"
                                        @else" style="background: #fff3cd; color: #856404; font-weight: 500; font-size: 0.55rem;" @endif>
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-folder-open fa-2x mb-2 d-block" style="color: #dee2e6;"></i>
                            <p class="text-muted" style="color: #6c757d; font-size: 0.8rem;">No projects yet</p>
                            <a href="{{ route('projects.create') }}" class="btn btn-sm rounded-3" style="background: #4f46e5; color: #ffffff; border: none;">
                                Create First Project
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Tasks -->
        <div class="col-lg-6">
            <div class="card border-0 rounded-3 h-100" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0" style="color: #111827; font-size: 0.9rem;">
                            <i class="fas fa-tasks me-2" style="color: #8b5cf6;"></i> Recent Tasks
                        </h6>
                        <a href="{{ route('tasks.create') }}" class="btn btn-sm rounded-3" style="color: #8b5cf6; border: 1px solid #e5e7eb; font-size: 0.65rem; transition: all 0.3s ease;">
                            Add New →
                        </a>
                    </div>
                    
                    @if($recentTasks->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentTasks as $task)
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-1" style="background: transparent !important; color: #4a5568 !important; border-bottom: 1px solid #f1f3f5 !important;">
                                    <div>
                                        <span class="badge rounded-circle me-2" 
                                            style="width: 8px; height: 8px; display: inline-block; padding: 0; 
                                            @if($task->status == 'completed') background: #34d399;
                                            @elseif($task->status == 'in_progress') background: #60a5fa;
                                            @else background: #fbbf24; @endif">
                                        </span>
                                        <span class="fw-medium" style="color: #111827; font-size: 0.8rem;">{{ Str::limit($task->title, 25) }}</span>
                                        <br>
                                        <small style="color: #6c757d !important; font-size: 0.6rem;">
                                            <i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                            <span class="mx-1">·</span>
                                            <i class="fas fa-folder me-1" style="color: #fbbf24;"></i> {{ Str::limit($task->project->name, 15) }}
                                        </small>
                                    </div>
                                    <span class="badge rounded-pill 
                                        @if($task->priority == 'high')" style="background: #f8d7da; color: #721c24; font-weight: 500; font-size: 0.55rem;"
                                        @elseif($task->priority == 'medium')" style="background: #fff3cd; color: #856404; font-weight: 500; font-size: 0.55rem;"
                                        @else" style="background: #d4edda; color: #155724; font-weight: 500; font-size: 0.55rem;" @endif>
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-tasks fa-2x mb-2 d-block" style="color: #dee2e6;"></i>
                            <p class="text-muted" style="color: #6c757d; font-size: 0.8rem;">No tasks yet</p>
                            <a href="{{ route('tasks.create') }}" class="btn btn-sm rounded-3" style="background: #8b5cf6; color: #ffffff; border: none;">
                                Add First Task
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== Footer Info ===== -->
<div class="container-fluid px-4 mt-3">
    <div class="text-center pt-2" style="border-top: 1px solid #e5e7eb;">
        <p class="text-muted small mb-0" style="color: #6c757d; font-size: 0.65rem;">
            <i class="fas fa-info-circle me-1"></i>
            You have <strong style="color: #111827;">{{ $totalProjects }}</strong> projects and <strong style="color: #111827;">{{ $totalTasks }}</strong> tasks
        </p>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== CHART.JS SCRIPTS ===== -->
<!-- ============================================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    const textColor = isDark ? '#f1f5f9' : '#111827';
    const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';
    
    // ===== Line Chart - Task Trends =====
    const lineCtx = document.getElementById('taskLineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Tasks Created',
                data: {!! json_encode($monthlyTasks) !!},
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#4f46e5',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: textColor,
                        font: { size: 11 }
                    },
                    grid: {
                        color: gridColor
                    }
                },
                x: {
                    ticks: {
                        color: textColor,
                        font: { size: 11 }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // ===== Pie Chart - Task Status =====
    const pieCtx = document.getElementById('taskPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                data: {!! json_encode($chartData) !!},
                backgroundColor: ['#fbbf24', '#60a5fa', '#34d399'],
                borderColor: isDark ? '#1e293b' : '#ffffff',
                borderWidth: 2,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: textColor,
                        font: { size: 11, weight: '500' },
                        padding: 16,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            },
            cutout: '60%'
        }
    });
});

// Re-render charts on theme change
document.addEventListener('themeChanged', function() {
    // Recreate charts with new theme colors
    location.reload();
});
</script>

<!-- ============================================= -->
<!-- ===== CSS ===== -->
<!-- ============================================= -->
<style>
    /* ===== Card Hover Effect ===== */
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06) !important;
        transition: all 0.3s ease;
    }

    /* ===== List Group Hover ===== */
    .list-group-item:hover {
        background: rgba(79, 70, 229, 0.03) !important;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    /* ===== Dark Mode Support ===== */
    [data-theme="dark"] .card {
        background: rgba(30, 41, 59, 0.85) !important;
        backdrop-filter: blur(10px);
    }

    [data-theme="dark"] .card h3,
    [data-theme="dark"] .card h6,
    [data-theme="dark"] .card .fw-medium {
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .card .text-muted {
        color: #94a3b8 !important;
    }

    [data-theme="dark"] .list-group-item {
        border-color: rgba(255,255,255,0.05) !important;
        color: #cbd5e1 !important;
    }

    [data-theme="dark"] .list-group-item .fw-medium {
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .list-group-item small {
        color: #94a3b8 !important;
    }

    [data-theme="dark"] .hero-banner {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
    }

    [data-theme="dark"] .btn[style*="background: #111827"] {
        background: rgba(255,255,255,0.1) !important;
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .btn[style*="background: #111827"]:hover {
        background: rgba(255,255,255,0.2) !important;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .hero-banner h1 {
            font-size: 1.4rem !important;
        }
        
        .hero-banner {
            min-height: 130px !important;
            padding: 16px !important;
        }

        .hero-banner .text-center {
            min-width: 50px !important;
            padding: 6px 10px !important;
        }

        .hero-banner .text-center h5 {
            font-size: 1rem !important;
        }

        .hero-banner .text-center p {
            font-size: 0.4rem !important;
        }
        
        .card h3 {
            font-size: 1.2rem !important;
        }

        .card-body {
            padding: 12px !important;
        }

        .card-body .p-4 {
            padding: 16px !important;
        }
    }
</style>

@endsection