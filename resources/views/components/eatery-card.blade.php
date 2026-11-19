@props(['eatery'])

@php
    $prices = ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'];
    $reviewCount = $eatery->reviews->count();
    $average = $eatery->reviews->avg('rating');
@endphp

<div class="bg-white rounded-xl shadow-sm border border-stone-200 p-4 flex flex-col gap-2">
    <div class="flex justify-between items-start gap-2">
        <a href="{{ route('eateries.show', $eatery) }}" class="font-display text-lg font-semibold text-purple-800 hover:underline">
            {{ $eatery->name }}
        </a>

        @if (! $eatery->is_open)
            <span class="text-xs bg-rose-600 text-white px-2 py-1 rounded">Closed</span>
        @endif
    </div>

    <a href="{{ route('districts.show', $eatery->district) }}" class="text-sm text-stone-600 hover:underline">
        {{ $eatery->district->name }}
    </a>

    <p class="text-sm">
        <span class="font-semibold text-emerald-700">{{ $prices[$eatery->price_range] ?? '' }}</span>
        @if ($eatery->specialty)
            &middot; {{ $eatery->specialty }}
        @endif
    </p>

    <div class="flex flex-wrap gap-1">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}" class="text-xs bg-lime-100 text-lime-900 px-2 py-1 rounded-full hover:bg-lime-200">
                {{ $feature->name }}
            </a>
        @endforeach
    </div>

    <div class="text-sm mt-auto pt-2">
        @if ($reviewCount > 0)
            <x-rating :value="$average" />
            <span>{{ number_format($average, 1) }} ★ ({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})</span>
        @else
            <span class="text-stone-500">No reviews yet</span>
        @endif
    </div>
</div>