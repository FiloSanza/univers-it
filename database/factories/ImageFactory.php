<?php

namespace Database\Factories;

use App\Http\Controllers\ImageController;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\app\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the image's default state.
     *
     * @return array<string, string>
     */
    public function definition()
    {
        return [
            'storage_path' => fake()->filePath(),
        ];
    }
}
