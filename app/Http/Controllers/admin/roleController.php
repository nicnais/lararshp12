<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib Import DB
use Exception;

class roleController extends Controller
{
    public function index()
    {
        // QUERY BUILDER: Ambil semua data role
        $role = DB::table('role')->get();
        return view('admin.role.index', compact('role'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => ['required', 'string', 'max:100', 'unique:role,nama_role']
        ], [
            'nama_role.required' => 'Nama role wajib diisi.',
            'nama_role.unique' => 'Nama role sudah ada.',
        ]);

        try {
            // QUERY BUILDER: Insert Data
            DB::table('role')->insert([
                'nama_role' => trim(ucwords(strtolower($request->nama_role)))
            ]);

            return redirect()->route('admin.role.index')
                             ->with('success', 'Role berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // METHOD EDIT
    public function edit($id)
    {
        // QUERY BUILDER: Ambil 1 data
        $role = DB::table('role')->where('idrole', $id)->first();
        return view('admin.role.edit', compact('role'));
    }

    // METHOD UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => ['required', 'string', 'max:100']
        ]);

        // QUERY BUILDER: Update Data
        DB::table('role')->where('idrole', $id)->update([
            'nama_role' => trim(ucwords(strtolower($request->nama_role)))
        ]);

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil diupdate.');
    }

    // METHOD DESTROY
    public function destroy($id)
    {
        // QUERY BUILDER: Hapus Data
        DB::table('role')->where('idrole', $id)->delete();
        
        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil dihapus.');
    }
}