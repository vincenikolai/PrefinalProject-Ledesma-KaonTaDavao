<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $eateryCount = Eatery::count();
        $districtCount = District::count();
        $reviewCount = Review::count();

        $topRated = Eatery::with(['district', 'features', 'reviews'])
            ->has('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->orderBy('name')
            ->take(3)
            ->get();

        return view('home', compact('eateryCount', 'districtCount', 'reviewCount', 'topRated'));
    }
}