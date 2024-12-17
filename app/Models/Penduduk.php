<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'penduduk';

    // Menentukan kolom mana yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama_penduduk',
        'alamat',
        'rt_rw',
        'usia',
        'jenis_kelamin'
    ];

    // Relasi ke model UsahaDesa (Penduduk memiliki banyak UsahaDesa)
    public function usahaDesa()
    {
        return $this->hasMany(UsahaDesa::class, 'penduduk_id', 'id');
    }
}
