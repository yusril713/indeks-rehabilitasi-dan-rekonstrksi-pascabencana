<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table = 'tb_kelurahan';

    public function kec() {
        return $this->belongsTo(Kabupaten::class, 'id_kec', 'id');
    }
}
