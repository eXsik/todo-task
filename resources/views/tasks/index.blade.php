@extends('layouts.app')

@section('content')
    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-semibold mb-6 text-gray-700 mt-6">Lista zadań</h1>
            <div class=''>
                <a href="{{ route('tasks.create') }}"
                    class="text-white bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-md shadow transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span class="">
                        Dodaj zadanie
                    </span>
                </a>
            </div>
        </div>

        <div class="mb-4 flex space-x-4">
            <form action="{{ route('tasks.index') }}" method="GET" class="flex space-x-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Wszystkie</option>
                        <option value="to-do" {{ request('status') == 'to-do' ? 'selected' : '' }}>Do zrobienia</option>
                        <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>W trakcie
                        </option>
                        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Zakończone</option>
                    </select>
                </div>
                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700">Priorytet</label>
                    <select name="priority" id="priority"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Wszystkie</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Niski</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Średni</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Wysoki</option>
                    </select>
                </div>
                <div>
                    <label for="expiration_date" class="block text-sm font-medium text-gray-700">Data zakończenia</label>
                    <input type="date" name="expiration_date" id="expiration_date"
                        value="{{ request('expiration_date') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <button type="submit"
                    class="text-white bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-md shadow transition-all max-h-[40px] self-end flex gap-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    Filtruj
                </button>
                @if (request('status') || request('priority') || request('expiration_date'))
                    <a href="{{ route('tasks.index') }}"
                        class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md shadow transition-all max-h-[40px] self-end flex gap-2 items-center justify-center">
                        Wyczyść filtry
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-auto bg-white shadow sm:rounded-lg pb-10 mb-10">
            @if (count($tasks) > 0)
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nazwa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Opis
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Priorytet
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data
                                zakończenia</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akcje
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach ($tasks as $task)
                            <tr class="border-b">
                                <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-900">
                                    {{ $task->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-500 max-w-96">
                                    {{ $task->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $task->getPriorityAttribute($task->priority) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $task->getStatusAttribute($task->status) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $task->expiration_date->format('d.m.Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  h-full">
                                    <div class="flex gap-4 items-center">
                                        <a href="{{ route('tasks.edit', $task) }}"
                                            class="text-indigo-600 hover:text-indigo-800 transition-all inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>

                                        <div x-data="{ showConfirmation: false }" x-init="showConfirmation = false" class="flex">
                                            <button @click="showConfirmation = true"
                                                class="text-red-500 hover:text-red-700 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                            <div x-show="showConfirmation" @click.away="showConfirmation = false" x-cloak
                                                x-transition.opacity
                                                class="mt-2 p-4 bg-red-100 rounded-md absolute right-4">

                                                <p>Czy na pewno chcesz usunąć zadanie {{ $task->name }}?</p>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                    class="mt-2">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-800">
                                                        Tak, usuń
                                                    </button>
                                                    <button @click="showConfirmation = false" type="button"
                                                        class="ml-2 text-gray-600 hover:text-gray-800">
                                                        Anuluj
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="px-6 py-3">
                    {{ $tasks->links() }}
                </div>
            @else
                <p class="flex items-center justify-center h-full pt-10">Nie masz obecnie żadnych zadań do wykonania!</p>
            @endif

        </div>
    </div>
@endsection
