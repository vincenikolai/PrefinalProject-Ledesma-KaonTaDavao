@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Districts</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}" class="bg-white rounded-lg shadow p-4 hover:bg-orange-100">
                <p class="text-lg font-semibold text-orange-700">{{ $district->name }}</p>
                <p class="text-sm text-gray-600">{{ $district->eateries_count }} {{ Str::plural('eatery', $district->eateries_count) }}</p>
            </a>
        @endforeach
    </div>
@endsection