<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeHistorico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_historico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('age_agenda_persona_id')->nullable();
            $table->integer('user_id')->nullable()->comment('get con CI');
            $table->string('user_ip')->nullable();
            $table->string('user_os')->nullable()->comment('Operating System Name');
            $table->string('user_browser')->nullable();
            $table->string('user_device')->nullable()->comment('Mobile,Tablet,Computer');
            $table->string('user_imei')->nullable()->comment('if null is browser');
            $table->string('reg_id')->nullable()->comment('if null is browser');
            $table->timestamps();
            $table->foreign('age_agenda_persona_id')
                ->references('id')
                ->on('age_agenda_persona')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('age_historico');
    }
}
