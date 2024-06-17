<?php

namespace App\Exports;

use App\Models\Kuesioner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportKuesioner implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $kuesioners = Kuesioner::orderBy('created_at', 'asc')->get();
        return $kuesioners;
    }

    private $number = 0;

    public function map($kuesioners):array{
        $this->number++;
        return [
            $this->number,
            $kuesioners->pertanyaan,
        ];
    }

    public function headings():array{
        return[
            'No',
            'pertanyaan',
        ];
    }
}
