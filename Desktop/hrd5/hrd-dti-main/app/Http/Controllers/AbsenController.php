<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Pegawai;

use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\AbsenRequest;


class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Absen::query()->with(['pegawai'])->get();
            // dd($query);
            // $pesan = 'apakah yakinmau menghapus!';
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '" style="border-radius:10px 0px 10px 10px; margin:10px;">
                                    <a class="dropdown-item" href="' . route('absen.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('absen.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make();
        }

        // $absen = Absen::query()->with(['pegawai'])->get();
        // return response()->json($absen);
        return view('pages.absen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        return view('pages.absen.create', [
            'pegawai'    => $pegawai
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbsenRequest $request)
    {
        $data = $request->all();

        $absen = Absen::create($data);

        if ($absen) {
            return redirect()->route('absen.index')->with(['success' => 'Data Berhasil Diupload']);
        } else {
            return redirect()->route('absen.index')->with(['error' => 'Data Gagal Diupload']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = Pegawai::all();
        $absen = Absen::findOrFail($id);
        return view('pages.absen.edit', [
            'absen'    => $absen,
            'pegawai'    => $pegawai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::all();
        $absen = Absen::findOrFail($id);
        return view('pages.absen.edit', [
            'absen'    => $absen,
            'pegawai'    => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AbsenRequest $request, $id)
    {
        $data = $request->all();
        $item = Absen::findOrFail($id);

        $absen = $item->update($data);

        if ($absen) {
            return redirect()->route('absen.index')->with(['success' => 'Data Berhasil Dirubah']);
        } else {
            return redirect()->route('absen.index')->with(['error' => 'Data Gagal Dirubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Absen::findOrFail($id);
        
        $absen = $item->delete();

        if ($absen) {
            return redirect()->route('absen.index')->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return redirect()->route('absen.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }

    public function view()
    {
            $pegawai = Pegawai::all();
            return view('pages.absen.month_report', [
            'title'    => 'Month Report',
            'pegawai'   => $pegawai,  
        ]);
    }

    public function resultSearch(Request $request){
        $tanggal_1 = $request->tanggal;
        $date = explode("/", $tanggal_1);
        $pegawai = Pegawai::all();
            $absen = Absen::query()->with(['pegawai'])->whereBetween('tanggal', [$date[0], $date[1]])->where('pegawai_id', $request->pegawai_id)->get();
        // dd($pegawai);
        $total = Absen::query()->with(['pegawai'])->whereBetween('tanggal', [$date[0], $date[1]])->where('pegawai_id', $request->pegawai_id)->count();
    
            return view('pages.absen.result_search', [
                'title'    => 'Month Report',
                'absen' => $absen,
                'total' => $total,
                'pegawai'   => $pegawai
            ]);
    }

}
