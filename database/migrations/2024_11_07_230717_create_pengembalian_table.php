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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id('id_kembali'); // Primary key for pengembalian
            $table->foreignId('id_pinjam') // Foreign key for peminjaman
                  ->constrained('peminjaman')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('tgl_dikembalikan'); // Date of return
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
