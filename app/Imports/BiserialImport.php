<?php

namespace App\Imports;

use App\Models\Biserial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BiserialImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Biserial([
            'kecerdasan' => $row['kecerdasan'],
            'keaktifan' => $row['keaktifan']
        ]);
    }
}