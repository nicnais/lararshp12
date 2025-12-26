@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Edit Kategori</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
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
                    
                    <form action="{{ route('admin.kategori.update', $kategori->idkategori) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nama_kategori" 
                                       name="nama_kategori" 
                                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                                       required>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Update</button>
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection