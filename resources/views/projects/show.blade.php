@extends('layouts.app')

@section('content')

<!-- ============================================= -->
<!-- ===== BANNER SECTION - NO IMAGE, ONLY GRADIENT ===== -->
<!-- ============================================= -->
<div class="hero-banner w-100 mb-4 overflow-hidden position-relative" 
     style="background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
            min-height: 200px;
            border-radius: 0;
            border: none;
            margin-left: calc(-50vw + 50%);
            margin-right: calc(-50vw + 50%);
            width: 100vw;">
    
    <!-- Decorative Elements -->
    <div class="position-absolute" style="top: -60px; right: -20px; width: 150px; height: 150px; background: rgba(96, 165, 250, 0.06); border-radius: 50%; z-index: 1;"></div>
    <div class="position-absolute" style="bottom: -60px; left: -10px; width: 180px; height: 180px; background: rgba(167, 139, 250, 0.04); border-radius: 50%; z-index: 1;"></div>
    
    <!-- Glowing Dots -->
    <div class="position-absolute" style="bottom: 20px; right: 40px; width: 6px; height: 6px; background: #60a5fa; border-radius: 50%; box-shadow: 0 0 30px rgba(96, 165, 250, 0.3); z-index: 1; animation: pulseDot 3s ease-in-out infinite;"></div>
    <div class="position-absolute" style="top: 20px; left: 15%; width: 4px; height: 4px; background: #a78bfa; border-radius: 50%; box-shadow: 0 0 20px rgba(167, 139, 250, 0.3); z-index: 1; animation: pulseDot 2.5s ease-in-out infinite 1s;"></div>
    
    <div class="position-relative d-flex align-items-center" style="min-height: 200px; z-index: 2; padding: 30px 50px;">
        <div class="container-fluid px-0">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <!-- Badges -->
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.06); color: rgba(255,255,255,0.7); font-size: 0.7rem; backdrop-filter: blur(5px);">
                            <i class="fas fa-folder-open me-1" style="color: #60a5fa;"></i> Project Details
                        </span>
                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(52, 211, 153, 0.15); border: 1px solid rgba(52, 211, 153, 0.1); color: #34d399; font-size: 0.7rem; backdrop-filter: blur(5px);">
                            <i class="fas fa-tasks me-1"></i> {{ $project->tasks->count() }} Tasks
                        </span>
                    </div>
                    
                    <!-- Project Name -->
                    <h1 class="fw-bold mb-2" style="font-size: 2.5rem; color: #ffffff; text-shadow: 0 2px 30px rgba(0,0,0,0.3);">
                        <span style="background: linear-gradient(90deg, #60a5fa, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            {{ $project->name }}
                        </span>
                    </h1>
                    
                    <!-- Description -->
                    <p class="text-white/70 mb-0" style="font-size: 1rem; max-width: 600px; text-shadow: 0 1px 10px rgba(0,0,0,0.2);">
                        <i class="fas fa-arrow-right me-2" style="color: #60a5fa;"></i> 
                        {{ $project->description ?? 'No description provided' }}
                    </p>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="d-flex gap-2 justify-content-lg-end">
                        <a href="{{ route('projects.edit', $project) }}" class="btn rounded-3 px-4 py-2" style="background: rgba(251, 191, 36, 0.15); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.1); font-weight: 600; font-size: 0.8rem; transition: all 0.3s ease;">
                            <i class="fas fa-edit me-2"></i> Edit
                        </a>
                        <a href="{{ route('projects.index') }}" class="btn rounded-3 px-4 py-2" style="background: rgba(255,255,255,0.08); color: #ffffff; border: 1px solid rgba(255,255,255,0.1); font-weight: 600; font-size: 0.8rem; transition: all 0.3s ease;">
                            <i class="fas fa-arrow-left me-2"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== PROJECT INFO & TASKS ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4">
    <!-- Project Info Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="card border-0 rounded-3 p-3" style="background: #f8fafc; transition: all 0.3s ease;">
                <p class="text-muted small mb-0" style="color: #6c757d !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px;">Status</p>
                <span class="badge rounded-pill px-3 py-2 mt-1" style="font-weight: 600; font-size: 0.75rem; 
                    @if($project->status == 'completed') background: #d4edda; color: #155724;
                    @elseif($project->status == 'in_progress') background: #cce5ff; color: #004085;
                    @else background: #fff3cd; color: #856404; @endif">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 rounded-3 p-3" style="background: #f8fafc; transition: all 0.3s ease;">
                <p class="text-muted small mb-0" style="color: #6c757d !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px;">Start Date</p>
                <h6 class="fw-bold mb-0" style="color: #111827; font-size: 0.9rem;">
                    <i class="far fa-calendar-alt me-1" style="color: #60a5fa;"></i> 
                    {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}
                </h6>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 rounded-3 p-3" style="background: #f8fafc; transition: all 0.3s ease;">
                <p class="text-muted small mb-0" style="color: #6c757d !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px;">End Date</p>
                <h6 class="fw-bold mb-0" style="color: #111827; font-size: 0.9rem;">
                    <i class="far fa-calendar-check me-1" style="color: #fbbf24;"></i> 
                    {{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}
                </h6>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 rounded-3 p-3" style="background: #f8fafc; transition: all 0.3s ease;">
                <p class="text-muted small mb-0" style="color: #6c757d !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px;">Total Tasks</p>
                <h6 class="fw-bold mb-0" style="color: #111827; font-size: 0.9rem;">
                    <i class="fas fa-tasks me-1" style="color: #a78bfa;"></i> 
                    {{ $project->tasks->count() }}
                </h6>
            </div>
        </div>
    </div>

    <!-- Tasks Section -->
    <div class="card border-0 rounded-3" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center p-4">
            <div>
                <h5 class="fw-bold mb-0" style="color: #111827; font-size: 1.1rem;">
                    <i class="fas fa-list-check me-2" style="color: #4f46e5;"></i> Tasks
                </h5>
                <p class="text-muted small mb-0" style="color: #6c757d !important; font-size: 0.75rem;">
                    {{ $project->tasks->count() }} tasks in this project
                </p>
            </div>
            <a href="{{ route('tasks.create') }}?project_id={{ $project->id }}" class="btn rounded-3 px-3 py-2" style="background: linear-gradient(135deg, #4f46e5, #6366f1); color: #ffffff; border: none; font-weight: 500; font-size: 0.8rem; transition: all 0.3s ease;">
                <i class="fas fa-plus-circle me-2"></i> Add Task
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 mx-4" style="background: #d4edda; color: #155724; padding: 12px 20px;">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card-body p-4 pt-0">
            @if($project->tasks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background: #f8fafc; border-bottom: 2px solid #e5e7eb;">
                            <tr>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; padding: 12px 16px;">#</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; padding: 12px 16px;">Title</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; padding: 12px 16px;">Priority</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; padding: 12px 16px;">Due Date</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; padding: 12px 16px;">Status</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; padding: 12px 16px; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($project->tasks as $task)
                            <tr style="border-bottom: 1px solid #f1f3f5; transition: all 0.3s ease;">
                                <td style="color: #6b7280; font-weight: 500; font-size: 0.85rem; padding: 10px 16px;">{{ $loop->iteration }}</td>
                                <td style="padding: 10px 16px;">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge rounded-circle" style="width: 8px; height: 8px; display: inline-block; padding: 0; 
                                            @if($task->status == 'completed') background: #34d399;
                                            @elseif($task->status == 'in_progress') background: #60a5fa;
                                            @else background: #fbbf24; @endif">
                                        </span>
                                        <span class="fw-medium" style="color: #111827; font-size: 0.85rem;">{{ $task->title }}</span>
                                    </div>
                                </td>
                                <td style="padding: 10px 16px;">
                                    <span class="badge rounded-pill px-3 py-1" style="font-weight: 500; font-size: 0.65rem;
                                        @if($task->priority == 'high') background: #f8d7da; color: #721c24;
                                        @elseif($task->priority == 'medium') background: #fff3cd; color: #856404;
                                        @else background: #d4edda; color: #155724; @endif">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </td>
                                <!-- ===== DUE DATE WITH INDICATORS ===== -->
                                <td style="padding: 10px 16px;">
                                    @php
                                        $dueDate = \Carbon\Carbon::parse($task->due_date);
                                        $today = \Carbon\Carbon::today();
                                        $isOverdue = $dueDate->lt($today) && $task->status !== 'completed';
                                        $isToday = $dueDate->isToday();
                                        $isThisWeek = $dueDate->between($today, $today->copy()->addDays(7));
                                    @endphp
                                    
                                    <div style="display: flex; align-items: center; gap: 6px;">
                                        @if($isOverdue)
                                            <i class="fas fa-exclamation-circle" style="color: #ef4444; font-size: 0.7rem;"></i>
                                            <span style="color: #ef4444; font-weight: 600; font-size: 0.8rem;">{{ $dueDate->format('d M Y') }}</span>
                                            <span style="color: #ef4444; font-size: 0.6rem; font-weight: 500;">(Overdue)</span>
                                        @elseif($isToday)
                                            <i class="fas fa-clock" style="color: #fbbf24; font-size: 0.7rem;"></i>
                                            <span style="color: #fbbf24; font-weight: 600; font-size: 0.8rem;">Today</span>
                                        @elseif($isThisWeek)
                                            <i class="fas fa-calendar-week" style="color: #60a5fa; font-size: 0.7rem;"></i>
                                            <span style="color: #6b7280; font-size: 0.8rem;">{{ $dueDate->format('d M Y') }}</span>
                                            <span style="color: #60a5fa; font-size: 0.6rem;">(This week)</span>
                                        @else
                                            <i class="far fa-calendar-alt" style="color: #6b7280; font-size: 0.7rem;"></i>
                                            <span style="color: #6b7280; font-size: 0.8rem;">{{ $dueDate->format('d M Y') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <!-- ===== STATUS WITH AJAX SELECT ===== -->
                                <td style="padding: 10px 16px;">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge rounded-circle status-dot" style="width: 8px; height: 8px; display: inline-block; padding: 0; 
                                            @if($task->status == 'completed') background: #34d399;
                                            @elseif($task->status == 'in_progress') background: #60a5fa;
                                            @else background: #fbbf24; @endif">
                                        </span>
                                        <select class="form-select form-select-sm task-status-select border-0" 
                                                data-task-id="{{ $task->id }}"
                                                style="background: transparent; font-weight: 500; font-size: 0.7rem; padding: 2px 20px 2px 4px; width: auto; cursor: pointer; min-width: 100px;
                                                    @if($task->status == 'completed') color: #155724;
                                                    @elseif($task->status == 'in_progress') color: #004085;
                                                    @else color: #856404; @endif">
                                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                        </select>
                                    </div>
                                </td>
                                <td style="padding: 10px 16px; text-align: center;">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm rounded-3" style="background: rgba(251, 191, 36, 0.08); color: #fbbf24; border: none; font-size: 0.7rem; transition: all 0.3s ease;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm rounded-3" style="background: rgba(239, 68, 68, 0.08); color: #ef4444; border: none; font-size: 0.7rem; transition: all 0.3s ease;" onclick="return confirm('Are you sure you want to delete this task?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <div class="d-inline-flex p-3 rounded-circle" style="background: #f8f9fa;">
                            <i class="fas fa-tasks fa-3x" style="color: #dee2e6;"></i>
                        </div>
                    </div>
                    <h6 class="fw-bold" style="color: #111827;">No Tasks Yet</h6>
                    <p class="text-muted small mb-3" style="color: #6c757d !important;">Add your first task to this project</p>
                    <a href="{{ route('tasks.create') }}?project_id={{ $project->id }}" class="btn btn-sm rounded-3" style="background: #4f46e5; color: #ffffff; border: none;">
                        <i class="fas fa-plus-circle me-2"></i> Add Task
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- ===== ACTIVITY LOG SECTION ===== -->
    @php
        use App\Helpers\ActivityHelper;
        $activities = ActivityHelper::getRecentActivities(5);
    @endphp

    @if($activities->count() > 0)
    <div class="card border-0 rounded-3 mt-4" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
        <div class="card-header bg-transparent border-0 p-4">
            <h5 class="fw-bold mb-0" style="color: #111827; font-size: 1.1rem;">
                <i class="fas fa-clock me-2" style="color: #4f46e5;"></i> Recent Activity
            </h5>
        </div>
        <div class="card-body p-4 pt-0">
            <div class="timeline">
                @foreach($activities as $activity)
                    <div class="timeline-item d-flex gap-3 pb-3" style="border-bottom: 1px solid #f1f3f5; position: relative; padding-left: 20px;">
                        <!-- Timeline Dot -->
                        <div style="position: absolute; left: 0; top: 6px; width: 10px; height: 10px; border-radius: 50%; 
                            @if($activity->action == 'created') background: #34d399;
                            @elseif($activity->action == 'updated') background: #60a5fa;
                            @elseif($activity->action == 'deleted') background: #ef4444;
                            @elseif($activity->action == 'restored') background: #fbbf24;
                            @else background: #6b7280; @endif">
                        </div>
                        
                        <!-- Activity Content -->
                        <div style="flex: 1;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="fw-medium" style="color: #111827; font-size: 0.9rem;">
                                        <i class="fas 
                                            @if($activity->action == 'created') fa-plus-circle text-success
                                            @elseif($activity->action == 'updated') fa-edit text-primary
                                            @elseif($activity->action == 'deleted') fa-trash-alt text-danger
                                            @elseif($activity->action == 'restored') fa-undo text-warning
                                            @else fa-info-circle text-secondary @endif
                                            me-1"></i>
                                        {{ ucfirst($activity->action) }}
                                    </span>
                                    <span style="color: #6b7280; font-size: 0.85rem;">{{ $activity->details }}</span>
                                </div>
                                <span style="color: #94a3b8; font-size: 0.7rem; white-space: nowrap; margin-left: 12px;">
                                    {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<!-- ============================================= -->
<!-- ===== AJAX STATUS UPDATE SCRIPT ===== -->
<!-- ============================================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status update via AJAX for Tasks
    const statusSelects = document.querySelectorAll('.task-status-select');
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const taskId = this.dataset.taskId;
            const newStatus = this.value;
            const row = this.closest('tr');
            const statusBadge = row ? row.querySelector('.badge:not(.status-dot)') : null;
            const statusDot = row ? row.querySelector('.status-dot') : null;
            
            // Show loading state
            this.disabled = true;
            this.style.opacity = '0.6';
            
            // Send AJAX request
            fetch(`/tasks/${taskId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update badge
                    const statusColors = {
                        'pending': { bg: '#fff3cd', color: '#856404', text: 'Pending' },
                        'in_progress': { bg: '#cce5ff', color: '#004085', text: 'In Progress' },
                        'completed': { bg: '#d4edda', color: '#155724', text: 'Completed' }
                    };
                    
                    const colors = statusColors[newStatus];
                    if (statusBadge) {
                        statusBadge.style.background = colors.bg;
                        statusBadge.style.color = colors.color;
                        statusBadge.textContent = colors.text;
                    }
                    
                    // Show success message
                    showToast('✅ ' + data.message, 'success');
                    
                    // Update the status dot
                    if (statusDot) {
                        const dotColors = {
                            'pending': '#fbbf24',
                            'in_progress': '#60a5fa',
                            'completed': '#34d399'
                        };
                        statusDot.style.background = dotColors[newStatus];
                    }
                    
                    // Update select color
                    this.style.color = colors.color;
                }
            })
            .catch(error => {
                showToast('❌ Failed to update status. Please try again.', 'error');
                this.value = this.dataset.oldStatus || this.value;
            })
            .finally(() => {
                this.disabled = false;
                this.style.opacity = '1';
            });
        });
        
        select.addEventListener('focus', function() {
            this.dataset.oldStatus = this.value;
        });
    });
});

// Toast notification function
function showToast(message, type = 'success') {
    const colors = {
        success: { bg: '#d4edda', color: '#155724', icon: '✅' },
        error: { bg: '#f8d7da', color: '#721c24', icon: '❌' }
    };
    
    const config = colors[type] || colors.success;
    
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: ${config.bg};
        color: ${config.color};
        padding: 12px 24px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        font-weight: 500;
        font-size: 14px;
        z-index: 9999;
        animation: slideIn 0.3s ease-out;
        border-left: 4px solid ${type === 'success' ? '#34d399' : '#ef4444'};
        max-width: 400px;
    `;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Add animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);
</script>

<!-- ============================================= -->
<!-- ===== CSS ===== -->
<!-- ============================================= -->
<style>
    /* ===== Pulse Animation ===== */
    @keyframes pulseDot {
        0%, 100% { opacity: 0.3; transform: scale(0.8); }
        50% { opacity: 1; transform: scale(1.3); }
    }

    .btn:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.06) !important;
        transition: all 0.3s ease;
    }

    /* ===== Timeline Hover ===== */
    .timeline-item:hover {
        background: rgba(0,0,0,0.01);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    /* ===== Task Status Select Hover ===== */
    .task-status-select:hover {
        background: rgba(0,0,0,0.03) !important;
        border-radius: 4px;
    }

    /* ===== Dark Mode - Keep Banner Colors Fixed ===== */
    .hero-banner {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
    }

    [data-theme="dark"] .hero-banner {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
    }

    [data-theme="dark"] .card {
        background: rgba(30, 41, 59, 0.85) !important;
        backdrop-filter: blur(10px);
    }

    [data-theme="dark"] .card h5,
    [data-theme="dark"] .card h6,
    [data-theme="dark"] .card .fw-medium {
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .card .text-muted {
        color: #94a3b8 !important;
    }

    [data-theme="dark"] .card[style*="background: #f8fafc"] {
        background: rgba(255,255,255,0.03) !important;
    }

    [data-theme="dark"] thead {
        background: rgba(255,255,255,0.02) !important;
    }

    [data-theme="dark"] thead th {
        color: #94a3b8 !important;
    }

    [data-theme="dark"] tbody tr {
        border-color: rgba(255,255,255,0.03) !important;
    }

    [data-theme="dark"] tbody tr:hover {
        background: rgba(255,255,255,0.02) !important;
    }

    [data-theme="dark"] tbody td {
        color: #cbd5e1 !important;
    }

    [data-theme="dark"] tbody td .fw-medium {
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .alert-success {
        background: rgba(52, 211, 153, 0.15) !important;
        color: #34d399 !important;
        border-color: rgba(52, 211, 153, 0.1) !important;
    }

    [data-theme="dark"] .timeline-item {
        border-color: rgba(255,255,255,0.05) !important;
    }

    [data-theme="dark"] .timeline-item .fw-medium {
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .timeline-item span[style*="color: #6b7280"] {
        color: #94a3b8 !important;
    }

    [data-theme="dark"] .task-status-select {
        color: #cbd5e1 !important;
        background: transparent !important;
    }

    [data-theme="dark"] .task-status-select option {
        background: #1e293b !important;
        color: #f1f5f9 !important;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .hero-banner h1 {
            font-size: 1.8rem !important;
        }
        .hero-banner {
            min-height: 150px !important;
        }
        .hero-banner .badge {
            font-size: 0.6rem !important;
        }
        .card-body {
            padding: 20px !important;
        }
        .btn {
            font-size: 0.75rem !important;
            padding: 8px 12px !important;
        }
        .timeline-item {
            padding-left: 16px !important;
        }
        .timeline-item .d-flex {
            flex-direction: column;
            gap: 4px;
        }
        .timeline-item .d-flex .justify-content-between {
            width: 100%;
        }
        .timeline-item span[style*="white-space: nowrap"] {
            white-space: normal !important;
        }
        .task-status-select {
            font-size: 0.65rem !important;
            min-width: 80px !important;
        }
    }
</style>

@endsection