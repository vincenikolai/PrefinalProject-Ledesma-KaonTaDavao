<?php

namespace App\Http\Controllers;

use App\Models\User;

class ReviewerController extends Controller
{
    public function show(User $user)
    {
        $user->load([
            'reviews' => function ($query) {
                $query->with('eatery')->latest();
            },
        ]);

        return view('reviewers.show', compact('user'));
    }
}