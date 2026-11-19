@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Maayong pag-abot!</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $eateryCount }}</p>
            <p class="text-gray-600">Eateries</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $districtCount }}</p>
            <p class="text-gray-600">Districts</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $reviewCount }}</p>
            <p class="text-gray-600">Reviews</p>
        </div>
    </div>

    <h2 class="text-xl font-semibold mb-3">Top Rated</h2>

    @if ($topRated->isEmpty())
        <p class="text-gray-500">No rated eateries yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($topRated as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    @endif
@endsection