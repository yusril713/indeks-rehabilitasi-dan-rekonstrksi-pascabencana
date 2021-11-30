<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemulihanSektor extends Model
{
    use HasFactory;
    protected $table = 'tb_pemulihan_sektor';

    public function sektor() {
        return $this->belongsTo(Sektor::class, 'sektor_id', 'id');
    }
}
