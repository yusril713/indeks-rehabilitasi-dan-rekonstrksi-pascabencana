<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KetTempat;
use App\Models\Petugas;
use App\Models\Survei;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PetugasRespondenController extends Controller
{
    public function index($id) {
        $role = User::with('roles')->find(\Auth::user()->id);

        // $data = '';
        if ($role->roles[0]->name == 'Level 3') {
            $data = Petugas::all();
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = Petugas::where('user_id', \Auth::user()->id)->first();
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = Petugas::where('user_id', \Auth::user()->id)->first();
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data =Petugas::all();
        }


        return view('admin.petugas-respon.index', [
            'ket_tempat' => KetTempat::findOrFail(Crypt::decrypt($id)),
            'petugas' => $data,
            'survei' => Survei::where('keterangan_tempat_id', Crypt::decrypt($id))->first()
        ]);
        // return Survei::where('keterangan_tempat_id', Crypt::decrypt($id))->first() ? 'ada' : 'Tidak ada';
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'petugas' => 'required',
            'tgl_survei' => 'required',
            'tgl_periksa' => 'required',
            'nama_responden' => 'required|min:3',
            'no_hp' => 'required|min:10',
            'no_kk' => 'required|min:14',
            'no_responden' => 'required|min:5',
            'lokasi_asal' => 'required|min:3'
        ]);
        if (Survei::isAvalailable($request->keterangan_tempat_id)) {
            $survei = Survei::where('keterangan_tempat_id', $request->keterangan_tempat_id)->first();
            $survei->petugas_id = $request->petugas;
            $survei->tgl_survei = $request->tgl_survei;
            $survei->tgl_periksa = $request->tgl_periksa;
            $survei->nama_responden = $request->nama_responden;
            $survei->no_hp = $request->no_hp;
            $survei->no_responden = $request->no_responden;
            $survei->no_kk = $request->no_kk;
            $survei->lokasi_asal = $request->lokasi_asal;
            $survei->save();
            return redirect()->route('survei.sektor-pemukiman', [Crypt::encrypt($survei->id), Crypt::encrypt(1)]);
        } else {
            $survei = new Survei();
            $survei->keterangan_tempat_id = $request->keterangan_tempat_id;
            $survei->petugas_id = $request->petugas;
            $survei->tgl_survei = $request->tgl_survei;
            $survei->tgl_periksa = $request->tgl_periksa;
            $survei->nama_responden = $request->nama_responden;
            $survei->no_hp = $request->no_hp;
            $survei->no_responden = $request->no_responden;
            $survei->no_kk = $request->no_kk;
            $survei->lokasi_asal = $request->lokasi_asal;
            $survei->save();
            return redirect()->route('survei.sektor-pemukiman', [Crypt::encrypt($survei->id), Crypt::encrypt(1)]);
        }
    }

}
