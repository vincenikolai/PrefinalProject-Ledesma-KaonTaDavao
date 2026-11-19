<?php

use App\Http\Controllers\DistrictController;
use App\Http\Controllers\EateryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewerController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::resource('eateries', EateryController::class);

Route::post('/eateries/{eatery}/reviews', [ReviewController::class, 'store'])->name('eateries.reviews.store');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

Route::get('/districts', [DistrictController::class, 'index'])->name('districts.index');
Route::get('/districts/{district}', [DistrictController::class, 'show'])->name('districts.show');

Route::get('/reviewers/{user}', [ReviewerController::class, 'show'])->name('reviewers.show');