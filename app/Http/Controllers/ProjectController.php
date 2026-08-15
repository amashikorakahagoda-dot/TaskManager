<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Helpers\ActivityHelper; // Add this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Display list of user's projects with pagination
    public function index()
    {
        // Changed: Added pagination
        $projects = Auth::user()->projects()->latest()->paginate(6);
        return view('projects.index', compact('projects'));
    }

    // Show create form
    public function create()
    {
        return view('projects.create');
    }

    // Store new project
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $project = Auth::user()->projects()->create($validated);
        
        // ADDED: Log activity
        ActivityHelper::log($project, 'created', "Project '{$project->name}' was created.");
        
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    // Show single project with tasks
    public function show(Project $project)
    {
        // Check if user owns this project
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $project->load('tasks'); // Load tasks
        return view('projects.show', compact('project'));
    }

    // Show edit form
    public function edit(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('projects.edit', compact('project'));
    }

    // Update project
    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $oldName = $project->name; // ADDED
        $project->update($validated);
        
        // ADDED: Log activity
        ActivityHelper::log($project, 'updated', "Project '{$oldName}' was updated to '{$project->name}'.");
        
        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    // Delete project with confirmation - Changed to soft delete
    public function destroy(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $projectName = $project->name; // ADDED
        $project->delete(); // Now soft delete
        
        // ADDED: Log activity
        ActivityHelper::log($project, 'deleted', "Project '{$projectName}' was moved to trash.");
        
        return redirect()->route('projects.index')
            ->with('success', 'Project moved to trash. You can restore it later.');
    }

    // ========== ADDED: New Methods ==========
    
    // Restore soft deleted project
    public function restore($id)
    {
        $project = Project::withTrashed()->find($id);
        
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $project->restore();
        
        ActivityHelper::log($project, 'restored', "Project '{$project->name}' was restored.");
        
        return redirect()->route('projects.index')
            ->with('success', 'Project restored successfully.');
    }

    // Force delete project
    public function forceDelete($id)
    {
        $project = Project::withTrashed()->find($id);
        
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $projectName = $project->name;
        $project->forceDelete();
        
        return redirect()->route('projects.index')
            ->with('success', "Project '{$projectName}' permanently deleted.");
    }
    // ========== ADDED: AJAX Status Update ==========
public function updateStatus(Request $request, Project $project)
{
    if ($project->user_id !== Auth::id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $request->validate([
        'status' => 'required|in:pending,in_progress,completed'
    ]);

    $oldStatus = $project->status;
    $project->update(['status' => $request->status]);

    // Log activity
    ActivityHelper::log($project, 'status_updated', "Project status changed from '{$oldStatus}' to '{$request->status}'");

    return response()->json([
        'success' => true,
        'message' => 'Project status updated successfully!',
        'status' => $request->status
    ]);
}
}