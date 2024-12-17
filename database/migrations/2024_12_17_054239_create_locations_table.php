<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id(); // Kolom primary key
            $table->string('nama'); // Nama lokasi
            $table->text('deskripsi')->nullable(); // Deskripsi lokasi
            $table->string('gambar')->nullable(); // Nama atau path file gambar
            $table->decimal('latitude', 10, 8); // Koordinat latitude
            $table->decimal('longitude', 11, 8); // Koordinat longitude
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
