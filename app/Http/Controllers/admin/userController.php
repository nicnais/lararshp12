<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   // Wajib: Import DB
use Illuminate\Support\Facades\Hash; // Wajib: Import Hash untuk password
use Exception;

class userController extends Controller
{
    public function index()
    {
        // QUERY BUILDER: Ambil semua data user
        $users = DB::table('user')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        try {
            // QUERY BUILDER: Insert Data
            DB::table('user')->insert([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Enkripsi password
                // 'created_at' => now(), // Uncomment jika ada
            ]);

            return redirect()->route('admin.user.index')
                             ->with('success', 'User berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // METHOD EDIT
    public function edit($id)
    {
        $user = DB::table('user')->where('iduser', $id)->first();
        return view('admin.user.edit', compact('user'));
    }

    // METHOD UPDATE
    public function update(Request $request, $id)
    {
        // Validasi: Email harus unique tapi kecualikan ID user ini
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'], // validasi unique manual atau abaikan sementara agar simpel
            // Password nullable (kosong berarti tidak diubah)
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Siapkan data update dasar
        $dataUpdate = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        // Jika password diisi, enkripsi dan masukkan ke data update
        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        // QUERY BUILDER: Update
        DB::table('user')->where('iduser', $id)->update($dataUpdate);

        return redirect()->route('admin.user.index')
                         ->with('success', 'Data user berhasil diupdate.');
    }

    // METHOD DESTROY
    public function destroy($id)
    {
        DB::table('user')->where('iduser', $id)->delete();
        return redirect()->route('admin.user.index')
                         ->with('success', 'Data user berhasil dihapus.');
    }
}