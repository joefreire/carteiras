<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpcaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipca', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('mes');
            $table->unsignedInteger('ano');
            $table->decimal('retorno_mensal', 8, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ipca');
    }
}
