<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'id_pinjam',
        'tgl_dikembalikan',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_pinjam');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_kode', 'kode_buku');
    }
}
