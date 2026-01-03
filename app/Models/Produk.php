<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'satuan',
        'status',
        'deskripsi'
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
