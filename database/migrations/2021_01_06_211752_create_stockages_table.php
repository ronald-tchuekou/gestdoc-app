<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockages', function (Blueprint $table) {
            $table->string('produit', 50)->index();
            $table->string('magasinStockage', 50)->index();
            $table->integer('qteStock');
            $table->string('refPro', 50);
            $table->date('datePeremption');
            $table->string('refProDatePeremptionProduitMaga', 255);
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
        Schema::dropIfExists('stockages');
    }
}
