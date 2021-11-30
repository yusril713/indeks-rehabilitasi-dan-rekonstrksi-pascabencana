<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InaPdri;
use App\Models\JenisSektor;
use App\Models\KetTempat;
use App\Models\PemulihanSektor;
use App\Models\Sektor;
use App\Models\Survei;
use App\Models\SurveiDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SurveiController extends Controller
{
    public function SektorPemukiman($id, $sektor_id) {
        return view('admin.sektor.pemukiman', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(Crypt::decrypt($sektor_id)),
            'survei' => Survei::with('keterangan_tempat')->findOrFail(Crypt::decrypt($id)),
            'detail_survei' => SurveiDetail::where('survei_id', Crypt::decrypt($id))->get()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'nilai' => 'required|numeric|min:1|max:4'
        ]);
        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        if (SurveiDetail::isAvailable($request->survei_id, $request->kuesioner_id, $request->tahun)) {
            if ($request->nilai == '') {
                SurveiDetail::where('survei_id', $request->survei_id)
                    ->where('kuesioner_id', $request->kuesioner_id)
                    ->where('tahun', $request->tahun)->first()->delete();
            } else {
                $detail = SurveiDetail::where('survei_id', $request->survei_id)
                    ->where('kuesioner_id', $request->kuesioner_id)
                    ->where('tahun', $request->tahun)->first();
                $detail->nilai = $request->nilai;
                $detail->save();
            }          
        } else {
            $detail = new SurveiDetail();
            $detail->survei_id = $request->survei_id;
            $detail->kuesioner_id = $request->kuesioner_id;
            $detail->tahun = $request->tahun;
            $detail->nilai = $request->nilai;
            $detail->save();
        }
        return response()->json($response);
    }

    public function SektorInfrastruktur($survei_id, $sektor_id) {
        return view('admin.sektor.infrastruktur', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(Crypt::decrypt($sektor_id)),
            'survei' => Survei::with('keterangan_tempat')->findOrFail(Crypt::decrypt($survei_id)),
            'detail_survei' => SurveiDetail::where('survei_id', Crypt::decrypt($survei_id))->get()
        ]);
    }

    public function SektorSosial($survei_id, $sektor_id) {
        return view('admin.sektor.sosial', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(Crypt::decrypt($sektor_id)),
            'survei' => Survei::with('keterangan_tempat')->findOrFail(Crypt::decrypt($survei_id)),
            'detail_survei' => SurveiDetail::where('survei_id', Crypt::decrypt($survei_id))->get()
        ]);
    }

    public function SektorEkonomi($survei_id, $sektor_id) {
        return view('admin.sektor.ekonomi', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(Crypt::decrypt($sektor_id)),
            'survei' => Survei::with('keterangan_tempat')->findOrFail(Crypt::decrypt($survei_id)),
            'detail_survei' => SurveiDetail::where('survei_id', Crypt::decrypt($survei_id))->get()
        ]);
    }

    public function LintasSektor($survei_id, $sektor_id) {
        return view('admin.sektor.lintas', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(Crypt::decrypt($sektor_id)),
            'survei' => Survei::with('keterangan_tempat')->findOrFail(Crypt::decrypt($survei_id)),
            'detail_survei' => SurveiDetail::where('survei_id', Crypt::decrypt($survei_id))->get()
        ]);
    }

    public function CalculateInaPdri($survei_id) {
        $detail = SurveiDetail::where('survei_id', Crypt::decrypt($survei_id))->orderBy('kuesioner_id', 'asc')->orderBy('tahun', 'asc')->get();
        // return $detail->groupBy('kuesioner_id')[1][2]->tahun;
        $key = array();
        $data = array();
        $col = 0;
        foreach ($detail->groupBy('kuesioner_id') as $item) {
            $row = 0;
            $key[$col] = $item[0]->kuesioner_id;
            foreach($item as $i) {
                // echo $i->tahun . ', ';
                $data[$col][$row] = $i->nilai;
                $row++;
            } 
            $col++;
        }

        $result = array();
        $inaPdri = array();

        $kuesioner = PemulihanSektor::with('sektor')->find($key);

        for ($i = 0; $i < sizeof($data); $i++) {
            $tMin = $data[$i][0];
            for($j = 0; $j < sizeof($data[$i]); $j++) {
                if($tMin == 0 or $tMin == 0.00)
                    $result[$i][$j] = 0.00;
                else
                    $result[$i][$j] = ($data[$i][$j] / $tMin) * 100;
                // $tMin = $data[$i][$j];
            }
            $inaPdri[] = ['sektor'=> $kuesioner[$i]->sektor->jenis , 'pertanyaan' => $kuesioner[$i]->pertanyaan , 'hasil' =>$result[$i]];
        }
        
        $nilai = array();
        $dim = 0;
        foreach($this->grouping($inaPdri) as $item) {
            $row = 0;
            foreach($item as $i) {
                $col = 0;
                foreach($i['hasil'] as $j) {
                    $nilai[$dim][$row][$col++]= $j;
                }
                $row++;
            }
            $dim++;
        }

        $rata2 = array();
        for($i = 0; $i < sizeof($nilai); $i++) {
            for ($k = 0; $k < sizeof($nilai[$i][0]); $k++) {
                $temp = 0;
                for ($j = 0; $j < sizeof($nilai[$i]); $j++) {
                    $temp += $nilai[$i][$j][$k];
                    // return $nilai[$i][$j][3];
                }  
                $rata2[$i][$k] = $temp / sizeof($nilai[$i]);   
            } 
        }

        $jenis_sektor = JenisSektor::orderBy('id', 'asc')->get();
        $survei = Survei::with('keterangan_tempat')->find(Crypt::decrypt($survei_id));
        $yearSurveiMin1 = $survei->keterangan_tempat->tahun_bencana - 1;
        $currentYear = date('Y');
        $tahun = array();
        for ($i = $yearSurveiMin1; $i <= $currentYear; $i++) {
            $tahun[] = $i;
        }

        if (InaPdri::isAvailable($survei->id)) {
            $ina = InaPdri::where('survei_id', $survei->id)->get();
            foreach($ina as $i) {
                InaPdri::find($i->id)->delete();
            }
        }

        for($i = 0; $i < sizeof($rata2); $i++) {
            for($j = 0; $j < sizeof($rata2[$i]); $j++) {
                $ina = new InaPdri();
                $ina->jenis_sektor_id = $jenis_sektor[$i]->id;
                $ina->survei_id = $survei->id;
                $ina->tahun = $tahun[$j];
                $ina->ina_pdri = $rata2[$i][$j];
                $ina->save();
            }
        }

        return redirect()->route('ina-pdri', [Crypt::encrypt($survei->id)]);
        // return $data;
    } 

    public function grouping ($data) {
        $result = array();
        foreach ($data as $element) {
            $result[$element['sektor']][] = $element;
        }
        return $result;
    }

    public function StoreSektor(Request $request, $survei_id, $sektor_id, $sektor_name) {
        $request->validate([
            'nilai.*' => 'required|min:1|max:4',
        ]);

        // for ($i= 0; $i < sizeof($request->survei_id); $i++) {
        //     if (SurveiDetail::isAvailable($request->survei_id[$i], $request->kuesioner_id[$i], $request->tahun[$i])) {
        //         if ($request->nilai == '') {
        //             SurveiDetail::where('survei_id', $request->survei_id[$i])
        //                 ->where('kuesioner_id', $request->kuesioner_id[$i])
        //                 ->where('tahun', $request->tahun[$i])->first()->delete();
        //         } else {
        //             $detail = SurveiDetail::where('survei_id', $request->survei_id[$i])
        //                 ->where('kuesioner_id', $request->kuesioner_id[$i])
        //                 ->where('tahun', $request->tahun[$i])->first();
        //             $detail->nilai = $request->nilai[$i];
        //             $detail->save();
        //         }          
        //     } else {
        //         $detail = new SurveiDetail();
        //         $detail->survei_id = $request->survei_id[$i];
        //         $detail->kuesioner_id = $request->kuesioner_id[$i];
        //         $detail->tahun = $request->tahun[$i];
        //         $detail->nilai = $request->nilai[$i];
        //         $detail->save();
        //     }
        // }
        return redirect()->route('survei.' . $sektor_name,  [$survei_id, $sektor_id]);
    }

    public function InaPdri($survei_id) {
        $survei = Survei::with('keterangan_tempat.prov', 'keterangan_tempat.kab', 'keterangan_tempat.kec', 'keterangan_tempat.kel', 'petugas', 'ina_pdri')->find(Crypt::decrypt($survei_id));
        $count = InaPdri::distinct('tahun')->where('survei_id', Crypt::decrypt($survei_id))->count('name');
        $distinct = InaPdri::distinct()->orderBy('tahun', 'asc')->where('survei_id', Crypt::decrypt($survei_id))->get('tahun');
        $ina_pdri = InaPdri::with('jenis_sektor')->where('survei_id', Crypt::decrypt($survei_id))->get();

        $k = KetTempat::find($survei->keterangan_tempat->id);
        $k->status = 'success';
        $k->save();
        
        // return view('admin.sektor.ina-pdri', [
        //     'survei' => $survei,
        //     'count' => $count,
        //     'tahun' => $distinct,
        //     'ina_pdri' => $ina_pdri
        // ]);
        return redirect()->route('keterangan-tempat.index')->with('status', 'Data successfully created...');
    }

    public function readSektorPemukiman() {
        return view('admin.sektor.readonly.index', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(1)
        ]);
    }

    public function readSektorInfrastruktur() {
        return view('admin.sektor.readonly.index', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(2)
        ]);
    }

    public function readSektorEkonomi() {
        return view('admin.sektor.readonly.index', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(3)
        ]);
    }

    public function readSektorSosial() {
        return view('admin.sektor.readonly.index', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(4)
        ]);
    }

    public function readLintasSektor() {
        return view('admin.sektor.readonly.index', [
            'sektor' => JenisSektor::with('sektor.pemulihan_sektor')->find(5)
        ]);
    }
}
