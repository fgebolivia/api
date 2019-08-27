<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToRrhhPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rrhh_personas', function (Blueprint $table) {
            $table->integer('idioma_id')->unsigned()->nullable();
            $table->integer('pais_id')->unsigned()->nullable();
            $table->string('profesion_ocupacion')->nullable();
            $table->string('pueblo_originario')->nullable();
            $table->string('lugar_trabajo')->nullable();
            $table->string('domicilio_laboral')->nullable();
            $table->string('telf_laboral', 50)->nullable();
            $table->string('alias')->nullable();
            $table->double('estatura')->nullable();
            $table->string('tez')->nullable();
            $table->integer('edad')->nullable();
            $table->text('vestimenta')->nullable();
            $table->text('senia')->nullable();
            $table->double('peso')->nullable();
            $table->string('cabello')->nullable();
            $table->string('genero', 1)->nullable();
            $table->string('email')->unique();
            $table->foreign('idioma_id')
                ->references('id')
                ->on('conf_idioma')
                ->onDelete('cascade');
            $table->foreign('pais_id')
                ->references('id')
                ->on('ubge_pais')
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
        Schema::table('rrhh_personas', function (Blueprint $table) {
            $table->dropColumn('profesion_ocupacion');
            $table->dropColumn('pueblo_originario');
            $table->dropColumn('lugar_trabajo');
            $table->dropColumn('domicilio_laboral');
            $table->dropColumn('telf_laboral');
            $table->dropColumn('alias');
            $table->dropColumn('estatura');
            $table->dropColumn('tez');
            $table->dropColumn('edad');
            $table->dropColumn('vestimenta');
            $table->dropColumn('senia');
            $table->dropColumn('peso');
            $table->dropColumn('cabello');
        });
    }
}
