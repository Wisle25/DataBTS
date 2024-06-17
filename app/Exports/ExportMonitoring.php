<?php

namespace App\Exports;

use App\Models\Monitoring;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportMonitoring implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $monitorings = Monitoring::orderBy('id_bts', 'asc')->get();
        return $monitorings;
    }

    private $number = 0;

    public function map($monitorings):array{
        $this->number++;
        return [
            $this->number,
            $monitorings->tahun,
            $monitorings->id_bts,
            $monitorings->tgl_generate,
            $monitorings->tgl_kunjungan,
            $monitorings->kondisi_bts,
        ];
    }

    public function headings():array{
        return[
            'No',
            'tahun',
            'id_bts',
            'tgl_generate',
            'tgl_kunjungan',
            'kondisi_bts',
        ];
    }
}
