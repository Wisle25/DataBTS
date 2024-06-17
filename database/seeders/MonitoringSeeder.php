<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Monitoring;
use Carbon\Carbon;

class MonitoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data contoh untuk tabel monitoring
        $monitoringData = [
            [
                'tahun' => 2022,
                'id_bts' => 1,
                'tgl_generate' => Carbon::now()->subDays(10)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(5)->toDateString(),
                'kondisi_bts' => 'Active',
                'id_user_surveyor' => 1,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'tahun' => 2022,
                'id_bts' => 2,
                'tgl_generate' => Carbon::now()->subDays(8)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(3)->toDateString(),
                'kondisi_bts' => 'Active',
                'id_user_surveyor' => 2,
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'tahun' => 2022,
                'id_bts' => 3,
                'tgl_generate' => Carbon::now()->subDays(12)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(7)->toDateString(),
                'kondisi_bts' => 'Not Active',
                'id_user_surveyor' => 3,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'tahun' => 2023,
                'id_bts' => 4,
                'tgl_generate' => Carbon::now()->subDays(6)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(2)->toDateString(),
                'kondisi_bts' => 'Active',
                'id_user_surveyor' => 1,
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'tahun' => 2023,
                'id_bts' => 5,
                'tgl_generate' => Carbon::now()->subDays(9)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(4)->toDateString(),
                'kondisi_bts' => 'Active',
                'id_user_surveyor' => 2,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'tahun' => 2023,
                'id_bts' => 6,
                'tgl_generate' => Carbon::now()->subDays(11)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(6)->toDateString(),
                'kondisi_bts' => 'Active',
                'id_user_surveyor' => 3,
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'tahun' => 2023,
                'id_bts' => 7,
                'tgl_generate' => Carbon::now()->subDays(7)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(3)->toDateString(),
                'kondisi_bts' => 'Not Active',
                'id_user_surveyor' => 1,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'tahun' => 2023,
                'id_bts' => 8,
                'tgl_generate' => Carbon::now()->subDays(5)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(1)->toDateString(),
                'kondisi_bts' => 'Active',
                'id_user_surveyor' => 2,
                'created_by' => 2,
                'edited_by' => 2,
            ],
            [
                'tahun' => 2023,
                'id_bts' => 9,
                'tgl_generate' => Carbon::now()->subDays(8)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(4)->toDateString(),
                'kondisi_bts' => 'Not Active',
                'id_user_surveyor' => 3,
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'tahun' => 2023,
                'id_bts' => 10,
                'tgl_generate' => Carbon::now()->subDays(10)->toDateString(),
                'tgl_kunjungan' => Carbon::now()->subDays(5)->toDateString(),
                'kondisi_bts' => 'Active',
                'id_user_surveyor' => 1,
                'created_by' => 2,
                'edited_by' => 2,
            ],
        ];

        // Insert data ke dalam database
        foreach ($monitoringData as $monitoring) {
            Monitoring::create($monitoring);
        }
    }
}
