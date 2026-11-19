@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Eateries</h1>

    <form method="GET" action="{{ route('eateries.index') }}" class="bg-white rounded-lg shadow p-4 mb-6 flex flex-col md:flex-row gap-3 md:items-end">
        <div class="flex-1">
            <label for="q" class="block text-sm font-medium mb-1">Search</label>
            <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="Name or specialty" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label for="district" class="block text-sm font-medium mb-1">District</label>
            <select name="district" id="district" class="w-full border rounded px-3 py-2">
                <option value="">All districts</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected(request('district') == $district->id)>{{ $district->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="feature" class="block text-sm font-medium mb-1">Feature</label>
            <select name="feature" id="feature" class="w-full border rounded px-3 py-2">
                <option value="">All features</option>
                @foreach ($features as $feature)
                    <option value="{{ $feature->name }}" @selected(request('feature') == $feature->name)>{{ $feature->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">Filter</button>
            <a href="{{ route('eateries.index') }}" class="px-4 py-2 rounded border hover:bg-gray-100">Clear</a>
        </div>
    </form>

    @if ($eateries->isEmpty())
        <p class="text-gray-600">No eateries match your filters.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    @endif

    <div class="mt-6">
        {{ $eateries->links() }}
    </div>
@endsection