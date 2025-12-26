@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Edit Jenis Hewan</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.jenis-hewan.index') }}">Jenis Hewan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Data</h3>
                    </div>
                    
                    <form action="{{ route('admin.jenis-hewan.update', $jenis_hewan->idjenis_hewan) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Wajib ada untuk proses update --}}
                        
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
                                <input type="text" 
                                       class="form-control @error('nama_jenis_hewan') is-invalid @enderror" 
                                       id="nama_jenis_hewan" 
                                       name="nama_jenis_hewan" 
                                       value="{{ old('nama_jenis_hewan', $jenis_hewan->nama_jenis_hewan) }}">
                                
                                @error('nama_jenis_hewan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Update</button>
                            <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection