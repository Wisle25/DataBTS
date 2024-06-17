<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemilik;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemilikData = [
            [
                'name' => 'Budi Santoso',
                'alamat' => 'Jalan Merdeka No. 10, Jakarta Selatan',
                'telepon' => '081234567890',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'name' => 'Joko Susanto',
                'alamat' => 'Jalan Kenangan No. 5, Surabaya',
                'telepon' => '081234567891',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'name' => 'Agus Setiawan',
                'alamat' => 'Jalan Gembira No. 3, Bandung',
                'telepon' => '081234567892',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'name' => 'Hadi Prabowo',
                'alamat' => 'Jalan Bahagia No. 8, Yogyakarta',
                'telepon' => '081234567893',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'name' => 'Herry Wijaya',
                'alamat' => 'Jalan Damai No. 12, Medan',
                'telepon' => '081234567894',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'name' => 'Ali Akbar',
                'alamat' => 'Jalan Suka No. 9, Palembang',
                'telepon' => '081234567895',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'name' => 'Rizky Pratama',
                'alamat' => 'Jalan Sejahtera No. 6, Makassar',
                'telepon' => '081234567896',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'name' => 'Andi Wijaya',
                'alamat' => 'Jalan Makmur No. 15, Semarang',
                'telepon' => '081234567897',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'name' => 'Ahmad Firdaus',
                'alamat' => 'Jalan Indah No. 7, Denpasar',
                'telepon' => '081234567898',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'name' => 'Bayu Kusuma',
                'alamat' => 'Jalan Harmoni No. 4, Manado',
                'telepon' => '081234567899',
                'created_by' => 1,
                'edited_by' => 1,
            ],
        ];

        // Insert data ke dalam database
        foreach ($pemilikData as $pemilik) {
            Pemilik::create($pemilik);
        }
    }
}
