<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjiT extends Model
{
    protected $table = 'tb_uji_t';
    protected $fillable = ['x1', 'x2'];
    public $timestamps = false;    
    use HasFactory;
}