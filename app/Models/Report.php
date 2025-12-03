<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mahasiswa', 
        'nim', 
        'jurusan',
        'fasilitas', 
        'keluhan', 
        'foto',
        'is_anonymous',
        'status'
    ];
}