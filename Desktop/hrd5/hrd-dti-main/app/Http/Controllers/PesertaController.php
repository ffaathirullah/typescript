<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Http\Requests\RegisterRequest;

class PesertaController extends Controller
{
    public function index(){
        $pesertas = Peserta::all();

        $data = [];
        foreach ($pesertas as $pes) {
            $daftar_hari = array(
                    'Sunday'    => 'Minggu',
                    'Monday'    => 'Senin',
                    'Tuesday'   => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday'  => 'Kamis',
                    'Friday'    => 'Jumat',
                    'Saturday'  => 'Sabtu'
            );
            $date = $pes->tgl_keberangkatan;
            $dateHari = date('l', strtotime($date));
            $hari = $daftar_hari[$dateHari];
        
            $data[] = [
                'id'                    => $pes-> id,
                'kode_peserta'          => $pes-> kode_peserta,
                'name'                  => $pes-> name,
                'destinasi'             => $pes-> destinasi,
                'kontingen'             => $pes-> kontingen,
                'cabor'                 => $pes-> cabor,
                'tgl_pcr'               => $pes-> tgl_pcr,
                'hari'                  => $hari,
                'tgl_keberangkatan'     => $pes-> tgl_keberangkatan,
                'jam_keberangkatan'     => $pes-> jam_keberangkatan,
                'tipe_kendaraan'        => $pes-> tipe_kendaraan,
                'status'                => $pes-> status,
            ];
        }
        // dd($data);
        return view('pages.peserta.index', [
            'data' => $data
        ]);
        
    }

    public function store(Request $request){
        $rules = [
            'name'                      => 'required|string',
            'destinasi'                 => 'required|string',
            'kontingen'                 => 'required|string',
            'cabor'                     => 'required|string',
            //'tgl_pcr'                   => 'required|date',
            'tgl_keberangkatan'         => 'required|date',
            'jam_keberangkatan'         => 'required|string',
            'tipe_kendaraan'            => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all)->with(['error' => 'Pendaftaran Gagal']);
        }
        // generate kode
        //mengambil tanggal
        $today = date('dmy');
        $char = 'PRT' . $today;

        // mengambil id terakhir
        $code = Peserta::latest()->value('kode_peserta');
        $nourut = substr($code, -4, 4);
        $nourut = (int) $nourut;
        $kodePeserta = $nourut + 1;

        $data_kode_peserta = $char . sprintf("%04s", $kodePeserta);
        
        
        $data = $request->all();
        $peserta = new Peserta(); 

        $peserta->kode_peserta = $data_kode_peserta ;
        $peserta->name = $data['name'];
        $peserta->destinasi = $data['destinasi'];
        $peserta->kontingen = $data['kontingen'];
        $peserta->cabor = $data['cabor'];
        // $peserta->tgl_pcr = $data['tgl_pcr'];
        $peserta->tgl_keberangkatan = $data['tgl_keberangkatan'];
        $peserta->jam_keberangkatan = $data['jam_keberangkatan'];
        $peserta->tipe_kendaraan = $data['tipe_kendaraan'];
        $peserta->status = 1;

