<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->index();
            $table->date('date');
            $table->time('time');
            $table->bigInteger('chasier_id')->unsigned();
            $table->foreign('chasier_id')->references('id')->on('employees');
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('sub_total');
            $table->integer('discount');
            $table->integer('grand_total');
            $table->integer('cash');
            $table->integer('change');
            $table->string('note')->nullable();
            $table->integer('profit_total');
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
        Schema::dropIfExists('sellings');
    }
}
