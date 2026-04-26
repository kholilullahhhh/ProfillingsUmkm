<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Umkm;
use App\Models\User;
use App\Models\JenisUsaha;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users with role 'user'
        $users = User::where('role', 'user')->get();
        
        // Get jenis usaha mappings
        $jenisUsahaMap = [
            'Tenun' => JenisUsaha::where('nama_jenis', 'Tenun')->first(),
            'Rajutan/Knit' => JenisUsaha::where('nama_jenis', 'Rajutan/Knit')->first(),
            'Anyaman' => JenisUsaha::where('nama_jenis', 'Anyaman')->first(),
            'Aksesoris' => JenisUsaha::where('nama_jenis', 'Aksesoris')->first(),
            'Fashion/Desainer' => JenisUsaha::where('nama_jenis', 'Fashion/Desainer')->first(),
            'Kerajinan Kayu' => JenisUsaha::where('nama_jenis', 'Kerajinan Kayu')->first(),
            'Kerajinan Logam/Perak' => JenisUsaha::where('nama_jenis', 'Kerajinan Logam/Perak')->first(),
            'Kerajinan Bambu' => JenisUsaha::where('nama_jenis', 'Kerajinan Bambu')->first(),
            'Kerajinan Batok Kelapa' => JenisUsaha::where('nama_jenis', 'Kerajinan Batok Kelapa')->first(),
            'Decoupage' => JenisUsaha::where('nama_jenis', 'Decoupage')->first(),
            'Makrame' => JenisUsaha::where('nama_jenis', 'Makrame')->first(),
            'Songkok' => JenisUsaha::where('nama_jenis', 'Songkok')->first(),
            'Hiasan Kaca' => JenisUsaha::where('nama_jenis', 'Hiasan Kaca')->first(),
            'Akrilik' => JenisUsaha::where('nama_jenis', 'Akrilik')->first(),
        ];

        $umkmData = [
            // No 1
            [
                'nama_usaha' => 'Fenisa 05',
                'pemilik' => 'Lindayati',
                'alamat' => 'Jl. Contoh Alamat No. 1, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 50000000,
                'kontak' => '081242011114',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 2
            [
                'nama_usaha' => 'Rumah Anyam Mandiri',
                'pemilik' => 'Elsa',
                'alamat' => 'Jl. Contoh Alamat No. 2, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 35000000,
                'kontak' => '082190956510',
                'status_binaan' => true,
                'jenis_usaha' => 'Anyaman'
            ],
            // No 3
            [
                'nama_usaha' => 'Atap Konjo',
                'pemilik' => 'Yuyun Wahyuni',
                'alamat' => 'Jl. Contoh Alamat No. 3, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 40000000,
                'kontak' => '08219094800',
                'status_binaan' => true,
                'jenis_usaha' => 'Anyaman'
            ],
            // No 4
            [
                'nama_usaha' => 'Melody Rajut',
                'pemilik' => 'Marry Mappakaya',
                'alamat' => 'Jl. Contoh Alamat No. 4, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 60000000,
                'kontak' => '08114500818',
                'status_binaan' => true,
                'jenis_usaha' => 'Rajutan/Knit'
            ],
            // No 5
            [
                'nama_usaha' => 'Mardia Berkah',
                'pemilik' => 'Radia',
                'alamat' => 'Jl. Contoh Alamat No. 5, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 45000000,
                'kontak' => '081355434375',
                'status_binaan' => true,
                'jenis_usaha' => 'Rajutan/Knit'
            ],
            // No 6
            [
                'nama_usaha' => 'Rosebud Diary',
                'pemilik' => 'Sri Wahyuningsih',
                'alamat' => 'Jl. Contoh Alamat No. 6, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2019,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 55000000,
                'kontak' => '081355002026',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 7
            [
                'nama_usaha' => 'Kreasi Sutera',
                'pemilik' => 'Anti',
                'alamat' => 'Jl. Contoh Alamat No. 7, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2014,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 120000000,
                'kontak' => '082189538980',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 8
            [
                'nama_usaha' => 'Rhya Silk',
                'pemilik' => 'Rhya',
                'alamat' => 'Jl. Contoh Alamat No. 8, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 150000000,
                'kontak' => '082292030404',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 9
            [
                'nama_usaha' => 'Cantika Sabbena',
                'pemilik' => 'Nurlaela',
                'alamat' => 'Jl. Contoh Alamat No. 9, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 70000000,
                'kontak' => '085240472010',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            // No 10
            [
                'nama_usaha' => 'Resky Bros',
                'pemilik' => 'Herlina',
                'alamat' => 'Jl. Contoh Alamat No. 10, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 30000000,
                'kontak' => '082291710900',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 11
            [
                'nama_usaha' => 'Harly\'s Craft & Art',
                'pemilik' => 'Andi Harliaty',
                'alamat' => 'Jl. Contoh Alamat No. 11, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 50000000,
                'kontak' => '082192791010',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 12
            [
                'nama_usaha' => 'Daun Lontar Takalar',
                'pemilik' => 'Andi Asminuh',
                'alamat' => 'Jl. Contoh Alamat No. 12, Takalar',
                'kabupaten' => 'Takalar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 25000000,
                'kontak' => '082190948000',
                'status_binaan' => true,
                'jenis_usaha' => 'Anyaman'
            ],
            // No 13
            [
                'nama_usaha' => 'Arkrilik',
                'pemilik' => 'Rahmatia',
                'alamat' => 'Jl. Contoh Alamat No. 13, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2019,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 40000000,
                'kontak' => '082393866772',
                'status_binaan' => true,
                'jenis_usaha' => 'Akrilik'
            ],
            // No 14
            [
                'nama_usaha' => 'WR Creative',
                'pemilik' => 'Sarwinah',
                'alamat' => 'Jl. Contoh Alamat No. 14, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 45000000,
                'kontak' => '081355230378',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 15
            [
                'nama_usaha' => 'Erni Art',
                'pemilik' => 'Erni Kamal',
                'alamat' => 'Jl. Contoh Alamat No. 15, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 35000000,
                'kontak' => '082174635689',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 16
            [
                'nama_usaha' => 'Sutra',
                'pemilik' => 'Hery',
                'alamat' => 'Jl. Contoh Alamat No. 16, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2014,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 180000000,
                'kontak' => '082337949371',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 17
            [
                'nama_usaha' => 'Sutra Wajo',
                'pemilik' => 'H. Rahmatiah',
                'alamat' => 'Jl. Contoh Alamat No. 17, Wajo',
                'kabupaten' => 'Wajo',
                'tahun_berdiri' => 2013,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 200000000,
                'kontak' => '081356360178',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 18
            [
                'nama_usaha' => 'Cantika Sabbena',
                'pemilik' => 'H. Lela',
                'alamat' => 'Jl. Contoh Alamat No. 18, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 70000000,
                'kontak' => '085240472010',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 19
            [
                'nama_usaha' => 'Kriya Rotan',
                'pemilik' => 'Imam Subowo',
                'alamat' => 'Jl. Contoh Alamat No. 19, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2012,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 150000000,
                'kontak' => '085255053719',
                'status_binaan' => true,
                'jenis_usaha' => 'Kerajinan Bambu'
            ],
            // No 20
            [
                'nama_usaha' => 'Decopage',
                'pemilik' => 'Andi Tenri Cicylia',
                'alamat' => 'Jl. Contoh Alamat No. 20, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 40000000,
                'kontak' => '-',
                'status_binaan' => true,
                'jenis_usaha' => 'Decoupage'
            ],
            // No 21
            [
                'nama_usaha' => 'Laras Hatiku',
                'pemilik' => 'Dg. Eppe',
                'alamat' => 'Jl. Contoh Alamat No. 21, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 30000000,
                'kontak' => '081350483872',
                'status_binaan' => true,
                'jenis_usaha' => 'Kerajinan Batok Kelapa'
            ],
            // No 22
            [
                'nama_usaha' => 'Macrame',
                'pemilik' => 'Nirmala Kasih',
                'alamat' => 'Jl. Contoh Alamat No. 22, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2019,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 25000000,
                'kontak' => '-',
                'status_binaan' => true,
                'jenis_usaha' => 'Makrame'
            ],
            // No 23
            [
                'nama_usaha' => 'Rumah Kreatif Eva',
                'pemilik' => 'Eva Sriyani',
                'alamat' => 'Jl. Contoh Alamat No. 23, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 50000000,
                'kontak' => '085242435480',
                'status_binaan' => true,
                'jenis_usaha' => 'Rajutan/Knit'
            ],
            // No 24
            [
                'nama_usaha' => 'Neon Kreasi',
                'pemilik' => 'Igha Lativa',
                'alamat' => 'Jl. Contoh Alamat No. 24, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2020,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 20000000,
                'kontak' => '0852642690990',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 25
            [
                'nama_usaha' => 'Princess Yulita',
                'pemilik' => 'Yulita',
                'alamat' => 'Jl. Contoh Alamat No. 25, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 35000000,
                'kontak' => '08114493678',
                'status_binaan' => true,
                'jenis_usaha' => 'Anyaman'
            ],
            // No 26
            [
                'nama_usaha' => 'AAA',
                'pemilik' => 'Luhriah',
                'alamat' => 'Jl. Contoh Alamat No. 26, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 55000000,
                'kontak' => '081936300174',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            // No 27
            [
                'nama_usaha' => 'Mubarak',
                'pemilik' => 'Erni Kamal',
                'alamat' => 'Jl. Contoh Alamat No. 27, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 30000000,
                'kontak' => '082174635689',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 28
            [
                'nama_usaha' => 'AT Craft',
                'pemilik' => 'Airin',
                'alamat' => 'Jl. Contoh Alamat No. 28, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2019,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 35000000,
                'kontak' => '081242469363',
                'status_binaan' => true,
                'jenis_usaha' => 'Rajutan/Knit'
            ],
            // No 29
            [
                'nama_usaha' => 'Arqah Craft',
                'pemilik' => 'Cahyani',
                'alamat' => 'Jl. Contoh Alamat No. 29, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 40000000,
                'kontak' => '082192520050',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 30
            [
                'nama_usaha' => 'Zaini Hijab',
                'pemilik' => 'Tiara',
                'alamat' => 'Jl. Contoh Alamat No. 30, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2019,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 60000000,
                'kontak' => '085298901990',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            // No 31
            [
                'nama_usaha' => 'TanganDia',
                'pemilik' => 'Diayani Sukardi',
                'alamat' => 'Jl. Contoh Alamat No. 31, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 45000000,
                'kontak' => '08114617611',
                'status_binaan' => true,
                'jenis_usaha' => 'Rajutan/Knit'
            ],
            // No 32
            [
                'nama_usaha' => 'Macora Rajut',
                'pemilik' => 'Harlina',
                'alamat' => 'Jl. Contoh Alamat No. 32, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 40000000,
                'kontak' => '085314662179',
                'status_binaan' => true,
                'jenis_usaha' => 'Rajutan/Knit'
            ],
            // No 33
            [
                'nama_usaha' => 'Songkok Dua Putri',
                'pemilik' => 'Fatma Wati',
                'alamat' => 'Jl. Contoh Alamat No. 33, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 50000000,
                'kontak' => '082393063167',
                'status_binaan' => true,
                'jenis_usaha' => 'Songkok'
            ],
            // No 34
            [
                'nama_usaha' => 'Logam Borong Makassar',
                'pemilik' => 'Syamsul',
                'alamat' => 'Jl. Contoh Alamat No. 34, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2012,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 250000000,
                'kontak' => '082358888505',
                'status_binaan' => true,
                'jenis_usaha' => 'Kerajinan Logam/Perak'
            ],
            // No 35
            [
                'nama_usaha' => 'Eir Craft',
                'pemilik' => 'Alfrida Kaissi',
                'alamat' => 'Jl. Contoh Alamat No. 35, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2019,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 30000000,
                'kontak' => '0811422334',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 36
            [
                'nama_usaha' => 'Simbolong Manik',
                'pemilik' => 'Merry D Sari',
                'alamat' => 'Jl. Contoh Alamat No. 36, Toraja Utara',
                'kabupaten' => 'Toraja Utara',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 40000000,
                'kontak' => '081344496343',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 37
            [
                'nama_usaha' => 'Sutera Indah',
                'pemilik' => 'Meri',
                'alamat' => 'Jl. Contoh Alamat No. 37, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 60000000,
                'kontak' => '085298846500',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 38
            [
                'nama_usaha' => 'Bosara Ayu',
                'pemilik' => 'Ayu Wahyuningsih',
                'alamat' => 'Jl. Contoh Alamat No. 38, Gowa',
                'kabupaten' => 'Gowa',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 35000000,
                'kontak' => '085398397268',
                'status_binaan' => true,
                'jenis_usaha' => 'Anyaman'
            ],
            // No 39
            [
                'nama_usaha' => 'Rinys Craft',
                'pemilik' => 'Marini Ningsih',
                'alamat' => 'Jl. Contoh Alamat No. 39, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 45000000,
                'kontak' => '085242245350',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 40
            [
                'nama_usaha' => 'Bambu Hias',
                'pemilik' => 'Jamaluddin',
                'alamat' => 'Jl. Contoh Alamat No. 40, Maros',
                'kabupaten' => 'Maros',
                'tahun_berdiri' => 2014,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 50000000,
                'kontak' => '085254735999',
                'status_binaan' => true,
                'jenis_usaha' => 'Kerajinan Bambu'
            ],
            // No 41
            [
                'nama_usaha' => 'Kriya Bambu',
                'pemilik' => 'Dana Kusnadar',
                'alamat' => 'Jl. Contoh Alamat No. 41, Maros',
                'kabupaten' => 'Maros',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 55000000,
                'kontak' => '081341905131',
                'status_binaan' => true,
                'jenis_usaha' => 'Kerajinan Bambu'
            ],
            // No 42
            [
                'nama_usaha' => 'Jayadi Silver Gold',
                'pemilik' => 'Jayadi',
                'alamat' => 'Jl. Contoh Alamat No. 42, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2011,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 300000000,
                'kontak' => '085299999337',
                'status_binaan' => true,
                'jenis_usaha' => 'Kerajinan Logam/Perak'
            ],
            // No 43
            [
                'nama_usaha' => 'AGIS EKRAF',
                'pemilik' => 'CENNING',
                'alamat' => 'Jl. Contoh Alamat No. 43, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 80000000,
                'kontak' => '081325511809',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 44
            [
                'nama_usaha' => 'Hiasan Kaca',
                'pemilik' => 'DARMAWATI HALIK',
                'alamat' => 'Jl. Contoh Alamat No. 44, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 35000000,
                'kontak' => '085342690966',
                'status_binaan' => true,
                'jenis_usaha' => 'Hiasan Kaca'
            ],
            // No 45
            [
                'nama_usaha' => 'Anyaman Bambu Lakkang',
                'pemilik' => 'Surianti',
                'alamat' => 'Jl. Contoh Alamat No. 45, Lakkang',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 45000000,
                'kontak' => '085399691379',
                'status_binaan' => true,
                'jenis_usaha' => 'Kerajinan Bambu'
            ],
            // No 46
            [
                'nama_usaha' => 'Bantal Hias',
                'pemilik' => 'Sutina',
                'alamat' => 'Jl. Contoh Alamat No. 46, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 30000000,
                'kontak' => '0813427074',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 47
            [
                'nama_usaha' => 'Tas Rajutan Lakkang',
                'pemilik' => 'Murniyanti',
                'alamat' => 'Jl. Contoh Alamat No. 47, Lakkang',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 35000000,
                'kontak' => '085396583863',
                'status_binaan' => true,
                'jenis_usaha' => 'Rajutan/Knit'
            ],
            // No 48
            [
                'nama_usaha' => 'Aylacraft and Handmade',
                'pemilik' => 'Fitri',
                'alamat' => 'Jl. Contoh Alamat No. 48, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2019,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 40000000,
                'kontak' => '081351259956',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 49
            [
                'nama_usaha' => 'ShiviaCraft',
                'pemilik' => 'Annie',
                'alamat' => 'Jl. Contoh Alamat No. 49, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 35000000,
                'kontak' => '082335963344',
                'status_binaan' => true,
                'jenis_usaha' => 'Rajutan/Knit'
            ],
            // No 50
            [
                'nama_usaha' => 'Rizki Assesories',
                'pemilik' => 'Tanti',
                'alamat' => 'Jl. Contoh Alamat No. 50, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 40000000,
                'kontak' => '085255870857',
                'status_binaan' => true,
                'jenis_usaha' => 'Aksesoris'
            ],
            // No 51
            [
                'nama_usaha' => 'Galeri Wong Sinting',
                'pemilik' => 'Dina Mahardika',
                'alamat' => 'Jl. Contoh Alamat No. 51, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 60000000,
                'kontak' => '081245473523',
                'status_binaan' => true,
                'jenis_usaha' => 'Kerajinan Kayu'
            ],
            // No 52
            [
                'nama_usaha' => 'Ria Silk',
                'pemilik' => 'Ria',
                'alamat' => 'Jl. Contoh Alamat No. 52, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 70000000,
                'kontak' => '082292030404',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 53
            [
                'nama_usaha' => 'Kreasi Sutra',
                'pemilik' => 'Anty',
                'alamat' => 'Jl. Contoh Alamat No. 53, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 80000000,
                'kontak' => '082189538980',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 54
            [
                'nama_usaha' => 'Canero Thinoring',
                'pemilik' => 'Nency',
                'alamat' => 'Jl. Contoh Alamat No. 54, Toraja',
                'kabupaten' => 'Toraja Utara',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 50000000,
                'kontak' => '082345204567',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 55
            [
                'nama_usaha' => 'Naval Modesty Tailor',
                'pemilik' => 'Intan',
                'alamat' => 'Jl. Contoh Alamat No. 55, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 90000000,
                'kontak' => '081343806608',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            // No 56
            [
                'nama_usaha' => 'Yuyun Nailufar',
                'pemilik' => 'Yuyun',
                'alamat' => 'Jl. Contoh Alamat No. 56, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2018,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 55000000,
                'kontak' => '082190737309',
                'status_binaan' => true,
                'jenis_usaha' => 'Tenun'
            ],
            // No 57-64 (Desainer)
            [
                'nama_usaha' => 'Af Colection',
                'pemilik' => 'Arfiah Makmur',
                'alamat' => 'Jl. Contoh Alamat No. 57, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 150000000,
                'kontak' => '081342998809',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            [
                'nama_usaha' => 'Eka Madjid',
                'pemilik' => 'Eka Madjid',
                'alamat' => 'Jl. Contoh Alamat No. 58, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2014,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 200000000,
                'kontak' => '08124270645',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            [
                'nama_usaha' => 'Zahra Zhafira',
                'pemilik' => 'Jum',
                'alamat' => 'Jl. Contoh Alamat No. 59, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 80000000,
                'kontak' => '08114103122',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            [
                'nama_usaha' => 'Ari Rich',
                'pemilik' => 'Ari',
                'alamat' => 'Jl. Contoh Alamat No. 60, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 90000000,
                'kontak' => '085255693645',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            [
                'nama_usaha' => 'Amriany Achmad',
                'pemilik' => 'Amriany Achmad',
                'alamat' => 'Jl. Contoh Alamat No. 61, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 100000000,
                'kontak' => '087726292074',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            [
                'nama_usaha' => 'Faizah Nawawi',
                'pemilik' => 'Faizah Nawawi',
                'alamat' => 'Jl. Contoh Alamat No. 62, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2016,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 85000000,
                'kontak' => '085397191119',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            [
                'nama_usaha' => 'Jane Fashion',
                'pemilik' => 'Jannah Zainal',
                'alamat' => 'Jl. Contoh Alamat No. 63, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2017,
                'skala_usaha' => 'mikro',
                'omset_per_tahun' => 95000000,
                'kontak' => '08114104505',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
            [
                'nama_usaha' => 'Lutfiah Butik',
                'pemilik' => 'Mahdalia Makkulau',
                'alamat' => 'Jl. Contoh Alamat No. 64, Makassar',
                'kabupaten' => 'Makassar',
                'tahun_berdiri' => 2015,
                'skala_usaha' => 'kecil',
                'omset_per_tahun' => 180000000,
                'kontak' => '082322227276',
                'status_binaan' => true,
                'jenis_usaha' => 'Fashion/Desainer'
            ],
        ];

        // Create UMKM records
        $userIndex = 0;
        $umkmUsers = User::where('role', 'user')->get();
        
        foreach ($umkmData as $index => $data) {
            if ($userIndex < $umkmUsers->count()) {
                $jenisUsaha = $jenisUsahaMap[$data['jenis_usaha']] ?? JenisUsaha::first();
                
                Umkm::create([
                    'user_id' => $umkmUsers[$userIndex]->id,
                    'jenis_usaha_id' => $jenisUsaha ? $jenisUsaha->id : 1,
                    'nama_usaha' => $data['nama_usaha'],
                    'pemilik' => $data['pemilik'],
                    'alamat' => $data['alamat'],
                    'kabupaten' => $data['kabupaten'],
                    'tahun_berdiri' => $data['tahun_berdiri'],
                    'skala_usaha' => $data['skala_usaha'],
                    'omset_per_tahun' => $data['omset_per_tahun'],
                    'kontak' => $data['kontak'],
                    'status_binaan' => $data['status_binaan'],
                ]);
                
                $userIndex++;
            }
        }
    }
}