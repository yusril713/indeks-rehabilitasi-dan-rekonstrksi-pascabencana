<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetTempat extends Model
{
    use HasFactory;
    protected $table = 'tb_kettempat';
    public const PAGINATE = 30;

    public function prov() {
        return $this->hasOne(Provinsi::class, 'id', 'provinsi');
    }

    public function kab() {
        return $this->hasOne(Kabupaten::class, 'id', 'kabupaten');
    }

    public function kec() {
        return $this->hasOne(Kecamatan::class, 'id', 'kecamatan');
    }

    public function kel() {
        return $this->hasOne(Kelurahan::class, 'id', 'kelurahan');
    }

    public function petugas_responden(){
        return $this->hasOne(Survei::class, 'keterangan_tempat_id', 'id');
    }

    /**
     * Get the user that owns the KetTempat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class, 'bencana_id', 'id');
    }
}
