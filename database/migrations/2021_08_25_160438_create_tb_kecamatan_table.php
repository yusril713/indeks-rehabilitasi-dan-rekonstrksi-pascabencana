<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kab')->unsigned();
            $table->string('nama')->nullable();
            $table->timestamps();
        });

        Schema::table('tb_kecamatan', function (Blueprint $table) {
            $table->foreign('id_kab')->references('id')->on('tb_kabupaten')
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
        Schema::dropIfExists('tb_kecamatan');
    }
}
