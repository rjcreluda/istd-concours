<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Concour;
use App\Models\ConcourInfo;
use App\Models\Setting;

class ConcoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Setting::create([
        'app_name' => 'Gestion concours IST-D',
        'app_description' => 'Gestion de concours d\'entree à l\'IST-D'
      ]);
      $c1 = Concour::create([
        'anneeUniv' => '2019',
        'note_eliminatoire' => 8,
        'moyenne_deliberation' => 10,
        'nombre_candidat' => 30,
        'active' => 0,
        'decret' => 'Decret n°123-456'
      ]);
      ConcourInfo::create([
            'concour_id' => $c1->id,
            'cycle' => '1er cycle',
            'date_1' => dateToMySQL( '20/05/2020' ),
            'date_2' => dateToMySQL( '21/05/2020' )
        ]);
      ConcourInfo::create([
            'concour_id' => $c1->id,
            'cycle' => '2nd cycle',
            'date_1' => dateToMySQL( '21/05/2020' ),
            'date_2' => dateToMySQL( '22/05/2020' )
        ]);
      $c2 = Concour::create([
        'anneeUniv' => '2020',
        'note_eliminatoire' => 5,
        'moyenne_deliberation' => 10,
        'nombre_candidat' => 30,
        'active' => 1,
        'decret' => 'Decret n°123-456-789'
      ]);
      ConcourInfo::create([
            'concour_id' => $c2->id,
            'cycle' => '1er cycle',
            'date_1' => dateToMySQL( '20/05/2021' ),
            'date_2' => dateToMySQL( '21/05/2021' )
        ]);
      ConcourInfo::create([
            'concour_id' => $c2->id,
            'cycle' => '2nd cycle',
            'date_1' => dateToMySQL( '20/05/2021' ),
            'date_2' => dateToMySQL( '21/05/2021' )
        ]);
    }
}
