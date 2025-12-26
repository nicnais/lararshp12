@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Edit Hewan</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Pet</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Data</h3>
                    </div>
                    
                    <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Hewan</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $pet->nama) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Warna / Tanda</label>
                                <input type="text" name="warna_tanda" class="form-control" value="{{ old('warna_tanda', $pet->warna_tanda) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="M" {{ $pet->jenis_kelamin == 'M' ? 'selected' : '' }}>Jantan</option>
                                    <option value="F" {{ $pet->jenis_kelamin == 'F' ? 'selected' : '' }}>Betina</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pemilik</label>
                                <select name="idpemilik" class="form-select" required>
                                    @foreach($pemilik as $p)
                                        <option value="{{ $p->idpemilik }}" {{ $pet->idpemilik == $p->idpemilik ? 'selected' : '' }}>
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ras Hewan</label>
                                <select name="idras_hewan" class="form-select" required>
                                    @foreach($ras_hewan as $ras)
                                        <option value="{{ $ras->idras_hewan }}" {{ $pet->idras_hewan == $ras->idras_hewan ? 'selected' : '' }}>
                                            {{ $ras->nama_ras }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Update</button>
                            <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection