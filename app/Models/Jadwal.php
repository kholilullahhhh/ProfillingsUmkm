<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mapel_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'id');
    }

}
