<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($peminjaman) {
            $peminjaman->status = DB::table('pengembalian')->where('id_pinjam', $peminjaman->id)->exists()
                ? 'Sudah Dikembalikan'
                : 'Belum Dikembalikan';

            return [
                'id' => $peminjaman->id,
                'nip_nidn_nim' => $peminjaman->nip_nidn_nim,
                'buku_kode' => $peminjaman->buku_kode,
                'tgl_pinjam' => $peminjaman->tgl_pinjam,
                'tgl_kembali' => $peminjaman->tgl_kembali,
                'status' => $peminjaman->status,
            ];
        });
    }
    
    public function headings(): array
    {
        return ["ID Peminjaman", "Nomor Identitas Peminjam", "Kode Buku", "Tanggal Pinjam", "Tanggal Jadwal Kembali", "Status"];
    }
}
