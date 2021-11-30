<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\KetTempat;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KetTempatController extends Controller
{
    public function index() {
        // return User::with('roles')->get();
        $role = User::with('roles')->find(\Auth::user()->id);

        // $data = '';
        if ($role->roles[0]->name == 'Level 3') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel')->orderBy('created_at', 'desc')->paginate(50);
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel')->orderBy('created_at', 'desc')->paginate(50);
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel')->orderBy('created_at', 'desc')->where('user_id', \Auth::user()->id)->paginate(50);
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data = KetTempat::with('prov', 'kab', 'kec', 'kel')->orderBy('created_at', 'desc')->paginate(50);
        }

        // $data = KetTempat::with('prov', 'kab', 'kec', 'kel')->orderBy('created_at', 'desc')->get();
        return view('admin.ket-tempat.index', [
            'data' => $data
        ]);
    }

    public function create() {
        $role = User::with('roles')->find(\Auth::user()->id);

        // $data = '';
        if ($role->roles[0]->name == 'Level 3') {
            $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->orderBy('created_at', 'desc')->get();
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->orderBy('created_at', 'desc')->get();
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->orderBy('created_at', 'desc')->where('user_id', \Auth::user()->id)->get();
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->orderBy('created_at', 'desc')->get();
        }
        //$prov = Provinsi::with('kab')->orderBy('nama')->get();
        return view('admin.ket-tempat.create', ['provinsi' => Provinsi::all(),
            'bencana' => $data,
            'edit' => FALSE
        ]);
    }

    public function getBencana($id) {
        return response()->json(Bencana::with('prov', 'kab', 'kec', 'kel')->find($id));
    }

    public function store(Request $request) {
        $request->validate([
            'prov_id' => 'required',
            'kab_id' => 'required|max:100',
            'kec_id' => 'required|max:100',
            'kel_id' => 'required|max:100',
            'alamat' => 'required|max:255',
            'tahun_bencana' => 'required',
            'jenis_bencana' => 'required'
        ]);

        $bencana =explode(" ",  $request->jenis_bencana);
        $kettempat = new kettempat();
        $kettempat->user_id = \Auth::user()->id;
        $kettempat->provinsi = $request->prov_id;
        $kettempat->kabupaten = $request->kab_id;
        $kettempat->kecamatan = $request->kec_id;
        $kettempat->kelurahan = $request->kel_id;
        $kettempat->alamat = $request->alamat;
        $kettempat->tahun_bencana = $request->tahun_bencana;
        $kettempat->jenis_bencana = $bencana[1];
        $kettempat->bencana_id = $bencana[0];

        if($kettempat->save()) {
            return redirect()->route('keterangan-tempat.index')->with(['success' => 'Data successfully created...']);
        } else {

        }


    }

    public function edit($id) {
        $data = KetTempat::with('prov', 'kab', 'kec', 'kel')->findOrFail(Crypt::decrypt($id));
        return view('admin.ket-tempat.create', [
            'data' => $data,
            'bencana' => Bencana::with('prov', 'kab', 'kec', 'kel')->get(),
            'edit' => TRUE]);
    }

    public function update(Request $request, $id) {
        $bencana =explode(" ",  $request->jenis_bencana);
        $kettempat = KetTempat::find(Crypt::decrypt($id));
        $kettempat->provinsi = $request->prov_id;
        $kettempat->kabupaten = $request->kab_id;
        $kettempat->kecamatan = $request->kec_id;
        $kettempat->kelurahan = $request->kel_id;
        $kettempat->alamat = $request->alamat;
        $kettempat->tahun_bencana = $request->tahun_bencana;
        $kettempat->jenis_bencana = $bencana[1];
        $kettempat->bencana_id = $bencana[0];

        if($kettempat->save()) {
            return redirect()->route('keterangan-tempat.index')->with(['success' => 'Data successfully changed']);
        }
    }

    public function destroy($id) {
        KetTempat::find(Crypt::decrypt($id))->delete();
        return redirect()->route('keterangan-tempat.index')->with(['success' => 'Data successfully removed']);
    }

    public function GetKabupaten($id) {
        $kab = Kabupaten::where('id_prov', $id)->get();
        return response()->json($kab);
    }

    public function GetKecamatan($id) {
        $kec = Kecamatan::where('id_kab', $id)->get();
        return response()->json($kec);
    }

    public function GetKelurahan($id) {
        $kel = Kelurahan::where('id_kec', $id)->get();
        return response()->json($kel);
    }
}
