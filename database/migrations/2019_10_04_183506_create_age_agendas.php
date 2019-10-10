<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeAgendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_agendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('codigo_audiencia')->nullable();
            $table->dateTime('fecha_hora_inicio')->nullable();
            $table->dateTime('fecha_hora_fin')->nullable();
            $table->string('sala')->nullable();
            $table->integer('hecho_id')->nullable();
            $table->integer('tipo_audiencia_id')->nullable();
            $table->integer('juzgado_id')->nullable();
            $table->timestamps();
            $table->foreign('hecho_id')
                ->references('id')
                ->on('pol_hecho')
                ->onDelete('cascade');
            $table->foreign('tipo_audiencia_id')
                ->references('id')
                ->on('age_tipo_audiencias')
                ->onDelete('cascade');
            $table->foreign('juzgado_id')
                ->references('id')
                ->on('age_juzgados')
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
        Schema::dropIfExists('age_agendas');
    }
}
