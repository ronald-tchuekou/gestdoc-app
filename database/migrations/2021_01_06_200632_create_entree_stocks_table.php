<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreeStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entree_stocks', function (Blueprint $table) {
            $table->id('idEntree');
            $table->timestamp('dateEntree');
            $table->string('fournisseur', 255);
            $table->string('magOrigine', 50)->index();
            $table->string('magDestination', 50)->index();
            $table->string('motifEntree', 50);
            $table->string('client', 50)->index();
            $table->string('ajouterParE', 50)->index();
            $table->string('modifierParE', 50)->index();
            $table->date('dateModiE');
            $table->string('supprimerParS', 50)->index();
            $table->date('dateSupp');
            $table->string('selecteur', 50);
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
        Schema::dropIfExists('entree_stocks');
    }
}
