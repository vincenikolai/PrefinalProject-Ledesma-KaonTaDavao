<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poblacion = District::where('name', 'Poblacion')->first();

        $mine = Eatery::create([
            'district_id' => $poblacion->id,
            'name' => 'Carinderia ni Ledesma',
            'slug' => Str::slug('Carinderia ni Ledesma'),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        $myFeatures = Feature::whereIn('name', ['Suki ni Ledesma', 'Budget Meal'])->pluck('id');
        $mine->features()->sync($myFeatures);

        $mine->permit()->create([
            'permit_no' => 'DVO-2026-0914',
            'expires_on' => '2027-09-14',
        ]);

        $mine->dishes()->createMany([
            ['name' => 'Tinolang Manok', 'price' => 85.00, 'is_bestseller' => true],
            ['name' => 'Kinilaw na Tuna', 'price' => 120.00],
            ['name' => 'Durian Shake', 'price' => 75.00],
        ]);

        // 14 more eateries from the factory, 3 of them closed
        $features = Feature::all();

        $others = Eatery::factory(11)->create()
            ->concat(Eatery::factory(3)->closed()->create());

        foreach ($others as $index => $eatery) {
            if ($index == 0) {
                Permit::factory()->expired()->for($eatery)->create();
            } else {
                Permit::factory()->for($eatery)->create();
            }

            Dish::factory(rand(2, 5))->for($eatery)->create();

            $eatery->features()->attach($features->random(rand(1, 3))->pluck('id'));
        }
    }
}