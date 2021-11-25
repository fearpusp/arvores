<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEspecieIdTableArvores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arvores', function (Blueprint $table) {
            $table->unsignedBigInteger('especie_id')->nullable();
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('arvores', function (Blueprint $table) {
            //
        });
    }
}
