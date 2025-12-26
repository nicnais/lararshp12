@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Data Hewan (Pet)</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pet</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Hewan Terdaftar</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.pet.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama Hewan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Ras</th>
                                    <th>Pemilik</th>
                                    <th style="width: 150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pet as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $item->nama }}</strong><br>
                                        <small class="text-muted">{{ $item->warna_tanda }}</small>
                                    </td>
                                    <td>
                                        @if($item->jenis_kelamin == 'M')
                                            <span class="badge text-bg-primary">Jantan</span>
                                        @else
                                            <span class="badge text-bg-danger">Betina</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->nama_ras }}</td>
                                    <td>{{ $item->nama_pemilik }}</td>
                                    <td>
                                        <a href="{{ route('admin.pet.edit', $item->idpet) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.pet.destroy', $item->idpet) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data hewan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center">Data tidak tersedia</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection