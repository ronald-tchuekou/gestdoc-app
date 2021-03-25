<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeployementsTable extends Migration
{

    protected $connection = 'mysql2';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('deployements', function (Blueprint $table) {
            $table->string('code')->uniqid();
            $table->string('location')->nullable();
            $table->text('licence');
            $table->timestamp('date_end');
            $table->float('pay_plan');
            $table->primary('code');
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
        Schema::connection('mysql2')->dropIfExists('deployements');
    }
}
