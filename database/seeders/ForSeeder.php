<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Fournisseur::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'country' => $faker->country,
                'created_by' => 1, // Fixed value,
                'I_F' => $faker->randomNumber(8),
                'R_C' => $faker->randomNumber(8),
                'I_C_E' => $faker->randomNumber(8),
                'C_N_S_S' => $faker->randomNumber(8),
                'C_I_N' => $faker->randomNumber(8),
                'profile_image' => $faker->imageUrl(640, 480, 'people'),
                'C_I_N_image' => $faker->imageUrl(640, 480, 'business'),
            ]);
        }
    }
}
