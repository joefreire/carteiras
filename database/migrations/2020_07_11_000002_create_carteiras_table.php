<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteirasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteiras', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corretora_id');
            $table->string('ativo');
            $table->unsignedTinyInteger('mes');
            $table->unsignedInteger('ano');
            $table->decimal('variacao_mensal', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('corretora_id')->references('id')->on('corretoras')->onUpdate('cascade');
            $table->foreign('ativo')->references('ticker')->on('empresas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corretoras');
    }
}
