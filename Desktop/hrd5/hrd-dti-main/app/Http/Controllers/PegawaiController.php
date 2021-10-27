<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Bidang;
use App\Models\Jabatan;

use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\PegawaiRequest;
use App\Models\Shift;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Pegawai::query()->with(['bidang', 'jabatan'])->get();
            // dd($query);
            $pesan = 'apakah yakinmau menghapus!';
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
                                    <a class="dropdown-item" href="' . route('pegawai.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('pegawai.destroy', $item->id) . '" method="POST">
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

        // $pegawai = Pegawai::query()->with(['bidang'])->get();
        // return response()->json($pegawai);
        return view('pages.pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Jabatan::all();
        $bidang = Bidang::all();
        $shift = Shift::all();
        return view('pages.pegawai.create', [
            'bidang'    => $bidang,
            'jabatan'   => $jabatan,
            'shift'     => $shift
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        $data = $request->all();

        $pegawai = Pegawai::create($data);

        if ($pegawai) {
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diupload']);
        } else {
            return redirect()->route('pegawai.index')->with(['error' => 'Data Gagal Diupload']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jabatan = Jabatan::all();
        $bidang = Bidang::all();
        $shift = Shift::all();
        $pegawai = Pegawai::findOrFail($id);
        return view('pages.pegawai.edit', [
            'pegawai'    => $pegawai,
            'bidang'    => $bidang,
            'jabatan'   => $jabatan,
            'shift'     => $shift
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiRequest $request, $id)
    {
        $data = $request->all();
        $item = Pegawai::findOrFail($id);

        $pegawai = $item->update($data);

        if ($pegawai) {
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dirubah']);
        } else {
            return redirect()->route('pegawai.index')->with(['error' => 'Data Gagal Dirubah']);
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
        $item = Pegawai::findOrFail($id);
        $pegawai = $item->delete();

        if ($pegawai) {
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return redirect()->route('pegawai.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
