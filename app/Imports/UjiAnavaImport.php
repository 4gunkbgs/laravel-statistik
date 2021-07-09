<?php

namespace App\Imports;

use App\Models\UjiAnava;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UjiAnavaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UjiAnava([
            'x1' => $row['x1'],
            'x2' => $row['x2'],
            'x3' => $row['x3'],
            'x4' => $row['x4']
        ]);
    }
}