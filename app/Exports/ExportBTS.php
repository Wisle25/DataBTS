<?php

namespace App\Exports;

use App\Models\BTS;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportBTS implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = BTS::orderBy('nama', 'asc')->get();
        return $data;
    }

    private $number = 0;

    public function map($data):array{
        $this->number++;
        return [
            $this->number,
            $data->nama,
            $data->alamat,
            $data->id_jenis_bts,
            $data->latitude,
            $data->longitude,
            $data->tinggi_tower,
            $data->panjang_tanah,
            $data->lebar_tanah,
        ];
    }

    public function headings():array{
        return[
            'No',
            'Nama',
            'Alamat',
            ' ID jenis bts',
            'Latitude',
            'Longitude',
            'Tinggi Tower',
            'Panjang Tanah',
            'Lebar Tanah',
        ];
    }
}
