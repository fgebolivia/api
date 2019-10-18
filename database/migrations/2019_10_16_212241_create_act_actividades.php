<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('codigo_actividad')->nullable();
            $table->integer('tipo_actividad_id')->nullable();
            $table->dateTime('fecha_actividad')->nullable();
            $table->string('descripcion_actividad')->nullable();
            $table->string('nombre_archivo')->nullable();
            $table->integer('hecho_id')->nullable();
            $table->timestamps();
            $table->foreign('hecho_id')
                ->references('id')
                ->on('pol_hecho')
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
        Schema::dropIfExists('act_actividades');
    }
}
