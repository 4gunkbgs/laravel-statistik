<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjiAnava extends Model
{
    protected $table = 'tb_uji_anava';
    protected $fillable = ['x1', 'x2', 'x3', 'x4'];
    public $timestamps = false; 
    use HasFactory;
}