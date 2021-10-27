@extends('layouts.app')

@section('content')

    <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb shadow-sm bg-white p-5">
              <li class="breadcrumb-item"><a href="/dashboard" style="text-decoration: none"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Bukti Penggajian</li>
            </ol>
          </nav>

          <div class="content mb-4">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="nav-wrapper">
                @include('pages.gaji.navigasi')
              </div>
            </div>
              <div class="row">
                  <div class="col-md-4 col-12">
                    <div class="card card-custom gutter-b border-0 shadow">
                        <div class="card-header">
                          <div class="card-title">
                            <h3 class="card-label text-gray-700">Filter Bukti Penggajian</h3>
                          </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('buktinya') }}" method="GET">
                              @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group justify-content-center">
                                            <label for="example-month-input" class="col-form-label">Month:</label>
                                            
                                            <input class="form-control" type="month" nama="tanggal" value="2011-08" id="example-month-input"/>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group justify-content-center">
                                            <label for="pegawai" class="col-form-label">Pegawai:</label>
                                            
                                            <select name="pegawai_id" id="pegawai_id" class="form-control">
                                                @foreach ($pegawai as $p)
                                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <input type="submit" value="Submit" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-8 col-12">
                      <div class="card card-custom gutter-b border-0 shadow">
                        <div class="card-header">
                          <div class="card-title">
                            <h3 class="card-label text-gray-700">List Bukti penggajian</h3>
                          </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover scroll-horizontal-vertical w-100">
                              <thead class="text-sm border-b select-none bg-primary-o-50 rounded-bottom">
                                <tr>
                                  {{-- <th class="px-6 py-3 font-bold text-center uppercase">No</th> --}}
                                  <th class="px-6 py-3 font-bold text-left uppercase">Nama Pegawai</th>
                                  <th class="px-6 py-3 font-bold text-left uppercase">Tanggal Awal</th>
                                  <th class="px-6 py-3 font-bold text-left uppercase">Tanggal Akhir</th>
                                  <th class="px-6 py-3 font-bold text-left uppercase">Total Gaji</th>
                                  <th class="px-6 py-3 font-bold text-right uppercase">Aksi</th>
                                </tr>
                              </thead>
                              <tbody class="text-sm text-gray-700 bg-white divide-y divide-secondary-300">
                                @if ($gaji->count() > 0)
                                @foreach ($gaji as $gaj)
                                <tr>
                                  <td class="w-10 px-6 py-3 leading-6 sm:w-auto">{{ $gaj->pegawai->nama }}</td>
                                  <td class="px-6 py-3 leading-6">{{ $gaj->tanggal_awal }}</td>
                                  <td class="px-6 py-3 leading-6">{{ $gaj->tanggal_akhir }}</td>
                                  <td class="px-6 py-3 leading-6">{{ $gaj->total_gaji }}</td>
                                  <td class="px-6 text-right select-none whitespace-nowrap">
                                    
                                    <a class="btn-sm btn-primary" href="{{ route('gaji.show', $gaj->id) }}">
                                      <i class="fas fa-print icon-sm-1x text-white"></i>
                                    </a>
                                  </td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="select-none">
                                  <td class="px-6 py-3 leading-4 text-center whitespace-nowrap">-</td>
                                  <td class="px-6 py-3 leading-4 whitespace-nowrap">-</td>
                                  <td class="px-6 py-3 leading-4 whitespace-nowrap">-</td>
                                  <td class="px-6 text-right whitespace-nowrap">-</td>
                                  <td class="px-6 text-right whitespace-nowrap">-</td>
                                </tr>
                                @endif
                              </tbody>
                            </table>
                        </div>
                      </div>
                  </div>
              </div>
          </div>

        </div>
        <!-- /.container-fluid -->

@endsection

@push('addon-script')

    <script>
        // AJAX DataTable
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'DT_RowIndex', name:'DT_RowIndex'},
                { data: 'pegawai.nama', name: 'pegawai.nama' },
                { data: 'tanggal_awal', name: 'tanggal_awal' },
                { data: 'tanggal_akhir', name: 'tanggal_akhir' },
                { data: 'total_gaji', name: 'total_gaji' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
    </script>
@endpush