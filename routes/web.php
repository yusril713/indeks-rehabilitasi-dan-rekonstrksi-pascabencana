<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DatabaseController;
use App\Http\Controllers\Admin\KetTempatController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\BencanaController;
use App\Http\Controllers\Admin\FotoController;
use App\Http\Controllers\Admin\PetugasRespondenController;
use App\Http\Controllers\Admin\ProcessController;
use App\Http\Controllers\Admin\SurveiController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\ReferensiController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AssignRole;
use App\Http\Controllers\Admin\AssignPermission;
use App\Http\Controllers\User\HomeController;
use App\Http\Livewire\KetTempat;
use App\Models\Petugas;
use App\Models\Survei;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home user');
Route::post('register/post', [PetugasController::class, 'register_akun'])->name('manage-petugas.register_akun');
// Route::get('/login', [HomeController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('keterangan-tempat', KetTempatController::class)->except(['show']);
    Route::get('keterangan_tempat/get-bencana/{id}', [KetTempatController::class, 'getBencana']);
    Route::resource('manage-petugas', PetugasController::class)->except(['show']);
    Route::resource('manage-bencana', BencanaController::class);
    Route::resource('manage-foto', FotoController::class)->except(['show']);
    Route::resource('referensi', ReferensiController::class);

    // Route::resource([
    //     'manage-bencana' => BencanaController::class,
    // ]);

    Route::get('/manage-responden/{id}', [PetugasRespondenController::class, 'index'])->name('manage-responden');
    Route::post('/manage-responden/store', [PetugasRespondenController::class, 'store'])->name('manage-responden.store');

    Route::get('/sektor-pemukiman/{id}/{sektor_id}', [SurveiController::class, 'SektorPemukiman'])->name('survei.sektor-pemukiman');
    Route::post('/kinerja-pemulihan/post', [SurveiController::class, 'store']);

    Route::get('/sektor-infrastruktur/{survei_id}/{sektor_id}', [SurveiController::class, 'SektorInfrastruktur'])->name('survei.sektor-infrastruktur');
    Route::put('/sektor-infrastruktur/{survei_id}/{sektor_id}/{sektor_name}/store', [SurveiController::class, 'StoreSektor'])->name('sektor-infrastruktur.store');

    Route::get('/sektor-sosial/{survei_id}/{sektor_id}', [SurveiController::class, 'SektorSosial'])->name('survei.sektor-sosial');
    Route::get('/sektor-ekonomi/{survei_id}/{sektor_id}', [SurveiController::class, 'SektorEkonomi'])->name('survei.sektor-ekonomi');
    Route::get('/lintas-sektor/{survei_id}/{sektor_id}', [SurveiController::class, 'LintasSektor'])->name('survei.lintas-sektor');
    Route::get('/ina-pdri/{survei_id}', [SurveiController::class, 'InaPdri'])->name('ina-pdri');

    Route::get('/calc-inapdri/{survei}', [SurveiController::class, 'CalculateInaPdri'])->name('calculate');

    Route::get('/get-kab/{id}', [KetTempatController::class, 'GetKabupaten']);
    Route::get('/get-kec/{id}', [KetTempatController::class, 'GetKecamatan']);
    Route::get('/get-kel/{id}', [KetTempatController::class, 'GetKelurahan']);

    Route::resource('manage-process', ProcessController::class)->only(['index', 'show']);
    Route::get('manage-process/get-kabupaten/{id}', [ProcessController::class, 'getKabupaten']);
    Route::get('manage-process/get-kecamatan/{id}', [ProcessController::class, 'getKecamatan']);
    Route::get('manage-process/find/{id}', [ProcessController::class, 'find']);
    Route::get('manage-process/hitung/{id}', [ProcessController::class, 'calculate']);
    Route::get('manage-process/chart/{id}', [ProcessController::class, 'getChart']);

    Route::get('database/kelurahan', [DatabaseController::class, 'mainKelurahan'])->name('database.kelurahan');
    Route::get('database/get-provinsi/', [DatabaseController::class, 'getProvinsi']);
    Route::get('database/get-kabupaten/{id}', [DatabaseController::class, 'getKabupaten']);
    Route::get('database/get-kecamatan/{id}', [DatabaseController::class, 'getKecamatan']);
    Route::get('database/get-kelurahan/{id}', [DatabaseController::class, 'getKelurahan']);
    Route::get('database/get-kelurahann/{id}', [DatabaseController::class, 'getKelurahann']);
    Route::get('database/kelurahan/find/{id}', [DatabaseController::class, 'findKelurahan']);
    Route::get('database/detail-kelurahan-ajax/{id}/{tahun}', [DatabaseController::class, 'detailKelurahanAjax']);
    Route::get('database/detail-kelurahan/print/{id}', [DatabaseController::class, 'printKelurahan'])->name('database.detail-kelurahan.print');
    Route::get('database/detail-kelurahan/{id}', [DatabaseController::class, 'detailKelurahan'])->name('database.detail-kelurahan');

    Route::get('database/kecamatan', [DatabaseController::class, 'mainKecamatan'])->name('database.kecamatan');
    Route::get('database/get-kabupaten/{id}', [DatabaseController::class, 'getKabupaten']);
    Route::get('database/kecamatan/find/{id}', [DatabaseController::class, 'findKecamatan']);
    Route::get('database/detail-kecamatan-ajax/{id}/{tahun}', [DatabaseController::class, 'detailKecamatanAjax']);
    Route::get('database/detail-kecamatan/{id}', [DatabaseController::class, 'detailKecamatan'])->name('database.detail-kecamatan');

    Route::get('database/kabupaten', [DatabaseController::class, 'mainKabupaten'])->name('database.kabupaten');
    Route::get('database/kabupaten/find/{id}', [DatabaseController::class, 'findKabupaten']);
    Route::get('database/detail-kabupaten-ajax/{id}/{tahun}', [DatabaseController::class, 'detailKabupatenAjax']);
    Route::get('database/detail-kabupaten/{id}', [DatabaseController::class, 'detailKabupaten'])->name('database.detail-kabupaten');

    Route::get('database/provinsi', [DatabaseController::class, 'mainProvinsi'])->name('database.provinsi');
    Route::get('database/detail-provinsi-ajax/{id}/{tahun}', [DatabaseController::class, 'detailProvinsiAjax']);
    Route::get('database/detail-provinsi/{id}', [DatabaseController::class, 'detailProvinsi'])->name('database.detail-provinsi');

    Route::get('database/responden', [DatabaseController::class, 'mainResponden'])->name('database.responden');
    Route::get('database/responden/child', [DatabaseController::class, 'fetchResponden']);
    Route::get('database/get-responden/', [DatabaseController::class, 'getResponden']);
    Route::get('database/kuesioner-responden/{id}', [DatabaseController::class, 'kuesionerResponden']);
    Route::get('database/detail-responden-ajax/{id}/{tahun}', [DatabaseController::class, 'detailRespondenAjax']);
    Route::get('database/detail-responden/{id}', [DatabaseController::class, 'detailResponden'])->name('database.detail-responden');

    Route::get('sektor-sosial/readonly', [SurveiController::class, 'readSektorSosial'])->name('sektor-sosial.readonly');
    Route::get('sektor-ekonomi/readonly', [SurveiController::class, 'readSektorEkonomi'])->name('sektor-ekonomi.readonly');
    Route::get('sektor-pemukiman/readonly', [SurveiController::class, 'readSektorPemukiman'])->name('sektor-pemukiman.readonly');
    Route::get('sektor-infrastruktur/readonly', [SurveiController::class, 'readSektorInfrastruktur'])->name('sektor-infrastruktur.readonly');
    Route::get('lintas-sektor/readonly', [SurveiController::class, 'readLintasSektor'])->name('lintas-sektor.readonly');

    Route::get('gallery', [GaleriController::class, 'index'])->name('manage-gallery');

    Route::resource('manage-role', RoleController::class)->except(['show']);
    Route::resource('manage-permission', PermissionController::class)->only(['index', 'store', 'destroy']);
    Route::resource('assign-role', AssignRole::class)->only(['index', 'store']);
    Route::resource('assign-permission', AssignPermission::class)->except(['show']);

    Route::get('ganti-password', [PetugasController::class, 'password'])->name('ganti-password');
    Route::post('ganti-password/pass-post', [PetugasController::class, 'pass_post'])->name('manage-petugas.pass_post');



});
Route::get('forgot-password', [PetugasController::class, 'forgotPassword'])->name('forgot-password');
Route::put('store-password', [PetugasController::class, 'storePassword'])->name('store-password');
