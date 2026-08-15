<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Helpers\ActivityHelper; // Add this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Show create task form
    public function create()
    {
        $projects = Auth::user()->projects;
        return view('tasks.create', compact('projects'));
    }

    // Store new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        // Check if user owns the project
        $project = Project::find($validated['project_id']);
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task = Task::create($validated); // CHANGED: Store variable
        
        // ADDED: Log activity
        ActivityHelper::log($task, 'created', "Task '{$task->title}' was created in project '{$project->name}'.");
        
        return redirect()->route('projects.show', $validated['project_id'])
            ->with('success', 'Task created successfully!');
    }

    // Show edit form
    public function edit(Task $task)
    {
        if ($task->project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $projects = Auth::user()->projects;
        return view('tasks.edit', compact('task', 'projects'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        if ($task->project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $oldTitle = $task->title; // ADDED
        $task->update($validated);
        
        // ADDED: Log activity
        ActivityHelper::log($task, 'updated', "Task '{$oldTitle}' was updated to '{$task->title}'.");
        
        return redirect()->route('projects.show', $validated['project_id'])
            ->with('success', 'Task updated successfully!');
    }

    // Delete task
    public function destroy(Task $task)
    {
        if ($task->project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $taskTitle = $task->title; // ADDED
        $projectId = $task->project_id;
        $task->delete();
        
        // ADDED: Log activity
        ActivityHelper::log($task, 'deleted', "Task '{$taskTitle}' was deleted.");
        
        return redirect()->route('projects.show', $projectId)
            ->with('success', 'Task deleted successfully!');
    }
    // ========== ADDED: AJAX Status Update ==========
public function updateStatus(Request $request, Task $task)
{
    if ($task->project->user_id !== Auth::id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $request->validate([
        'status' => 'required|in:pending,in_progress,completed'
    ]);

    $oldStatus = $task->status;
    $task->update(['status' => $request->status]);

    // Log activity
    ActivityHelper::log($task, 'status_updated', "Task status changed from '{$oldStatus}' to '{$request->status}'");

    return response()->json([
        'success' => true,
        'message' => 'Task status updated successfully!',
        'status' => $request->status,
        'old_status' => $oldStatus
    ]);
}
}