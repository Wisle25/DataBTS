<?php

namespace App\Exports;

use App\Models\JenisBTS;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportJenisBTS implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $jenisBTS = JenisBTS::orderBy('nama', 'asc')->get();
        return $jenisBTS;
    }

    private $number = 0;

    public function map($data):array{
        $this->number++;
        return [
            $this->number,
            $data->nama,
        ];
    }

    public function headings():array{
        return[
            'No',
            'Jenis BTS',
        ];
    }
}
