<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;

use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\BidangRequest;


class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Bidang::all();
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
                                    <a class="dropdown-item" href="' . route('bidang.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('bidang.destroy', $item->id) . '" method="POST">
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

        //  $bidang = Bidang::all();
        // return response()->json($bidang);
        return view('pages.bidang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidangRequest $request)
    {
        $data = $request->all();

        $bidang = Bidang::create($data);

        if ($bidang) {
            return redirect()->route('bidang.index')->with(['success' => 'Data Berhasil Diupload']);
        } else {
            return redirect()->route('bidang.index')->with(['error' => 'Data Gagal Diupload']);
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
        $bidang = Bidang::findOrFail($id);
        return view('pages.bidang.edit', [
            'bidang'    => $bidang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BidangRequest $request, $id)
    {
        $data = $request->all();
        $item = Bidang::findOrFail($id);

        $bidang = $item->update($data);

        if ($bidang) {
            return redirect()->route('bidang.index')->with(['success' => 'Data Berhasil Dirubah']);
        } else {
            return redirect()->route('bidang.index')->with(['error' => 'Data Gagal Dirubah']);
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
        $item = Bidang::findOrFail($id);
        $bidang = $item->delete();

        if ($bidang) {
            return redirect()->route('bidang.index')->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return redirect()->route('bidang.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
