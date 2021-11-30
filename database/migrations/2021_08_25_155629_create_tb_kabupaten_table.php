<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKabupatenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kabupaten', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_prov')->unsigned();
            $table->string('nama')->nullable();
            $table->timestamps();
        });

        Schema::table('tb_kabupaten', function (Blueprint $table) {
            $table->foreign('id_prov')->references('id')->on('tb_provinsi')
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
        Schema::dropIfExists('tb_kabupaten');
    }
}
