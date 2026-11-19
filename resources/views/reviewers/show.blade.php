@extends('layouts.app')

@section('content')
    @php
        $count = $user->reviews->count();
    @endphp

    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
    <p class="text-gray-600 mb-6">{{ $count }} {{ Str::plural('review', $count) }} written</p>

    <div class="bg-white rounded-lg shadow p-6">
        @forelse ($user->reviews as $review)
            <div class="border-b py-3">
                <p>
                    <a href="{{ route('eateries.show', $review->eatery) }}" class="font-semibold text-orange-700 hover:underline">{{ $review->eatery->name }}</a>
                    <x-rating :value="$review->rating" class="ml-2" />
                    <span class="text-sm">{{ $review->rating }}/5</span>
                </p>
                <p class="mt-1">{{ $review->body }}</p>
            </div>
        @empty
            <p class="text-gray-500">This reviewer has not written any reviews yet.</p>
        @endforelse
    </div>
@endsection