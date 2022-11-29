<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\app\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the post's default state.
     *
     * @return array<string, string>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'group_id' => Group::factory(),
            'title' => fake()->word(),
            'content' => fake()->paragraph(2)
        ];
    }
}
