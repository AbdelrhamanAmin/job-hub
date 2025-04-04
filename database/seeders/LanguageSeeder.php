<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = ['PHP', 'JavaScript', 'Python', 'Ruby', 'Go', 'Java', 'C#'];

        foreach ($languages as $language) {
            Language::create(['name' => $language]);
        }
    }
}
