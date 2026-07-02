<?php

namespace Database\Factories;

use App\Models\Doc;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'doc_id' => Doc::factory(),
            'section_id' => Section::factory(),
            'title' => fake()->sentence(3),
            'slug' => Str::slug(fake()->sentence(3)),
            'content' => '<p>'.fake()->paragraph().'</p>',
            'permission' => 'view',
            'is_public' => false,
            'order' => 0,
        ];
    }
}
