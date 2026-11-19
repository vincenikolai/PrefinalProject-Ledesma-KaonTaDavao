<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = ['Suki ni Ledesma', 'Budget Meal', 'Halal', 'Open 24 Hours', 'Aircon', 'Free WiFi'];

        foreach ($features as $name) {
            Feature::create(['name' => $name]);
        }
    }
}