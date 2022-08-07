<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;

class DataImportController extends Controller
{
    public function index(){
      //dd( public_path() );
      $data = json_decode(file_get_contents( public_path() . "/candidats.json"), false);
      $candidats = $data[2]->data;
      echo "<pre>";

      //$data = json_decode(file_get_contents( public_path() . "/parcours.json"), true);
      //$parcours = $data[1]['parcours'];
      print_r($candidats);
      dd('r');
      //$code_parcours = array();
      /*foreach( $candidats as $c ){
        if ( !in_array( $c->Code_Parcours, $code_parcours) ) {
          array_push($code_parcours, $c->Code_Parcours);
        }
      }*/

      if( count($candiats) == 0){
        foreach( $candidats as $c ){
          $centre = Centre::where('lieu', $c->Centre_Examen)->get()->first();
          $parcour = Parcour::where('code_parcour', $c->Code_Parcours)->get()->first();
          Candidat::create([
          'nom' => $c->Nom_Prenom,
          'prenom' => '',
          'civilite' => $c->Civilite,
          'dateNaissance' => $c->Date_Naissance,
          'lieuNaissance' => $c->Lieu_Naissance,
          'adresse' => $c->Adresse,
          'codePostale' => $c->Code_Postal,
          'email' => $candidat.'@gmail.com',
          'telephone' => $c->Num_Tel,
          'candidatBacc' => $c->Type_candidat,
          'serieBacc' => $c->Serie_Bacc,
          'mentionBacc' => $c->Mention_Bacc,
          'anneeBacc' => $c->Annee_Bacc,
          'num_arrive' => $c->Num_Arrive,
          'moyen_paiement' => $c->Mode_Payment,
          'num_mandat' => $c->Num_Payment,
          'date_envoie' => $c->Date_Envoie,
          'date_arrive' => $c->Date_Arrivee,
          'observation' => $c->Observations,
          'dossier_ok' => 1,
          'imageProfile' => '',
          'parcour_id' => 5,
          'centre_id' => $centre->id,
          'concour_id' => 2
        ]);
        }
      }

    }
}
