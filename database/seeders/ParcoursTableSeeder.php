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
      // Parcours du 1er cycle
      $data = json_decode(file_get_contents( public_path() . "/parcours.json"), true);
      $parcours = $data[1]['parcours'];
      foreach( $parcours as $p ){
        $ecole_id = Ecole::where('code', $p['ecole']['code'])->get()->first()->id;
        Parcour::create([
          'nom' => $p['nom'],
          'code' => $p['code'],
          'ecole_id' => $ecole_id,
          'cycle' => 1,
          'niveau' => 1
        ]);
      }

      // Parcours 2nd cycle
      $parcours2 = [
        array('nom' => 'Administration des Réseaux', 'code' => 'AdR', 'ecole_id' => 1, 'cycle' => 2, 'niveau' => 2 ),
        array('nom' => "Ingénierie des Réseaux Mobiles", 'code' => 'IRM', 'ecole_id' => 1, 'cycle' => 2, 'niveau' => 2 ),
        array('nom' => "Système à Energie Renouvelable et Alternance", 'code' => 'SERA', 'ecole_id' => 1, 'cycle' => 2, 'niveau' => 2 ),
        array('nom' => 'Ingénierie des Communications Electroniques', 'code' => 'ICE', 'ecole_id' => 1, 'cycle' => 2, 'niveau' => 3 ),
        array('nom' => 'Technique Avancé de Maintenance', 'code' => 'TAM', 'ecole_id' => 1, 'cycle' => 2, 'niveau' => 3 ),
        array('nom' => 'Nouvel Technologie de l\electricité', 'code' => 'NTE', 'ecole_id' => 1, 'cycle' => 2, 'niveau' => 3 ),
        array('nom' => 'Développement de Produit Touristique', 'code' => 'DPT', 'ecole_id' => 2, 'cycle' => 2, 'niveau' => 2 ),
        array('nom' => 'Transit et Commerce Internationnale', 'code' => 'TCI', 'ecole_id' => 2, 'cycle' => 2, 'niveau' => 2 ),
        array('nom' => 'Management des Entreprise et Organisation', 'code' => 'MEO', 'ecole_id' => 2, 'cycle' => 2, 'niveau' => 3 ),
      ];
      foreach( $parcours2 as $p ){
        Parcour::create( $p );
      }
    }
}
