<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pol_archivo', function(Blueprint $table){
            $table->increments('id');
            $table->smallInteger('estado')->default('1')->unsigned();
            $table->string('archivo', 250)->nullable();
            $table->integer('hecho_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('hecho_id')
                ->references('id')
                ->on('pol_hecho')
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
        Schema::dropIfExists('pol_archivo');
    }
}
