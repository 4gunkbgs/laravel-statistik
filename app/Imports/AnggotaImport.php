<?php

namespace App\Imports;

use App\Models\Anggota;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AnggotaImport implements ToModel
{    
    use importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {                            
        return new Anggota([           
            'skor' => $row[0],                                               
        ]);
    }

    // public function customValidationMessages()
    // {
    //     return [
    //         '1.in' => 'Custom message for :attribute.',
    //     ];
    // }

    
   
}