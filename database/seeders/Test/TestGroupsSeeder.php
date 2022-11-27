<?php

namespace Database\Seeders\Test;

use App\Models\Group;
use Illuminate\Database\Seeder;

class TestGroupsSeeder extends Seeder
{
    /**
     * Creates some users used to run tests.
     *
     * @return void
     */
    public function run()
    {
        Group::factory()->create([
            'name' => 'group01'
        ]);

        Group::factory()->create([
            'name' => 'group02'
        ]);

        Group::factory()->create([
            'name' => 'group03'
        ]);
    }
}
