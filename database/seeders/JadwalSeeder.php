<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = Carbon::today();

        $jadwals = [];

        // ========================
        // KELAS 1-2 (Wali 4 JP/hari)
        // ========================
        $jadwals[] = [
            'user_id' => 1, // wali kelas 1A
            'mapel_id' => 1, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '08:10:00', // 4 JP
            'keterangan' => 'ya'
        ];
        $jadwals[] = [
            'user_id' => 1, // wali kelas 1
            'mapel_id' => 2,
            'tanggal' => $today,
            'jam_mulai' => '08:10:00',
            'jam_selesai' => '08:50:00', // 4 JP
            'keterangan' => 'ya'
        ];
        $jadwals[] = [
            'user_id' => 1, // wali kelas 1
            'mapel_id' => 3,
            'tanggal' => $today,
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '10:40:00', // 4 JP
            'keterangan' => 'ya'
        ];

        $jadwals[] = [
            'user_id' => 1, // wali kelas 1A
            'mapel_id' => 4, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '10:40:00',
            'jam_selesai' => '11:20:00', // 4 JP
            'keterangan' => 'ya'
        ];

        //1C
        $jadwals[] = [
            'user_id' => 2, // wali kelas 11C
            'mapel_id' => 1, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '08:10:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 2, // wali kelas 1C
            'mapel_id' => 2,
            'tanggal' => $today,
            'jam_mulai' => '08:10:00',
            'jam_selesai' => '08:50:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 2, // wali kelas 1C
            'mapel_id' => 3,
            'tanggal' => $today,
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '10:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        $jadwals[] = [
            'user_id' => 2, // wali kelas 11C
            'mapel_id' => 4, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '10:40:00',
            'jam_selesai' => '11:20:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        //2C
        $jadwals[] = [
            'user_id' => 3, // wali kelas 11C
            'mapel_id' => 1, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '08:10:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 3, // wali kelas 1C
            'mapel_id' => 2,
            'tanggal' => $today,
            'jam_mulai' => '08:10:00',
            'jam_selesai' => '08:50:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 3, // wali kelas 1C
            'mapel_id' => 3,
            'tanggal' => $today,
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '10:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        $jadwals[] = [
            'user_id' => 3, // wali kelas 11C
            'mapel_id' => 4, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '10:40:00',
            'jam_selesai' => '11:20:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        //3A
        $jadwals[] = [
            'user_id' => 4, // wali kelas 11C
            'mapel_id' => 1, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '08:10:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 4, // wali kelas 1C
            'mapel_id' => 2,
            'tanggal' => $today,
            'jam_mulai' => '08:10:00',
            'jam_selesai' => '08:50:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 4, // wali kelas 1C
            'mapel_id' => 3,
            'tanggal' => $today,
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '10:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        $jadwals[] = [
            'user_id' => 4, // wali kelas 11C
            'mapel_id' => 4, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '10:40:00',
            'jam_selesai' => '11:20:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 4, // wali kelas 11C
            'mapel_id' => 5, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '11:20:00',
            'jam_selesai' => '12:00:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        //3C
        $jadwals[] = [
            'user_id' => 5, // wali kelas 11C
            'mapel_id' => 1, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '08:10:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 5, // wali kelas 1C
            'mapel_id' => 2,
            'tanggal' => $today,
            'jam_mulai' => '08:10:00',
            'jam_selesai' => '08:50:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 5, // wali kelas 1C
            'mapel_id' => 3,
            'tanggal' => $today,
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '10:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        $jadwals[] = [
            'user_id' => 5, // wali kelas 11C
            'mapel_id' => 4, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '10:40:00',
            'jam_selesai' => '11:20:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 5, // wali kelas 11C
            'mapel_id' => 5, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '11:20:00',
            'jam_selesai' => '12:00:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        //4B
        $jadwals[] = [
            'user_id' => 6, // wali kelas 11C
            'mapel_id' => 1, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '08:10:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 6, // wali kelas 1C
            'mapel_id' => 2,
            'tanggal' => $today,
            'jam_mulai' => '08:10:00',
            'jam_selesai' => '08:50:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 6, // wali kelas 1C
            'mapel_id' => 3,
            'tanggal' => $today,
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '10:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        $jadwals[] = [
            'user_id' => 6, // wali kelas 11C
            'mapel_id' => 4, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '10:40:00',
            'jam_selesai' => '11:20:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 6, // wali kelas 11C
            'mapel_id' => 5, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '11:20:00',
            'jam_selesai' => '12:00:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 6, // wali kelas 11C
            'mapel_id' => 6, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '13:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        //5B
        $jadwals[] = [
            'user_id' => 7, // wali kelas 11C
            'mapel_id' => 1, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '08:10:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 7, // wali kelas 1C
            'mapel_id' => 2,
            'tanggal' => $today,
            'jam_mulai' => '08:10:00',
            'jam_selesai' => '08:50:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 7, // wali kelas 1C
            'mapel_id' => 3,
            'tanggal' => $today,
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '10:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        $jadwals[] = [
            'user_id' => 7, // wali kelas 11C
            'mapel_id' => 4, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '10:40:00',
            'jam_selesai' => '11:20:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 7, // wali kelas 11C
            'mapel_id' => 5, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '11:20:00',
            'jam_selesai' => '12:00:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 7, // wali kelas 11C
            'mapel_id' => 6, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '13:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        //6B
        $jadwals[] = [
            'user_id' => 8, // wali kelas 11C
            'mapel_id' => 1, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '08:10:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 8, // wali kelas 1C
            'mapel_id' => 2,
            'tanggal' => $today,
            'jam_mulai' => '08:10:00',
            'jam_selesai' => '08:50:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 8, // wali kelas 1C
            'mapel_id' => 3,
            'tanggal' => $today,
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '10:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];

        $jadwals[] = [
            'user_id' => 8, // wali kelas 11C
            'mapel_id' => 4, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '10:40:00',
            'jam_selesai' => '11:20:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 8, // wali kelas 11C
            'mapel_id' => 5, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '11:20:00',
            'jam_selesai' => '12:00:00', // 4 JP
            'keterangan' => 'tidak'
        ];
        $jadwals[] = [
            'user_id' => 8, // wali kelas 11C
            'mapel_id' => 6, // contoh: Gowa Angngaji
            'tanggal' => $today,
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '13:40:00', // 4 JP
            'keterangan' => 'tidak'
        ];



        // ========================
        // MAPEL TAMBAHAN (2 JP/kelas)
        // ========================
        $mapelTambahan = [
            ['user_id' => 9, 'mapel_id' => 7, 'nama' => 'PJOK'],
            ['user_id' => 9, 'mapel_id' => 7, 'nama' => 'PJOK'],
            ['user_id' => 9, 'mapel_id' => 7, 'nama' => 'PJOK'],

            ['user_id' => 10, 'mapel_id' => 8, 'nama' => 'PJOK'],
            ['user_id' => 10, 'mapel_id' => 8, 'nama' => 'PJOK'],
            ['user_id' => 10, 'mapel_id' => 8, 'nama' => 'PJOK'],

            ['user_id' => 11, 'mapel_id' => 9, 'nama' => 'PAI'],
            ['user_id' => 11, 'mapel_id' => 9, 'nama' => 'PAI'],
            ['user_id' => 11, 'mapel_id' => 9, 'nama' => 'PAI'],
            ['user_id' => 11, 'mapel_id' => 9, 'nama' => 'PAI'],
            ['user_id' => 11, 'mapel_id' => 9, 'nama' => 'PAI'],
            ['user_id' => 11, 'mapel_id' => 9, 'nama' => 'PAI'],
        ];

        $start = Carbon::createFromTime(11, 00, 0); // mulai setelah wali kelas
        foreach ($mapelTambahan as $m) {
            $jadwals[] = [
                'user_id' => $m['user_id'],
                'mapel_id' => $m['mapel_id'],
                'tanggal' => $today,
                'jam_mulai' => $start->format('H:i:s'),
                'jam_selesai' => $start->copy()->addMinutes(80)->format('H:i:s'), // 2 JP
                'keterangan' => "tidak"
            ];
            $start->addMinutes(90); // geser 2 JP + 10 menit transisi
        }

        DB::table('jadwals')->insert($jadwals);
    }
}
