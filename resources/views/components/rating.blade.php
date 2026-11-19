@props(['value' => 0])

@php
    $stars = (int) round($value);
@endphp

<span {{ $attributes->merge(['class' => 'text-yellow-500']) }}>{{ str_repeat('★', $stars) }}{{ str_repeat('☆', 5 - $stars) }}</span>