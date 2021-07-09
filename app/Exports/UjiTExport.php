<?php

namespace App\Exports;

use App\Models\UjiT;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UjiTExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UjiT::all();
    }

    public function headings(): array
    {
        return [            
            'x1',
            'x2',
        ];
    }

    public function map($anggota): array{
        return [
            $anggota->x1,         
            $anggota->x2,         
        ];
    }
}