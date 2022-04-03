<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\EntreeStock;
use App\Models\SortieStock;
use App\Models\Livraison;
use App\Models\Fournisseur;
use App\Models\Boutique;
use App\Models\Vente;
use Faker\Generator;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $designations = array(
          'PAPER CUP 9OZ (Tasse avec Main)', 'PAPER CUP 6OZ',
          'CARTON FRITE', 'SAUCIERE 1OZ',
          'VERRE A JETER MARRON', 'VERRE A JETER BLANC',
          'BOITE ROND 250CC', 'BOITE ROND 350CC',
          'BARQUETTE ALU 8389', 'CUILLERE A SOUPE JETER BLANC',
          'CUILLERE A CAFE JETER BLANC', 'ASSIETTE A JETER BLANC',
          'Fillet de peche 10x10 blanc',
          'Fillet de peche 10x20 blanc',
          'GLACIER ROND 1L', 'GLACIER ROND 3L',
          'ROULEAUX SACHET BLANC/METRE',
          'ROULEAUX SACHET JAUNE/METRE', 'HAMECON',
          'PAPER ALU CP 9 X 15 (PA9)', 'PAPER ALU CP 12 X 20 (PA12)',
          'CUVETTE 18', 'CUVETTE 23', 'SEAU 6 L', 'SEAU 8 L',
          'BASSINE 32 AVEC MANCHE', 'BASSINE 36 AVEC MANCHE',
      );
      $articles = array();
      for( $i = 0; $i < count($designations); $i++ ){
        $faker = \Faker\Factory::create();
        $item = Article::create([
          'nom' => $designations[$i],
          'marque' => '',
          'description' => $faker->sentence,
          'photo' => '',
          'stockMinimal' => 5,
          'qte' => 0,
        ]);
        if( $i < 10 ){
          $articles[] = $item;
        }
      }
      // Generate Livraison
      $fournisseur = Fournisseur::first();
      for($l = 0; $l < 2; $l++){
        $livraison = new Livraison();
        $livraison->fournisseur_id = $fournisseur->id;
        $livraison->save();
      }

      $prix = array(20000, 15000, 10000, 25000, 30000);
      for( $i = 0; $i < count($articles); $i++ ){
        /*** Generation Entree Stock ***/
        $entree = EntreeStock::create([
          'titre' => 'Entrée '.$articles[$i]->nom,
          'prixEntree' => $prix[ random_int(0, count($prix)-1) ] ,
          'qte' => random_int(10, 20),
          'livraison_id' => $i < 5 ? 1 : 2,
          'article_id' => $articles[$i]->id
        ]);
        // Update article quantity
        $articles[$i]->qte += $entree->qte;
        $articles[$i]->save();
        /*** Generation de Sortie stock ***/
        $sortie = SortieStock::create([
          'qte' => random_int(7, 10),
          'prixVente' => $entree->prixEntree * 1.3,
          'article_id' => $articles[$i]->id
        ]);
        // Update Boutique
        $shop = Boutique::where('article_id', $sortie->article_id)->get()->first();
        if( $shop ){
          // article deja au boutique
          // on met à jour la qté et prix
          $shop->qte += $sortie->qte;
          $shop->prixVente = $sortie->prixVente;
          $shop->save();
        }
        else{
          // article pas encore au boutique, on l'ajoute
          $shop = Boutique::create([
            'qte' => $sortie->qte,
            'prixVente' => $sortie->prixVente,
            'article_id' => $sortie->article_id
          ]);
        }

        /*** Generation de Vente ***/
        for($j = 0; $j < 2; $j++){
          $vente = Vente::create([
            'qte' => random_int(1, 3),
            'boutique_id' => $shop->id
          ]);
          //. Update shop qty
          $shop->qte -= $vente->qte;
          $shop->save();
        }

      }

    }
}
