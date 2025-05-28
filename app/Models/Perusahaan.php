<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaans'; // default Laravel akan menebak nama tabel jamak

    protected $fillable = [
        'nama_perusahaan',
        'judul_deskripsi',
        'deskripsi',
        'alamat',
        'telepon',
        'email',
        'logo',
    ];
}
