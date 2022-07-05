<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            $table->string('numInscription')->nullable();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('civilite');
            $table->string('dateNaissance');
            $table->string('lieuNaissance');
            $table->string('adresse');
            $table->string('codePostale');
            $table->string('telephone')->nullable();
            $table->string('candidatBacc');
            $table->string('serieBacc');
            $table->string('mentionBacc');
            $table->string('anneeBacc');
            $table->integer('num_arrive');
            $table->string('moyen_paiement');
            $table->string('num_mandat');
            $table->string('date_envoie');
            $table->string('date_arrive');
            $table->boolean('dossier_ok');
            $table->string('email')->nullable();
            $table->string('imageProfile')->nullable();
            $table->integer('parcour_id');
            $table->integer('centre_id');
            $table->integer('concour_id');
            $table->integer('salle_id')->nullable();
            $table->string('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidats');
    }
}
