@extends('layouts.app')

@section('content')
    @php
        $prices = ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'];
    @endphp

    <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6 mb-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
            <div>
                <h1 class="font-display text-2xl font-semibold text-purple-950">
                    {{ $eatery->name }}
                    @if (! $eatery->is_open)
                        <span class="text-sm bg-rose-600 text-white px-2 py-1 rounded align-middle">Closed</span>
                    @endif
                </h1>

                <p class="text-stone-600">
                    <a href="{{ route('districts.show', $eatery->district) }}" class="hover:underline">{{ $eatery->district->name }}</a>
                    &middot; {{ $eatery->address }}
                </p>

                <p class="mt-2">
                    <span class="font-semibold text-emerald-700">{{ $prices[$eatery->price_range] ?? '' }}</span>
                    ({{ ucfirst($eatery->price_range) }})
                </p>

                @if ($eatery->specialty)
                    <p>Specialty: {{ $eatery->specialty }}</p>
                @endif

                <p>Status: {{ $eatery->is_open ? 'Open' : 'Closed' }}</p>

                <div class="flex flex-wrap gap-1 mt-3">
                    @foreach ($eatery->features as $feature)
                        <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}" class="text-xs bg-lime-100 text-lime-900 px-2 py-1 rounded-full hover:bg-lime-200">
                            {{ $feature->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('eateries.edit', $eatery) }}" class="bg-purple-700 text-white px-4 py-2 rounded-lg hover:bg-purple-800">Edit</a>

                <form method="POST" action="{{ route('eateries.destroy', $eatery) }}" onsubmit="return confirm('Delete this eatery?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-lg hover:bg-rose-700">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6">
            <h2 class="font-display text-lg font-semibold text-purple-900 mb-2">Business Permit</h2>

            @if ($eatery->permit)
                <p>Permit No.: {{ $eatery->permit->permit_no }}</p>
                <p>Expires on: {{ $eatery->permit->expires_on->format('M d, Y') }}</p>

                @if ($eatery->permit->expires_on->lt(today()))
                    <p class="text-red-600 font-semibold mt-1">Permit expired</p>
                @endif
            @else
                <p class="text-stone-500">No permit on file.</p>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6">
            <h2 class="font-display text-lg font-semibold text-purple-900 mb-2">Dishes</h2>

            <ul class="divide-y">
                @forelse ($eatery->dishes as $dish)
                    <li class="py-2 flex justify-between">
                        <span>
                            {{ $dish->name }}
                            @if ($dish->is_bestseller)
                                <span class="text-xs bg-amber-200 text-amber-900 px-2 py-0.5 rounded">Bestseller</span>
                            @endif
                        </span>
                        <span>₱{{ number_format($dish->price, 2) }}</span>
                    </li>
                @empty
                    <li class="py-2 text-stone-500">No dishes yet.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6 mb-6">
        <h2 class="font-display text-lg font-semibold text-purple-900 mb-3">Reviews</h2>

        @forelse ($eatery->reviews as $review)
            <div class="border-b py-3 flex justify-between gap-4">
                <div>
                    <p>
                        <a href="{{ route('reviewers.show', $review->user) }}" class="font-semibold text-purple-800 hover:underline">{{ $review->user->name }}</a>
                        <x-rating :value="$review->rating" class="ml-2" />
                        <span class="text-sm">{{ $review->rating }}/5</span>
                    </p>
                    <p class="text-xs text-stone-500">{{ $review->created_at->format('M d, Y') }}</p>
                    <p class="mt-1">{{ $review->body }}</p>
                </div>

                <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                </form>
            </div>
        @empty
            <p class="text-stone-500">No reviews yet.</p>
        @endforelse
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6">
        <h2 class="font-display text-lg font-semibold text-purple-900 mb-3">Write a Review</h2>

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
                    <select name="user_id" id="user_id" class="w-full border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
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
                    <input type="number" name="rating" id="rating" value="{{ old('rating') }}" class="w-32 border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
                    @error('rating')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body" class="block text-sm font-medium mb-1">Review</label>
                    <textarea name="body" id="body" rows="4" class="w-full border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-emerald-700 text-white px-4 py-2 rounded-lg hover:bg-emerald-800">Post Review</button>
                </div>
            </form>
        @else
            <p class="text-stone-600">This eatery is closed. Reviews are paused.</p>
        @endif
    </div>
@endsection