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
    protected $description = 'Hapus data buku dipinjam yang berhubungan dengan peminjaman yang sudah kembali hari ini dan perbarui stok buku.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ambil tanggal hari ini
        $today = Carbon::today();

        // Cari peminjaman yang memiliki tanggal kembali hari ini atau sebelumnya
        $peminjaman = Peminjaman::where('tgl_kembali', '<=', $today)->get();

        // Loop melalui peminjaman yang ditemukan
        foreach ($peminjaman as $pinjam) {
            // Ambil buku yang dipinjam berdasarkan peminjaman_id
            $bukuDipinjam = BukuDipinjam::where('peminjaman_id', $pinjam->id)->get();

            foreach ($bukuDipinjam as $buku) {
                // Ambil buku yang dipinjam
                $bukuDetail = $buku->buku; // Pastikan relasi ke model Buku sudah ada
                if ($bukuDetail) {
                    // Setiap entri BukuDipinjam mewakili satu buku yang dipinjam
                    $bukuDetail->increment('stok'); // Tambah stok 1 untuk setiap buku yang dikembalikan
                }

                // Hapus data buku dipinjam
                $buku->delete();
            }

            // Tambahkan data ke tabel pengembalian
            Pengembalian::create([
                'id_pinjam' => $pinjam->id,
                'tgl_dikembalikan' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            // Opsional: Anda bisa menghapus peminjaman jika sudah tidak relevan
            // $pinjam->delete(); // Atau lakukan update status jika diperlukan
        }

        // Menampilkan output
        $this->info('Data buku yang dipinjam berhasil dihapus dan stok buku diperbarui.');
    }
}
