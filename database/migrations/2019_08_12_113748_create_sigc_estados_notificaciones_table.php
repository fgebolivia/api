<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSigcEstadosNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('sigc_estados_notificaciones', function (Blueprint $table) {
            $table->increments('id');

            $table->smallInteger('estado')->default('1')->unsigned();
            $table->smallInteger('orden')->default('1')->unsigned();

            $table->string('nombre', 100);

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
        Schema::dropIfExists('sigc_estados_notificaciones');
    }
}
