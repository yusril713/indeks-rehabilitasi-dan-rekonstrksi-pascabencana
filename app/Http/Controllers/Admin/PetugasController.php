<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index() {
        // return User::with('roles')->get();
        $role = User::with('roles')->find(\Auth::user()->id);
        // return $role->roles[0]->name;

        $petugas = '';
        if ($role->roles[0]->name == 'Level 3') {
            $petugas = Petugas::with('user')->orderBy('nip', 'asc')->get();
        } else if ($role->roles[0]->name == 'Level 2') {
            $petugas = Petugas::with('user')->orderBy('nip', 'asc')->get();
        } else if ($role->roles[0]->name == 'Level 1') {
            $petugas = Petugas::with('user')->orderBy('nip', 'asc')->where('user_id', \Auth::user()->id)->get();
        } else {
            $petugas = Petugas::with('user')->orderBy('nip', 'asc')->get();
        }

        // return $petugas;
        return view('admin.manage-petugas.index', [
            'petugas' => $petugas
        ]);
    }

    public function create(){
        return view('admin.manage-petugas.create', ['roles' => Role::where('name', '!=', 'Super Admin')->get()]);
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'no_identitas' => 'required|min:4|unique:tb_petugas,nip,except,id',
            'nama' => 'required|min:3',
            'no_hp' => 'required|min:9',
            'jenis_kelamin' => 'required',
        ]);

        $user  = new User();
        $user->email = $request->email;
        $user->name = $request->nama;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole($request->role);

        $petugas = new Petugas();
        $petugas->user_id = $user->id;
        $petugas->nip = $request->no_identitas;
        $petugas->nama = $request->nama;
        $petugas->no_hp = $request->no_hp;
        $petugas->alamat = $request->alamat;
        $petugas->tempat_lahir = $request->tempat_lahir;
        $petugas->tgl_lahir = $request->tanggal_lahir;
        $petugas->jenis_kelamin = $request->jenis_kelamin;
        $petugas->save();
        return redirect()->route('manage-petugas.index')->with('status', 'Data successfully created');
        // return $date;
    }

    public function edit($id) {
        return view('admin.manage-petugas.edit', ['petugas'=> Petugas::findOrFail(Crypt::decrypt($id))]);
    }

    public function update(Request $request, $id) {
        $petugas = Petugas::findOrFail(Crypt::decrypt($id));
        $petugas->nip = $request->no_identitas;
        $petugas->nama = $request->nama;
        $petugas->no_hp = $request->no_hp;
        $petugas->alamat = $request->alamat;
        $petugas->tempat_lahir = $request->tempat_lahir;
        $petugas->tgl_lahir = $request->tanggal_lahir;
        $petugas->jenis_kelamin = $request->jenis_kelamin;
        $petugas->save();
        return redirect()->route('manage-petugas.index')->with('status', 'Data successfully created...');
    }

    public function destroy($id) {
        Petugas::findOrFail(Crypt::decrypt($id))->delete();
        return redirect()->route('manage-petugas.index')->with('status', 'Data successfully removed...');
    }

    public function password() {
        return view('admin.account.index');
    }

    public function pass_post(Request $request) {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $password = User::findOrFail(auth()->user()->id);
        $password->password = Hash::make($request->new_password);
        $password->save();
        return redirect()->route('manage-petugas.index')->with('status', 'Data successfully removed...');
    }

    public function register_akun(Request $request) {
        $validate = $request->validate([
            'no_identitas' => 'required|min:4|unique:tb_petugas,nip,except,id',
            'nama' => 'required|min:3',
            'no_hp' => 'required|min:9',
            'jenis_kelamin' => 'required',
        ]);

        $val = ['Indeks RR 01', 'Indeks RR 02', 'Indeks RR 03', 'Indeks RR 04'];
        $cek = FALSE;
        for ($i = 0; $i < sizeof($val); $i++) {
            if ($request->validasi_provinsi==$val[$i]) {
                $cek = TRUE;
                break;
            }
        }
       if ($cek) {

            $user  = new User();
            $user->email = $request->email;
            $user->name = $request->nama;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->assignRole($request->role);

            $petugas = new Petugas();
            $petugas->user_id = $user->id;
            $petugas->nip = $request->no_identitas;
            $petugas->nama = $request->nama;
            $petugas->no_hp = $request->no_hp;
            $petugas->alamat = $request->alamat;
            $petugas->tempat_lahir = $request->tempat_lahir;
            $petugas->tgl_lahir = $request->tanggal_lahir;
            $petugas->jenis_kelamin = $request->jenis_kelamin;
            $petugas->kode_wilayah = $request->validasi_provinsi;
            $petugas->save();
            return redirect()->route('login')->with('status', 'Data successfully created');
        } else {
            return redirect()->route('register')->with('status', 'Kode Validasi Provinsi Tidak Valid...');
        }
        // return $date;
    }

    public function forgotPassword() {
        return view('auth.reset-pass');
    }

    public function storePassword(Request $request) {
        $user = User::where('email', $request->email)->first();
        $val = ['Indeks RR 01', 'Indeks RR 02', 'Indeks RR 03', 'Indeks RR 04'];
        $cek = FALSE;
        for ($i = 0; $i < sizeof($val); $i++) {
            if ($request->kode_wilayah==$val[$i]) {
                $cek = TRUE;
                break;
            }
        }
        if ($cek) {
            if ($request->password == $request->password_confirmation) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->route('login')->with('status', 'Password successfully changed...');
            }
            else {
                return redirect()->route('forgot-password')->with('status', 'Make sure your password confirmation same with new password');
            }
        }
        else {
            return redirect()->route('forgot-password')->with('status', 'Failed to change password...');
        }
    }
}
