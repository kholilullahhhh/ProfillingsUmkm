<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian_kinerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bulan',
        'kehadiran_mengajar',
        'ketepatan_waktu',
        'jam_mengajar',
        'pengisian_nilai',
        'kehadiran_rapat',
        'skor_akhir',
        'kategori',
        'detail',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
