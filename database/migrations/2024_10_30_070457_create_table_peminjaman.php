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
        Schema::create('peminjaman', function(Blueprint $table){
            $table -> id();
            $table->string('nip_nidn_nim', 15);
            $table->foreign('nip_nidn_nim')->references('nip_nim_nidn')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('buku_kode', 255);
            $table->foreign('buku_kode')->references('kode_buku')->on('buku')->onDelete('cascade')->onUpdate('cascade');
            $table -> date('tgl_pinjam');
            $table -> date('tgl_kembali')->nullable();
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};