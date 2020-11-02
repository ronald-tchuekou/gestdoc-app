<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockEnterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_enter_details', function (Blueprint $table) {
            $table->integer('enter_id')->index()->unsigned();
            $table->integer('product_id')->index()->unsigned();
            $table->integer('mag_des_id')->index()->unsigned();
            $table->date('exp_date');
            $table->integer('qte_enter');
            $table->float('sal_prise');
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
        Schema::dropIfExists('stock_enter_details');
    }
}
