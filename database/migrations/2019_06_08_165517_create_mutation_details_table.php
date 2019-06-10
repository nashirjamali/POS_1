<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutation_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mutation_id')->unsigned();
            $table->foreign('mutation_id')->references('id')->on('mutations')->onDelete('cascade');
            $table->string('product_item_code')->index();
            $table->foreign('product_item_code')->references('code')->on('product_items')->onDelete('cascade');
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
        Schema::dropIfExists('mutation_details');
    }
}
