<?php

namespace App\Exports;

use App\Models\Biserial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BiserialExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Biserial::all();
    }

    public function headings(): array
    {
        return [            
            'kecerdasan',
            'keaktifan',
        ];
    }

    public function map($anggota): array{
        return [
            $anggota->kecerdasan,         
            $anggota->keaktifan,         
        ];
    }
}