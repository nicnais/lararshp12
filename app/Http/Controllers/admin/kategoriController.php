<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class kategoriController extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:kategori,nama_kategori']
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.'
        ]);

        try {
            DB::table('kategori')->insert([
                'nama_kategori' => trim(ucwords(strtolower($request->nama_kategori)))
            ]);
            
            return redirect()->route('admin.kategori.index')
                             ->with('success', 'Kategori berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $kategori = DB::table('kategori')->where('idkategori', $id)->first();
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        DB::table('kategori')->where('idkategori', $id)->update([
            'nama_kategori' => trim(ucwords(strtolower($request->nama_kategori)))
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('kategori')->where('idkategori', $id)->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil dihapus');
    }
}