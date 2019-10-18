<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeAgendaCausal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_agenda_causal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agenda_id')->nullable();
            $table->integer('tipo_causal_id')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();
            $table->foreign('agenda_id')
                ->references('id')
                ->on('age_agendas')
                ->onDelete('cascade');
            $table->foreign('tipo_causal_id')
                ->references('id')
                ->on('age_tipo_causales')
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
        Schema::dropIfExists('age_agenda_causal');
    }
}
