@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Tambah Data</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.kode-tindakan-terapi.index') }}">Kode Tindakan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Kode Tindakan</h3>
                    </div>
                    
                    <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            {{-- Kode --}}
                            <div class="mb-3">
                                <label class="form-label">Kode</label>
                                <input type="text" name="kode" class="form-control" placeholder="Contoh: K001" value="{{ old('kode') }}" required>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input type="text" name="deskripsi_tindakan_terapi" class="form-control" placeholder="Contoh: Pemeriksaan Umum" value="{{ old('deskripsi_tindakan_terapi') }}" required>
                            </div>

                            {{-- Kategori --}}
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="idkategori" class="form-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->idkategori }}" {{ old('idkategori') == $kat->idkategori ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Kategori Klinis --}}
                            <div class="mb-3">
                                <label class="form-label">Kategori Klinis</label>
                                <select name="idkategori_klinis" class="form-select" required>
                                    <option value="">-- Pilih Kategori Klinis --</option>
                                    @foreach($kategori_klinis as $klinis)
                                        <option value="{{ $klinis->idkategori_klinis }}" {{ old('idkategori_klinis') == $klinis->idkategori_klinis ? 'selected' : '' }}>
                                            {{ $klinis->nama_kategori_klinis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection