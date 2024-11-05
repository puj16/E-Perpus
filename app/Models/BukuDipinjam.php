<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuDipinjam extends Model
{
    use HasFactory;
    protected $table = 'buku_dipinjam';
    protected $fillable = [
        'peminjaman_id'
    ];

    /**
     * Relasi dengan model User.
     * Peminjaman terkait dengan satu user (relasi one-to-one atau many-to-one)
     */

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    /**
     * Relasi dengan model Buku.
     * Peminjaman terkait dengan satu buku (relasi one-to-one atau many-to-one)
     */
    
}
