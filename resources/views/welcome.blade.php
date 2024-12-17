<?php

namespace App\Http\Controllers;

use App\Models\UsahaDesa;   // Pastikan model UsahaDesa sudah ada
use App\Models\Penduduk;    // Jika Anda ingin menampilkan jumlah penduduk
use App\Models\Fasilitas;   // Jika ingin menampilkan jumlah fasilitas
use Illuminate\Http\Request;

class UsahaDesaController extends Controller
{
    public function index()
    {
        // Menghitung jumlah total usaha desa
        $totalUsahaDesa = UsahaDesa::count();

        // Menghitung jumlah usaha berdasarkan jenis
        $usahaIndustri = UsahaDesa::where('jenis_usaha', 'Industri')->count();
        $usahaPertanian = UsahaDesa::where('jenis_usaha', 'Pertanian')->count();
        $usahaPerdagangan = UsahaDesa::where('jenis_usaha', 'Perdagangan')->count();

        // Menghitung jumlah penduduk
        $totalPenduduk = Penduduk::count();

        // Menghitung jumlah penduduk berdasarkan jenis kelamin
        $jumlahLakiLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();

        // Menghitung jumlah fasilitas
        $totalUsahaDesa = UsahaDesa::count();

        // Mengirim data ke tampilan dashboard
        return view('usaha_desa_dashboard', compact(
            'totalUsahaDesa',
            'usahaIndustri',
            'usahaPertanian',
            'usahaPerdagangan',
            'totalPenduduk',
            'jumlahLakiLaki',
            'jumlahPerempuan',
            'totalFasilitas'
        ));
    }
}
