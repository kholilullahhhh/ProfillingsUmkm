<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicators extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'skor', // Score Indikator, 0 sampai 100
        'description',
    ];
}
