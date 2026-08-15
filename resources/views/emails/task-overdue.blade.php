<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Task Overdue Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #ef4444;
        }
        .header h1 {
            color: #ef4444;
            font-size: 24px;
            margin: 0;
        }
        .content {
            padding: 20px 0;
        }
        .task-details {
            background: #f8fafc;
            padding: 16px;
            border-radius: 8px;
            margin: 16px 0;
            border-left: 4px solid #ef4444;
        }
        .task-details p {
            margin: 6px 0;
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            color: #6b7280;
            font-size: 12px;
            border-top: 1px solid #e5e7eb;
        }
        .priority-high { color: #ef4444; font-weight: 700; }
        .priority-medium { color: #fbbf24; font-weight: 700; }
        .priority-low { color: #34d399; font-weight: 700; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚠️ Task Overdue</h1>
            <p style="color: #6b7280; margin: 4px 0 0;">This task needs your attention</p>
        </div>

        <div class="content">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>
            <p>The following task is <strong style="color: #ef4444;">overdue</strong> and requires your immediate attention:</p>

            <div class="task-details">
                <p><strong>📋 Task:</strong> {{ $task->title }}</p>
                <p><strong>📁 Project:</strong> {{ $task->project->name }}</p>
                <p><strong>📅 Due Date:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</p>
                <p><strong>⚡ Priority:</strong> 
                    <span class="priority-{{ $task->priority }}">
                        {{ ucfirst($task->priority) }}
                    </span>
                </p>
                <p><strong>📝 Status:</strong> {{ ucfirst(str_replace('_', ' ', $task->status)) }}</p>
                @if($task->description)
                    <p><strong>📄 Description:</strong> {{ $task->description }}</p>
                @endif
            </div>

            <p style="text-align: center; margin: 24px 0;">
                <a href="{{ route('tasks.edit', $task) }}" class="btn">
                    <i class="fas fa-edit"></i> Update Task
                </a>
            </p>

            <p style="color: #6b7280; font-size: 14px;">
                <i class="fas fa-info-circle"></i> 
                Please update the status or due date of this task as soon as possible.
            </p>
        </div>

        <div class="footer">
            <p>Task Management System</p>
            <p style="margin: 4px 0 0;">This is an automated notification. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>