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
                'nama' => 'Jawa Barat',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Jakarta',
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
                'nama' => 'Surabaya',
                'id_parent' => 2,
                'level' => 3,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Bandung',
                'id_parent' => 2,
                'level' => 3,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Yogyakarta',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Denpasar',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Medan',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Makassar',
                'id_parent' => 1,
                'level' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
        ];

        // Insert data wilayah ke dalam database
        foreach ($wilayahs as $wilayah) {
            Wilayah::create($wilayah);
        }
    }
}
