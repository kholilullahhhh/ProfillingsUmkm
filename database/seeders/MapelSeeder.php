<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapels = [
            // Kelas 1-2
            ['nama' => 'Gowa Angngaji', 'kelompok_kelas' => '1-2'],
            ['nama' => 'Bahasa Indonesia', 'kelompok_kelas' => '1-2'],
            ['nama' => 'Kokurikuler', 'kelompok_kelas' => '1-2'],
            ['nama' => 'PKN', 'kelompok_kelas' => '1-2'],
            ['nama' => 'Matematika', 'kelompok_kelas' => '1-2'],
            ['nama' => 'Mulok', 'kelompok_kelas' => '1-2'],
            ['nama' => 'SBDP', 'kelompok_kelas' => '1-2'],
            ['nama' => 'PJOK', 'kelompok_kelas' => '1-3'],
            ['nama' => 'PAI', 'kelompok_kelas' => '1-6'],

            // Kelas 3-6
            ['nama' => 'Gowa Angngaji', 'kelompok_kelas' => '3-6'],
            ['nama' => 'Bahasa Indonesia', 'kelompok_kelas' => '3-6'],
            ['nama' => 'Kokurikuler', 'kelompok_kelas' => '3-6'],
            ['nama' => 'PKN', 'kelompok_kelas' => '3-6'],
            ['nama' => 'Matematika', 'kelompok_kelas' => '3-6'],
            ['nama' => 'Mulok', 'kelompok_kelas' => '3-6'],
            ['nama' => 'SBDP', 'kelompok_kelas' => '3-6'],
            ['nama' => 'IPAS', 'kelompok_kelas' => '3-6'],
            ['nama' => 'PJOK', 'kelompok_kelas' => '3-6'],
        ];

        DB::table('mapels')->insert($mapels);
    }
}
