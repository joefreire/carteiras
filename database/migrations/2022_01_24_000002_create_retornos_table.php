<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetornosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retornos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corretora_id');
            $table->unsignedTinyInteger('mes');
            $table->unsignedInteger('ano');
            $table->decimal('retorno_mensal', 8, 4);
            $table->foreign('corretora_id')->references('id')->on('corretoras')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retornos');
    }
}
