@extends('layouts.app')

@section('content')

    <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb shadow-sm bg-white p-5">
              <li class="breadcrumb-item"><a href="/dashboard" style="text-decoration: none"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Lembur</li>
            </ol>
          </nav>

          <div class="content">
            <div class="card card-custom gutter-b border-0 shadow">
              <div class="card-header">
                <div class="card-title">
                  <h3 class="card-label text-gray-700">Edit Data Lembur</h3>
                </div>
              </div>
              <div class="card-body bg-white">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif
                  <form action="{{ route('lembur.update', $lembur->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="form-group">
                          <label for="pegawai_id">Nama pegawai:</label>
                          <select name="pegawai_id" id="pegawai_id" class="form-control">
                            <option value="" selected>--Tentukan Pegawai--</option>
                              @foreach ($pegawai as $b)
                                <option value="{{ $b->id }}" {{ old('pegawai_id', $lembur->pegawai_id) == $b->id ? 'selected' : '' }}>{{ $b->nama }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group">
                          <label for="status_lembur">Nama Pegawai:</label>
                          <select name="status_lembur" id="status_lembur" class="form-control">
                            @if ($lembur->status_lembur == 0)
                              <option value="" disabled>--Tentukan Status Lembur--</option>
                              <option value="0" selected>Not Verified</option>
                              <option value="1">Verified</option>
                              <option value="2">Finished</option>
                            @endif
                            @if ($lembur->status_lembur == 1)
                              <option value="" disabled>--Tentukan Status Lembur--</option>
                              <option value="0">Not Verified</option>
                              <option value="1" selected>Verified</option>
                              <option value="2">Finished</option>
                            @endif
                            @if ($lembur->status_lembur == 1)
                              <option value="" disabled>--Tentukan Status Lembur--</option>
                              <option value="0">Not Verified</option>
                              <option value="1">Verified</option>
                              <option value="2" selected>Finished</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="tanggal">Tanggal:</label>
                              <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $lembur->tanggal }}"> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jam_masuk_lembur">Jam Mulai:</label>
                                <input type="time" name="jam_masuk_lembur" id="jam_masuk_lembur" class="form-control" value="{{ $lembur->jam_masuk_lembur }}"> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jam_keluar_lembur">Jam Selesai:</label>
                                <input type="time" name="jam_keluar_lembur" id="jam_keluar_lembur" class="form-control" value="{{ $lembur->jam_keluar_lembur }}"> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan:</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{ $lembur->pekerjaan }}" placeholder="Pekerjaan..."> 
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="uraian_pekerjaan">Uraian Pekerjaan:</label>
                          <textarea name="uraian_pekerjaan" id="uraian_pekerjaan" cols="30" rows="10" class="form-control" placeholder="Uraian Pekerjaan..">{{ $lembur->uraian_pekerjaan }}</textarea>
                        </div>
                      </div>
                    </div>
                      <div class="form-group">
                          <div class="row p-3 justify-content-md-start">
                              <input type="submit" value="submit" class="btn btn-primary">
                              <input type="reset" value="Clear" class="btn btn-warning ml-2">
                              <a href="{{ route('lembur.index') }}" class="btn btn-dark ml-2"> <i class="fas fa-reply"></i>Back  </a>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

@endsection