<?php

namespace App\Exports;

use App\Models\Pengembalian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengembalianExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengembalian::select("id_kembali","id_pinjam","tgl_dikembalikan")->get();
    }
    public function headings(): array
    {
        return ["ID Pengembalian", "ID Peminjaman", "Tanggal Buku Dikembalikan"];
    }
}
