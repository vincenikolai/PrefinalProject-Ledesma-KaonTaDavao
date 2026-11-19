@extends('layouts.app')

@section('content')
    <h1 class="font-display text-2xl font-semibold text-purple-950 mb-4">Districts</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}" class="bg-white rounded-xl shadow-sm border border-stone-200 p-4 hover:bg-purple-50">
                <p class="font-display text-lg font-semibold text-purple-800">{{ $district->name }}</p>
                <p class="text-sm text-stone-600">{{ $district->eateries_count }} {{ Str::plural('eatery', $district->eateries_count) }}</p>
            </a>
        @endforeach
    </div>
@endsection