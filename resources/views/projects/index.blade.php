@extends('layouts.app')

@section('content')

<!-- ============================================= -->
<!-- ===== BANNER SECTION - MATCHED DASHBOARD SIZE ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="hero-banner rounded-3 mb-4 p-4" 
                 style="background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
                        min-height: 140px;
                        position: relative;
                        overflow: hidden;">
                
                <!-- Decorative Circles -->
                <div class="position-absolute" style="top: -40px; right: -20px; width: 120px; height: 120px; background: rgba(96, 165, 250, 0.05); border-radius: 50%;"></div>
                <div class="position-absolute" style="bottom: -40px; left: -10px; width: 150px; height: 150px; background: rgba(167, 139, 250, 0.04); border-radius: 50%;"></div>
                
                <!-- Content -->
                <div class="position-relative d-flex flex-wrap align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.85); font-size: 0.7rem;">
                                <i class="fas fa-folder-open me-1" style="color: #60a5fa;"></i> 
                                <span style="color: #ffffff; font-weight: 600;">Projects</span>
                            </span>
                            <span class="badge px-3 py-2 rounded-pill" style="background: rgba(52, 211, 153, 0.15); border: 1px solid rgba(52, 211, 153, 0.1); color: #34d399; font-size: 0.7rem; backdrop-filter: blur(5px);">
                                <i class="fas fa-check-circle me-1"></i> {{ $projects->total() }} Total
                            </span>
                        </div>
                        <h1 class="fw-bold mb-0" style="font-size: 1.6rem; color: #ffffff; text-shadow: 0 2px 30px rgba(0,0,0,0.3);">
                            <span style="background: linear-gradient(90deg, #60a5fa, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Projects</span>
                            <span style="color: #ffffff; font-weight: 300; font-size: 1.3rem;">Overview</span>
                        </h1>
                        <p class="text-white/70 mb-0" style="font-size: 0.85rem; max-width: 550px; text-shadow: 0 1px 10px rgba(0,0,0,0.2);">
                            Manage all your projects in one place
                        </p>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="d-flex gap-3 mt-3 mt-md-0">
                        <div class="text-center" style="background: rgba(255,255,255,0.04); backdrop-filter: blur(5px); border-radius: 12px; padding: 8px 14px; border: 1px solid rgba(255,255,255,0.04); min-width: 60px;">
                            <p class="text-white/40 small mb-0" style="font-size: 0.45rem; text-transform: uppercase; letter-spacing: 0.3px;">Total</p>
                            <h5 class="fw-bold mb-0" style="color: #ffffff; font-size: 1.1rem;">{{ $projects->total() }}</h5>
                        </div>
                        <div class="text-center" style="background: rgba(255,255,255,0.04); backdrop-filter: blur(5px); border-radius: 12px; padding: 8px 14px; border: 1px solid rgba(255,255,255,0.04); min-width: 60px;">
                            <p class="text-white/40 small mb-0" style="font-size: 0.45rem; text-transform: uppercase; letter-spacing: 0.3px;">Active</p>
                            <h5 class="fw-bold mb-0" style="color: #34d399; font-size: 1.1rem;">
                                {{ $projects->filter(function($p) { return $p->status !== 'completed'; })->count() }}
                            </h5>
                        </div>
                        <div class="text-center" style="background: rgba(255,255,255,0.04); backdrop-filter: blur(5px); border-radius: 12px; padding: 8px 14px; border: 1px solid rgba(255,255,255,0.04); min-width: 60px;">
                            <p class="text-white/40 small mb-0" style="font-size: 0.45rem; text-transform: uppercase; letter-spacing: 0.3px;">Completed</p>
                            <h5 class="fw-bold mb-0" style="color: #60a5fa; font-size: 1.1rem;">
                                {{ $projects->filter(function($p) { return $p->status === 'completed'; })->count() }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- ===== PROJECTS LIST ===== -->
<!-- ============================================= -->
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0" style="color: #111827; font-size: 1.1rem;">
                <i class="fas fa-list me-2" style="color: #4f46e5;"></i> All Projects
            </h4>
            <p class="text-muted small mb-0" style="color: #6c757d; font-size: 0.8rem;">
                Showing {{ $projects->firstItem() ?? 0 }} to {{ $projects->lastItem() ?? 0 }} of {{ $projects->total() }} projects
            </p>
        </div>
        <a href="{{ route('projects.create') }}" class="btn rounded-3 px-3 py-1" style="background: linear-gradient(135deg, #4f46e5, #6366f1); color: #ffffff; border: none; font-weight: 600; font-size: 0.75rem; transition: all 0.3s ease;">
            <i class="fas fa-plus-circle me-1"></i> New Project
        </a>
    </div>

    <!-- ===== SEARCH & FILTER ===== -->
    <div class="row g-2 mb-3">
        <div class="col-md-8">
            <div class="input-group rounded-3" style="box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
                <span class="input-group-text bg-white border-0" style="padding-left: 14px;">
                    <i class="fas fa-search" style="color: #6c757d; font-size: 0.8rem;"></i>
                </span>
                <input type="text" id="searchProject" class="form-control border-0 py-1" placeholder="Search projects..." style="background: #ffffff; font-size: 0.85rem;">
            </div>
        </div>
        <div class="col-md-4">
            <select id="filterStatus" class="form-select rounded-3" style="border: 2px solid #e5e7eb; padding: 8px 14px; font-size: 0.85rem; background: #ffffff;">
                <option value="all">All Status</option>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 mb-3" style="background: #d4edda; color: #155724; padding: 10px 16px; font-size: 0.85rem;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if($projects->count() > 0)
        <div class="card border-0 rounded-3" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background: #f8fafc; border-bottom: 2px solid #e5e7eb;">
                            <tr>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; color: #6b7280; padding: 10px 14px;">#</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; color: #6b7280; padding: 10px 14px;">Project Name</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; color: #6b7280; padding: 10px 14px;">Status</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; color: #6b7280; padding: 10px 14px;">Start Date</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; color: #6b7280; padding: 10px 14px;">End Date</th>
                                <th style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; color: #6b7280; padding: 10px 14px; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="projectTableBody">
                            @foreach($projects as $project)
                            <tr data-status="{{ $project->status }}" style="border-bottom: 1px solid #f1f3f5; transition: all 0.3s ease;">
                                <td style="color: #6b7280; font-weight: 500; font-size: 0.85rem; padding: 10px 14px;">{{ $loop->iteration }}</td>
                                <td style="padding: 10px 14px;">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-3 p-1" style="background: rgba(79, 70, 229, 0.08);">
                                            <i class="fas fa-folder" style="color: #4f46e5; font-size: 0.8rem;"></i>
                                        </div>
                                        <span class="fw-medium project-name" style="color: #111827; font-size: 0.85rem;">{{ $project->name }}</span>
                                    </div>
                                </td>
                                <td style="padding: 10px 14px;">
                                    <span class="badge rounded-pill px-2 py-1 project-status" data-status="{{ $project->status }}" style="font-weight: 500; font-size: 0.65rem; 
                                        @if($project->status == 'completed') background: #d4edda; color: #155724;
                                        @elseif($project->status == 'in_progress') background: #cce5ff; color: #004085;
                                        @else background: #fff3cd; color: #856404; @endif">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </td>
                                <td style="color: #6b7280; font-size: 0.8rem; padding: 10px 14px;">{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</td>
                                <td style="color: #6b7280; font-size: 0.8rem; padding: 10px 14px;">{{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}</td>
                                <td style="padding: 10px 14px; text-align: center;">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('projects.show', $project) }}" class="btn btn-sm rounded-3" style="background: rgba(96, 165, 250, 0.08); color: #60a5fa; border: none; font-size: 0.65rem; padding: 4px 8px; transition: all 0.3s ease;" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm rounded-3" style="background: rgba(251, 191, 36, 0.08); color: #fbbf24; border: none; font-size: 0.65rem; padding: 4px 8px; transition: all 0.3s ease;" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm rounded-3" style="background: rgba(239, 68, 68, 0.08); color: #ef4444; border: none; font-size: 0.65rem; padding: 4px 8px; transition: all 0.3s ease;" onclick="return confirm('Are you sure you want to delete this project?')" title="Delete">
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
            </div>
        </div>
        
        <!-- ===== PAGINATION ===== -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <p class="text-muted small mb-0" style="color: #6c757d; font-size: 0.7rem;">
                Showing {{ $projects->firstItem() ?? 0 }} to {{ $projects->lastItem() ?? 0 }} of {{ $projects->total() }} projects
            </p>
            <div>
                {{ $projects->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="card border-0 rounded-3 text-center py-4" style="background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-inline-flex p-3 rounded-circle" style="background: #f8f9fa;">
                        <i class="fas fa-folder-open fa-3x" style="color: #dee2e6;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-1" style="color: #111827; font-size: 1rem;">No Projects Yet</h5>
                <p class="text-muted mb-3" style="color: #6c757d; font-size: 0.85rem;">Create your first project to get started</p>
                <a href="{{ route('projects.create') }}" class="btn rounded-3 px-3 py-1" style="background: linear-gradient(135deg, #4f46e5, #6366f1); color: #ffffff; border: none; font-weight: 600; font-size: 0.75rem;">
                    <i class="fas fa-plus-circle me-1"></i> Create New Project
                </a>
            </div>
        </div>
    @endif
</div>

<!-- ============================================= -->
<!-- ===== SEARCH & FILTER JAVASCRIPT ===== -->
<!-- ============================================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchProject');
    const filterStatus = document.getElementById('filterStatus');
    const rows = document.querySelectorAll('#projectTableBody tr');

    function filterProjects() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = filterStatus.value;

        rows.forEach(row => {
            const name = row.querySelector('.project-name').textContent.toLowerCase();
            const status = row.querySelector('.project-status').dataset.status;

            let show = true;
            if (searchTerm && !name.includes(searchTerm)) show = false;
            if (statusFilter !== 'all' && status !== statusFilter) show = false;
            row.style.display = show ? '' : 'none';
        });
    }

    searchInput.addEventListener('keyup', filterProjects);
    filterStatus.addEventListener('change', filterProjects);
});
</script>

