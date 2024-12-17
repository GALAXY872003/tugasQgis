<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('usaha_desa', function (Blueprint $table) {
            $table->id(); // Kolom primary key
            $table->string('nama_usaha'); // Nama usaha
            $table->string('jenis_usaha'); // Jenis usaha
            $table->text('deskripsi')->nullable(); // Deskripsi usaha
            $table->unsignedBigInteger('penduduk_id'); // Foreign key ke tabel penduduk
            $table->string('koordinat'); // Lokasi usaha (alamat)
            $table->timestamps();

            // Relasi ke tabel penduduk
            $table->foreign('penduduk_id')->references('id')->on('penduduk')->onDelete('cascade');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('usaha_desa');
    }
};
