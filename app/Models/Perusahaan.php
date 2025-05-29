<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaans'; // ini sudah benar, default Laravel memang jamak

    protected $fillable = [
        'nama_perusahaan',
        'judul_deskripsi',  // pastikan kolom ini ada di tabel, kalau tidak hapus
        'deskripsi',
        'alamat',
        'telepon',
        'email',
        'logo',
        'status',          // tambahkan kolom status agar bisa diisi mass assignment
    ];

    // Optional: membuat accessor agar mudah cek status aktif
    public function isActive(): bool
    {
        return $this->status === 'aktif';
    }
}
