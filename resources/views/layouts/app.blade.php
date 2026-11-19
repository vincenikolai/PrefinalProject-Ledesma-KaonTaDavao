<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaon Ta! Davao – Ledesma's Food Guide</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-orange-50 text-gray-800 min-h-screen">
    <header class="bg-orange-600 text-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <a href="{{ route('home') }}" class="text-2xl font-bold">Kaon Ta! Davao – Ledesma's Food Guide</a>
        </div>

        @include('partials.nav')
    </header>

    <main class="max-w-6xl mx-auto px-4 py-6">
        @include('partials.flash')

        @yield('content')
    </main>

    <footer class="text-center text-sm text-gray-500 py-6">
        4-334 Prefinal Project &middot; Vince Nikolai B. Ledesma
    </footer>
</body>
</html>