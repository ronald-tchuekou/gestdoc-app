<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->integer('categorie_id')->index();
            $table->integer('service_id')->index();
            $table->integer('personne_id')->index();
            $table->string('objet');
            $table->string('prestataire');
            $table->timestamp('dateEnregistrement')->index();
            $table->string('tache')->nullable();
            $table->string('recommandation')->nullable();
            $table->text('observation')->nullable();
            $table->dateTime('dateValidation')->nullable();
            $table->integer('nbPiece');
            $table->enum('etat', ['Initial','Assigné','Traitement','Traité','Validé','Rejeté', 'Modifié', 'Reprendre'])
                ->default('Initial')
                ->index();
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
        Schema::dropIfExists('couriers');
    }
}
