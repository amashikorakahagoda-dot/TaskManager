<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskOverdueMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $user;

    public function __construct(Task $task, $user)
    {
        $this->task = $task;
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '⚠️ Task Overdue: ' . $this->task->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.task-overdue',
        );
    }
}