<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib Import DB
use Exception;

class petController extends Controller
{
    public function index()
    {
        // QUERY BUILDER: Join 4 Tabel (Pet -> Pemilik -> User, Pet -> Ras)
        $pet = DB::table('pet')
                  ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
                  ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                  ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
                  ->select(
                      'pet.*', 
                      'user.nama as nama_pemilik', 
                      'ras_hewan.nama_ras'
                  )
                  ->orderBy('pet.idpet', 'desc')
                  ->get();

        return view('admin.pet.index', compact('pet'));
    }

    public function create()
    {
        // Ambil data Pemilik (Join User untuk dapat nama orangnya)
        $pemilik = DB::table('pemilik')
                     ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                     ->select('pemilik.idpemilik', 'user.nama')
                     ->get();

        // Ambil data Ras Hewan
        $ras_hewan = DB::table('ras_hewan')->get();

        return view('admin.pet.create', compact('pemilik', 'ras_hewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'warna_tanda' => ['required', 'string', 'max:45'],
            'jenis_kelamin' => ['required', 'in:M,F'],
            'idpemilik' => ['required', 'exists:pemilik,idpemilik'],
            'idras_hewan' => ['required', 'exists:ras_hewan,idras_hewan'],
        ]);

        try {
            DB::table('pet')->insert([
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'warna_tanda' => $request->warna_tanda,
                'jenis_kelamin' => $request->jenis_kelamin,
                'idpemilik' => $request->idpemilik,
                'idras_hewan' => $request->idras_hewan,
                // 'created_at' => now(), // Uncomment jika ada
            ]);

            return redirect()->route('admin.pet.index')
                             ->with('success', 'Data Hewan berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // METHOD EDIT
    public function edit($id)
    {
        $pet = DB::table('pet')->where('idpet', $id)->first();
        
        // Data pendukung untuk dropdown
        $pemilik = DB::table('pemilik')
                     ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                     ->select('pemilik.idpemilik', 'user.nama')
                     ->get();
        $ras_hewan = DB::table('ras_hewan')->get();

        return view('admin.pet.edit', compact('pet', 'pemilik', 'ras_hewan'));
    }

    // METHOD UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'warna_tanda' => ['required', 'string', 'max:45'],
            'jenis_kelamin' => ['required', 'in:M,F'],
            'idpemilik' => ['required', 'exists:pemilik,idpemilik'],
            'idras_hewan' => ['required', 'exists:ras_hewan,idras_hewan'],
        ]);

        DB::table('pet')->where('idpet', $id)->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'warna_tanda' => $request->warna_tanda,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
        ]);

        return redirect()->route('admin.pet.index')->with('success', 'Data Hewan berhasil diupdate.');
    }

    // METHOD DESTROY
    public function destroy($id)
    {
        DB::table('pet')->where('idpet', $id)->delete();
        return redirect()->route('admin.pet.index')->with('success', 'Data Hewan berhasil dihapus.');
    }
}