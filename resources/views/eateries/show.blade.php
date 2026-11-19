@extends('layouts.app')

@section('content')
    @php
        $prices = ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'];
    @endphp

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
            <div>
                <h1 class="text-2xl font-bold">
                    {{ $eatery->name }}
                    @if (! $eatery->is_open)
                        <span class="text-sm bg-gray-700 text-white px-2 py-1 rounded align-middle">Closed</span>
                    @endif
                </h1>

                <p class="text-gray-600">
                    <a href="{{ route('districts.show', $eatery->district) }}" class="hover:underline">{{ $eatery->district->name }}</a>
                    &middot; {{ $eatery->address }}
                </p>

                <p class="mt-2">
                    <span class="font-semibold text-green-700">{{ $prices[$eatery->price_range] ?? '' }}</span>
                    ({{ ucfirst($eatery->price_range) }})
                </p>

                @if ($eatery->specialty)
                    <p>Specialty: {{ $eatery->specialty }}</p>
                @endif

                <p>Status: {{ $eatery->is_open ? 'Open' : 'Closed' }}</p>

                <div class="flex flex-wrap gap-1 mt-3">
                    @foreach ($eatery->features as $feature)
                        <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}" class="text-xs bg-orange-100 text-orange-800 px-2 py-1 rounded-full hover:bg-orange-200">
                            {{ $feature->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('eateries.edit', $eatery) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>

                <form method="POST" action="{{ route('eateries.destroy', $eatery) }}" onsubmit="return confirm('Delete this eatery?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Business Permit</h2>

            @if ($eatery->permit)
                <p>Permit No.: {{ $eatery->permit->permit_no }}</p>
                <p>Expires on: {{ $eatery->permit->expires_on->format('M d, Y') }}</p>

                @if ($eatery->permit->expires_on->lt(today()))
                    <p class="text-red-600 font-semibold mt-1">Permit expired</p>
                @endif
            @else
                <p class="text-gray-500">No permit on file.</p>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Dishes</h2>

            <ul class="divide-y">
                @forelse ($eatery->dishes as $dish)
                    <li class="py-2 flex justify-between">
                        <span>
                            {{ $dish->name }}
                            @if ($dish->is_bestseller)
                                <span class="text-xs bg-yellow-200 text-yellow-800 px-2 py-0.5 rounded">Bestseller</span>
                            @endif
                        </span>
                        <span>₱{{ number_format($dish->price, 2) }}</span>
                    </li>
                @empty
                    <li class="py-2 text-gray-500">No dishes yet.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-3">Reviews</h2>

        @forelse ($eatery->reviews as $review)
            <div class="border-b py-3 flex justify-between gap-4">
                <div>
                    <p>
                        <a href="{{ route('reviewers.show', $review->user) }}" class="font-semibold text-orange-700 hover:underline">{{ $review->user->name }}</a>
                        <x-rating :value="$review->rating" class="ml-2" />
                        <span class="text-sm">{{ $review->rating }}/5</span>
                    </p>
                    <p class="text-xs text-gray-500">{{ $review->created_at->format('M d, Y') }}</p>
                    <p class="mt-1">{{ $review->body }}</p>
                </div>

                <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                </form>
            </div>
        @empty
            <p class="text-gray-500">No reviews yet.</p>
        @endforelse
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-3">Write a Review</h2>

        @if ($eatery->is_open)
            @if ($errors->any())
                <div class="mb-4 rounded bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                    <p class="font-semibold">Please fix the following:</p>
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('eateries.reviews.store', $eatery) }}" class="flex flex-col gap-4">
                @csrf

                <div>
                    <label for="user_id" class="block text-sm font-medium mb-1">Reviewer</label>
                    <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select reviewer --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rating" class="block text-sm font-medium mb-1">Rating (1 to 5)</label>
                    <input type="number" name="rating" id="rating" value="{{ old('rating') }}" class="w-32 border rounded px-3 py-2">
                    @error('rating')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body" class="block text-sm font-medium mb-1">Review</label>
                    <textarea name="body" id="body" rows="4" class="w-full border rounded px-3 py-2">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">Post Review</button>
                </div>
            </form>
        @else
            <p class="text-gray-600">This eatery is closed. Reviews are paused.</p>
        @endif
    </div>
@endsection