@extends('layouts.app')

@section('content')
    <h1 class="font-display text-2xl font-semibold text-purple-950 mb-4">Maayong pag-abot!</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-4 text-center">
            <p class="text-3xl font-bold text-emerald-700">{{ $eateryCount }}</p>
            <p class="text-stone-600">Eateries</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-4 text-center">
            <p class="text-3xl font-bold text-emerald-700">{{ $districtCount }}</p>
            <p class="text-stone-600">Districts</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-4 text-center">
            <p class="text-3xl font-bold text-emerald-700">{{ $reviewCount }}</p>
            <p class="text-stone-600">Reviews</p>
        </div>
    </div>

    <h2 class="font-display text-xl font-semibold text-purple-900 mb-3">Top Rated</h2>

    @if ($topRated->isEmpty())
        <p class="text-stone-500">No rated eateries yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($topRated as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    @endif
@endsection