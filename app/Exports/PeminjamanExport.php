<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil data peminjaman dan tambahkan status berdasarkan pengecekan di tabel pengembalian
        return Peminjaman::select("id","nip_nidn_nim","buku_kode","tgl_pinjam","tgl_kembali")
            ->get()
            ->map(function ($peminjaman) {
                // Cek apakah id peminjaman ada di tabel pengembalian
                $status = DB::table('pengembalian')->where('id_pinjam', $peminjaman->id)->exists()
                    ? 'Sudah Dikembalikan'
                    : 'Belum Dikembalikan';
                
                // Tambahkan status ke dalam data peminjaman
                $peminjaman->status = $status;
                
                return $peminjaman;
            });
    }

    public function headings(): array
    {
        return ["ID Peminjaman", "Nomor Identitas Peminjam", "Kode Buku", "Tanggal Pinjam", "Tanggal Jadwal Kembali", "Status"];
    }
}
