@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <h1 class="text-2xl font-bold mb-4">Add Eatery</h1>

        <form method="POST" action="{{ route('eateries.store') }}">
            @csrf

            @include('eateries._form')

            <div class="mt-6 flex gap-2">
                <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">Save Eatery</button>
                <a href="{{ route('eateries.index') }}" class="px-4 py-2 rounded border hover:bg-gray-100">Cancel</a>
            </div>
        </form>
    </div>
@endsection