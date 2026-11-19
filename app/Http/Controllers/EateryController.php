<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eatery $eatery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eatery $eatery)
    {
        //
    }
}