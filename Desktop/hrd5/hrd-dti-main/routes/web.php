<?php

use App\Http\Controllers\BidangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\SpController;
use App\Http\Controllers\SppdController;
use App\Http\Controllers\PenilaianKerjaController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\BpjsController;
use App\Http\Controllers\GajiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KebijakanhrController;
use App\Http\Controllers\PegawaiexitController;
use App\Http\Controllers\PengumumanhrController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\OvertimeRequestController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskProjectController;


// use finance middleware
use App\Http\Controllers\Finance\DashboardFinanceController;
use App\Http\Controllers\Finance\UserFinanceController;
use App\Http\Controllers\Finance\PenjualanController;
use App\Http\Controllers\Finance\PembelianController;


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

Route::get('/', function () {
    return view('welcome');
});
// Auth::routes(['register' => false]);

Route::post('daftar', [PesertaController::class, 'store'])->name('daftar.peserta');
Route::get('e-ticket/{id}', [PesertaController::class, 'eticket'])->name('eticket.peserta');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('user', UserController::class);
    Route::post('/changePassword',[UserController::class, 'changePassword'])->name('changePassword');


    Route::resource('bidang', BidangController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('overtime', OvertimeRequestController::class);
    Route::resource('lembur', LemburController::class);
    Route::resource('cuti', CutiController::class);
    Route::resource('absen', AbsenController::class);
    Route::get('/report', [AbsenController::class, 'view'])->name('report');
    Route::get('/result', [AbsenController::class, 'resultSearch'])->name('result');
    Route::resource('sp', SpController::class);
    Route::resource('sppd', SppdController::class);
    Route::resource('penilaiankerja', PenilaianKerjaController::class);
    Route::resource('asset', AssetController::class);
    Route::resource('bpjs', BpjsController::class);
    Route::resource('gaji', GajiController::class);
    Route::get('/bukti', [GajiController::class, 'view'])->name('buktinya');
    // Route::get('/filter', [GajiController::class, 'filter'])->name('filter');

    // Route::resource('kebijakanhr', KebijakanhrController::class);
    // Route::resource('pengumumanhr', PengumumanhrController::class);
    Route::resource('pinjaman', PinjamanController::class);
    Route::resource('shift', ShiftController::class);
    Route::resource('pegawaiexit', PegawaiexitController::class);

    // menu hr
    Route::resource('pengumumanhr', PengumumanhrController::class);
    Route::resource('kebijakanhr', KebijakanhrController::class);

    Route::resource('peserta', PesertaController::class); 
    Route::put('/verifikasi/{id}', [PesertaController::class, 'verifikasi'])->name('verifikasi-peserta');


    // client
    Route::resource('client', ClientController::class); 

    // Poject with client
    Route::resource('project', ProjectController::class); 
    Route::resource('taskproject', TaskProjectController::class); 
    // Route::get('/taskprojected', [TaskProjectController::class, 'edit'])->name('taskprojected');

    Route::get('/logout', [DashboardController::class, 'signout']);
});


// Route untuk finance
Route::prefix('fnc')->middleware(['auth', 'finance'])->group(function () {
    Route::get('dashboard_finance', [DashboardFinanceController::class, 'index']);
    Route::resource('user_finance', UserFinanceController::class);
    Route::post('/changePasswordFinance',[UserController::class, 'changePasswordFinance'])->name('changePasswordFinance');
    Route::resource('penjualan', PenjualanController::class);
    Route::resource('pembelian', PembelianController::class);
});