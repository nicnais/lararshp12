@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Tambah Ras Hewan</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.ras-hewan.index') }}">Ras Hewan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Data</h3>
                    </div>
                    
                    <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            {{-- Dropdown Jenis Hewan --}}
                            <div class="mb-3">
                                <label for="idjenis_hewan" class="form-label">Jenis Hewan</label>
                                <select class="form-select @error('idjenis_hewan') is-invalid @enderror" 
                                        id="idjenis_hewan" name="idjenis_hewan" required>
                                    <option value="">-- Pilih Jenis Hewan --</option>
                                    @foreach($jenis_hewan as $jenis)
                                        <option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                            {{ $jenis->nama_jenis_hewan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idjenis_hewan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Input Nama Ras --}}
                            <div class="mb-3">
                                <label for="nama_ras" class="form-label">Nama Ras</label>
                                <input type="text" 
                                       class="form-control @error('nama_ras') is-invalid @enderror" 
                                       id="nama_ras" 
                                       name="nama_ras" 
                                       value="{{ old('nama_ras') }}" 
                                       placeholder="Contoh: Persia" 
                                       required>
                                @error('nama_ras')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection