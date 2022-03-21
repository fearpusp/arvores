<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableComentariosFotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios_fotos', function (Blueprint $table) {
            $table->id();
            $table->string('original_name');
            $table->string('path');
            $table->unsignedBigInteger('comentario_id')->nullable();
            $table->foreign('comentario_id')->references('id')->on('comentarios')->onDelete('set null');
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
        Schema::dropIfExists('comentarios_fotos');
    }
}
