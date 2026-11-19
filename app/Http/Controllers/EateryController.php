<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EateryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Eatery::with(['district', 'features', 'reviews']);

        if ($request->filled('q')) {
            $search = $request->input('q');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('specialty', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('district')) {
            $query->where('district_id', $request->input('district'));
        }

        if ($request->filled('feature')) {
            $feature = $request->input('feature');

            $query->whereHas('features', function ($q) use ($feature) {
                $q->where('name', $feature);
            });
        }

        $eateries = $query->orderBy('name')->paginate(6)->withQueryString();

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.index', compact('eateries', 'districts', 'features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.create', compact('districts', 'features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEateryRequest $request)
    {
        $data = $request->validated();

        $eatery = Eatery::create([
            'district_id' => $data['district_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'address' => $data['address'],
            'price_range' => $data['price_range'],
            'specialty' => $data['specialty'] ?? null,
            'is_open' => $data['is_open'],
        ]);

        $eatery->permit()->create([
            'permit_no' => $data['permit_no'],
            'expires_on' => $data['expires_on'],
        ]);

        $eatery->features()->sync($data['features']);

        return redirect()->route('eateries.show', $eatery)->with('success', 'Eatery added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Eatery $eatery)
    {
        $eatery->load([
            'district',
            'features',
            'permit',
            'dishes',
            'reviews' => function ($query) {
                $query->with('user')->latest();
            },
        ]);

        $users = User::orderBy('name')->get();

        return view('eateries.show', compact('eatery', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eatery $eatery)
    {
        $eatery->load(['permit', 'features']);

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.edit', compact('eatery', 'districts', 'features'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEateryRequest $request, Eatery $eatery)
    {
        $data = $request->validated();

        $eatery->update([
            'district_id' => $data['district_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'address' => $data['address'],
            'price_range' => $data['price_range'],
            'specialty' => $data['specialty'] ?? null,
            'is_open' => $data['is_open'],
        ]);

        $eatery->permit()->updateOrCreate([], [
            'permit_no' => $data['permit_no'],
            'expires_on' => $data['expires_on'],
        ]);

        $eatery->features()->sync($data['features']);

        return redirect()->route('eateries.show', $eatery)->with('success', 'Eatery updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eatery $eatery)
    {
        $eatery->permit()->delete();
        $eatery->dishes()->delete();
        $eatery->reviews()->delete();
        $eatery->features()->detach();

        $eatery->delete();

        return redirect()->route('eateries.index')->with('success', 'Eatery deleted.');
    }
}