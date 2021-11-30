<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InaPdri;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\KetTempat;
use App\Models\PemulihanSektor;
use App\Models\Survei;
use App\Models\SurveiDetail;
use App\Models\User;
use App\Models\JenisSektor;
use Illuminate\Http\Request;


class ProcessController extends Controller
{
    public function index() {
        return view('admin.proses.index', [
            'provinsi' => Provinsi::orderBy('nama')->get()
        ]);
    }

    public function getKabupaten($id) {
        $role = User::with('roles')->find(\Auth::user()->id);

        // $data = '';
        if ($role->roles[0]->name == 'Level 3') {
            $data = KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('provinsi', $id)->where('status', 'success')->get();
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('provinsi', $id)->where('status', 'success')->get();
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('provinsi', $id)->where('status', 'success')->where('user_id', \Auth::user()->id)->get();
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data = KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('provinsi', $id)->where('status', 'success')->get();
        }

        return response()->json([
            'kab' => Kabupaten::where('id_prov', $id)->orderBy('nama')->get(),
            'ket_tempat' => $data
        ]);
    }

    public function getKecamatan($id) {
        $role = User::with('roles')->find(\Auth::user()->id);
        if ($role->roles[0]->name == 'Level 3') {
            $data = KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('kabupaten', $id)->where('status', 'success')->get();
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('kabupaten', $id)->where('status', 'success')->get();
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('kabupaten', $id)->where('status', 'success')->where('user_id', \Auth::user()->id)->get();
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data = KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('kabupaten', $id)->where('status', 'success')->get();
        }

        return response()->json([
            'kec' => Kecamatan::where('id_kab', $id)->orderBy('nama')->get(),
            'ket_tempat' => $data
        ]);
    }

    public function find($id) {
        $role = User::with('roles')->find(\Auth::user()->id);
        if ($role->roles[0]->name == 'Level 3') {
            $data = KetTempat::with('kab', 'kec', 'kec', 'petugas_responden')->where('kecamatan', $id)->where('status', 'success')->get();
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = KetTempat::with('kab', 'kec', 'kec', 'petugas_responden')->where('kecamatan', $id)->where('status', 'success')->get();
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = KetTempat::with('kab', 'kec', 'kec', 'petugas_responden')->where('kecamatan', $id)->where('status', 'success')->where('user_id', \Auth::user()->id)->get();
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data = KetTempat::with('kab', 'kec', 'kec', 'petugas_responden')->where('kecamatan', $id)->where('status', 'success')->get();
        }
        return response()->json(['ket_tempat' => $data]);
    }

    public function calculate($id) {
        // $survei = Survei::with('keterangan_tempat')->where('keterangan_tempat_id', $id)->first();
        // $detail = SurveiDetail::where('survei_id', $survei->id)->orderBy('kuesioner_id', 'asc')->orderBy('tahun', 'asc')->get();
        // $key = array();
        // $data = array();
        // $col = 0;
        // foreach ($detail->groupBy('kuesioner_id') as $item) {
        //     $row = 0;
        //     $key[$col] = $item[0]->kuesioner_id;
        //     foreach($item as $i) {
        //         // echo $i->tahun . ', ';
        //         $data[$col][$row] = $i->nilai;
        //         $row++;
        //     } 
        //     $col++;
        // }

        // $result = array();
        // $inaPdri = array();

        // $kuesioner = PemulihanSektor::with('sektor')->find($key);
        // $t = array();
        // for ($i = 0; $i < sizeof($data); $i++) {
        //     $tMin = $data[$i][0];
        //     for($j = 0; $j < sizeof($data[$i]); $j++) {
        //         $result[$i][$j] = ($data[$i][$j] / $tMin) * 100;
        //         $t[$i][$j] = $tMin;
        //         $tMin = $data[$i][$j];
        //     }
        //     $inaPdri[] = ['sektor'=> $kuesioner[$i]->sektor->jenis , 
        //         'pertanyaan' => $kuesioner[$i]->pertanyaan , 
        //         'hasil' =>$result[$i],
        //         't_min' => $t[$i],
        //         'data_awal' => $data[$i]
        //     ];
        // }

        // $nilai = array();
        // $dim = 0;
        // foreach($this->grouping($inaPdri) as $item) {
        //     $row = 0;
        //     foreach($item as $i) {
        //         $col = 0;
        //         foreach($i['hasil'] as $j) {
        //             $nilai[$dim][$row][$col++]= $j;
        //         }
        //         $row++;
        //     }
        //     $dim++;
        // }

        // $rata2 = array();
        // for($i = 0; $i < sizeof($nilai); $i++) {
        //     for ($k = 0; $k < sizeof($nilai[$i][0]); $k++) {
        //         $temp = 0;
        //         for ($j = 0; $j < sizeof($nilai[$i]); $j++) {
        //             $temp += $nilai[$i][$j][$k];
        //             // return $nilai[$i][$j][3];
        //         }  
        //         $rata2[$i][$k] = $temp / sizeof($nilai[$i]);   
        //     } 
        // }

        // $jenis_sektor = JenisSektor::orderBy('id', 'asc')->get();
        // $survei = Survei::with('keterangan_tempat')->find($survei->id);
        // $yearSurveiMin1 = $survei->keterangan_tempat->tahun_bencana - 1;
        // $currentYear = date('Y');
        // $tahun = array();
        // for ($i = $yearSurveiMin1; $i <= $currentYear; $i++) {
        //     $tahun[] = $i;
        // }
        // return view('admin.proses.hasil', ['detail' => $inaPdri, 'rata_rata' => $rata2, 'nilai' => $nilai, 'survei'=> $survei]);
        $survei = Survei::with('keterangan_tempat')->where('keterangan_tempat_id', $id)->first();
        $survei = Survei::with('keterangan_tempat.prov', 'keterangan_tempat.kab', 'keterangan_tempat.kec', 'keterangan_tempat.kel', 'petugas', 'ina_pdri')->find($survei->id);
        $count = InaPdri::distinct('tahun')->where('survei_id', $survei->id)->count('name');
        $distinct = InaPdri::distinct()->orderBy('tahun', 'asc')->where('survei_id', $survei->id)->get('tahun');
        $ina_pdri = InaPdri::with('jenis_sektor')->where('survei_id', $survei->id)->get();
        return view('admin.proses.hasil', [
            'survei' => $survei,
            'count' => $count,
            'tahun' => $distinct,
            'ina_pdri' => $ina_pdri
        ]);
    }

    public function getChart($id){
        $ina_pdri = InaPdri::with('jenis_sektor')->where('survei_id', $id)->get();
        return response()->json($ina_pdri);
    }

    public function grouping ($data) {
        $result = array();
        foreach ($data as $element) {
            $result[$element['sektor']][] = $element;
        }
        return $result;
    }
}
