<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agenda;

use Carbon\Carbon;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agenda::insert([
            [
                'user_id' => null,
                'judul' => 'Rapat Evaluasi Bulanan',
                'tempat_kegiatan' => 'Ruang Rapat 1',
                'tgl_kegiatan' => '2025-08-05',
                'jam_mulai' => '09:00:00',
                'deskripsi_kegiatan' => 'Membahas hasil evaluasi kerja bulan Juli.',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'judul' => 'Sosialisasi Kurikulum Baru',
                'tempat_kegiatan' => 'Aula Utama',
                'tgl_kegiatan' => '2025-08-07',
                'jam_mulai' => '10:00:00',
                'deskripsi_kegiatan' => 'Pemaparan mengenai perubahan kurikulum terbaru.',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'judul' => 'Workshop Pengembangan Diri',
                'tempat_kegiatan' => 'Lab Komputer',
                'tgl_kegiatan' => '2025-08-10',
                'jam_mulai' => '08:30:00',
                'deskripsi_kegiatan' => 'Pelatihan peningkatan kompetensi guru.',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'judul' => 'Rapat Koordinasi Tim IT',
                'tempat_kegiatan' => 'Ruang IT',
                'tgl_kegiatan' => '2025-08-11',
                'jam_mulai' => '14:00:00',
                'deskripsi_kegiatan' => 'Koordinasi pengembangan sistem informasi sekolah.',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'judul' => 'Rapat Persiapan Ujian',
                'tempat_kegiatan' => 'Ruang Guru',
                'tgl_kegiatan' => '2025-08-13',
                'jam_mulai' => '09:00:00',
                'deskripsi_kegiatan' => 'Diskusi teknis pelaksanaan ujian semester.',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
