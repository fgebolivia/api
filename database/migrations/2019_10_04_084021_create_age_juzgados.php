<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeJuzgados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_juzgados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('codigo_juzgado')->nullable();
            $table->string('nombre',250)->nullable();
            $table->integer('municipio_id')->nullable();
            $table->string('oficina_gestora')->nullable();
            $table->string('zona')->nullable();
            $table->string('direccion')->nullable();
            $table->string('map_latitud')->nullable();
            $table->string('map_longitud')->nullable();
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
        Schema::dropIfExists('age_juzgados');
    }
}
