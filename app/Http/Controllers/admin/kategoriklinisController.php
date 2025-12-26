<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib Import DB
use Exception;

class kategoriklinisController extends Controller
{
    public function index()
    {
        // QUERY BUILDER: Ambil semua data
        $kategori_klinis = DB::table('kategori_klinis')->get();
        return view('admin.kategori_klinis.index', compact('kategori_klinis'));
    }

    public function create()
    {
        return view('admin.kategori_klinis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_klinis' => [
                'required', 
                'string', 
                'max:255', 
                'unique:kategori_klinis,nama_kategori_klinis'
            ]
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada.',
        ]);

        try {
            // QUERY BUILDER: Insert Data
            DB::table('kategori_klinis')->insert([
                'nama_kategori_klinis' => trim(ucwords(strtolower($request->nama_kategori_klinis)))
            ]);

            return redirect()->route('admin.kategori-klinis.index')
                             ->with('success', 'Kategori Klinis berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // METHOD EDIT
    public function edit($id)
    {
        // QUERY BUILDER: Ambil 1 data berdasarkan ID
        $kategori_klinis = DB::table('kategori_klinis')
                             ->where('idkategori_klinis', $id)
                             ->first();

        return view('admin.kategori_klinis.edit', compact('kategori_klinis'));
    }

    // METHOD UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255'
        ]);

        // QUERY BUILDER: Update Data
        DB::table('kategori_klinis')
            ->where('idkategori_klinis', $id)
            ->update([
                'nama_kategori_klinis' => trim(ucwords(strtolower($request->nama_kategori_klinis)))
            ]);

        return redirect()->route('admin.kategori-klinis.index')
                         ->with('success', 'Data berhasil diupdate.');
    }

    // METHOD DESTROY
    public function destroy($id)
    {
        // QUERY BUILDER: Hapus Data
        DB::table('kategori_klinis')
            ->where('idkategori_klinis', $id)
            ->delete();

        return redirect()->route('admin.kategori-klinis.index')
                         ->with('success', 'Data berhasil dihapus.');
    }
}