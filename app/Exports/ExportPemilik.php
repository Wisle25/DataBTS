<?php

namespace App\Exports;

use App\Models\Pemilik;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPemilik implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $pemilik = Pemilik::orderBy('name', 'asc')->get();

        return $pemilik;
    }

    private $number = 0;

    public function map($pemilik):array{
        $this->number++;
        return [
            $this->number,
            $pemilik->name,
            $pemilik->alamat,
            $pemilik->telepon,
        ];
    }

    public function headings():array{
        return[
            'No',
            'Nama',
            'Alamat',
            'Telepon',
        ];
    }
}
