<?php

namespace App\Exports;

use App\Models\BTS;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExportBTS implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    private $number = 0;
    private $rowCount;
    private $columnCount;
    private $images = [];

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = BTS::orderBy('nama', 'asc')->get();
        $this->rowCount = $data->count();
        $this->columnCount = count($this->headings());
        return $data;
    }

    public function map($data): array
    {
        $this->number++;
        $pathFoto = null;
        if ($data->path_foto && file_exists(public_path('path_foto/' . $data->path_foto))) {
            $pathFoto = public_path('path_foto/' . $data->path_foto);
            $this->images[] = ['path' => $pathFoto, 'row' => $this->number + 1];
        }
        return [
            $this->number,
            $data->nama,
            $data->alamat,
            $data->wilayah->nama,
            $data->latitude,
            $data->longitude,
            $data->tinggi_tower,
            $data->panjang_tanah,
            $data->lebar_tanah,
            $data->pemilik->name,
            $data->jenisBTS->nama,
            $pathFoto ? '' : 'No Image',
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Alamat',
            'Wilayah',
            'Latitude',
            'Longitude',
            'Tinggi Tower',
            'Panjang Tanah',
            'Lebar Tanah',
            'Pemilik',
            'Jenis',
            'Foto',
        ];
    }

    /**
     * Apply styles to the worksheet.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->rowCount + 1; // +1 to include the header row
        $lastColumn = chr(64 + $this->columnCount); 

        // Center align all cells
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Apply bold to the first row
        $sheet->getStyle('A1:' . $lastColumn . '1')->getFont()->setBold(true);

        // Apply border to all cells
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [];
    }

    /**
     * Register events for the worksheet.
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Set max column widths
                foreach (range('A', $sheet->getHighestColumn()) as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }

                // Set specific column width for Foto column
                $sheet->getColumnDimension('L')->setWidth(20); 

                // Add images and adjust row height
                foreach ($this->images as $image) {
                    $drawing = new Drawing();
                    $drawing->setPath($image['path']);
                    $drawing->setCoordinates('L' . $image['row']);
                    $drawing->setWidth(50); 
                    $drawing->setHeight(50); 
                    $drawing->setOffsetX(15); 
                    $drawing->setOffsetY(10); 
                    $drawing->setWorksheet($sheet);

                    // Adjust row height
                    $sheet->getRowDimension($image['row'])->setRowHeight(55); 
                }

                // Center align all cells vertically
                $sheet->getStyle('A2:L' . ($this->rowCount + 1))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            },
        ];
    }
}
