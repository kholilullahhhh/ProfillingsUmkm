<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar guru dengan jabatan
        $gurus = [
            ["name" => "Mas'ah", "jabatan" => "Wali Kelas 1A"],
            ["name" => "Indahyani Tawakkal", "jabatan" => "Wali Kelas 1C"],
            ["name" => "Risky Inesa", "jabatan" => "Wali Kelas 2C"],
            ["name" => "Mulyati", "jabatan" => "Wali Kelas 3A"],
            ["name" => "Riska", "jabatan" => "Wali Kelas 3C"],
            ["name" => "Muh. Musyawwir", "jabatan" => "Wali Kelas 4B"],
            ["name" => "St. Nurhalisa", "jabatan" => "Wali Kelas 5B"],
            ["name" => "Sri Sundari Rasyid", "jabatan" => "Wali Kelas 6B"],
            ["name" => "Arifuddin", "jabatan" => "PJOK (1-3)"],
            ["name" => "Savira D. Salsabella", "jabatan" => "PJOK (3-6)"],
            ["name" => "Nur Fadilah Putri", "jabatan" => "PAI (1-6)"],
        ];

        foreach ($gurus as $guru) {
            User::create([
                'name' => $guru['name'],
                'username' => strtolower(Str::slug($guru['name'])),
                'password' => bcrypt('user123'),
                'nuptk' => str_pad(random_int(1000000000, 9999999999), 10, '0', STR_PAD_LEFT),
                'jabatan' => $guru['jabatan'],
                'role' => 'user',
            ]);
             Admin::create([
                'name' => $guru['name'],
                'username' => strtolower(Str::slug($guru['name'])),
                'password' => bcrypt('user123'),
                'nuptk' => str_pad(random_int(1000000000, 9999999999), 10, '0', STR_PAD_LEFT),
                'jabatan' => $guru['jabatan'],
                'role' => 'user',
            ]);
        }

        // Akun khusus admin, kepala sekolah, dan guru umum
        $accounts = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
            [
                'name' => 'Kepala Sekolah',
                'username' => 'kepala',
                'password' => bcrypt('kepala'),
                'role' => 'kepala_sekolah',
            ],
            [
                'name' => 'Guru',
                'username' => 'guru',
                'password' => bcrypt('guru'),
                'nuptk' => '1234567890',
                'role' => 'user',
            ],
        ];

        foreach ($accounts as $acc) {
            User::create([
                'name' => $acc['name'],
                'username' => $acc['username'],
                'password' => $acc['password'],
                'nuptk' => $acc['nuptk'] ?? null,
                'jabatan' => $acc['jabatan'] ?? null,
                'role' => $acc['role'],
            ]);
            Admin::create([
                'name' => $acc['name'],
                'username' => $acc['username'],
                'password' => $acc['password'],
                'nuptk' => $acc['nuptk'] ?? null,
                'jabatan' => $acc['jabatan'] ?? null,
                'role' => $acc['role'],
            ]);
        }
    }
}
