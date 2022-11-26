<?php

namespace Database\Factories;

use App\Models\FollowEdge;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FollowEdge>
 */
class FollowEdgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FollowEdge::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'followed_id' => User::factory(),
            'follower_id' => User::factory()
        ];
    }
}
