<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Foto;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\User;
use App\Models\Kelurahan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BencanaController extends Controller
{
    public function index() {
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

        // $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->orderBy('created_at', 'desc')->get();
        return view('admin.manage-bencana.index', compact('data'));
        //return $data;
    }

    public function show($id) {
        return view('admin.manage-bencana.show', [
            'bencana' => Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->where('id', Crypt::decrypt($id))->first(),
        ]);
        $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->where('id', Crypt::decrypt($id))->first();
        // $data = Foto::all()->where('id');
        return $data;
    }

    public function create() {
        $role = User::with('roles')->find(\Auth::user()->id);
        $petugas = Petugas::where('user_id', \Auth::user()->id)->first();

        // $data = '';
        if ($role->roles[0]->name == 'Level 3') {
            $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->orderBy('created_at', 'desc')->get();
            $prov = Provinsi::all();
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->orderBy('created_at', 'desc')->get();
            $prov = Provinsi::all();
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->orderBy('created_at', 'desc')->where('user_id', \Auth::user()->id)->get();
            $prov = Provinsi::where('kode_wilayah', $petugas->kode_wilayah)->get();
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data = Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->orderBy('created_at', 'desc')->get();
            $prov = Provinsi::all();
        }
        return view('admin.manage-bencana.create', [
            'bencana' => Bencana::with('prov', 'kab', 'kec', 'kel')->orderBy('created_at', 'desc')->get(),
            'provinsi' => $prov,
            'edit'     => FALSE
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'provinsi' => 'required',
            'kabupaten' => 'required|max:100',
            'kecamatan' => 'required|max:100',
            'kelurahan' => 'required|max:100',
            'alamat' => 'required|max:255',
            'jenis_bencana' => 'required|max:100',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'tgl_bencana' => 'required',
            'jam_bencana' => 'required'
        ]);

        $bencana = new Bencana();
        $bencana->user_id = \Auth::user()->id;
        $bencana->provinsi = $request->provinsi;
        $bencana->kabupaten = $request->kabupaten;
        $bencana->kecamatan = $request->kecamatan;
        $bencana->kelurahan = $request->kelurahan;
        $bencana->alamat = $request->alamat;
        $bencana->jenis_bencana = $request->jenis_bencana;
        $bencana->tgl_bencana = $request->tgl_bencana;
        $bencana->jam_bencana = $request->jam_bencana;
        $bencana->save();

        if($request->hasfile('images')) {
            foreach($request->file('images') as $image) {
                $filename = round(microtime(true) * 1000).'_'.str_replace(' ','-',$image->getClientOriginalName());
                $image->move(public_path('images/upload/'), $filename);
                $data = $filename;
                $img = new Foto();
                $img->id_bencana = $bencana->id;
                $img->nama = $data;
                $img->save();
            }
        }
        return redirect()->route('manage-bencana.index')->with('status', 'Data successfully created');
        // return 'ok';
    }

    public function edit($id) {
        return view('admin.manage-bencana.edit', [
            'bencana'  => Bencana::with('prov', 'kab', 'kec', 'kel', 'foto')->findOrFail(Crypt::decrypt($id)),
            'provinsi' => Provinsi::all()
        ]);
        //return Bencana::with('prov', 'kab', 'kec', 'kel')->findOrFail(Crypt::decrypt($id))
    }

    public function update(Request $request, $id) {
        $bencana = Bencana::findOrFail(Crypt::decrypt($id));
        $bencana->provinsi = $request->provinsi;
        $bencana->kabupaten = $request->kabupaten;
        $bencana->kecamatan = $request->kecamatan;
        $bencana->kelurahan = $request->kelurahan;
        $bencana->alamat = $request->alamat;
        $bencana->jenis_bencana = $request->jenis_bencana;
        $bencana->tgl_bencana = $request->tgl_bencana;
        $bencana->jam_bencana = $request->jam_bencana;
        $bencana->save();

        if($request->hasfile('images')) {
            foreach($request->file('images') as $image) {
                $filename = round(microtime(true) * 1000).'_'.str_replace(' ','-',$image->getClientOriginalName());
                $image->move(public_path('images/upload/'), $filename);
                $data = $filename;
                $img = new Foto();
                $img->id_bencana = $bencana->id;
                $img->nama = $data;
                $img->save();
            }
        }

        return redirect()->route('manage-bencana.index')->with('status', 'Data successfully created');
    }

    public function destroy($id) {
        $bencana = Bencana::findOrFail(Crypt::decrypt($id));
        //$image = \DB::table('tb_foto_bencana')->where('id_bencana', $id)->first();
        //$file= $image->nama;
        //$filename = public_path().'/images/upload/'.$file;
        //\File::delete($filename);
        $bencana->delete();

        return redirect()->route('manage-bencana.index')->with('ststus', 'Data successfully deleted');
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
