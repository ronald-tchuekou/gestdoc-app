<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{

    protected $connection = 'mysql2';
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('administrators', function (Blueprint $table) {
            $table->string('code');
            $table->string('deploy_code');
            $table->string('name');
            $table->string('surname');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->enum('sexe', ['F', 'M']);
            $table->primary('code');
            $table->foreign('deploy_code')->references('code')->on('deployements')->cascadeOnDelete();
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
        Schema::connection('mysql2')->dropIfExists('administrators');
    }
}
