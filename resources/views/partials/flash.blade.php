@if (session('success'))
    <div class="mb-4 rounded bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3">
        {{ session('success') }}
    </div>
@endif