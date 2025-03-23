<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\AttributeSeeder;
use Database\Seeders\JobBoardSeeder;
use Database\Seeders\JobAttributeValueSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            LocationSeeder::class,
            CategorySeeder::class,
            AttributeSeeder::class,
            JobBoardSeeder::class,
            JobAttributeValueSeeder::class,
        ]);
    }
}
