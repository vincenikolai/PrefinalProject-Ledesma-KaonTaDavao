@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6 max-w-2xl">
        <h1 class="font-display text-2xl font-semibold text-purple-950 mb-4">Add Eatery</h1>

        <form method="POST" action="{{ route('eateries.store') }}">
            @csrf

            @include('eateries._form')

            <div class="mt-6 flex gap-2">
                <button type="submit" class="bg-emerald-700 text-white px-4 py-2 rounded-lg hover:bg-emerald-800">Save Eatery</button>
                <a href="{{ route('eateries.index') }}" class="px-4 py-2 rounded-lg border border-stone-300 hover:bg-stone-200">Cancel</a>
            </div>
        </form>
    </div>
@endsection