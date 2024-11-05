<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari default (plural of the class name)
    protected $table = 'peminjaman';

    // Tentukan kolom-kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nip_nidn_nim',
        'buku_kode',
        'tgl_pinjam',
        'tgl_kembali',
    ];

    /**
     * Relasi dengan model User.
     * Peminjaman terkait dengan satu user (relasi one-to-one atau many-to-one)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'nip_nidn_nim', 'nip_nim_nidn');
    }

    /**
     * Relasi dengan model Buku.
     * Peminjaman terkait dengan satu buku (relasi one-to-one atau many-to-one)
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_kode', 'kode_buku');
    }

    public function bukudipinjam()
    {
        return $this->hasMany(BukuDipinjam::class, 'id_kategori');
    }
}
