<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskMail;
use App\Models\Task;

class SendTaskReminder implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Task $task,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void {
        Mail::to($this->task->email)
            ->send(new TaskMail($this->task->title, $this->task->due_date));
    }
}
