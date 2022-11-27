<?php

namespace Database\Seeders\Test;

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Creates some users used to run tests.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TestGroupSeeder::class);
        $this->call(TestUserSeeder::class);
    }
}
