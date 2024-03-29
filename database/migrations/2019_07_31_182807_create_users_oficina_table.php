<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersOficinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_oficina', function(Blueprint $table){
            $table->increments('id');
            $table->smallInteger('estado')->default('1')->unsigned();
            $table->integer('persona_id')->unsigned()->nullable();
            $table->integer('oficina_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('persona_id')
                ->references('id')
                ->on('rrhh_personas')
                ->onDelete('cascade');
            $table->foreign('oficina_id')
                ->references('id')
                ->on('pol_oficina')
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
        Schema::dropIfExists('persona_oficina');
    }
}
