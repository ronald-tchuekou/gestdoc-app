<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnes', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->enum('sexe', ['Masculin', 'Feminin'])->default('Masculin');
            $table->string('email', 255)->nullable();
            $table->string('telephone', 20);
            $table->string('cni', 20);
            $table->string('localisation', 255)->nullable();
            $table->enum('status', ['Marié', 'Célibataire'])->default('Célibataire');
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
        Schema::dropIfExists('personnes');
    }
}
