<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    use HasFactory;
    protected $table = 'tb_survei';

    public function keterangan_tempat() {
        return $this->belongsTo(KetTempat::class, 'keterangan_tempat_id', 'id');
    }

    public static function isAvalailable($keterangan_tempat_id) {
        $cek = FALSE;
        $survei = self::where('keterangan_tempat_id', $keterangan_tempat_id)->first();
        if ($survei) {
            $cek = TRUE;
        }
        return $cek;
    }

    public function petugas() {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }

    public function detail() {
        return $this->hasMany(SurveiDetail::class, 'survei_id', 'id')->orderBy('kuesioner_id', 'asc')->orderBy('tahun', 'asc');
    }

    public function ina_pdri() {
        return $this->hasMany(InaPdri::class, 'survei_id', 'id')->orderBy('id', 'asc');
    }

    public function ina_pdri_kelurahan() {
        return $this->hasMany(InaPdri::class, 'survei_id', 'id')->orderBy('id', 'asc')->groupBy('jenis_sektor_id')->groupBy('tahun');
    }
}