<!-- ============================================= -->
<!-- ===== CSS ===== -->
<!-- ============================================= -->
<style>
    .pagination {
        display: flex;
        gap: 3px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination li {
        display: inline-block;
    }

    .pagination li a,
    .pagination li span {
        padding: 4px 12px;
        border-radius: 6px;
        color: #4a5568;
        text-decoration: none;
        border: 1px solid #e5e7eb;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        background: #ffffff;
    }

    .pagination li.active span {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: #ffffff;
        border-color: #4f46e5;
    }

    .pagination li a:hover {
        background: #f8fafc;
        border-color: #4f46e5;
        color: #4f46e5;
    }

    .pagination li.disabled span {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn:hover {
        transform: translateY(-1px);
        transition: all 0.3s ease;
    }

    .hero-banner {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
    }

    /* ===== Dark Mode Support ===== */
    [data-theme="dark"] .card {
        background: rgba(30, 41, 59, 0.85) !important;
        backdrop-filter: blur(10px);
    }

    [data-theme="dark"] .card h4,
    [data-theme="dark"] .card .fw-medium {
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .card .text-muted {
        color: #94a3b8 !important;
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

    [data-theme="dark"] .input-group-text,
    [data-theme="dark"] .form-control,
    [data-theme="dark"] .form-select {
        background: rgba(255,255,255,0.05) !important;
        border-color: rgba(255,255,255,0.1) !important;
        color: #f1f5f9 !important;
    }

    [data-theme="dark"] .form-control::placeholder {
        color: #94a3b8 !important;
    }

    [data-theme="dark"] .pagination li a,
    [data-theme="dark"] .pagination li span {
        background: rgba(255,255,255,0.05) !important;
        border-color: rgba(255,255,255,0.1) !important;
        color: #94a3b8 !important;
    }

    [data-theme="dark"] .pagination li.active span {
        background: linear-gradient(135deg, #4f46e5, #6366f1) !important;
        color: #ffffff !important;
    }

    [data-theme="dark"] .pagination li a:hover {
        background: rgba(255,255,255,0.1) !important;
        color: #ffffff !important;
    }

    [data-theme="dark"] .hero-banner {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
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
            min-height: 100px !important;
            padding: 12px 16px !important;
        }
        .hero-banner .badge {
            font-size: 0.5rem !important;
            padding: 2px 8px !important;
        }
        .hero-banner .text-center {
            min-width: 50px !important;
            padding: 4px 10px !important;
        }
        .hero-banner .text-center h5 {
            font-size: 0.9rem !important;
        }
        .hero-banner .text-center p {
            font-size: 0.4rem !important;
        }
        .table-responsive {
            font-size: 0.75rem;
        }
        .table-responsive .btn {
            padding: 3px 6px !important;
            font-size: 0.55rem !important;
        }
        .table-responsive .px-4 {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
        .table-responsive .py-3 {
            padding-top: 6px !important;
            padding-bottom: 6px !important;
        }
        .pagination li a,
        .pagination li span {
            padding: 3px 8px !important;
            font-size: 0.7rem !important;
        }
        .card-body .py-4 {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
        }
        .btn {
            font-size: 0.65rem !important;
            padding: 4px 10px !important;
        }
    }
</style>

@endsection