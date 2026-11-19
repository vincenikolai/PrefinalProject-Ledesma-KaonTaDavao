<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Vince Nikolai Ledesma',
            'email' => 'ledesma@kaonta.test',
            'password' => Hash::make('kaonta2026'),
        ]);

        User::create([
            'name' => 'Tita Ledesma',
            'email' => 'tita.ledesma@kaonta.test',
            'password' => Hash::make('kaonta2026'),
        ]);

        User::factory(10)->create();
    }
}