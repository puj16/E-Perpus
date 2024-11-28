<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peminjaman;
use App\Models\BukuDipinjam;
use App\Models\Pengembalian;
use Carbon\Carbon;

class PengembalianOtomatis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pengembalian:otomatis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus data buku dipinjam yang berhubungan dengan peminjaman yang sudah kembali hari ini';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ambil tanggal hari ini
        $today = Carbon::today();

        // Cari peminjaman yang memiliki tanggal kembali hari ini
        // $peminjaman = Peminjaman::where('tgl_kembali', $today)->get();
        $peminjaman = Peminjaman::where('tgl_kembali', '<=', $today)->get();
        // Loop melalui peminjaman yang ditemukan
        foreach ($peminjaman as $pinjam) {
            // Hapus buku yang dipinjam berdasarkan peminjaman_id
            BukuDipinjam::where('peminjaman_id', $pinjam->id)->delete();
            Pengembalian::create([
                'id_pinjam' => $pinjam->id,
                'tgl_dikembalikan' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            // Opsional: Anda bisa juga menghapus atau memperbarui peminjaman, jika perlu
            // $pinjam->delete(); // Atau lakukan update status jika diperlukan
        }

        // Menampilkan output
        $this->info('Data buku yang dipinjam berhasil dihapus untuk peminjaman yang kembali hari ini.');
    }
}