<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTbInaPdri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ina_pdri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_sektor_id')->constrained('tb_jenis_sektor')->onDelete('cascade');
            $table->foreignId('survei_id')->constrained('tb_survei')->onDelete('cascade');
            $table->string('tahun', 5);
            $table->double('ina_pdri');
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
        Schema::dropIfExists('tb_ina_pdri');
    }
}
