<?php

namespace App\Http\Controllers;

use App\Models\UsahaDesa;  // Pastikan model Fasilitas sudah ada
use App\Models\Penduduk;   // Jika Anda juga ingin menampilkan jumlah penduduk
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Fungsi untuk menampilkan dashboard
    public function index()
    {
        // Ambil jumlah total penduduk
        $totalPenduduk = Penduduk::count();

        // Ambil jumlah fasilitas
        $usaha_desa = UsahaDesa::count();

        // Ambil jumlah penduduk berdasarkan jenis kelamin
        $jumlahLakiLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();

        // Kirim data ke view
        return view('dashboard', compact('totalPenduduk', 'usaha_desa', 'jumlahLakiLaki', 'jumlahPerempuan'));
    }
}
