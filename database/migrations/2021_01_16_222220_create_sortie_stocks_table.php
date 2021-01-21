<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSortieStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sortie_stocks', function (Blueprint $table) {
            $table->id('idSortie');
            $table->date('dateSortie')->index();
            $table->string('magasinDestination')->index();
            $table->string('magasinOrigine')->index();
            $table->string('motifSortie');
            $table->string('fourSortie');   
            $table->string('ajouterParS');
            $table->string('modifierParS');
            $table->date('dateModifS');
            $table->string('supprimerPare');
            $table->date('dateSuppres');
            $table->string('selecteurs');
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
        Schema::dropIfExists('sortie_stocks');
    }
}
