<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPetugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_petugas', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 100);
            $table->string('nama', 100);
            $table->string('no_hp', 20)->nullable();
            $table->string('alamat');
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->timestamps();
        });

        Schema::create('tb_keterangan_responden', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petugas_id')->constrained('tb_petugas')->onDelete('cascade');
            $table->date('tgl_survei');
            $table->date('tgl_periksa');
            $table->string('nama_responden');
            $table->string('no_hp', 20);
            $table->string('no_kk', 50);
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
        Schema::dropIfExists('tb_petugas');
    }
}
