<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mine = Eatery::where('slug', 'carinderia-ni-ledesma')->first();
        $tita = User::where('email', 'tita.ledesma@kaonta.test')->first();

        Review::factory(2)->for($mine)->create();

        $mine->reviews()->create([
            'user_id' => $tita->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Ledesma.',
        ]);

        // only open eateries get reviews
        $openEateries = Eatery::where('is_open', true)
            ->where('id', '!=', $mine->id)
            ->get();

        foreach ($openEateries as $eatery) {
            Review::factory(rand(0, 6))->for($eatery)->create();
        }
    }
}