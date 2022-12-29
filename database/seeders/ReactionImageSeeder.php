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
        ReactionImage::factory()->create([ 'name' => 'like' ]);

        ReactionImage::factory()->create([ 'name' => 'dislike' ]);
    }
}
