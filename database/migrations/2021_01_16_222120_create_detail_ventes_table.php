<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_ventes', function (Blueprint $table) {
            $table->id('ligneCom');
            $table->string('idProduit',);
            $table->integer('qteVendue',);
            $table->integer('remise',);
            $table->integer('idVente',);
            $table->integer('pu',);
            $table->integer('tva',);
            $table->string('reference',);
            $table->date('datePeremptionV',);
            $table->string('magVente',);
            $table->string('nomCats',);
            $table->string('cond',);
            $table->integer('stockInit',);
            $table->integer('stockCrit',);
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
        Schema::dropIfExists('detail_ventes');
    }
}
