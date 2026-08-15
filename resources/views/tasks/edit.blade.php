@extends('layouts.app')

@section('content')

<!-- ============================================= -->
<!-- ===== BANNER SECTION ===== -->
<!-- ============================================= -->
<div class="hero-banner w-100 mb-4 overflow-hidden position-relative" 
     style="background: url('{{ asset('images/banner.png') }}');
            background-size: cover;
            background-position: center;
            min-height: 200px;
            border-radius: 0;
            border: none;
            margin-left: calc(-50vw + 50%);
            margin-right: calc(-50vw + 50%);
            width: 100vw;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(135deg, rgba(10,10,26,0.7) 0%, rgba(22,33,62,0.5) 40%, rgba(15,52,96,0.4) 70%, rgba(10,10,26,0.7) 100%);">
    </div>
    
    <!-- Decorative Elements -->
    <div class="position-absolute" style="top: -60px; right: -20px; width: 150px; height: 150px; background: rgba(251, 191, 36, 0.05); border-radius: 50%; z-index: 1;"></div>
    <div class="position-absolute" style="bottom: -60px; left: -10px; width: 180px; height: 180px; background: rgba(251, 191, 36, 0.03); border-radius: 50%; z-index: 1;"></div>
    
    <!-- Glowing Dots -->
    <div class="position-absolute" style="bottom: 20px; right: 40px; width: 6px; height: 6px; background: #fbbf24; border-radius: 50%; box-shadow: 0 0 30px rgba(251, 191, 36, 0.3); z-index: 1; animation: pulseDot 3s ease-in-out infinite;"></div>
    <div class="position-absolute" style="top: 20px; left: 15%; width: 4px; height: 4px; background: #f59e0b; border-radius: 50%; box-shadow: 0 0 20px rgba(245, 158, 11, 0.3); z-index: 1; animation: pulseDot 2.5s ease-in-out infinite 1s;"></div>
    
    <div class="position-relative d-flex align-items-center" style="min-height: 200px; z-index: 2; padding: 30px 50px;">
        <div class="container-fluid px-0">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Breadcrumb / Badge -->
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.06); color: rgba(255,255,255,0.7); font-size: 0.7rem; letter-spacing: 0.5px; text-transform: uppercase; backdrop-filter: blur(5px);">
                            <i class="fas fa-edit me-1" style="color: #fbbf24;"></i> Edit
                        </span>
                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(96, 165, 250, 0.12); border: 1px solid rgba(96, 165, 250, 0.08); color: #60a5fa; font-size: 0.7rem; backdrop-filter: blur(5px);">
                            <i class="fas fa-tasks me-1"></i> {{ $task->title }}
                        </span>
                    </div>
                    
                    <!-- Main Topic -->
                    <h1 class="fw-bold mb-2" style="font-size: 2.5rem; color: #ffffff; text-shadow: 0 2px 30px rgba(0,0,0,0.3); letter-spacing: -0.5px;">
                        <span style="background: linear-gradient(90deg, #fbbf24, #f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Edit
                        </span>
                        <span style="color: #ffffff; font-weight: 300;">Task</span>
                    </h1>
                    
                    <!-- Description -->
                    <p class="text-white/70 mb-0" style="font-size: 1rem; max-width: 600px; text-shadow: 0 1px 10px rgba(0,0,0,0.2);">
                        <i class="fas fa-arrow-right me-2" style="color: #fbbf24;"></i> 
                        Update the task details below
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== EDIT TASK FORM ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success border-0 rounded-3 mb-4" style="background: #d4edda; color: #155724; padding: 12px 20px; border-left: 4px solid #34d399;">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="card border-0 rounded-3" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Project -->
                        <div class="mb-3">
                            <label for="project_id" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                <i class="fas fa-folder-open me-1" style="color: #fbbf24;"></i> Project <span class="text-danger">*</span>
                            </label>
                            <select name="project_id" id="project_id" 
                                    class="form-select rounded-3 @error('project_id') is-invalid @enderror" 
                                    style="border: 2px solid #e5e7eb; padding: 12px 16px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;" 
                                    required>
                                <option value="">Select a project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Task Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                <i class="fas fa-heading me-1" style="color: #fbbf24;"></i> Task Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" 
                                   class="form-control rounded-3 @error('title') is-invalid @enderror" 
                                   style="border: 2px solid #e5e7eb; padding: 12px 16px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;"
                                   placeholder="Enter task title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                <i class="fas fa-align-left me-1" style="color: #fbbf24;"></i> Description
                            </label>
                            <textarea name="description" id="description" rows="4" 
                                      class="form-control rounded-3 @error('description') is-invalid @enderror" 
                                      style="border: 2px solid #e5e7eb; padding: 12px 16px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;"
                                      placeholder="Enter task description">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Due Date -->
                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                    <i class="fas fa-calendar-check me-1" style="color: #fbbf24;"></i> Due Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" 
                                       class="form-control rounded-3 @error('due_date') is-invalid @enderror" 
                                       style="border: 2px solid #e5e7eb; padding: 12px 16px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;"
                                       required>
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Priority -->
                            <div class="col-md-6 mb-3">
                                <label for="priority" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                    <i class="fas fa-flag me-1" style="color: #fbbf24;"></i> Priority
                                </label>
                                <select name="priority" id="priority" 
                                        class="form-select rounded-3 @error('priority') is-invalid @enderror" 
                                        style="border: 2px solid #e5e7eb; padding: 12px 16px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;">
                                    <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>🟢 Low</option>
                                    <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                                    <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>🔴 High</option>
                                </select>
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                <i class="fas fa-chart-simple me-1" style="color: #fbbf24;"></i> Status
                            </label>
                            <select name="status" id="status" 
                                    class="form-select rounded-3 @error('status') is-invalid @enderror" 
                                    style="border: 2px solid #e5e7eb; padding: 12px 16px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;">
                                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-3">
                            <a href="{{ route('projects.show', $task->project_id) }}" class="btn rounded-3 px-4 py-2" style="background: #f8f9fa; color: #4a5568; border: 2px solid #e5e7eb; font-weight: 600; font-size: 0.85rem; transition: all 0.3s ease;">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn rounded-3 px-4 py-2" style="background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #ffffff; border: none; font-weight: 600; font-size: 0.85rem; transition: all 0.3s ease; box-shadow: 0 2px 12px rgba(251,191,36,0.2);">
                                <i class="fas fa-save me-2"></i> Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== CSS ===== -->
