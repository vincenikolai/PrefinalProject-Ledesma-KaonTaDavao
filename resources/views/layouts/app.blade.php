<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaon Ta! Davao – Ledesma's Food Guide</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fredoka:500,600|nunito:400,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-100 text-stone-800 font-sans min-h-screen">
    <header class="bg-purple-950 text-white">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <a href="{{ route('home') }}" class="font-display text-2xl font-semibold text-lime-300">Kaon Ta! Davao – Ledesma's Food Guide</a>
        </div>

        @include('partials.nav')
    </header>

    <main class="max-w-6xl mx-auto px-4 py-6">
        @include('partials.flash')

        @yield('content')
    </main>

    <footer class="text-center text-sm text-stone-500 py-8">
        4-334 Prefinal Project &middot; Vince Nikolai B. Ledesma
    </footer>
</body>
</html>