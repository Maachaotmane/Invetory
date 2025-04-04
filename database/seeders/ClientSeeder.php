<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Client::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'country' => $faker->country,
                'credit_limit' => $faker->randomFloat(2, 1000, 10000),
                'total_due_amount' => $faker->randomFloat(2, 0, 5000),
                'created_by' => 1, // Fixed value
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

