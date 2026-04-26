<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;

use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Admin users
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'jabatan' => 'Super Admin',
                'role' => 'admin'
            ],
            [
                'name' => 'Dekranasda Admin',
                'username' => 'dekranasda',
                'password' => Hash::make('password'),
                'jabatan' => 'Admin Dekranasda',
                'role' => 'admin'
            ],
        ];

        // Create UMKM users (role = 'user')
        $umkmData = [
            ['name' => 'Lindayati', 'username' => 'lindayati', 'jabatan' => 'Pemilik'],
            ['name' => 'Elsa', 'username' => 'elsa', 'jabatan' => 'Pemilik'],
            ['name' => 'Yuyun Wahyuni', 'username' => 'yuyun_wahyuni', 'jabatan' => 'Pemilik'],
            ['name' => 'Marry Mappakaya', 'username' => 'marry', 'jabatan' => 'Pemilik'],
            ['name' => 'Radia', 'username' => 'radia', 'jabatan' => 'Pemilik'],
            ['name' => 'Sri Wahyuningsih', 'username' => 'sri_wahyuningsih', 'jabatan' => 'Pemilik'],
            ['name' => 'Anti', 'username' => 'anti', 'jabatan' => 'Pemilik'],
            ['name' => 'Rhya', 'username' => 'rhya', 'jabatan' => 'Pemilik'],
            ['name' => 'Nurlaela', 'username' => 'nurlaela', 'jabatan' => 'Pemilik'],
            ['name' => 'Herlina', 'username' => 'herlina', 'jabatan' => 'Pemilik'],
            ['name' => 'Andi Harliaty', 'username' => 'andi_harliaty', 'jabatan' => 'Pemilik'],
            ['name' => 'Andi Asminuh', 'username' => 'andi_asminuh', 'jabatan' => 'Pemilik'],
            ['name' => 'Rahmatia', 'username' => 'rahmatia', 'jabatan' => 'Pemilik'],
            ['name' => 'Sarwinah', 'username' => 'sarwinah', 'jabatan' => 'Pemilik'],
            ['name' => 'Erni Kamal', 'username' => 'erni_kamal', 'jabatan' => 'Pemilik'],
            ['name' => 'Hery', 'username' => 'hery', 'jabatan' => 'Pemilik'],
            ['name' => 'H. Rahmatiah', 'username' => 'rahmatiah', 'jabatan' => 'Pemilik'],
            ['name' => 'H. Lela', 'username' => 'lela', 'jabatan' => 'Pemilik'],
            ['name' => 'Imam Subowo', 'username' => 'imam_subowo', 'jabatan' => 'Pemilik'],
            ['name' => 'Andi tenri Cicylia', 'username' => 'andi_tenri', 'jabatan' => 'Pemilik'],
            ['name' => 'Dg. Eppe', 'username' => 'dg_eppe', 'jabatan' => 'Pemilik'],
            ['name' => 'Nirmala Kasih', 'username' => 'nirmala', 'jabatan' => 'Pemilik'],
            ['name' => 'Eva Sriyani', 'username' => 'eva_sriyani', 'jabatan' => 'Pemilik'],
            ['name' => 'Igha Lativa', 'username' => 'igha_lativa', 'jabatan' => 'Pemilik'],
            ['name' => 'Yulita', 'username' => 'yulita', 'jabatan' => 'Pemilik'],
            ['name' => 'Luhriah', 'username' => 'luhriah', 'jabatan' => 'Pemilik'],
            ['name' => 'Airin', 'username' => 'airin', 'jabatan' => 'Pemilik'],
            ['name' => 'Cahyani', 'username' => 'cahyani', 'jabatan' => 'Pemilik'],
            ['name' => 'Tiara', 'username' => 'tiara', 'jabatan' => 'Pemilik'],
            ['name' => 'Diayani Sukardi', 'username' => 'diayani', 'jabatan' => 'Pemilik'],
            ['name' => 'Harlina', 'username' => 'harlina', 'jabatan' => 'Pemilik'],
            ['name' => 'Fatma Wati', 'username' => 'fatma_wati', 'jabatan' => 'Pemilik'],
            ['name' => 'Syamsul', 'username' => 'syamsul', 'jabatan' => 'Pemilik'],
            ['name' => 'Alfrida Kaissi', 'username' => 'alfrida', 'jabatan' => 'Pemilik'],
            ['name' => 'Merry D Sari', 'username' => 'merry', 'jabatan' => 'Pemilik'],
            ['name' => 'Meri', 'username' => 'meri', 'jabatan' => 'Pemilik'],
            ['name' => 'Ayu Wahyuningsih', 'username' => 'ayu_wahyuningsih', 'jabatan' => 'Pemilik'],
            ['name' => 'Marini Ningsih', 'username' => 'marini', 'jabatan' => 'Pemilik'],
            ['name' => 'Jamaluddin', 'username' => 'jamaluddin', 'jabatan' => 'Pemilik'],
            ['name' => 'Dana Kusnadar', 'username' => 'dana', 'jabatan' => 'Pemilik'],
            ['name' => 'Jayadi', 'username' => 'jayadi', 'jabatan' => 'Pemilik'],
            ['name' => 'CENNING', 'username' => 'cenning', 'jabatan' => 'Pemilik'],
            ['name' => 'DARMAWATI HALIK', 'username' => 'darmawati', 'jabatan' => 'Pemilik'],
            ['name' => 'Surianti', 'username' => 'surianti', 'jabatan' => 'Pemilik'],
            ['name' => 'Sutina', 'username' => 'sutina', 'jabatan' => 'Pemilik'],
            ['name' => 'Murniyanti', 'username' => 'murniyanti', 'jabatan' => 'Pemilik'],
            ['name' => 'Fitri', 'username' => 'fitri', 'jabatan' => 'Pemilik'],
            ['name' => 'Annie', 'username' => 'annie', 'jabatan' => 'Pemilik'],
            ['name' => 'Tanti', 'username' => 'tanti', 'jabatan' => 'Pemilik'],
            ['name' => 'Dina Mahardika', 'username' => 'dina', 'jabatan' => 'Pemilik'],
            ['name' => 'Ria', 'username' => 'ria', 'jabatan' => 'Pemilik'],
            ['name' => 'Anty', 'username' => 'anty', 'jabatan' => 'Pemilik'],
            ['name' => 'Nency', 'username' => 'nency', 'jabatan' => 'Pemilik'],
            ['name' => 'Intan', 'username' => 'intan', 'jabatan' => 'Pemilik'],
            ['name' => 'Yuyun', 'username' => 'yuyun', 'jabatan' => 'Pemilik'],
            ['name' => 'Arfiah Makmur', 'username' => 'arfiah', 'jabatan' => 'Pemilik'],
            ['name' => 'Eka Madjid', 'username' => 'eka_madjid', 'jabatan' => 'Pemilik'],
            ['name' => 'Jum', 'username' => 'jum', 'jabatan' => 'Pemilik'],
            ['name' => 'Ari', 'username' => 'ari', 'jabatan' => 'Pemilik'],
            ['name' => 'Amriany Achmad', 'username' => 'amriany', 'jabatan' => 'Pemilik'],
            ['name' => 'Faizah Nawawi', 'username' => 'faizah', 'jabatan' => 'Pemilik'],
            ['name' => 'Jannah Zainal', 'username' => 'jannah', 'jabatan' => 'Pemilik'],
            ['name' => 'Mahdalia Makkulau', 'username' => 'mahdalia', 'jabatan' => 'Pemilik'],
        ];

        foreach ($umkmData as $umkm) {
            $users[] = array_merge($umkm, [
                'password' => Hash::make('umkm123'),
                'role' => 'user'
            ]);
        }

        foreach ($users as $user) {
            User::create($user);
        }
        foreach ($users as $user) {
            Admin::create($user);
        }
    }
}