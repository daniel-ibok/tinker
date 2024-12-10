<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Jobs\SendTaskReminder;
use Illuminate\Console\Command;

class TaskRemainder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task-remainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get all pending and incompleted tasks
        $tasks = Task::PendingOrIncompleted()->get();
        
        $tasks->each(fn ($task) => SendTaskReminder::dispatchIf($tasks->count() > 0, $task));

        $this->info('Task reminders sent successfully.');
        return 0;
    }
}
