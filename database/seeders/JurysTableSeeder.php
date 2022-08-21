<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jury;

class JurysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $juries = array(
          array('nom' => 'Jean Koto', 'concour_id' => 2 ),
          array('nom' => 'Jean Paul', 'concour_id' => 2 ),
          array('nom' => 'Jean Bosco', 'concour_id' => 2 ),
        );
        foreach ($juries as $jury) {
          Jury::create( $jury );
        }
    }
}
