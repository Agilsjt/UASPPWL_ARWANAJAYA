<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanans'; // nama tabel harus jamak sesuai konvensi Laravel

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'gambar',
        'harga',
        'kategori',
    ];
}
