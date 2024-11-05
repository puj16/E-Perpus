<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku'; // Tambahkan string
    protected $primaryKey = 'kode_buku';
    public $incrementing = false; // Karena kode_buku bukan auto-increment
    protected $keyType = 'string'; // Karena primary key menggunakan string
    protected $fillable = ['kode_buku', 'judul', 'penulis_id', 'penerbit_id', 'kategori_id', 'tahun_terbit', 'cover', 'file_buku', 'stok' ];

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'penulis_id');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }

   public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_kode', 'kode_buku');
    }
}
