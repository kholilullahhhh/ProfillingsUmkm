<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisUsaha;

class JenisUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisUsaha = [
            ['nama_jenis' => 'Tenun', 'deskripsi' => 'Tenun tradisional termasuk Tenun Toraja, Tenun Sutera, dll'],
            ['nama_jenis' => 'Rajutan/Knit', 'deskripsi' => 'Produk rajutan seperti tas, sepatu, topi, dll'],
            ['nama_jenis' => 'Anyaman', 'deskripsi' => 'Anyaman dari eceng gondok, daun lontar, bambu, plastik'],
            ['nama_jenis' => 'Aksesoris', 'deskripsi' => 'Aksesoris seperti kalung, gelang, bros, konektor masker'],
            ['nama_jenis' => 'Fashion/Desainer', 'deskripsi' => 'Produk fashion dan desainer pakaian'],
            ['nama_jenis' => 'Kerajinan Kayu', 'deskripsi' => 'Ukiran kayu, gelang kayu, dll'],
            ['nama_jenis' => 'Kerajinan Logam/Perak', 'deskripsi' => 'Produk dari perak dan logam'],
            ['nama_jenis' => 'Kerajinan Bambu', 'deskripsi' => 'Produk dari bambu seperti lampu hias, kursi'],
            ['nama_jenis' => 'Kerajinan Batok Kelapa', 'deskripsi' => 'Produk dari batok kelapa'],
            ['nama_jenis' => 'Decoupage', 'deskripsi' => 'Kerajinan decoupage'],
            ['nama_jenis' => 'Makrame', 'deskripsi' => 'Kerajinan makrame'],
            ['nama_jenis' => 'Songkok', 'deskripsi' => 'Pembuatan songkok'],
            ['nama_jenis' => 'Hiasan Kaca', 'deskripsi' => 'Hiasan dari kaca'],
            ['nama_jenis' => 'Akrilik', 'deskripsi' => 'Produk dari akrilik seperti pot bunga'],
        ];

        foreach ($jenisUsaha as $jenis) {
            JenisUsaha::create($jenis);
        }
    }
}