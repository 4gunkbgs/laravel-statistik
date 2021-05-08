<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'users';
    protected $fillable = ['skor'];
    public $timestamps = false;    
}