<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->float('anterior',8,2);
            $table->float('actual',8,2);
            $table->float('consumo',8,2);
            $table->float('basico',8,2);
            $table->float('exceso',8,2);
            $table->text('observacion')->nullable();
            $table->text('imagen')->nullable();
            $table->float('latitud',10,6)->nullable();
            $table->float('longitud',10,6)->nullable();
            $table->string('estado');
            $table->Integer('medidor_id');
            $table->Integer('user_id');
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
        Schema::dropIfExists('lecturas');
    }
}
