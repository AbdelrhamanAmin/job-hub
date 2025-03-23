<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobBoard;
use App\Models\Attribute;
use App\Models\JobAttributeValue;

class JobAttributeValueSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = JobBoard::all();
        $attributes = Attribute::all();

        foreach ($jobs as $job) {
            foreach ($attributes->random(rand(1, 3)) as $attribute) {
                JobAttributeValue::create([
                    'job_board_id' => $job->id,
                    'attribute_id' => $attribute->id,
                    'value' => $this->generateValueByType($attribute),
                ]);
            }
        }
    }

    /**
     * Generate value based on attribute type.
     */
    private function generateValueByType(Attribute $attribute)
    {
        switch ($attribute->type) {
            case 'boolean':
                return fake()->boolean() ? 'true' : 'false';

            case 'number':
                return fake()->numberBetween(1000, 100000);

            case 'text':
                return fake()->sentence(3);

            case 'date':
                return fake()->dateTimeThisYear('+1 month');

            case 'select':
                $options = is_array($attribute->options) ? $attribute->options : json_decode($attribute->options, true);

                return is_array($options) && count($options) ? fake()->randomElement($options) : 'NULL';

            default:
                return 'NULL';
        }
    }
}

