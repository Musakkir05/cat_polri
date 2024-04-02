<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'kolomA',
        'kolomB',
        'kolomC',
        'kolomD',
        'kolomE',
        'waktu',
        'kkm',
        'status',
    ];
}
