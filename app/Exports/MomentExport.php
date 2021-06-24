<?php

namespace App\Exports;

use App\Models\Moment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MomentExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Moment::all();
    }

    public function headings(): array
    {
        return [            
            'X',
            'Y',
        ];
    }

    public function map($anggota): array{
        return [
            $anggota->x,         
            $anggota->y,         
        ];
    }
}