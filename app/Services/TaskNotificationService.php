<?php

namespace App\Services;

use App\Models\Task;
use App\Notifications\TaskExpireSoon;

class TaskNotificationService
{
  public function sendExpireSoonNotifications(): void
  {
    $tasks = Task::where("expiration_date", now()->addDay()->toDateString())
      ->whereHas('user')
      ->get();

    foreach ($tasks as $task) {
      $task->user->notify((new TaskExpireSoon($task))->onQueue('emails'));
    }
  }
}