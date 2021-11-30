<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Foto;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index() {
        // return Foto::with('bencana')->get()->groupBy('bencana.jenis_bencana');
        return view(
            'admin.galeri.index', ['foto' => Foto::with('bencana', 'bencana.prov', 'bencana.kab', 'bencana.kec', 'bencana.kel')->get()->groupBy('bencana.jenis_bencana')]
        );
    }
}
