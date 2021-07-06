<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moment extends Model
{
    protected $table = 'table_kor_point_moment';
    protected $fillable = ['x', 'y'];
    public $timestamps = false;   
    use HasFactory;
}