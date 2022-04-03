<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\EntreeStock;
use App\Models\Livraison;

class LivraisonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /* Generation Livraison */
      $livraison = new Livraison();
      $livraison->fournisseur_id = 1;
      $livraison->save();
      $prix = array(20000, 15000, 10000, 25000, 30000);
      for( $i = 0; $i < 5; $i++ ){
        $article = Article::find($i+1);
        /*** Generation Entree Stock ***/
        $entree = EntreeStock::create([
          'titre' => 'Entrée '.$article->nom,
          'prixEntree' => $prix[$i] ,
          'qte' => 5,
          'livraison_id' => $livraison->id,
          'article_id' => $article->id
        ]);
        // Update article quantity
        $article->qte += $entree->qte;
        $article->save();
      }
    }
}