        $peserta_message = $peserta->save();
        if($peserta_message){
            //redirect dengan pesan sukses
            return redirect()->back()->with(['success' => 'Pendaftaran Berhasil!']);
        }
        else{
            //redirect dengan pesan error
            return redirect()->back()->with(['error' => 'Pendaftaran Gagal']);
        }
    }


    public function show($id){
        $peserta = Peserta::findOrFail($id);
        $daftar_hari = array(
                    'Sunday'    => 'Minggu',
                    'Monday'    => 'Senin',
                    'Tuesday'   => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday'  => 'Kamis',
                    'Friday'    => 'Jumat',
                    'Saturday'  => 'Sabtu'
            );
        $date = $peserta->tgl_keberangkatan;
        $dateHari = date('l', strtotime($date));
        $hari = $daftar_hari[$dateHari];

        $data[] = [
                'id'                    => $peserta-> id,
                'kode_peserta'          => $peserta-> kode_peserta,
                'name'                  => $peserta-> name,
                'destinasi'             => $peserta-> destinasi,
                'kontingen'             => $peserta-> kontingen,
                'cabor'                 => $peserta-> cabor,
                'tgl_pcr'               => $peserta-> tgl_pcr,
                'hari'                  => $hari,
                'tgl_keberangkatan'     => $peserta-> tgl_keberangkatan,
                'jam_keberangkatan'     => $peserta-> jam_keberangkatan,
                'tipe_kendaraan'        => $peserta-> tipe_kendaraan,
                'link'      => 'http://127.0.0.1:8000/e-ticket/',
                'status'                => $peserta-> status,
        ];

        return view('pages.peserta.view', [
            'data' => $data
        ]);

        // dd($data);
    }


    public function edit($id){
        $peserta = Peserta::findOrFail($id);

        return view('pages.peserta.edit', [
            'peserta' => $peserta
        ]);

        // dd($data);
    }


    public function update(Request $request, $id){
        $rules = [
            'name'                      => 'required|string',
            'destinasi'                 => 'required|string',
            'kontingen'                 => 'required|string',
            'cabor'                     => 'required|string',
            // 'tgl_pcr'                   => 'required|date',
            'tgl_keberangkatan'         => 'required|date',
            'jam_keberangkatan'         => 'required|string',
            'tipe_kendaraan'            => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all)->with(['error' => 'Pendaftaran Gagal']);
        }

        $data = $request->all();
        $item = peserta::findOrFail($id);

        $peserta_message = $item->update($data);

        if($peserta_message){
            //redirect dengan pesan sukses
            return redirect()->route('peserta.index')->with(['success' => 'Update Data Berhasil!']);
        }
        else{
            //redirect dengan pesan error
            return redirect()->route('peserta.index')->with(['error' => 'Update Data Gagal']);
        }
    }

    public function verifikasi($id){
        $peserta = Peserta::findOrFail($id); 

        $peserta->status = 0;

        $peserta_message = $peserta->save();

        if($peserta_message){
            //redirect dengan pesan sukses
            return redirect()->route('peserta.index')->with(['success' => 'Verifikasi Data Berhasil!']);
        }
        else{
            //redirect dengan pesan error
            return redirect()->route('peserta.index')->with(['error' => 'Verifikasi Data Gagal']);
        }
    }


    public function destroy($id)
    {
        $item = Peserta::findOrFail($id);
        $peserta = $item->delete();

        if ($peserta) {
            return redirect()->route('peserta.index')->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return redirect()->route('peserta.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }

    public function eticket($id)
    {
        $peserta = Peserta::findOrFail($id);
        $daftar_hari = array(
                    'Sunday'    => 'Minggu',
                    'Monday'    => 'Senin',
                    'Tuesday'   => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday'  => 'Kamis',
                    'Friday'    => 'Jumat',
                    'Saturday'  => 'Sabtu'
            );
        $date = $peserta->tgl_keberangkatan;
        $dateHari = date('l', strtotime($date));
        $hari = $daftar_hari[$dateHari];

        $data[] = [
                'id'                    => $peserta-> id,
                'kode_peserta'          => $peserta-> kode_peserta,
                'name'                  => $peserta-> name,
                'destinasi'             => $peserta-> destinasi,
                'kontingen'             => $peserta-> kontingen,
                'cabor'                 => $peserta-> cabor,
                'tgl_pcr'               => $peserta-> tgl_pcr,
                'hari'                  => $hari,
                'tgl_keberangkatan'     => $peserta-> tgl_keberangkatan,
                'jam_keberangkatan'     => $peserta-> jam_keberangkatan,
                'tipe_kendaraan'        => $peserta-> tipe_kendaraan,
                'link'      => 'http://127.0.0.1:8000/e-ticket/',
                'status'                => $peserta-> status,
        ];

        return view('eticket', [
            'data' => $data
        ]);
    }
    
}
