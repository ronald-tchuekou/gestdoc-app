<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailleEntreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detaille_entrees', function (Blueprint $table) {
            $table->string('idProduit', 50)->index();
            $table->integer('idEntree')->index();
            $table->integer('qtEntree')->index();
            $table->date('datePeremption')->index();
            $table->string('reference')->index();
            $table->integer('qteEntree2')->index();
            $table->integer('prixAchat')->index();
            $table->text('observation')->index();
            $table->string('magEntree', 50)->index();
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
        Schema::dropIfExists('detaille_entrees');
    }
}
