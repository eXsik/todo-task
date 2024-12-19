@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-8">
        <div class=" flex flex-col md:flex-row justify-between items-center">

            <h2 class="text-2xl font-semibold text-gray-900">Szczegóły zadania: {{ $task->name }}</h2>
            <div class="mt-6">
                <form method="POST" action="{{ route('tasks.generateToken', $task->id) }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 transition-all shadow text-white rounded-md">
                        Wygeneruj link dostępu
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-6 space-y-6 bg-white p-6 rounded-md">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Opis zadania</h3>
                <p class="text-gray-600">{{ $task->description ?? 'Brak opisu' }}</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800">Priorytet</h3>
                <p class="text-gray-600 capitalize">{{ $task->priority }}</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800">Status</h3>
                <p class="text-gray-600 capitalize">{{ $task->status }}</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800">Data zakończenia</h3>
                <p class="text-gray-600">
                    {{ $task->expiration_date ? $task->expiration_date->format('Y-m-d') : 'Brak daty' }}</p>
            </div>

            <div class="mt-6">
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded-md">
                        <strong>Link dostępu do zadania:</strong>
                        <a href="{{ session('success') }}" class="text-blue-600">{{ session('success') }}</a>
                    </div>
                @elseif (session('error'))
                    <div class="bg-red-100 text-red-800 p-4 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            @if ($taskAccessToken)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800">Link publiczny do zadania</h3>
                    <p class="text-blue-600">
                        <a href="{{ route('tasks.access', ['task' => $task->id, 'token' => $taskAccessToken->token]) }}"
                            target="_blank">
                            Kliknij tutaj, aby zobaczyć zadanie
                        </a>
                    </p>
                    <p class="mt-2 text-sm text-gray-500">
                        Link jest ważny przez 24 godziny. (Wygenerowany został : {{ $taskAccessToken->created_at }})
                    </p>
                </div>
            @else
                <div class="mt-6 text-gray-500">
                    <p>Link dostępu do zadania wygasł lub nie został jeszcze wygenerowany.</p>
                </div>
            @endif
        </div>

        <div class="my-6">
            <h3 class="text-xl font-semibold text-gray-800 mt-8">Historia zmian</h3>
            @if ($history->isEmpty())
                <p class="text-gray-500">Brak historii zmian dla tego zadania.</p>
            @else
                <div class="overflow-x-auto bg-white shadow-md rounded-lg mt-4">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700">Data</th>
                                <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700">Użytkownik</th>
                                <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700">Zmiana</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach ($history as $entry)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $entry->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="px-4 py-2">{{ $entry->user->name ?? 'Nieznany' }}</td>
                                    <td class="px-4 py-2">
                                        <ul class="space-y-1">
                                            @foreach (json_decode($entry->changes, true) as $attribute => $change)
                                                <li>
                                                    <strong class="text-gray-700">{{ ucfirst($attribute) }}:</strong>
                                                    <span class="text-gray-500">
                                                        Z: <span
                                                            class="font-semibold">{{ $change['old'] ?? 'Brak zmian' }}</span>
                                                        &rarr;
                                                        Do: <span
                                                            class="font-semibold">{{ $change['new'] ?? 'Brak zmian' }}</span>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
