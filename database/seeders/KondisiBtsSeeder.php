<?php

namespace Database\Seeders;

use App\Models\KondisiBts;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KondisiBtsSeeder extends Seeder
{
    public function run()
    {
        $kondisi = [
            ['nama' => 'Normal'],
            ['nama' => 'Fault'],
            ['nama' => 'Maintenance'],
            ['nama' => 'Offline'],
        ];

        foreach ($kondisi as $item) {
            KondisiBts::create($item);
        }
    }
}
