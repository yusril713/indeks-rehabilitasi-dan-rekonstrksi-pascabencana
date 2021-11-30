<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReferensiController extends Controller
{
    public function index() {
        return view('admin.referensi.index', [
            'referensi' => Referensi::all()
        ]);
        // $data = Referensi::all();
        // return $data;
    }

    public function create() {
        return view('admin.referensi.create', [
            'edit'     => FALSE
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'ket' => 'required',
            'jenis' => 'required|max:100',
            'filedoc.*' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip|max:3048'
        ]);

        $referensi = new Referensi();
        $referensi->ket = $request->ket;
        $referensi->jenis = $request->jenis;

        if($request->hasfile('filedoc')) {
            foreach($request->file('filedoc') as $fileupload) {
                $filename = round(microtime(true) * 1000).'_'.str_replace(' ','-',$fileupload->getClientOriginalName());
                $fileupload->move(public_path('upload/file/'), $filename);
                $referensi->filedoc = $filename;
            }
        }
        $referensi->save();

        return redirect()->route('referensi.index')->with('success', 'Data successfully created');
    }

    public function destroy($id) {
        $referensi = Referensi::findOrFail(Crypt::decrypt($id));
        $file = Referensi::where('id', Crypt::decrypt($id))->get();
        foreach ($file as $i) {
            $image_path = public_path().'/upload/file/'.$i->filedoc;
            unlink($image_path);
            $i->delete();
        }
        $referensi->delete();

        return redirect()->route('referensi.index')->with('status', 'Data has been successfully deleted');
    }
}
