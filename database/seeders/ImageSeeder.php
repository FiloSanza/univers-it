<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the images seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::factory()->create();
    }
}
