<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parcour;
use App\Models\Ecole;

class ParcoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      /*$parcours = [
        array('nom' => 'Maintenance en Equipement Frigorifique et thermique', 'code' => 'MEFT', 'ecole_id' => 1),
        array('nom' => "Maiantenance en equipement Electromecanique", 'code' => 'MEEM', 'ecole_id' => 1),
        array('nom' => "Technologie de l'Informatique et Multimedia", 'code' => 'TIM', 'ecole_id' => 1),
        array('nom' => 'Technologie Navale', 'code' => 'TechNa', 'ecole_id' => 1),
          array('nom' => 'Réseaux et Télécommunications', 'code' => 'RT', 'ecole_id' => 1),
      ];*/
      $data = json_decode(file_get_contents( public_path() . "/parcours.json"), true);
      $parcours = $data[1]['parcours'];
      foreach( $parcours as $p ){
        $ecole_id = Ecole::where('code', $p['ecole']['code'])->get()->first()->id;
        Parcour::create([
          'nom' => $p['nom'],
          'code' => $p['code'],
          'ecole_id' => $ecole_id
        ]);
      }
    }
}
