<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisBTS;

class JenisBTSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisBTSData = [
            [
                'nama' => 'Macrocell',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Microcell',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Picocell',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Femtocell',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Outdoor DAS',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Indoor DAS',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Small Cell',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Repeater',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Relay Node',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'nama' => 'Hybrid BTS',
                'created_by' => 1,
                'edited_by' => 1,
            ],
        ];

        // Insert data ke dalam database
        foreach ($jenisBTSData as $jenisBTS) {
            JenisBTS::create($jenisBTS);
        }
    }
}
