<?php

namespace App\Http\Controllers;

use App\Models\District;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::withCount('eateries')->orderBy('name')->get();

        return view('districts.index', compact('districts'));
    }

    public function show(District $district)
    {
        $district->load([
            'eateries' => function ($query) {
                $query->with(['district', 'features', 'reviews'])->orderBy('name');
            },
        ]);

        $reviewCount = $district->reviews()->count();

        return view('districts.show', compact('district', 'reviewCount'));
    }
}