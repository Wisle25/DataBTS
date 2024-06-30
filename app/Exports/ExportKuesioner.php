<?php

namespace App\Exports;

use App\Models\Kuesioner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExportKuesioner implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    private $number = 0;
    private $rowCount;
    private $columnCount;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $kuesioners = Kuesioner::orderBy('created_at', 'asc')->get();
        $this->rowCount = $kuesioners->count();
        $this->columnCount = count($this->headings());
        return $kuesioners;
    }

    public function map($kuesioner): array
    {
        $this->number++;
        return [
            $this->number,
            $kuesioner->pertanyaan,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Pertanyaan',
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
        $lastColumn = chr(64 + $this->columnCount); // Convert column count to letter (e.g., 1 = A, 2 = B, ..., 26 = Z)

        // Center align all cells
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

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
            },
        ];
    }
}
