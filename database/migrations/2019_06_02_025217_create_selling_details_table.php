<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('selling_code')->index();
            $table->foreign('selling_code')->references('code')->on('sellings');
            $table->string('product_item_code')->index();
            $table->foreign('product_item_code')->references('code')->on('product_items');
            $table->integer('qty');
            $table->integer('sub_total');
            $table->integer('discount');
            $table->integer('total');
            $table->integer('profit');
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
        Schema::dropIfExists('selling_details');
    }
}
