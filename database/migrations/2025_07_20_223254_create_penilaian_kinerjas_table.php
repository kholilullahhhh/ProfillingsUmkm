<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaian_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            // Periode penilaian (format YYYY-MM)
            $table->string('bulan', 7); // contoh: 2025-04

            // Nilai indikator dalam persentase
            $table->decimal('kehadiran_mengajar', 5, 2)->default(0);   // 0-100
            $table->decimal('ketepatan_waktu', 5, 2)->default(0);      // 0-100
            $table->decimal('jam_mengajar', 5, 2)->default(0);         // 0-100
            $table->decimal('pengisian_nilai', 5, 2)->default(0);      // 0-100
            $table->decimal('kehadiran_rapat', 5, 2)->default(0);      // 0-100

            // Skor akhir dan kategori
            $table->decimal('skor_akhir', 6, 2)->default(0);
            $table->enum('kategori', ['Sangat Baik', 'Baik', 'Cukup', 'Kurang']);

            // Detail (jika ingin menyimpan semua data mentah sebagai JSON)
            $table->json('detail')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_kinerjas');
    }
};
