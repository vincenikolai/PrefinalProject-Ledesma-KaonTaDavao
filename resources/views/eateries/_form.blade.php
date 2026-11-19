@php
    $eatery = $eatery ?? null;

    // unchecked boxes are not sent, so after a failed submit we only trust the old input
    if (session()->hasOldInput()) {
        $isOpen = old('is_open') ? true : false;
        $checkedFeatures = old('features', []);
    } else {
        $isOpen = $eatery ? $eatery->is_open : true;
        $checkedFeatures = $eatery ? $eatery->features->pluck('id')->toArray() : [];
    }
@endphp

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

<div class="flex flex-col gap-4">
    <div>
        <label for="name" class="block text-sm font-medium mb-1">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $eatery?->name) }}" class="w-full border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
        @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="district_id" class="block text-sm font-medium mb-1">District</label>
        <select name="district_id" id="district_id" class="w-full border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <option value="">-- Select district --</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(old('district_id', $eatery?->district_id) == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>
        @error('district_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="address" class="block text-sm font-medium mb-1">Address</label>
        <input type="text" name="address" id="address" value="{{ old('address', $eatery?->address) }}" class="w-full border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
        @error('address')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price_range" class="block text-sm font-medium mb-1">Price Range</label>
        <select name="price_range" id="price_range" class="w-full border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <option value="">-- Select price range --</option>
            <option value="budget" @selected(old('price_range', $eatery?->price_range) == 'budget')>Budget (₱)</option>
            <option value="mid" @selected(old('price_range', $eatery?->price_range) == 'mid')>Mid (₱₱)</option>
            <option value="splurge" @selected(old('price_range', $eatery?->price_range) == 'splurge')>Splurge (₱₱₱)</option>
        </select>
        @error('price_range')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="specialty" class="block text-sm font-medium mb-1">Specialty</label>
        <input type="text" name="specialty" id="specialty" value="{{ old('specialty', $eatery?->specialty) }}" class="w-full border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
        @error('specialty')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" name="is_open" value="1" @checked($isOpen)>
            <span>Open</span>
        </label>
        @error('is_open')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <p class="block text-sm font-medium mb-1">Features</p>
        <div class="flex flex-wrap gap-4">
            @foreach ($features as $feature)
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}" @checked(in_array($feature->id, $checkedFeatures))>
                    <span>{{ $feature->name }}</span>
                </label>
            @endforeach
        </div>
        @error('features')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
        @error('features.*')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="permit_no" class="block text-sm font-medium mb-1">Permit Number</label>
        <input type="text" name="permit_no" id="permit_no" value="{{ old('permit_no', $eatery?->permit?->permit_no) }}" placeholder="DVO-2026-0415" class="w-full border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
        @error('permit_no')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="expires_on" class="block text-sm font-medium mb-1">Permit Expiry Date</label>
        <input type="date" name="expires_on" id="expires_on" value="{{ old('expires_on', $eatery?->permit?->expires_on?->format('Y-m-d')) }}" class="w-full border border-stone-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
        @error('expires_on')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>