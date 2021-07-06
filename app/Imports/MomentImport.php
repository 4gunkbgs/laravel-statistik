<?php

namespace App\Imports;

use App\Models\Moment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MomentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Moment([
            'x' => $row['x'],
            'y' => $row['y']
        ]);
    }
}