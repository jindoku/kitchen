<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CustomerExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents
{
    public $dataExport;

    public function collection()
    {
        return $this->dataExport;
    }

    public function headings(): array
    {
        return [
            'STT',
            'Tên khách hàng',
            'Số điện thoại',
            'Email',
            'Giới tính',
            'Ngày sinh'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->styleCells(
                    'A1:F1',
                    [
                        // //Set font style
                        'font' => [
                            'name'      =>  'Times New Roman',
                            'size'      =>  12,
                            'bold'      =>  true,
                            'color' => ['argb' => '000'],
                        ],

                        //Set background style
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => 'dff0d8',
                            ]
                        ],

                    ]
                );
            },
        ];
    }
}
