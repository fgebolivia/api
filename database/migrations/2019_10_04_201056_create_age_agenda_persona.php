<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeAgendaPersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_agenda_persona', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agenda_id')->nullable();
            $table->integer('persona_id')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();
            $table->foreign('agenda_id')
                ->references('id')
                ->on('age_agendas')
                ->onDelete('cascade');
            $table->foreign('persona_id')
                ->references('id')
                ->on('rrhh_personas')
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
        Schema::dropIfExists('age_agenda_persona');
    }
}
