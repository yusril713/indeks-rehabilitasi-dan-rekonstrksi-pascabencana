<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InaPdri extends Model
{
    use HasFactory;
    protected $table = 'tb_ina_pdri';

    public static function isAvailable($survei_id) {
        $ina_pdri = self::where('survei_id', $survei_id)
            ->first();
        if ($ina_pdri)
            return TRUE;
        return FALSE;
    }

    public function jenis_sektor() {
        return $this->belongsTo(JenisSektor::class, 'jenis_sektor_id', 'id');
    }
}
