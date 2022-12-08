<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\ReactionImage;
use Database\Factories\ReactionImageFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReactionImage::factory()->create([
            'name' => 'shaq_surprised', 
            'image_id' => Image::where('storage_path', 'shaq.png')->first()->id,
        ]);

        ReactionImage::factory()->create([
            'name' => 'mike_wtf', 
            'image_id' => Image::where('storage_path', 'mike.jpg')->first()->id,
        ]);
    }
}
