<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $parcour_id = 5; // Parcours Réseau et Télécommunication
      $candidats = \App\Models\Candidat::where('parcour_id', $parcour_id)->get();
      $matieres = \App\Models\Matiere::where('ecole_id', 1)->get();
      foreach($candidats as $candidat){
        // Generating Notes for each Candidats
        $i = 1;
        foreach($matieres as $matiere){
          // Generating note for each matieres
          $note = [
            'point' => $i < 5 ? random_int(12, 19) : random_int(7, 15), // Random note
            'candidat_id' => $candidat->id,
            'parcour_id' => $candidat->parcour_id ,
            'matiere_id' => $matiere->id
          ];
          //array_push($notes, $note);
          \App\Models\Note::create($note);
          $i++;
        }
      }

    }
}
