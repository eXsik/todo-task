<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the tasks.
     */
    public function index(Request $request): View
    {
        $tasks = Task::where('user_id', Auth::id())
            ->priority($request->priority)
            ->status($request->status)
            ->expirationDate($request->expiration_date)
            ->paginate(25);

        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new task.
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $this->taskService->create($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Zadanie zostało dodane do listy.');
    }

    /**
     * Display the task.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the task.
     */
    public function edit(Task $task): View
    {
        Gate::authorize('modify', $task);

        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the task in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        Gate::authorize('modify', $task);

        $this->taskService->update($task, $request->validated());

        return redirect()->route('tasks.index')->with('success', 'Zadanie zostało zaktualizowane.');
    }

    /**
     * Remove the task from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('modify', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Zadanie zostało usunięte.');
    }
}
