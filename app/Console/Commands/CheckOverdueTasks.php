<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Mail\TaskOverdueMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckOverdueTasks extends Command
{
    protected $signature = 'tasks:check-overdue';
    protected $description = 'Check for overdue tasks and send email notifications';

    public function handle()
    {
        $today = now()->startOfDay();
        
        // Get all overdue tasks (not completed)
        $overdueTasks = Task::where('status', '!=', 'completed')
            ->where('due_date', '<', $today)
            ->with('project')
            ->get();

        if ($overdueTasks->isEmpty()) {
            $this->info('No overdue tasks found.');
            return 0;
        }

        $this->info('Found ' . $overdueTasks->count() . ' overdue tasks.');

        // Group tasks by user
        $grouped = $overdueTasks->groupBy(function ($task) {
            return $task->project->user_id;
        });

        foreach ($grouped as $userId => $tasks) {
            $user = User::find($userId);
            if (!$user) continue;

            // Send one email per user with all overdue tasks
            $this->info('Sending email to: ' . $user->email);
            
            // Send email for each task
            foreach ($tasks as $task) {
                Mail::to($user->email)->send(new TaskOverdueMail($task, $user));
                $this->info('  - Sent for task: ' . $task->title);
            }
        }

        $this->info('Overdue task notifications sent successfully!');
        return 0;
    }
}