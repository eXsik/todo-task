<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
  public function create(array $data): Task
  {
    return Task::create([
      'name' => $data['name'],
      'description' => $data['description'],
      'priority' => $data['priority'],
      'status' => $data['status'],
      'expiration_date' => $data['expiration_date'],
      'user_id' => Auth::id()
    ]);
  }

  public function update(Task $task, array $data): void
  {
    $task->update($data);
  }
}
