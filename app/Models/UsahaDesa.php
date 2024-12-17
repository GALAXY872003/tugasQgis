<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsahaDesa extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'usaha_desa';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama_usaha', 'jenis_usaha', 'deskripsi', 'penduduk_id', 'koordinat'
    ];

    // Relasi dengan model Penduduk
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}
