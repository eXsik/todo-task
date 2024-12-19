<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadanie: {{ $task->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-8">
        <h2 class="text-2xl font-semibold text-gray-900">Zadanie: {{ $task->name }}</h2>

        <div class="mt-6 space-y-6 bg-white p-6 rounded-md shadow-lg">
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

            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-md mt-4">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</body>

</html>
