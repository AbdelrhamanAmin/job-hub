<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attribute::insert([
            ['name' => 'experience_level', 'type' => 'select', 'options' => json_encode(['Junior', 'Mid-level', 'Senior'])],
            ['name' => 'remote_availability', 'type' => 'boolean', 'options' => null],
            ['name' => 'Required Certifications', 'type' => 'text', 'options' => null],
            ['name' => 'expected_start_date', 'type' => 'date', 'options' => null],
            ['name' => 'work_hours_per_week', 'type' => 'number', 'options' => null],
        ]);
    }
}
