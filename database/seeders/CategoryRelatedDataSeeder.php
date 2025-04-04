<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Measure;
use App\Models\SubCategory;
use App\Models\SubMeasure;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoryRelatedDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create 5 categories
        Category::factory(5)->create()->each(function ($category) use ($faker) {
            // For each category, create 3 subcategories
            SubCategory::factory(3)->create([
                'category_id' => $category->id,
                'name' => $faker->unique()->word,
            ]);

            // For each category, create 2 types
            Type::factory(2)->create([
                'category_id' => $category->id,
                'name' => $faker->unique()->word,
            ]);

            // For each category, create 3 measures
            Measure::factory(3)->create([
                'category_id' => $category->id,
                'name' => $faker->unique()->word,
            ]);

            // For each category, create 4 units
            Unit::factory(4)->create([
                'category_id' => $category->id,
                'name' => $faker->unique()->word,
            ]);

            // For each category, create 5 brands
            Brand::factory(5)->create([
                'category_id' => $category->id,
                'name' => $faker->unique()->company,
            ]);

            SubMeasure::factory(3)->create([
                'category_id' => $category->id,
                'name' => $faker->unique()->word,
            ]);
        });

        $this->command->info('Successfully seeded categories with related data!');
    }
}