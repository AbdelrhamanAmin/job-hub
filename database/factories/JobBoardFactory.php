<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobBoard;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobBoard>
 */
class JobBoardFactory extends Factory
{
    protected $model = JobBoard::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'company_name' => $this->faker->company(),
            'salary_min' => $this->faker->randomFloat(2, 40000, 60000),
            'salary_max' => $this->faker->randomFloat(2, 60001, 120000),
            'is_remote' => $this->faker->boolean(),
            'job_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'freelance']),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'published_at' => $this->faker->dateTimeThisYear(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
