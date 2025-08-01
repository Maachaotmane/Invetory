<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => $this->faker->unique()->company,
        ];
    }
}