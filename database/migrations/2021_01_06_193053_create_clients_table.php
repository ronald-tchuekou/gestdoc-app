<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('idClient');
            $table->string('nomClient', 255);
            $table->string('adresse', 255);
            $table->string('telephoneClient', 255);
            $table->string('emailClient', 255);
            $table->string('numContr', 50)->index();
            $table->string('registCom', 50)->index();
            $table->string('agences', 50)->index();
            $table->string('categorieClient', 250)->index();
            $table->integer('avoirs');
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
        Schema::dropIfExists('clients');
    }
}
