<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolHechopersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pol_hechopersona', function(Blueprint $table){
            $table->increments('id');
            $table->integer('hecho_id')->unsigned()->nullable();
            $table->integer('persona_id')->unsigned()->nullable();
            $table->integer('persona_juridica_id')->unsigned()->nullable();
            $table->integer('persona_desconocida_id')->unsigned()->nullable();
            $table->integer('relacion_victima_id')->unsigned()->nullable();
            $table->integer('nivel_educacion_id')->unsigned()->nullable();
            $table->integer('grupo_vulnerable_id')->unsigned()->nullable();
            $table->integer('grado_discapacidad_id')->unsigned()->nullable();
            $table->integer('tipo_sujeto_id')->unsigned()->nullable();
            $table->smallInteger('fallecida')->unsigned()->nullable();
            $table->smallInteger('estado_procesal')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('hecho_id')
                ->references('id')
                ->on('pol_hecho')
                ->onDelete('cascade');
            $table->foreign('persona_id')
                ->references('id')
                ->on('rrhh_personas')
                ->onDelete('cascade');
            $table->foreign('persona_juridica_id')
                ->references('id')
                ->on('rrhh_persona_juridica')
                ->onDelete('cascade');
            $table->foreign('persona_desconocida_id')
                ->references('id')
                ->on('rrhh_persona_desconocida')
                ->onDelete('cascade');
            $table->foreign('relacion_victima_id')
                ->references('id')
                ->on('pol_relacion_victima')
                ->onDelete('cascade');
            $table->foreign('nivel_educacion_id')
                ->references('id')
                ->on('pol_nivel_educacion')
                ->onDelete('cascade');
            $table->foreign('grupo_vulnerable_id')
                ->references('id')
                ->on('pol_grupo_vulnerable')
                ->onDelete('cascade');
            $table->foreign('grado_discapacidad_id')
                ->references('id')
                ->on('pol_grado_discapacidad')
                ->onDelete('cascade');
            $table->foreign('tipo_sujeto_id')
                ->references('id')
                ->on('pol_tipo_sujeto')
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
        Schema::dropIfExists('pol_hechopersona');
    }
}