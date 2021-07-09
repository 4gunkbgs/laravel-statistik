<?php

namespace App\Exports;

use App\Models\UjiAnava;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UjiAnavaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UjiAnava::all();
    }

    public function headings(): array
    {
        return [            
            'x1',
            'x2',
            'x3',
            'x4',
        ];
    }

    public function map($anggota): array{
        return [
            $anggota->x1,         
            $anggota->x2, 
            $anggota->x3,
            $anggota->x4,        
        ];
    }
}