<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolHechoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pol_hecho', function(Blueprint $table){
            $table->increments('id');
            $table->smallInteger('estado')->default('1')->unsigned();
            $table->string('codigo', 250)->nullable();
            $table->text('relato')->nullable();
            $table->text('conducta')->nullable();
            $table->text('resultado')->nullable();
            $table->text('circunstancia')->nullable();
            $table->string('direccion')->nullable();
            $table->string('zona')->nullable();
            $table->string('detallelocacion')->nullable();
            $table->dateTime('fechahorainicio')->nullable();
            $table->dateTime('fechahorafin')->nullable();
            $table->string('aproximado')->nullable();
            $table->string('investigador', 255)->nullable();
            $table->string('latitude', 250)->nullable();
            $table->string('longitude', 250)->nullable();
            $table->integer('municipio_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('medida_proteccion_id')->unsigned()->nullable();
            $table->integer('division_id')->unsigned()->nullable();
            $table->integer('tipo_denuncia_id')->unsigned()->nullable();
            $table->integer('oficina_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('municipio_id')
                ->references('id')
                ->on('ubge_municipios')
                ->onDelete('cascade');
            $table->foreign('medida_proteccion_id')
                ->references('id')
                ->on('pol_medida_proteccion')
                ->onDelete('cascade');
            $table->foreign('division_id')
                ->references('id')
                ->on('pol_division')
                ->onDelete('cascade');
            $table->foreign('tipo_denuncia_id')
                ->references('id')
                ->on('pol_tipo_denuncia')
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
        Schema::dropIfExists('pol_hecho');
    }
}
