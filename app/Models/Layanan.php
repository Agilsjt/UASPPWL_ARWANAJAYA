<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanans'; // nama tabel harus jamak sesuai konvensi Laravel

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'gambar',
        'harga',
        'kategori',
    ];
}
