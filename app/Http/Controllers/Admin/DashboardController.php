<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\KetTempat;
use App\Models\Provinsi;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function dashboard() {
        return view('admin.dashboard.index', [
            'user' => ModelsUser::where('email', '!=', 'admin@admin.com')->get(),
            'keterangan_tempat'=> KetTempat::get()->count(),
            'provinsi' => Provinsi::get()->count(),
            'bencana' => Bencana::get()->count()
        ]);
    }
}
