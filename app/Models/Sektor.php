<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    use HasFactory;
    protected $table = 'tb_sektor';
    public function pemulihan_sektor() {
        return $this->hasMany(PemulihanSektor::class, 'sektor_id', 'id');
    }

    public function jenis_sektor() {
        return $this->belongsTo(JenisSektor::class, 'jenis', 'id');
    }
}
