<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', function () {
    return redirect()->route('login');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
   
    Route::resource('projects', ProjectController::class);
    
    Route::resource('tasks', TaskController::class);
    
    // ========== ADDED: AJAX Status Update Routes ==========
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    Route::patch('/projects/{project}/status', [ProjectController::class, 'updateStatus'])->name('projects.updateStatus');
});

require __DIR__.'/auth.php';