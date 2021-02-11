<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTerminerToAssignesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assignes', function (Blueprint $table) {
            $table->integer('terminer')->default(0)->comment('Perment de savoir si le user à deja terminé sa tache.');
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
