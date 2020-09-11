<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ativo_id');
            $table->date('data');
            $table->decimal('open',12,4)->nullable();
            $table->decimal('low',12,4)->nullable();
            $table->decimal('high',12,4)->nullable();
            $table->decimal('close',12,4)->nullable();
            $table->decimal('adjusted_close',12,4)->nullable();
            $table->decimal('dividend_amount',12,4)->nullable();
            $table->unsignedBigInteger('volume')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('precos');
    }
}
