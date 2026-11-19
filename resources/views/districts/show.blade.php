@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">{{ $district->name }}</h1>
    <p class="text-gray-600 mb-6">{{ $reviewCount }} {{ Str::plural('review', $reviewCount) }} in {{ $district->name }}</p>

    @if ($district->eateries->isEmpty())
        <p class="text-gray-500">No eateries in this district yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($district->eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    @endif
@endsection