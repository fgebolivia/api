<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHechoJuzgado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pol_hecho_juzgado', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('hecho_id')->nullable();
            $table->integer('juzgado_id')->nullable();
            $table->smallInteger('estado')->default('1')->unsigned()->comment('1 el caso esta en ese juzgado, 0 el caso ya no se encuentra en ese juzgado');
            $table->string('motivo')->nullable();
            $table->dateTime('fecha_alta')->nullable();
            $table->dateTime('fecha_baja')->nullable();

            $table->timestamps();
            $table->foreign('hecho_id')
                ->references('id')
                ->on('pol_hecho')
                ->onDelete('cascade');
            $table->foreign('juzgado_id')
                ->references('id')
                ->on('age_juzgados')
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
        Schema::dropIfExists('pol_hecho_juzgado');
    }
}
