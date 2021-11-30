<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    use HasFactory;
    protected $table = 'tb_bencana';
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

    public function foto() {
        return $this->hasMany(Foto::class, 'id_bencana', 'id');
    }

}
