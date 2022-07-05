<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator;

class CandidatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $ice = ['Koto', 'Paul', 'Jack', 'Marie', 'Fernand', 'Donal', 'Fleur', 'Pierre', 'Rick', 'Bosko', 'Dore', 'Frank', 'Luis', 'Bertin', 'Pascal', 'Ferdinand'];
      $i = 1;
      foreach($ice as $candidat){
        \App\Models\Candidat::create([
          'nom' => 'Jean',
          'prenom' => $candidat,
          'civilite' => 'monsieur',
          'dateNaissance' => '',
          'lieuNaissance' => '',
          'adresse' => '',
          'codePostale' => '201',
          'email' => $candidat.'@gmail.com',
          'telephone' => '03'.random_int(2, 4).random_int(10, 99).'54975',
          'candidatBacc' => 'ecole',
          'serieBacc' => 'd',
          'mentionBacc' => 'bien',
          'anneeBacc' => '2012',
          'num_arrive' => $i,
          'moyen_paiement' => '',
          'num_mandat' => '',
          'date_envoie' => '',
          'date_arrive' => '',
          'dossier_ok' => 1,
          'imageProfile' => '',
          'parcour_id' => 5,
          'centre_id' => 1,
          'concour_id' => 2
        ]);
        $i++;
      }

      foreach($ice as $candidat){
        \App\Models\Candidat::create([
          'nom' => 'Olo',
          'prenom' => $candidat,
          'civilite' => 'monsieur',
          'dateNaissance' => '',
          'lieuNaissance' => '',
          'adresse' => '',
          'codePostale' => '201',
          'email' => $candidat.'@gmail.com',
          'telephone' => '03'.random_int(2, 4).random_int(10, 99).'54975',
          'candidatBacc' => 'ecole',
          'serieBacc' => 'd',
          'mentionBacc' => 'bien',
          'anneeBacc' => '2012',
          'num_arrive' => $i,
          'moyen_paiement' => '',
          'num_mandat' => '',
          'date_envoie' => '',
          'date_arrive' => '',
          'dossier_ok' => 1,
          'imageProfile' => '',
          'parcour_id' => random_int(1, 4),
          'centre_id' => random_int(1, 4),
          'concour_id' => 2
        ]);
        $i++;
      }
    }
}
