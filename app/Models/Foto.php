<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $table = 'tb_foto_bencana';

    public function bencana() {
        return $this->belongsTo(Bencana::class, 'id_bencana', 'id');
    }
}
