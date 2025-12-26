<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib Import DB
use Exception;

class rashewanController extends Controller
{
    public function index()
    {
        // QUERY BUILDER: Join Table Ras -> Jenis Hewan
        $ras_hewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
            ->get();
            
        return view('admin.ras_hewan.index', compact('ras_hewan'));
    }

    public function create()
    {
        // Ambil data jenis hewan untuk dropdown
        $jenis_hewan = DB::table('jenis_hewan')->get();
        
        return view('admin.ras_hewan.create', compact('jenis_hewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => ['required', 'string', 'max:255'],
            'idjenis_hewan' => ['required', 'exists:jenis_hewan,idjenis_hewan']
        ]);

        try {
            // QUERY BUILDER: Insert Data
            DB::table('ras_hewan')->insert([
                'nama_ras' => trim(ucwords(strtolower($request->nama_ras))),
                'idjenis_hewan' => $request->idjenis_hewan,
                // 'created_at' => now(), // Uncomment jika ada timestamp
            ]);

            return redirect()->route('admin.ras-hewan.index')
                             ->with('success', 'Ras hewan berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // METHOD EDIT
    public function edit($id)
    {
        // Ambil data ras yang akan diedit
        $ras_hewan = DB::table('ras_hewan')->where('idras_hewan', $id)->first();
        
        // Ambil data jenis hewan untuk dropdown
        $jenis_hewan = DB::table('jenis_hewan')->get();

        return view('admin.ras_hewan.edit', compact('ras_hewan', 'jenis_hewan'));
    }

    // METHOD UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ras' => ['required', 'string', 'max:255'],
            'idjenis_hewan' => ['required', 'exists:jenis_hewan,idjenis_hewan']
        ]);

        DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->update([
                'nama_ras' => trim(ucwords(strtolower($request->nama_ras))),
                'idjenis_hewan' => $request->idjenis_hewan
            ]);

        return redirect()->route('admin.ras-hewan.index')
                         ->with('success', 'Data berhasil diupdate.');
    }

    // METHOD DESTROY
    public function destroy($id)
    {
        DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->delete();

        return redirect()->route('admin.ras-hewan.index')
                         ->with('success', 'Data berhasil dihapus.');
    }
}