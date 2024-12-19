<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
  protected $taskHistoryService;

  public function __construct(TaskHistoryService $taskHistoryService)
  {
    $this->taskHistoryService = $taskHistoryService;
  }

  public function create(array $data): Task
  {
    $task = Task::create([
      'name' => $data['name'],
      'description' => $data['description'],
      'priority' => $data['priority'],
      'status' => $data['status'],
      'expiration_date' => $data['expiration_date'],
      'user_id' => Auth::id()
    ]);

    $this->taskHistoryService->logCreate($task, $data);

    return $task;
  }

  public function update(Task $task, array $data): void
  {
    $oldData = $task->only(['name', 'description', 'status', 'priority', 'expiration_date']);

    $task->update($data);

    $this->taskHistoryService->logUpdate($task, $oldData, $data);
  }

  public function delete(Task $task)
  {
    $this->taskHistoryService->logDelete($task);

    $task->delete();
  }
}
