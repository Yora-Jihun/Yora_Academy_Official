<?php

namespace Database\Factories;

use App\Models\Doc;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Doc>
 */
class DocFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'slug' => Str::slug(fake()->sentence(3)),
            'is_public' => false,
            'permission' => 'view',
        ];
    }
}
