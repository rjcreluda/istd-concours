<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matiere;

class MatieresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $matieres = [
          array('nom' => 'Mathematique', 'coefficient' => 2, 'ecole_id' => 1),
          array('nom' => 'Physique', 'coefficient' => 2, 'ecole_id' => 1),
          array('nom' => 'Français', 'coefficient' => 1, 'ecole_id' => 1),
            array('nom' => 'Dessin', 'coefficient' => 2, 'ecole_id' => 1),
            array('nom' => 'Test Psy', 'coefficient' => 1, 'ecole_id' => 1),

            array('nom' => 'Français', 'coefficient' => 2, 'ecole_id' => 2),
            array('nom' => 'Mathematique', 'coefficient' => 1, 'ecole_id' => 2),
            array('nom' => 'Culture Générale', 'coefficient' => 2, 'ecole_id' => 2),
            array('nom' => 'Anglais', 'coefficient' => 2, 'ecole_id' => 2),
            array('nom' => 'Test Psy', 'coefficient' => 1, 'ecole_id' => 2)
      ];
      foreach( $matieres as $matiere ){
        Matiere::create($matiere);
      }
    }
}
