<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->bigInteger('source_id')->unsigned();
            $table->foreign('source_id')->references('id')->on('shops')->onDelete('cascade');
            $table->bigInteger('destination_id')->unsigned();
            $table->foreign('destination_id')->references('id')->on('shops')->onDelete('cascade');
            $table->integer('total_item');
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
        Schema::dropIfExists('mutations');
    }
}
