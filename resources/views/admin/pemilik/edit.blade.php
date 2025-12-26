@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Edit Pemilik</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Pemilik</a></li>
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
                    
                    <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="card-body">
                            {{-- User (Read Only saat Edit agar tidak error relasi) --}}
                            <div class="mb-3">
                                <label class="form-label">User Akun</label>
                                <select class="form-select" disabled>
                                    @foreach($users as $user)
                                        <option value="{{ $user->iduser }}" {{ $pemilik->iduser == $user->iduser ? 'selected' : '' }}>
                                            {{ $user->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">User tidak dapat diubah pada menu edit.</small>
                            </div>

                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No. WhatsApp</label>
                                <input type="text" class="form-control" name="no_wa" value="{{ old('no_wa', $pemilik->no_wa) }}">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3">{{ old('alamat', $pemilik->alamat) }}</textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Update</button>
                            <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection