<?php

namespace App\Imports;

use App\Models\UjiT;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UjiTImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UjiT([
            'x1' => $row['x1'],
            'x2' => $row['x2']
        ]);
    }
}