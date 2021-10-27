<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peserta;
use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\Gaji;

class DashboardController extends Controller
{
    public function index(){
        $pesertadaftar = Peserta::all()->count();
        // $now = Carbon::now();
        $today = date('Y-m-d');
        //  dd($today); 
        $pesertaHariIni = Peserta::query()->where('created_at', 'like', '%'.$today.'%')->count();
        // dd($pesertaHariIni); 
        $pesertaBelumVerifikasi = Peserta::query()->where('status', 1)->count();
        $pesertaSudahVerifikasi = Peserta::query()->where('status', 0)->count();
        
        $peserta = Peserta::take(10)->latest()->get();


        //dashboard hrd-dti
        $pegawai = Pegawai::count();
        $gaji = Gaji::with('pegawai')->take(10)->latest()->get();
        $title = "Dashboard";

        return view('dashboard',[
            'peserta'                    => $peserta,
            'pesertadaftar'              => $pesertadaftar,
            'pesertaHariIni'             => $pesertaHariIni,
            'pesertaBelumVerifikasi'     => $pesertaBelumVerifikasi,
            'pesertaSudahVerifikasi'     => $pesertaSudahVerifikasi,
            'pegawai'   => $pegawai,
            'gaji'      => $gaji,
            'title'     => $title
        ]);
    }
    public function signout(){
        Auth::logout();
        return redirect('/login');
    }
}

// Reservation::whereBetween('reservation_from', [$from, $to])->get();
