<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobAttributeValue;
use App\Models\JobBoard;
use App\Models\Attribute;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobAttributeValue>
 */
class JobAttributeValueFactory extends Factory
{
    protected $model = JobAttributeValue::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_board_id' => JobBoard::factory(),
            'attribute_id' => Attribute::factory(),
            'value' => $this->faker->randomElement(['Yes', 'No', '2025-06-01', '5+ years', '40']),
        ];
    }
}
