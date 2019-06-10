<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->bigInteger('shop_id')->unsigned();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->string('product_item_code')->index();
            $table->foreign('product_item_code')->references('code')->on('product_items')->onDelete('cascade');
            $table->string('detail');
            $table->integer('qty');
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
        Schema::dropIfExists('stock_outs');
    }
}
