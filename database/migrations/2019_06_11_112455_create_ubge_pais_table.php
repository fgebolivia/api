<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbgePaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubge_pais', function(Blueprint $table){
            $table->increments('id');
            $table->smallInteger('estado')->default('1')->unsigned();
            $table->string('nombre')->nullable();
            $table->string('codigo_2', 2)->nullable();
            $table->string('codigo_3', 3)->nullable();
            $table->string('cod_telf',10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubge_pais');
    }
}
