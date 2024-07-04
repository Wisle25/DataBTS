<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penggunaData = [
            [
                'nama' => 'Admin',
                'username' => 'Admin 1',
                'password' => Hash::make('admin12345'),
                'email' => 'admin@gmail.com',
                'peran' => 'Administrator',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Agung Susanto',
                'username' => 'PIC 1',
                'password' => Hash::make('pic12345'),
                'email' => 'pic1@gmail.com',
                'peran' => 'PIC',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Budi Raharjo',
                'username' => 'PIC 2',
                'password' => Hash::make('pic12345'),
                'email' => 'pic2@gmail.com',
                'peran' => 'PIC',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Lukman Maulana',
                'username' => 'PIC 3',
                'password' => Hash::make('pic12345'),
                'email' => 'pic3@gmail.com',
                'peran' => 'PIC',
                'status' => 'aktif',
            ],
            [
                'nama' => 'David Alberto',
                'username' => 'Surveyor 1',
                'password' => Hash::make('surveyor12345'),
                'email' => 'surveyor1@gmail.com',
                'peran' => 'Surveyor',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Gunawan Setyawan',
                'username' => 'Surveyor 2',
                'password' => Hash::make('surveyor12345'),
                'email' => 'surveyor2@gmail.com',
                'peran' => 'Surveyor',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Ahmad Maulana',
                'username' => 'Surveyor 3',
                'password' => Hash::make('surveyor12345'),
                'email' => 'surveyor3@gmail.com',
                'peran' => 'Surveyor',
                'status' => 'aktif',
            ],
        ];

        // Insert data ke dalam database
        foreach ($penggunaData as $pengguna) {
            Pengguna::create($pengguna);
        }
    }
}
