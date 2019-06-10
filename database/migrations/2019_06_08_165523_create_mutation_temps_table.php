<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutationTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutation_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mutation_id');
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
        Schema::dropIfExists('mutation_temps');
    }
}
