<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ecole;

class EcolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $ecoles = [
        (object) array('nom' => 'Ecole du Genie Indistruel', 'code' => 'EGI'),
        (object) array('nom' => 'Ecole du Genie Management Commerce et Service', 'code' => 'EGMCS'),
        (object) array('nom' => 'Ecole du Genie Civil et Naval', 'code' => 'EGCN'),
      ];
      foreach( $ecoles as $ecole ){
        Ecole::create([
          'nom' =>  $ecole->nom,
          'code' =>  $ecole->code
        ]);
      }
    }
}
