<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;

class UniversitySeeder extends Seeder
{
    /**
     * Run the universities seeds.
     *
     * @return void
     */
    public function run()
    {
        $universities = [
            ['name' => 'University of Bologna', 'domain' => 'studio.unibo.it'],
            ['name' => 'University of Trento', 'domain' => 'studenti.unitn.it'],
        ];

        foreach($universities as $university){
            University::create($university);
        }
    }
}
