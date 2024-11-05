<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function(Blueprint $table){
            $table -> string('kode_buku')->primary();
            $table -> string('judul');
            $table->foreignId('penulis_id')->constrained('penulis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('penerbit_id')->constrained('penerbit')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade')->onUpdate('cascade');
            $table -> year('tahun_terbit');
            $table -> string('cover')->nullable();
            $table -> string('file_buku')->nullable();
            $table -> integer('stok');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
