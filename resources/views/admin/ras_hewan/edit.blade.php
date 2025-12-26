@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Edit Ras Hewan</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.ras-hewan.index') }}">Ras Hewan</a></li>
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
                    
                    <form action="{{ route('admin.ras-hewan.update', $ras_hewan->idras_hewan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="card-body">
                            {{-- Dropdown Jenis Hewan --}}
                            <div class="mb-3">
                                <label for="idjenis_hewan" class="form-label">Jenis Hewan</label>
                                <select class="form-select" name="idjenis_hewan" required>
                                    @foreach($jenis_hewan as $jenis)
                                        <option value="{{ $jenis->idjenis_hewan }}" 
                                            {{ $ras_hewan->idjenis_hewan == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                            {{ $jenis->nama_jenis_hewan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Input Nama Ras --}}
                            <div class="mb-3">
                                <label for="nama_ras" class="form-label">Nama Ras</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="nama_ras" 
                                       value="{{ old('nama_ras', $ras_hewan->nama_ras) }}" 
                                       required>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Update</button>
                            <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection