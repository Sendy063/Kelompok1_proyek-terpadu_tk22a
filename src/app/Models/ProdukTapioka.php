<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukTapioka extends Model
{
    protected $table = 'produk_tapioka';
    
    protected $fillable = [
        'nama',
        'metode',
        'deskripsi',
        'harga',
        'gambar',
        'promo',
    ];
}
