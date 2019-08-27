<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSigcNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('sigc_notificaciones', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('hecho_id')->unsigned(); // Caso
            $table->integer('hecho_sujeto_id')->unsigned(); // Persona
            $table->integer('actividad_solicitante_id')->unsigned(); // Actividad
            $table->integer('actividad_notificacion_id')->unsigned()->nullable();
            $table->integer('funcionario_solicitante_id')->unsigned();
            $table->integer('funcionario_notificador_id')->unsigned()->nullable();
            $table->integer('funcionario_reparto_id')->unsigned()->nullable();
            $table->integer('tipo_notificacion_id')->unsigned()->nullable();
            $table->integer('estado_notificacion_id')->unsigned()->nullable();
            $table->integer('sujeto_situacion_id')->unsigned()->nullable();

            $table->smallInteger('estado')->default('1')->unsigned();
            $table->string('codigo', 20)->unique();

            $table->dateTime('solicitud_fh');
            $table->string('solicitud_asunto', 500)->nullable();

            $table->smallInteger('persona_natural_juridica')->default('1')->unsigned(); // 1 PERSONA NATURAL - 2 PERSONA JURIDICA
            $table->integer('persona_municipio_id')->unsigned()->nullable();
            $table->string('persona_zona', 200)->nullable();
            $table->string('persona_direccion', 200)->nullable();
            $table->string('persona_telefono', 20)->nullable();
            $table->string('persona_celular', 20)->nullable();
            $table->string('persona_email', 100)->nullable();
            $table->string('persona_map_latitud', 255)->nullable();
            $table->string('persona_map_longitud', 255)->nullable();

            $table->dateTime('notificacion_fh')->nullable();
            $table->smallInteger('notificacion_ciudadania_digital')->default('1')->unsigned(); // 1 NO - 2 SI
            $table->string('notificacion_observacion', 500)->nullable();
            $table->dateTime('notificacion_publicacion_fh')->nullable();
            $table->smallInteger('notificacion_publicacion_estado')->default('1')->unsigned(); // 1 SIN PUBLICAR - 2 PUBLICADO - 3 DESPUBLICADO INTERESADO - 4 DESPUBLICADO POR 5 AÑOS
            $table->smallInteger('notificacion_pdf_estado')->default('1')->unsigned(); // 1 NO - 2 SI
            $table->string('notificacion_pdf_nombre', 255)->nullable();
            $table->binary('notificacion_pdf')->nullable();
            $table->smallInteger('notificacion_abogado')->default('1')->unsigned(); // 1 NO - 2 SI

            $table->integer('testigo_persona')->unsigned()->nullable();

            $table->timestamps();

            $table->index('codigo', 'index_notificacion_codigo');

            $table->foreign('tipo_notificacion_id')
                ->references('id')
                ->on('sigc_tipos_notificaciones')
                ->onDelete('cascade');

            $table->foreign('estado_notificacion_id')
                ->references('id')
                ->on('sigc_estados_notificaciones')
                ->onDelete('cascade');

            $table->foreign('sujeto_situacion_id')
                ->references('id')
                ->on('sigc_estados_notificaciones')
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
        Schema::dropIfExists('sigc_notificaciones');
    }
}
