<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\UsahaDesa;
use Illuminate\Http\Request;

class UsahaDesaController extends Controller
{
    // Menampilkan daftar usaha desa
    public function index()
    {
        // Mendapatkan semua usaha desa beserta data penduduk terkait
        $usahaDesa = UsahaDesa::with('penduduk')->get();
        return view('usaha_desa.index', compact('usahaDesa'));
    }

    // Menampilkan form untuk menambah usaha desa baru
    public function create()
    {
        // Mengambil semua data penduduk
        $penduduk = Penduduk::all();
        return view('usaha_desa.create', compact('penduduk'));
    }

    // Menyimpan usaha desa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'penduduk_id' => 'required|exists:penduduk,id',
            'koordinat' => 'required|string',
        ]);

        UsahaDesa::create($request->all());

        return redirect()->route('usaha_desa.index')
                         ->with('success', 'Usaha Desa berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit usaha desa
    public function edit(UsahaDesa $usahaDesa)
    {
        $penduduk = Penduduk::all();
        return view('usaha_desa.edit', compact('usahaDesa', 'penduduk'));
    }

    // Mengupdate usaha desa
    public function update(Request $request, UsahaDesa $usahaDesa)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'penduduk_id' => 'required|exists:penduduk,id',
            'koordinat' => 'required|string',
        ]);

        $usahaDesa->update($request->all());

        return redirect()->route('usaha_desa.index')
                         ->with('success', 'Usaha Desa berhasil diperbarui');
    }
    public function show($id)
    {
        $usaha_desa = UsahaDesa::findOrFail($id);
        return view('usaha_desa.show', compact('usaha_desa'));
    }

    // Menghapus usaha desa
    public function destroy(UsahaDesa $usahaDesa)
    {
        $usahaDesa->delete();

        return redirect()->route('usaha_desa.index')
                         ->with('success', 'Usaha Desa berhasil dihapus');
    }
}
