<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\BukuDipinjam;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    //
    public function index()
    {
        $userNipNimNidn = Auth::user()->nip_nim_nidn;
        $categories = Kategori::all();
        $user = Auth::user();
    
        // Ambil data buku yang dipinjam yang berelasi dengan peminjaman yang terkait dengan user yang sesuai
        $dipinjam = BukuDipinjam::whereHas('peminjaman', function ($query) use ($userNipNimNidn) {
            $query->where('nip_nidn_nim', $userNipNimNidn);
        })->with('peminjaman.buku')->get();

        return view('pembaca.borrowedlist',compact('dipinjam','categories','userNipNimNidn','user'));
    }

    public function store($kode)
    {
        // 1. Ambil nip_nim_nidn dari user yang login
        $nip_nim_nidn = Auth::user()->nip_nim_nidn;

        // 2. Cek jumlah buku yang sudah dipinjam oleh user yang login
        $activeBorrowCount = BukuDipinjam::whereHas('peminjaman', function ($query) use ($nip_nim_nidn) {
            $query->where('nip_nidn_nim', $nip_nim_nidn);
        })->count();

        // 3. Jika jumlah buku yang dipinjam sudah mencapai 3, tampilkan pesan error
        if ($activeBorrowCount >= 3) {
            return redirect()->back()->with('message', 'Anda hanya dapat meminjam maksimal 3 buku sekaligus!');
        }

        // 4. Cek apakah buku dengan kode dan user sudah ada di tabel buku_dipinjam
        $isAlreadyBorrowed = BukuDipinjam::whereHas('peminjaman', function ($query) use ($nip_nim_nidn, $kode) {
            $query->where('nip_nidn_nim', $nip_nim_nidn)
                ->where('buku_kode', $kode);
        })->exists();

        // 5. Jika buku sudah dipinjam, kembalikan pesan error
        if ($isAlreadyBorrowed) {
        return redirect()->back()->with('message', 'Buku sudah dipinjam!');
        }

        // 6. Dapatkan tanggal hari ini untuk tgl_pinjam
        $tgl_pinjam = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');

        // 7. Tambahkan 7 hari untuk tgl_kembali dalam timezone yang sama
        $tgl_kembali = Carbon::now()->setTimezone('Asia/Jakarta')->addWeek()->format('Y-m-d H:i:s');

        // 8. Ambil buku berdasarkan kode
        $buku = Buku::where('kode_buku', $kode)->first();

        // 9. Cek apakah stok buku masih tersedia
        if ($buku->stok > 0) {
            // 10. Simpan data ke tabel peminjaman
            $peminjaman = Peminjaman::create([
                'nip_nidn_nim' => $nip_nim_nidn,  // nip_nim_nidn dari user login
                'buku_kode' => $kode,             // kode buku dari parameter URL
                'tgl_pinjam' => $tgl_pinjam,      // tanggal peminjaman adalah hari ini
                'tgl_kembali' => $tgl_kembali,    // tanggal kembali adalah 7 hari kemudian
            ]);

            BukuDipinjam::create([
                'peminjaman_id' => $peminjaman->id,
            ]);

            // 11. Kurangi stok buku
            $buku->stok -= 1;
            $buku->save(); // Update stok buku di database

            // 12. Redirect atau tampilkan pesan sukses
            return redirect('/borrowedlist')->with('success', 'Buku berhasil dipinjam!');
        } else {
            // Jika stok habis, tampilkan pesan error
            return redirect()->back()->with('message', 'Stok buku tidak mencukupi!');
        }
    }





    
}
