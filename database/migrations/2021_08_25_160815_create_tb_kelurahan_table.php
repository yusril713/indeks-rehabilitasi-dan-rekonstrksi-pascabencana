<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kec')->unsigned();
            $table->string('nama')->nullable();
            $table->timestamps();
        });

        Schema::table('tb_kelurahan', function (Blueprint $table) {
            $table->foreign('id_kec')->references('id')->on('tb_kecamatan')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kelurahan');
    }
}
