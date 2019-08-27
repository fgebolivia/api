<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolTipoSujetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pol_tipo_sujeto', function(Blueprint $table){
            $table->increments('id');
            $table->smallInteger('estado')->default('1')->unsigned();
            $table->string('nombre', 250)->nullable();
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
        Schema::dropIfExists('pol_tipo_sujeto');
    }
}
