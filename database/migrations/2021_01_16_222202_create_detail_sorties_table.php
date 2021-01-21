<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSortiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sorties', function (Blueprint $table)
        {
            $table->integer('idSortie');
            $table->string('idProduit');
            $table->integer('qteSortie');
            $table->string('referenceP');
            $table->string('motifSortie');
            $table->string('obserSortie');
            $table->date('datePeremptionS');
            $table->string('magSortie');
            $table->string('magDest');
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
        Schema::dropIfExists('detail_sorties');
    }
}
