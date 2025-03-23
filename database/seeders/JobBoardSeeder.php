<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobBoard;
use App\Models\Language;
use App\Models\Location;
use App\Models\Category;

class JobBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobBoard::factory(50)->create()->each(function ($job) {
            // Attach random languages (1 to 3 per job)
            $languages = Language::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $job->languages()->attach($languages);

            // Attach random locations (1 to 2 per job)
            $locations = Location::inRandomOrder()->limit(rand(1, 2))->pluck('id');
            $job->locations()->attach($locations);

            // Attach random categories (1 per job)
            $category = Category::inRandomOrder()->limit(1)->pluck('id');
            $job->categories()->attach($category);
        });
    }
}
