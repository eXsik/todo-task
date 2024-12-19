<?php

namespace App\Console\Commands;

use App\Services\TaskNotificationService;
use Illuminate\Console\Command;

class SendTaskExpireSoonNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-task-expire-soon-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications for tasks that are due tomorrow';

    /**
     * taskNotificationService
     *
     * @var mixed
     */
    protected $taskNotificationService;

    public function __construct(TaskNotificationService $taskNotificationService)
    {
        parent::__construct();

        $this->taskNotificationService = $taskNotificationService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->taskNotificationService->sendExpireSoonNotifications();

        $this->info('Expire soon task notifications sent!');
    }
}
