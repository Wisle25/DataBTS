<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilayah;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data wilayah contoh
        $wilayahs = [
            [
                'nama' => 'Indonesia',
                'id_parent' => null,
                'level' => 1,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Nangggoroe Aceh Darussalam',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Riau',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Sumatera Utara',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Sumatera Barat',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Sumatera Selatan',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Banten',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Daerah Khusus Jakarta',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Jawa Barat',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Daerah Istimewa Yogyakarta',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Jawa Tengah',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Jawa Timur',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Kalimantan Utara',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Kalimantan Timur',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Kalimantan Tengah',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Kalimantan Selatan',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Kalimantan Barat',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Sulawesi Utara',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Sulawesi Tengah',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Sulawesi Tenggara',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Sulawesi Selatan',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Sulawesi Barat',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Bali',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Nusa Tenggara Barat',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Nusa Tenggara Timur',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Maluku',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Maluku Utara',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Papua',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Papua Barat',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            // Tambahkan data baru di sini
        ];

        // Insert data wilayah ke dalam database
        foreach ($wilayahs as $wilayah) {
            Wilayah::create($wilayah);
        }
    }
}
