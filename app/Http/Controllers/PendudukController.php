<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\UsahaDesa;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    // Menampilkan daftar penduduk
    public function index()
    {
        // Mendapatkan semua data penduduk
        $penduduk = Penduduk::with('usahaDesa')->get();
        
        // Mengembalikan view dengan data penduduk
        return view('penduduk.index', compact('penduduk'));
    }

    // Menampilkan form untuk menambah penduduk baru
    public function create()
    {
        return view('penduduk.create');
    }

    // Menyimpan penduduk baru
    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'nama_penduduk' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'usia' => 'required|integer',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        // Membuat data penduduk baru
        $penduduk = Penduduk::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('penduduk.index')
                         ->with('success', 'Penduduk berhasil ditambahkan');
    }

    // Menampilkan detail penduduk dan usaha desanya
    public function show(Penduduk $penduduk)
    {
        // Mengambil semua usaha desa terkait penduduk ini
        $usahaDesa = $penduduk->usahaDesa;

        // Mengembalikan view dengan data penduduk dan usaha desa terkait
        return view('penduduk.show', compact('penduduk', 'usahaDesa'));
    }

    // Menampilkan form untuk mengedit penduduk
    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    // Mengupdate penduduk
    public function update(Request $request, Penduduk $penduduk)
    {
        // Validasi input dari pengguna
        $request->validate([
            'nama_penduduk' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'usia' => 'required|integer',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        // Mengupdate data penduduk dengan data baru
        $penduduk->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('penduduk.index')
                         ->with('success', 'Penduduk berhasil diupdate');
    }

    // Menghapus penduduk
    public function destroy(Penduduk $penduduk)
    {
        // Menghapus data penduduk
        $penduduk->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('penduduk.index')
                         ->with('success', 'Penduduk berhasil dihapus');
    }
}
