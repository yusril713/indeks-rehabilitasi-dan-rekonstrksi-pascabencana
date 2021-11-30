<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'tb_kecamatan';

    public function kab() {
        return $this->belongsTo(Kabupaten::class, 'id_kab', 'id');
    }

    public function kel() {
        return $this->hasMany(Kelurahan::class, 'id_kec', 'id');
    }
}
