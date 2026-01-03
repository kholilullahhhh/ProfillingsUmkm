<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'user_id',
        'nama',
        'kelompok_kelas',
        // 'mapel',
    ];
    //     public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }



}
