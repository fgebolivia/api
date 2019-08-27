<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSigcNotificacionesAbogadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('sigc_notificaciones_abogados', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tipo_notificacion_id')->unsigned()->nullable(); // NOTIFICACION ELECTRONICA
            $table->integer('estado_notificacion_id')->unsigned()->nullable(); // NOTIFICAR, NOTIFICADA

            $table->integer('notificacion_id')->unsigned();
            $table->integer('persona_id')->unsigned();
            $table->integer('municipio_id')->unsigned();
            $table->string('zona', 200)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('map_latitud', 255)->nullable();
            $table->string('map_longitud', 255)->nullable();

            $table->timestamps();

            $table->foreign('notificacion_id')
                ->references('id')
                ->on('sigc_notificaciones')
                ->onDelete('cascade');

            $table->foreign('tipo_notificacion_id')
                ->references('id')
                ->on('sigc_tipos_notificaciones')
                ->onDelete('cascade');

            $table->foreign('estado_notificacion_id')
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
        Schema::dropIfExists('sigc_notificaciones_abogados');
    }
}
