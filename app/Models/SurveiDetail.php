<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveiDetail extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_survei';

    public function pemulihan_sektor() {
        return $this->belongsTo(PemulihanSektor::class, 'kuesioner_id', 'id')->orderBy('sektor_id', 'asc');
    }

    public static function isAvailable($survei_id, $kuesioner_id, $tahun) {
        $detail = self::where('survei_id', $survei_id)
            ->where('kuesioner_id', $kuesioner_id)
            ->where('tahun', $tahun)->get()->first();
        if ($detail) {
            return TRUE;
        }
        return FALSE;
    }
}
