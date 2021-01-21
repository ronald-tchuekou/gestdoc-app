<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id('idVente');
            $table->date('dateVente');
            $table->string('idClient');
            $table->integer('remiseTotale');
            $table->integer('montant');
            $table->string('heureC');
            $table->integer('acompte');
            $table->integer('precompte');
            $table->string('responsable');
            $table->string('serveur');
            $table->string('magasin');
            $table->string('impression');
            $table->date('dateAnnulation');
            $table->string('ajouterPar');
            $table->string('modifierPar');
            $table->string('supprimerPar');
            $table->date('dateModif');
            $table->string('heureModif');
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
        Schema::dropIfExists('ventes');
    }
}
