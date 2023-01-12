<?php

namespace Database\Seeders;

use App\Models\Reaction;
use Database\Factories\ReactionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reaction::factory()->create([ 'name' => 'like' ]);

        Reaction::factory()->create([ 'name' => 'dislike' ]);
    }
}
