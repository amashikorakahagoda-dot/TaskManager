@extends('layouts.app')

@section('content')

<!-- ============================================= -->
<!-- ===== BANNER SECTION - MATCHED SIZE ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4 mt-3">
    <div class="row">
        <div class="col-12">
            <div class="hero-banner rounded-3 mb-4 p-4" 
                 style="background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
                        min-height: 120px;
                        position: relative;
                        overflow: hidden;">
                
                <!-- Decorative Circles -->
                <div class="position-absolute" style="top: -30px; right: -15px; width: 100px; height: 100px; background: rgba(96, 165, 250, 0.05); border-radius: 50%;"></div>
                <div class="position-absolute" style="bottom: -30px; left: -10px; width: 120px; height: 120px; background: rgba(96, 165, 250, 0.04); border-radius: 50%;"></div>
                
                <!-- Glowing Dots -->
                <div class="position-absolute" style="bottom: 15px; right: 30px; width: 4px; height: 4px; background: #60a5fa; border-radius: 50%; box-shadow: 0 0 20px rgba(96, 165, 250, 0.3); z-index: 1; animation: pulseDot 3s ease-in-out infinite;"></div>
                <div class="position-absolute" style="top: 15px; left: 20%; width: 3px; height: 3px; background: #93bbfc; border-radius: 50%; box-shadow: 0 0 15px rgba(147, 187, 252, 0.3); z-index: 1; animation: pulseDot 2.5s ease-in-out infinite 1s;"></div>
                
                <!-- Content -->
                <div class="position-relative d-flex flex-wrap align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.85); font-size: 0.7rem;">
                                <i class="fas fa-plus-circle me-1" style="color: #60a5fa;"></i> 
                                <span style="color: #ffffff; font-weight: 600;">Create</span>
                            </span>
                            <span class="badge px-3 py-2 rounded-pill" style="background: rgba(96, 165, 250, 0.12); border: 1px solid rgba(96, 165, 250, 0.08); color: #60a5fa; font-size: 0.6rem; backdrop-filter: blur(5px);">
                                <i class="fas fa-tasks me-1"></i> New Task
                            </span>
                        </div>
                        <h1 class="fw-bold mb-0" style="font-size: 1.6rem; color: #ffffff; text-shadow: 0 2px 30px rgba(0,0,0,0.3);">
                            <span style="background: linear-gradient(90deg, #60a5fa, #93bbfc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Create</span>
                            <span style="color: #ffffff; font-weight: 300; font-size: 1.3rem;">New Task</span>
                        </h1>
                        <p class="text-white mb-0 mt-2" style="font-size: 0.85rem; max-width: 550px; text-shadow: 0 1px 10px rgba(0,0,0,0.2);">
                            Add a new task to your project
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== CREATE TASK FORM - BLUE THEME ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-12">
            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-3" style="background: #f8d7da; color: #721c24; padding: 10px 16px; border-left: 4px solid #ef4444; font-size: 0.85rem;">
                    <i class="fas fa-exclamation-circle me-2"></i> 
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1" style="padding-left: 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card border-0 rounded-3" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <!-- Project -->
                        <div class="mb-3">
                            <label for="project_id" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                <i class="fas fa-folder-open me-1" style="color: #60a5fa;"></i> Project <span class="text-danger">*</span>
                            </label>
                            <select name="project_id" id="project_id" 
                                    class="form-select rounded-3 @error('project_id') is-invalid @enderror" 
                                    style="border: 2px solid #e5e7eb; padding: 10px 14px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;" 
                                    required>
                                <option value="">Select a project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
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
                                <i class="fas fa-heading me-1" style="color: #60a5fa;"></i> Task Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                   class="form-control rounded-3 @error('title') is-invalid @enderror" 
                                   style="border: 2px solid #e5e7eb; padding: 10px 14px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;"
                                   placeholder="Enter task title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                <i class="fas fa-align-left me-1" style="color: #60a5fa;"></i> Description
                            </label>
                            <textarea name="description" id="description" rows="3" 
                                      class="form-control rounded-3 @error('description') is-invalid @enderror" 
                                      style="border: 2px solid #e5e7eb; padding: 10px 14px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;"
                                      placeholder="Enter task description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Due Date -->
                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                    <i class="fas fa-calendar-check me-1" style="color: #60a5fa;"></i> Due Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" 
                                       class="form-control rounded-3 @error('due_date') is-invalid @enderror" 
                                       style="border: 2px solid #e5e7eb; padding: 10px 14px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;"
                                       required>
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Priority -->
                            <div class="col-md-6 mb-3">
                                <label for="priority" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                    <i class="fas fa-flag me-1" style="color: #60a5fa;"></i> Priority
                                </label>
                                <select name="priority" id="priority" 
                                        class="form-select rounded-3 @error('priority') is-invalid @enderror" 
                                        style="border: 2px solid #e5e7eb; padding: 10px 14px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;">
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>🟢 Low</option>
                                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>🔴 High</option>
                                </select>
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="form-label fw-semibold" style="color: #111827; font-size: 0.85rem;">
                                <i class="fas fa-chart-simple me-1" style="color: #60a5fa;"></i> Status
                            </label>
                            <select name="status" id="status" 
                                    class="form-select rounded-3 @error('status') is-invalid @enderror" 
                                    style="border: 2px solid #e5e7eb; padding: 10px 14px; font-size: 0.9rem; background: #f9fafb; transition: all 0.3s ease;">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-3">
                            <a href="{{ route('projects.index') }}" class="btn rounded-3 px-4 py-2" style="background: #f8f9fa; color: #4a5568; border: 2px solid #e5e7eb; font-weight: 600; font-size: 0.85rem; transition: all 0.3s ease;">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn rounded-3 px-4 py-2" style="background: linear-gradient(135deg, #4f46e5, #6366f1); color: #ffffff; border: none; font-weight: 600; font-size: 0.85rem; transition: all 0.3s ease; box-shadow: 0 2px 12px rgba(79, 70, 229, 0.2);">
                                <i class="fas fa-plus-circle me-2"></i> Create Task
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
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08) !important;
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

    .hero-banner {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
    }

    [data-theme="dark"] .hero-banner {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
    }

    /* ===== Dark Mode Support ===== */
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

    [data-theme="dark"] .btn[style*="background: linear-gradient(135deg, #4f46e5, #6366f1)"] {
        background: linear-gradient(135deg, #4f46e5, #6366f1) !important;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .hero-banner h1 {
            font-size: 1.3rem !important;
        }
        .hero-banner {
            min-height: 90px !important;
            padding: 12px 16px !important;
        }
        .hero-banner .badge {
            font-size: 0.5rem !important;
            padding: 2px 8px !important;
        }
        .card-body {
            padding: 16px !important;
        }
        .btn {
            font-size: 0.75rem !important;
            padding: 8px 14px !important;
        }
        .form-control, .form-select {
            padding: 8px 12px !important;
            font-size: 0.85rem !important;
        }
    }

    @media (max-width: 576px) {
        .col-lg-8 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }
</style>

@endsection