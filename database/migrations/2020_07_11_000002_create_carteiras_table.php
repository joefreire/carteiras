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
            $table->unsignedInteger('ativo_id');
            $table->unsignedTinyInteger('mes');
            $table->unsignedInteger('ano');
            $table->decimal('valor_mensal', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('corretora_id')->references('id')->on('corretoras')->onUpdate('cascade');
            $table->foreign('ativo_id')->references('id')->on('empresas')->onUpdate('cascade');
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
