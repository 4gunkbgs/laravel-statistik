<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biserial extends Model
{
    protected $table = 'table_biserial';
    protected $fillable = ['kecerdasan', 'keaktifan'];
    public $timestamps = false;    
    use HasFactory;
}