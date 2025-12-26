@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Tambah Hewan</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Pet</a></li>
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
                        <h3 class="card-title">Form Data Hewan</h3>
                    </div>
                    
                    <form action="{{ route('admin.pet.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            {{-- Nama --}}
                            <div class="mb-3">
                                <label class="form-label">Nama Hewan</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                            </div>

                            {{-- Warna --}}
                            <div class="mb-3">
                                <label class="form-label">Warna / Tanda</label>
                                <input type="text" name="warna_tanda" class="form-control" value="{{ old('warna_tanda') }}" placeholder="Contoh: Belang Tiga" required>
                            </div>

                            {{-- JK --}}
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="M" {{ old('jenis_kelamin') == 'M' ? 'selected' : '' }}>Jantan</option>
                                    <option value="F" {{ old('jenis_kelamin') == 'F' ? 'selected' : '' }}>Betina</option>
                                </select>
                            </div>

                            {{-- Pemilik --}}
                            <div class="mb-3">
                                <label class="form-label">Pemilik</label>
                                <select name="idpemilik" class="form-select" required>
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach($pemilik as $p)
                                        <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Ras --}}
                            <div class="mb-3">
                                <label class="form-label">Ras Hewan</label>
                                <select name="idras_hewan" class="form-select" required>
                                    <option value="">-- Pilih Ras --</option>
                                    @foreach($ras_hewan as $ras)
                                        <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                                            {{ $ras->nama_ras }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection