<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeArchivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_archivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('archivo',250)->nullable();
            $table->integer('agendamiento_id')->nullable();
            $table->integer('causal_suspencion_id')->nullable();
            $table->timestamps();
            $table->foreign('agendamiento_id')
                ->references('id')
                ->on('age_agendas')
                ->onDelete('cascade');
            $table->foreign('causal_suspencion_id')
                ->references('id')
                ->on('age_agenda_causal')
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
        Schema::dropIfExists('age_archivos');
    }
}
