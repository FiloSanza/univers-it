<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MailSettings>
 */
class MailSettingsFactory extends Factory
{
    const TRUE_CHANCE = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'new_post' => fake()->boolean(),
            'new_follower' => fake()->boolean(),
            'new_comment' => fake()->boolean(),
            'new_reaction' => fake()->boolean(),
        ];
    }
}
