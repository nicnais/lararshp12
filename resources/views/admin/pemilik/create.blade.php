@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Tambah Pemilik</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Pemilik</a></li>
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
                        <h3 class="card-title">Form Tambah Data</h3>
                    </div>
                    
                    <form action="{{ route('admin.pemilik.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            {{-- Dropdown User --}}
                            <div class="mb-3">
                                <label for="iduser" class="form-label">Pilih User Akun</label>
                                <select class="form-select @error('iduser') is-invalid @enderror" id="iduser" name="iduser">
                                    <option value="">-- Pilih User --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                            {{ $user->nama }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('iduser')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- No WA --}}
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No. WhatsApp</label>
                                <input type="text" class="form-control @error('no_wa') is-invalid @enderror" 
                                       id="no_wa" name="no_wa" value="{{ old('no_wa') }}" placeholder="08xxx">
                                @error('no_wa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection