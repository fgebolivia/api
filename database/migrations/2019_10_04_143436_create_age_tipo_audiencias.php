<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeTipoAudiencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_tipo_audiencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('codigo_audiencia')->nullable();
            $table->string('nombre',250)->nullable();
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
        Schema::dropIfExists('age_tipo_audiencias');
    }
}
