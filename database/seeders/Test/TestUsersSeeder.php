<?php

namespace Database\Seeders\Test;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestUsersSeeder extends Seeder
{
    /**
     * Creates some users used to run tests.
     *
     * @return void
     */
    public function run()
    {
      User::factory()->create([
         'name' => 'Filippo Sanzani',
         'email' => 'filippo.sanzani@mail.it'
      ]);

      User::factory()->create([
         'name' => 'Lorenzo Drudi',
         'email' => 'lorenzo.drudi@mail.it'
      ]);

      User::factory()->create([
         'name' => 'Rachele Margutti',
         'email' => 'rachele.margutti@mail.it'
      ]);
    }
}
