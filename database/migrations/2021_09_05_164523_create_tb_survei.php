<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSurvei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_survei', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keterangan_tempat_id')->constrained('tb_kettempat')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('tb_petugas')->onDelete('cascade');
            $table->date('tgl_survei');
            $table->date('tgl_periksa');
            $table->string('nama_responden');
            $table->string('no_hp');
            $table->string('no_responden');
            $table->string('no_kk');
            $table->string('lokasi_asal');
            $table->timestamps();
        });

        Schema::create('tb_detail_survei', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('survei_id')->constrained('tb_survei')->onDelete('cascade');
            $table->foreignId('kuesioner_id')->constrained('tb_pemulihan_sektor')->onDelete('cascade');
            $table->string('tahun');
            $table->double('nilai');
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
        Schema::dropIfExists('tb_survei');
    }
}
