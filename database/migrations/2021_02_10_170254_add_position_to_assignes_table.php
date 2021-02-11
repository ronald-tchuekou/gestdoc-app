<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPositionToAssignesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assignes', function (Blueprint $table) {
            $table->integer('position')->default(0)->comment('0 pour une seule personne et à partir de 1 pour plusiuers personnes avec la position 1 pour la première.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignes', function (Blueprint $table) {
            //
        });
    }
}
