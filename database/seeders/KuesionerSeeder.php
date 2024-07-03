<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kuesioner;

class KuesionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kuesionerData = [
            [
                'pertanyaan' => 'Bagaimana cara kerja BTS di daerah saya?',
                'subjek' => 'Teknologi',
                'created_by' => 2, // ID user biasa
                'edited_by' => 2,
            ],
            [
                'pertanyaan' => 'Apa yang harus saya lakukan jika sinyal BTS lemah?',
                'subjek' => 'Teknologi',
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'pertanyaan' => 'Berapa radius jangkauan BTS terdekat dari lokasi saya?',
                'subjek' => 'Teknologi',
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'pertanyaan' => 'Apakah ada rencana peningkatan jaringan BTS?',
                'subjek' => 'Teknologi',
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'pertanyaan' => 'Bagaimana cara melaporkan masalah dengan BTS?',
                'subjek' => 'Teknologi',
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'pertanyaan' => 'Apakah BTS di daerah saya mendukung 4G atau 5G?',
                'subjek' => 'Teknologi',
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'pertanyaan' => 'Bagaimana cara mengetahui lokasi BTS terdekat?',
                'subjek' => 'Teknologi',
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'pertanyaan' => 'Apakah ada biaya tambahan untuk perbaikan BTS?',
                'subjek' => 'Teknologi',
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'pertanyaan' => 'Apakah ada informasi mengenai maintance BTS?',
                'subjek' => 'Teknologi',
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'pertanyaan' => 'Bagaimana BTS mempengaruhi kualitas sinyal saya?',
                'subjek' => 'Teknologi',
                'created_by' => 2,
                'edited_by' => 2,
            ],
        ];

        // Insert data ke dalam database
        foreach ($kuesionerData as $kuesioner) {
            Kuesioner::create($kuesioner);
        }
    }
}
