<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Public Complaints' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 flex flex-col min-h-screen">
        <header class="bg-green-500 text-white p-4">
            <h1 class="text-center text-2xl font-bold">Public Complaints Portal</h1>
        </header>

        <main class="py-6 flex-grow">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
            <p>&copy; {{ date('Y') }} Public Complaints System</p>
        </footer>
    </body>
</html>
