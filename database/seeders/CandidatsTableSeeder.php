<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator;
use App\Models\Centre;
use App\Models\Candidat;
use App\Models\Parcour;

class CandidatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = json_decode(file_get_contents( public_path() . "/candidats.json"), false);
      $candidats = $data[2]->data;
      if( count($candidats) > 0){
        foreach( $candidats as $c ){
          $centre = Centre::where('lieu', $c->Centre_Examen)->get()->first();
          $parcour = Parcour::where('code', $c->Code_Parcours)->get()->first();
          if( ! is_object($centre) ){
            print_r( $c->Centre_Examen );
          }
          //$nom_complet = split(' ', string)
          Candidat::create([
          'nom' => $c->Nom_Prenom,
          'prenom' => '',
          'civilite' => $c->Civilite,
          'dateNaissance' => $c->Date_Naissance,
          'lieuNaissance' => $c->Lieu_Naissance,
          'adresse' => $c->Adresse,
          'codePostale' => $c->Code_Postal,
          'email' => '',
          'telephone' => $c->Num_Tel,
          'candidatBacc' => $c->Type_candidat,
          'serieBacc' => $c->Serie_Bacc,
          'mentionBacc' => $c->Mention_Bacc,
          'anneeBacc' => $c->Annee_Bacc,
          'num_arrive' => (int) $c->Num_Arrive,
          'moyen_paiement' => $c->Mode_Payment,
          'num_mandat' => $c->Num_Payment,
          'date_envoie' => $c->Date_Envoie,
          'date_arrive' => $c->Date_Arrivee,
          'observation' => $c->Observations,
          'dossier_ok' => 1,
          'imageProfile' => '',
          'parcour_id' => $parcour->id,
          'centre_id' => $centre->id,
          'concour_id' => 2,
          'user_id' => 1
        ]);
        }
      }
      $ice = ['Koto', 'Paul', 'Jack', 'Marie', 'Fernand', 'Donal', 'Fleur', 'Pierre', 'Rick', 'Bosko', 'Dore', 'Frank', 'Luis', 'Bertin', 'Pascal', 'Ferdinand'];
      $i = 1;
      foreach($ice as $candidat){
        \App\Models\Candidat::create([
          'nom' => 'Jean msa',
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
          'observation' => '',
          'dossier_ok' => 1,
          'imageProfile' => '',
          'parcour_id' => 12,
          'centre_id' => 1,
          'concour_id' => 1,
          'user_id' => 1
        ]);
        $i++;
      }
      /*
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
      }*/
    }
}
