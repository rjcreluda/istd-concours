<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salle;

class SallesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $salles = array(
        array('reference' => 'S1', 'localisation' => 'IST-D', 'capacite' => 30),
        array('reference' => 'S2', 'localisation' => 'IST-D', 'capacite' => 20),
        array('reference' => 'S3', 'localisation' => 'IST-D', 'capacite' => 20),
        array('reference' => 'S4', 'localisation' => 'IST-D', 'capacite' => 15),
        array('reference' => 'S5', 'localisation' => 'IST-D', 'capacite' => 20),
        array('reference' => 'S6', 'localisation' => 'IST-D', 'capacite' => 20),
        array('reference' => 'S7', 'localisation' => 'IST-D', 'capacite' => 20),
        array('reference' => 'LMA1', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA2', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA3', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA4', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA5', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA6', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA7', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA8', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA9', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA10', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA11', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
        array('reference' => 'LMA12', 'localisation' => 'Lycée Mixte', 'capacite' => 40),
      );
      foreach( $salles as $salle ){
        Salle::create($salle);
      }
    }
}
