<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;
    protected $table = 'penerbit';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_penerbit'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'penerbit_id');
    }
}
