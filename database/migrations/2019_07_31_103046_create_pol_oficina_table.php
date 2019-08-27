<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolOficinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pol_oficina', function(Blueprint $table){
            $table->increments('id');
            $table->integer('municipio_id')->unsigned()->nullable();
            $table->integer('institucion_id')->unsigned()->nullable();
            $table->smallInteger('estado')->default('1')->unsigned();
            $table->string('codigo',50)->nullable();
            $table->string('nombre', 250)->nullable();
            $table->string('latitude', 250)->nullable();
            $table->string('longitude', 250)->nullable();
            $table->timestamps();
            $table->foreign('municipio_id')
                ->references('id')
                ->on('ubge_municipios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pol_oficina');
    }
}
