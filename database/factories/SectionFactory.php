<?php

namespace Database\Factories;

use App\Models\Doc;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Section>
 */
class SectionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'doc_id' => Doc::factory(),
            'title' => fake()->sentence(2),
            'order' => 0,
        ];
    }
}
