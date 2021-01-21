<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->string('codeEmploye', 50)->primary();
            $table->string('nomComplet', 100);
            $table->string('adresse', 255);
            $table->string('telephone', 50);
            $table->string('cni', 50);
            $table->string('autreContact', 255);
            $table->string('emailemp', 250);
            $table->string('sonAgence', 50)->index();
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
        Schema::dropIfExists('employes');
    }
}
