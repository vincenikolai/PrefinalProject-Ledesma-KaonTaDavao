<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = ['Poblacion', 'Talomo', 'Agdao', 'Buhangin', 'Toril', 'Calinan'];

        foreach ($districts as $name) {
            District::create(['name' => $name]);
        }
    }
}