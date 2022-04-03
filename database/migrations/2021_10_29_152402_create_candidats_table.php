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
            $table->string('sexe');
            $table->string('dateNaissance');
            $table->string('email')->nullable();
            $table->string('telephone1');
            $table->string('telephone2')->nullable();
            $table->string('imageProfile')->nullable();
            $table->integer('parcour_id');
            $table->integer('centre_id');
            $table->integer('concour_id');
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
