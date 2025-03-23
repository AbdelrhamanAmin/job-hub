<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attribute;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    protected $model = Attribute::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['text', 'number', 'boolean', 'date', 'select']);

        return [
            'name' => $this->faker->word(),
            'type' => $type,
            'options' => $type === 'select' ? json_encode($this->faker->randomElements(['Beginner', 'Intermediate', 'Advanced'], 2)) : null,
        ];
    }
}
