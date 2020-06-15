<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo')->unique();
            $table->integer('numero')->unique();
            $table->string('marca');
            $table->string('modelo');
            $table->string('sector');
            $table->string('imagen')->nullable();
            $table->float('latitud',10,6)->nullable();
            $table->float('longitud',10,6)->nullable();
            $table->Integer('persona_id')->nullable();;
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
        Schema::dropIfExists('medidors');
    }
}
