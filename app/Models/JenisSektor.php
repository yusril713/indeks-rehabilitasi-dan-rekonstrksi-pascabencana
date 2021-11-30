<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSektor extends Model
{
    use HasFactory;
    protected $table='tb_jenis_sektor';
    public function sektor() {
        return $this->hasMany(Sektor::class, 'jenis', 'id');
    }
}
