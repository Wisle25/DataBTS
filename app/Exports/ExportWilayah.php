<?php

namespace App\Exports;

use App\Models\Wilayah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportWilayah implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $wilayah = Wilayah::orderBy('id_parent', 'asc')->get();
        return $wilayah;
    }

    private $number = 0;

    public function map($wilayah): array
    {
        $this->number++;
        return [
            $this->number,
            $wilayah->nama,
            $wilayah->id_parent,
            $wilayah->level,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'ID Parent',
            'Level',
        ];
    }
}
