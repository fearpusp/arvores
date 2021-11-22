<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnArvoreIdOcorrencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->unsignedBigInteger('arvore_id')->nullable();
            $table->foreign('arvore_id')->references('id')->on('arvores')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            //
        });
    }
}
