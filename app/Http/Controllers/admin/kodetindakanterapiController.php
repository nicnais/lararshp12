<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib Import DB
use Exception;

class kodetindakanterapiController extends Controller
{
    public function index()
    {
        // QUERY BUILDER: Join 3 Tabel (Kode Tindakan -> Kategori -> Kategori Klinis)
        $kode_tindakan_terapi = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*', 
                'kategori.nama_kategori', 
                'kategori_klinis.nama_kategori_klinis'
            )
            ->get();

        return view('admin.kode_tindakan_terapi.index', compact('kode_tindakan_terapi'));
    }

    public function create()
    {
        // Ambil data untuk dropdown
        $kategori = DB::table('kategori')->get();
        $kategori_klinis = DB::table('kategori_klinis')->get();

        return view('admin.kode_tindakan_terapi.create', compact('kategori', 'kategori_klinis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:kode_tindakan_terapi,kode'],
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:255'],
            'idkategori' => ['required', 'exists:kategori,idkategori'],
            'idkategori_klinis' => ['required', 'exists:kategori_klinis,idkategori_klinis'],
        ]);

        try {
            // QUERY BUILDER: Insert
            DB::table('kode_tindakan_terapi')->insert([
                'kode' => strtoupper($request->kode),
                'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
                'idkategori' => $request->idkategori,
                'idkategori_klinis' => $request->idkategori_klinis,
            ]);

            return redirect()->route('admin.kode-tindakan-terapi.index')
                             ->with('success', 'Data berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // METHOD EDIT
    public function edit($id)
    {
        // Ambil data yang akan diedit
        $data = DB::table('kode_tindakan_terapi')
                  ->where('idkode_tindakan_terapi', $id)
                  ->first();

        // Ambil data untuk dropdown
        $kategori = DB::table('kategori')->get();
        $kategori_klinis = DB::table('kategori_klinis')->get();

        return view('admin.kode_tindakan_terapi.edit', compact('data', 'kategori', 'kategori_klinis'));
    }

    // METHOD UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => ['required', 'string', 'max:50'], // Unique dihapus sementara atau disesuaikan agar ignore ID ini
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:255'],
            'idkategori' => ['required', 'exists:kategori,idkategori'],
            'idkategori_klinis' => ['required', 'exists:kategori_klinis,idkategori_klinis'],
        ]);

        DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->update([
                'kode' => strtoupper($request->kode),
                'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
                'idkategori' => $request->idkategori,
                'idkategori_klinis' => $request->idkategori_klinis,
            ]);

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Data berhasil diupdate.');
    }

    // METHOD DESTROY
    public function destroy($id)
    {
        DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->delete();

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Data berhasil dihapus.');
    }
}