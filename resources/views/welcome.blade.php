<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-[#0079bf] to-[#5067c5] text-white">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <header class="text-center mb-8">
                <h1 class="text-5xl font-extrabold">Welcome to Todo App</h1>
                <p class="mt-4 text-lg text-white/90">Your ultimate task management solution, designed to help you stay organized and productive.</p>
            </header>

            <div class="flex gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-[#61bd4f] text-white rounded-lg shadow-lg hover:bg-[#519e3e]">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-3 bg-[#f2d600] text-gray-900 rounded-lg shadow-lg hover:bg-[#e6c700]">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-[#0079bf] text-white rounded-lg shadow-lg hover:bg-[#026aa7]">Register</a>
                        @endif
                    @endauth
                @endif
            </div>

            <footer class="mt-12 text-center text-sm text-white/80">
                <p>&copy; {{ date('Y') }} Todo App. Built with dedication by the Rwanda Build Program.</p>
            </footer>
        </div>
    </body>
</html>
