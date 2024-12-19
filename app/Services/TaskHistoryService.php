<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Support\Facades\Auth;

class TaskHistoryService
{
  public function logCreate(Task $task, array $data): void
  {
    TaskHistory::create([
      'task_id' => $task->id,
      'user_id' => Auth::id(),
      'changes' => json_encode([
        'action' => 'created',
        'name' => $data['name'],
        'description' => $data['description'],
        'priority' => $data['priority'],
        'status' => $data['status'],
        'expiration_date' => $data['expiration_date']
      ])
    ]);
  }

  public function logUpdate(Task $task, array $oldData, array $newData): void
  {
    $changes = [];

    foreach ($oldData as $key => $value) {
      if (isset($newData[$key]) && $newData[$key] !== $value) {
        $changes[$key] = [
          'old' => $value,
          'new' => $newData[$key]
        ];
      }
    }

    if (!empty($changes)) {
      TaskHistory::create([
        'task_id' => $task->id,
        'user_id' => Auth::id(),
        'changes' => json_encode($changes)
      ]);
    }
  }

  public function logDelete(Task $task)
  {
    TaskHistory::create([
      'task_id' => $task->id,
      'user_id' => Auth::id(),
      'changes' => json_encode([
        'action' => 'deleted',
        'name' => $task->name,
        'description' => $task->description,
        'priority' => $task->priority,
        'status' => $task->status,
        'expiration_date' => $task->expiration_date
      ])
    ]);
  }
}
