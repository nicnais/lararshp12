<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class pemilikController extends Controller
{
    public function index()
    {
        $pemilik = DB::table('pemilik')
                    ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                    ->select('pemilik.*', 'user.nama as nama_user', 'user.email')
                    ->get();
                    
        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        $users = DB::table('user')->get();
        return view('admin.pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validasi tetap sama
        $request->validate([
            'iduser' => ['required', 'exists:user,iduser', 'unique:pemilik,iduser'], 
            'no_wa' => ['required', 'string', 'max:45'],
            'alamat' => ['required', 'string', 'max:100'],
        ]);

        try {
            DB::table('pemilik')->insert([
                'iduser' => $request->iduser,
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);

            return redirect()->route('admin.pemilik.index')->with('success', 'Data Pemilik berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        $users = DB::table('user')->get();

        return view('admin.pemilik.edit', compact('pemilik', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_wa' => ['required', 'string', 'max:45'],
            'alamat' => ['required', 'string', 'max:100'],
        ]);

        DB::table('pemilik')->where('idpemilik', $id)->update([
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.pemilik.index')->with('success', 'Data Pemilik berhasil diupdate.');
    }

    public function destroy($id)
    {
        DB::table('pemilik')->where('idpemilik', $id)->delete();
        
        return redirect()->route('admin.pemilik.index')->with('success', 'Data Pemilik berhasil dihapus.');
    }
}