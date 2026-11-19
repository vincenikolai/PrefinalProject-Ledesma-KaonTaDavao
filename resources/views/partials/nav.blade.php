<nav class="bg-orange-700">
    <div class="max-w-6xl mx-auto px-4 py-2 flex flex-wrap gap-6 text-sm">
        <a href="{{ route('home') }}" class="hover:underline {{ request()->routeIs('home') ? 'font-bold' : '' }}">Home</a>
        <a href="{{ route('eateries.index') }}" class="hover:underline {{ request()->routeIs('eateries.index') ? 'font-bold' : '' }}">Eateries</a>
        <a href="{{ route('districts.index') }}" class="hover:underline {{ request()->routeIs('districts.*') ? 'font-bold' : '' }}">Districts</a>
        <a href="{{ route('eateries.create') }}" class="hover:underline {{ request()->routeIs('eateries.create') ? 'font-bold' : '' }}">Add Eatery</a>
    </div>
</nav>