<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Indicators;

class IndicatorsSeeder extends Seeder
{
    public function run(): void
    {
        Indicators::insert([
            [
                'name' => 'Kehadiran',
                'skor' => 100,
                'description' => 'Persentase kehadiran guru selama periode berjalan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ketepatan Waktu',
                'skor' => 90,
                'description' => 'Kedisiplinan guru dalam memulai kelas tepat waktu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kualitas Pengajaran',
                'skor' => 95,
                'description' => 'Penilaian terhadap metode dan materi pengajaran.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partisipasi Rapat',
                'skor' => 85,
                'description' => 'Keaktifan dalam menghadiri dan berkontribusi dalam rapat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kelengkapan Administrasi',
                'skor' => 92,
                'description' => 'Kepatuhan terhadap pengumpulan administrasi mengajar.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
