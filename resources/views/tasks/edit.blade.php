@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <h2 class="text-2xl font-semibold text-gray-900">Edytuj zadanie</h2>

        <div class="mt-6">
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')

                <label for="name" class="block text-sm font-medium text-gray-700">Nazwa zadania</label>
                <input id="name"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="text" name="name" value="{{ old('name', $task->name) }}" required />

                <label for="description" class="block text-sm font-medium text-gray-700 mt-4">Opis zadania</label>
                <textarea id="description" name="description"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $task->description) }}</textarea>

                <label for="priority" class="block text-sm font-medium text-gray-700 mt-4">Priorytet</label>
                <select id="priority" name="priority"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="low" @selected($task->priority === 'low')>Niski</option>
                    <option value="medium" @selected($task->priority === 'medium')>Średni</option>
                    <option value="high" @selected($task->priority === 'high')>Wysoki</option>
                </select>

                <label for="status" class="block text-sm font-medium text-gray-700 mt-4">Status</label>
                <select id="status" name="status"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="to-do" @selected($task->status === 'to-do')>To Do</option>
                    <option value="in-progress" @selected($task->status === 'in-progress')>In Progress</option>
                    <option value="done" @selected($task->status === 'done')>Done</option>
                </select>

                <label for="expiration_date" class="block text-sm font-medium text-gray-700 mt-4">Data zakończenia
                    zadania</label>
                <input id="expiration_date"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="date" name="expiration_date"
                    value="{{ old('expiration_date', $task->expiration_date->format('Y-m-d')) }}" required />

                <button type="submit"
                    class="mt-4 text-white bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-md shadow transition-all">
                    Zapisz zmiany
                </button>
            </form>
        </div>
    </div>

    <script></script>
@endsection
