<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArvoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arvores', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_unico')->unique();
            $table->string('nome_popular');
            $table->string('nome_cientifico')->nullable();
            $table->string('porte');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('patrimonio')->nullable();
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
        Schema::dropIfExists('arvores');
    }
}
