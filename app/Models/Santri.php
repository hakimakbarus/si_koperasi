<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nisn',
        'foto',
        'tahun_masuk',
        'saldo',
        'status',
        'pin',
        'alamat',
        'id_madrasah',
        'id_ribath',
    ];
}
