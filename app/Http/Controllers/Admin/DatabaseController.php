<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\InaPdri;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\KetTempat;
use App\Models\Provinsi;
use App\Models\Survei;
use App\Models\Bencana;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    // GROUP BY KELURAHAN
    public function mainKelurahan(){
        return view('admin.database.kelurahan', [
            'provinsi' => Provinsi::orderBy('nama')->get()
        ]);
    }

    public function getProvinsi() {
        return response()->json([
            'keterangan_tempat' => KetTempat::with('prov', 'kab', 'kec', 'kel')->where('status', 'success')->get()
        ]);
    }

    public function getResponden() {
        $role = User::with('roles')->find(\Auth::user()->id);

        // $data = '';
        if ($role->roles[0]->name == 'Level 3') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->get();
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->get();
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->where('user_id', \Auth::user()->id)->get();
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->get();
        }
        return response()->json([
            'keterangan_tempat' => $data
        ]);
    }

    public function getKabupaten($id) {
        return response()->json([
            'kab' => Kabupaten::where('id_prov', $id)->orderBy('nama')->get(),
            'keterangan_tempat' => KetTempat::with('kab', 'kec', 'kel')->where('status', 'success')->where('provinsi', $id)->get()
        ]);
    }

    public function getKecamatan($id) {
        return response()->json([
            'kec' => Kecamatan::where('id_kab', $id)->orderBy('nama')->get(),
            'keterangan_tempat' => KetTempat::with('kec', 'kel')->where('status', 'success')->where('kabupaten', $id)->get()
        ]);
    }

    public function getKelurahan($id) {
        return response()->json(['kel' => Kelurahan::where('id_kec', $id)->orderBy('nama')->get(),
            'keterangan_tempat' => KetTempat::with('kel')->where('status', 'success')->where('kecamatan', $id)->get()->groupBy("kecamatan")
        ]);
    }

    public function getKelurahann($id) {
        return response()->json(['kel' => Kelurahan::where('id_kec', $id)->orderBy('nama')->get(),
            'keterangan_tempat' => KetTempat::with('kel')->where('status', 'success')->where('kecamatan', $id)->get()
        ]);
    }

    public function detailKelurahan($id) {

        $ket =  KetTempat::with('kel', 'petugas_responden', 'bencana.foto')->where('status', 'success')->where('kelurahan', $id)->get();
        $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $distinct[0]->tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        foreach($inaPdri as $i)
        {
            $categories[$i->jenis_sektor_id][] = $i;
        }

        // return ;
        return view('admin.database.detail-kelurahan', [
            'bencana' => Bencana::with('foto')->find($ket[0]->bencana_id),
            'kelurahan' => Kelurahan::find($id),
            'ina_pdri'=> $inaPdri,
            'tahun' => $distinct,
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
        // return $ket;
    }

    public function detailKelurahanAjax($id, $tahun) {

        $ket =  KetTempat::with('kel', 'petugas_responden')->where('status', 'success')->where('kelurahan', $id)->get();
        // $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        $inaPdriAll = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();
        return response()->json([
            'kelurahan' => Kelurahan::find($id),
            'ina_pdri'=> $inaPdri,
            'ina_pdri_all' => $inaPdriAll,
            'tahun' => $distinct,
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
        // return $distinct;
    }

    public function printKelurahan($id) {
        $ket =  KetTempat::with('kel', 'petugas_responden')->where('status', 'success')->where('kelurahan', $id)->get();
        $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $distinct[0]->tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();


        $pdf = PDF::loadView('admin.database.pdf.kelurahan',  [
            'kelurahan' => Kelurahan::find($id),
            'ina_pdri'=> $inaPdri,
            'tahun' => $distinct,
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('kelurahan.pdf');
    }


    // GROUP BY KECAMATAN
    public function mainKecamatan(){
        return view('admin.database.kecamatan', [
            'provinsi' => Provinsi::orderBy('nama')->get()
        ]);
    }

    public function detailKecamatan($id) {

        $ket =  KetTempat::with('kec', 'kel', 'petugas_responden')->where('status', 'success')->where('kecamatan', $id)->get();
        $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $distinct[0]->tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        foreach($inaPdri as $i)
        {
            $categories[$i->jenis_sektor_id][] = $i;
        }
        return view('admin.database.detail-kecamatan', [
            'kecamatan' => Kecamatan::find($id),
            'bencana' => Bencana::with('foto')->find($ket[0]->bencana_id),
            'ina_pdri'=> $inaPdri,
            'tahun' => $distinct,
            'jumlah_responden' => count($ket),
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
        // return $distinct;
    }

    public function detailKecamatanAjax($id, $tahun) {

        $ket =  KetTempat::with('kec', 'kel', 'petugas_responden')->where('status', 'success')->where('kecamatan', $id)->get();
        // $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        $inaPdriAll = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();
        return response()->json([
            'kecamatan' => Kecamatan::find($id),
            'ina_pdri'=> $inaPdri,
            'ina_pdri_all' => $inaPdriAll,
            'tahun' => $distinct,
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
        // return $distinct;
    }


    // GROUP NY KABUPATEN
    public function mainKabupaten(){
        return view('admin.database.kabupaten', [
            'provinsi' => Provinsi::orderBy('nama')->get()
        ]);
    }

    public function detailKabupaten($id) {

        $ket =  KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->where('kabupaten', $id)->get();
        $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $distinct[0]->tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        foreach($inaPdri as $i)
        {
            $categories[$i->jenis_sektor_id][] = $i;
        }
        return view('admin.database.detail-kabupaten', [
            'kabupaten' => Kabupaten::find($id),
            'bencana' => Bencana::with('foto')->find($ket[0]->bencana_id),
            'ina_pdri'=> $inaPdri,
            'tahun' => $distinct,
            'jumlah_responden' => count($ket),
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
    }

    public function detailKabupatenAjax($id, $tahun) {

        $ket =  KetTempat::with('kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->where('kabupaten', $id)->get();
        // $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        $inaPdriAll = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();
        return response()->json([
            'kabupaten' => Kabupaten::find($id),
            'ina_pdri'=> $inaPdri,
            'ina_pdri_all' => $inaPdriAll,
            'tahun' => $distinct,
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
        // return $distinct;
    }


    //GROUP BY PROVINSI
    public function mainProvinsi(){
        $data = KetTempat::with('prov', 'kab', 'kec', 'kel')->where('status', 'success')->paginate(20);
        return view('admin.database.provinsi', compact('data'));
    }

    public function fetchProvinsi() {
        $data = KetTempat::with('prov', 'kab', 'kec', 'kel')->where('status', 'success')->paginate(20);
        return view('admin.database.provinsi-child', compact('data'))->render();
    }

    public function detailProvinsi($id) {

        $ket =  KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->where('provinsi', $id)->get();
        $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $distinct[0]->tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        foreach($inaPdri as $i)
        {
            $categories[$i->jenis_sektor_id][] = $i;
        }
        return view('admin.database.detail-provinsi', [
            'provinsi' => Provinsi::find($id),
            'bencana' => Bencana::with('foto')->find($ket[0]->bencana_id),
            'ina_pdri'=> $inaPdri,
            'tahun' => $distinct,
            'jumlah_responden' => count($ket),
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
    }

    public function detailProvinsiAjax($id, $tahun) {

        $ket =  KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->where('provinsi', $id)->get();
        // $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        $inaPdriAll = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();
        return response()->json([
            'provinsi' => Provinsi::find($id),
            'ina_pdri'=> $inaPdri,
            'ina_pdri_all' => $inaPdriAll,
            'tahun' => $distinct,
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
        // return $distinct;
    }

    public function mainResponden(){
        $role = User::with('roles')->find(\Auth::user()->id);

        // $data = '';
        if ($role->roles[0]->name == 'Level 3') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->paginate(20);
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->paginate(20);
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->where('user_id', \Auth::user()->id)->paginate(20);
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->paginate(20);
        }
        return view('admin.database.responden', compact('data'));
    }

    public function fetchResponden(Request $request) {
        if($request->ajax()) {
            $role = User::with('roles')->find(\Auth::user()->id);

            // $data = '';
            if ($role->roles[0]->name == 'Level 3') {
                $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->paginate(20);
            } elseif ($role->roles[0]->name == 'Level 2') {
                $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->paginate(20);
            } elseif ($role->roles[0]->name == 'Level 1') {
                $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->where('user_id', \Auth::user()->id)->paginate(20);
            } elseif ($role->roles[0]->name == 'Super Admin') {
                $data = KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->paginate(20);
            }

            return view('admin.database.responden-child', compact('data'))->render();
        }
    }

    public function kuesionerResponden($id) {
        $responden = Survei::find($id);
        $survei = Survei::join('tb_detail_survei', 'tb_detail_survei.survei_id', '=', 'tb_survei.id')
            ->join('tb_pemulihan_sektor', 'tb_detail_survei.kuesioner_id', 'tb_pemulihan_sektor.id')
            ->join('tb_sektor', 'tb_sektor.id', 'tb_pemulihan_sektor.sektor_id')
            ->join('tb_jenis_sektor', 'tb_jenis_sektor.id', 'tb_sektor.jenis')
            ->where('tb_survei.id', $id)
            ->orderBy('tb_pemulihan_sektor.id')
            ->orderBy('tb_detail_survei.tahun')
            ->get();
        $distinct = InaPdri::distinct()->orderBy('tahun', 'asc')->where('survei_id', $id)->get('tahun');
        // return ['survei' => $survei->groupBy(['jenis', 'sektor', 'pertanyaan']), 'tahun' => count($distinct)];
        return view('admin.database.kuesioner', [
            'responden' => $responden,
            'survei' => $survei->groupBy(['jenis', 'sektor', 'pertanyaan']),
            'tahun' => $distinct
        ]);
    }

    public function detailResponden($id) {

        $ket =  KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden')->where('status', 'success')->where('id', $id)->get();
        $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $distinct[0]->tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        foreach($inaPdri as $i)
        {
            $categories[$i->jenis_sektor_id][] = $i;
        }
        return view('admin.database.detail-responden', [
            'keterangan_tempat' => KetTempat::with('prov', 'kab', 'kec', 'kel','petugas_responden')->find($id),
            'ina_pdri'=> $inaPdri,
            'ina_responden' => $ina_pdri = InaPdri::with('jenis_sektor')->whereIn('survei_id', $data)->get(),
            'tahun' => $distinct,
            'jumlah_responden' => count($ket),
            't_asc' => InaPdri::distinct()->orderBy('tahun', 'asc')->whereIn('survei_id', $data)->get('tahun'),
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
    }

    public function detailRespondenAjax($id, $tahun) {

        $ket =  KetTempat::with('prov', 'kab', 'kec', 'kel', 'petugas_responden', 'petugas_responden.petugas')->where('status', 'success')->where('id', $id)->get();
        // $survei_id = [];
        foreach ($ket as $i) {
            $data[] = $i->petugas_responden->id;
        }
        $distinct = InaPdri::distinct()->orderBy('tahun', 'desc')->whereIn('survei_id', $data)->get('tahun');

        $inaPdri = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)->where('tahun', $tahun)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();

        $inaPdriAll = InaPdri::with('jenis_sektor')->selectRaw('jenis_sektor_id, tahun, avg(ina_pdri) as hasil')->whereIn('survei_id', $data)
            ->groupBy('jenis_sektor_id')->groupBy('tahun')->get();
        return response()->json([
            'keterangan_tempat' => KetTempat::with('prov', 'kab', 'kec', 'kel','petugas_responden')->find($id),
            'ina_pdri'=> $inaPdri,
            'ina_pdri_all' => $inaPdriAll,
            'tahun' => $distinct,
            'sektor' => ['Pemukiman', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor']
        ]);
        // return $distinct;
    }
}