<!-- ============================================= -->
<style>
    @keyframes pulseDot {
        0%, 100% { opacity: 0.3; transform: scale(0.8); }
        50% { opacity: 1; transform: scale(1.3); }
    }

    .form-control:focus, .form-select:focus {
        border-color: #fbbf24 !important;
        box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.08) !important;
        background: #ffffff !important;
    }

    .btn:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.06) !important;
        transition: all 0.3s ease;
    }

    [data-theme="dark"] .card {
        background: rgba(30, 41, 59, 0.85) !important;
        backdrop-filter: blur(10px);
    }

    [data-theme="dark"] .card label {
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .form-control,
    [data-theme="dark"] .form-select {
        background: rgba(255,255,255,0.05) !important;
        border-color: rgba(255,255,255,0.1) !important;
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .form-control::placeholder {
        color: #94a3b8 !important;
    }

    [data-theme="dark"] .btn[style*="background: #f8f9fa"] {
        background: rgba(255,255,255,0.05) !important;
        color: #94a3b8 !important;
        border-color: rgba(255,255,255,0.1) !important;
    }

    [data-theme="dark"] .alert-success {
        background: rgba(52, 211, 153, 0.15) !important;
        color: #34d399 !important;
        border-color: rgba(52, 211, 153, 0.1) !important;
    }

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
            padding: 10px 16px !important;
        }
    }
</style>

@endsection