<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FotoController extends Controller
{
    public function index() {
        $role = User::with('roles')->find(\Auth::user()->id);

        // $data = '';
        $user_id = \Auth::user()->id;
        if ($role->roles[0]->name == 'Level 3') {
            $data = Foto::with('bencana')->get()->groupBy('bencana.jenis_bencana');
        } elseif ($role->roles[0]->name == 'Level 2') {
            $data = Foto::with('bencana')->get()->groupBy('bencana.jenis_bencana');
        } elseif ($role->roles[0]->name == 'Level 1') {
            $data = Foto::with('bencana')
                ->whereHas('bencana', function($q) use($user_id){
                    $q->where('user_id', $user_id);
                })
                ->get()->groupBy('bencana.jenis_bencana');
        } elseif ($role->roles[0]->name == 'Super Admin') {
            $data = Foto::with('bencana')->get()->groupBy('bencana.jenis_bencana');
        }

        // $data = Foto::with('bencana')->get()->groupBy('bencana.jenis_bencana');
        return view('admin.manage-foto.index', compact('data'));
        //return $data;
        // return $data;
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
        return view('admin.manage-foto.create', [
            'bencana' => $data
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'id_bencana' => 'required',
            'nama' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);

        $foto = new Foto;
        $foto->id_bencana = $request->id_bencana;
        if($request->hasfile('nama')) {
            $files = $request->nama;
            $filename = round(microtime(true) * 1000).'_'.str_replace(' ','-',$files->getClientOriginalName());
            $files->move(public_path('images/upload/'), $filename);
            $foto->nama = $filename;
        }
        $foto->save();
        return redirect()->route('manage-foto.index')->with('status', 'Your images has been successfully');
    }

    public function destroy($id) {
        $foto = Foto::where('id_bencana', Crypt::decrypt($id))->get();
        foreach ($foto as $i) {
            $image_path = public_path().'/images/upload/'.$i->nama;
            unlink($image_path);
            $i->delete();
        }

        return redirect()->route('manage-foto.index')->with('status', 'Data has been successfully deleted');
    }
}
