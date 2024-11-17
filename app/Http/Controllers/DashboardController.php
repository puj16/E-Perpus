<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard() {
        if(Auth::User()->role == '1'){
            $books = Buku::latest()->take(5)->get(); 
            $categories = Kategori::all();
            $user = Auth::user();
            return view('pembaca.dashboard', compact('books', 'categories','user'));
        }
        
        elseif(Auth::User()->role=='0'){
            $user=Auth::user();
            
                $dataPengembalian = DB::table('pengembalian')
                ->selectRaw('MONTH(tgl_dikembalikan) as bulan, COUNT(*) as jumlah_pengembalian')
                ->groupBy(DB::raw('MONTH(tgl_dikembalikan)'))
                ->orderBy(DB::raw('MONTH(tgl_dikembalikan)'))
                ->get();
        
            $jumlahPengembalian = array_fill(1, 12, 0);
            foreach ($dataPengembalian as $row) {
                $jumlahPengembalian[$row->bulan] = $row->jumlah_pengembalian;
            }
        
            // Data untuk peminjaman yang belum dikembalikan
            $dataPeminjamanBelumDikembalikan = DB::table('peminjaman')
                ->leftJoin('pengembalian', 'peminjaman.id', '=', 'pengembalian.id_pinjam')
                ->whereNull('pengembalian.id_kembali') // Filter peminjaman yang belum ada di tabel pengembalian
                ->selectRaw('MONTH(peminjaman.tgl_pinjam) as bulan, COUNT(*) as jumlah_peminjaman_belum_kembali')
                ->groupBy(DB::raw('MONTH(peminjaman.tgl_pinjam)'))
                ->orderBy(DB::raw('MONTH(peminjaman.tgl_pinjam)'))
                ->get();
        
            $jumlahPeminjamanBelumDikembalikan = array_fill(1, 12, 0);
            foreach ($dataPeminjamanBelumDikembalikan as $row) {
                $jumlahPeminjamanBelumDikembalikan[$row->bulan] = $row->jumlah_peminjaman_belum_kembali;
            }
        
            // Data untuk total peminjaman (sudah dikembalikan + belum dikembalikan)
            $dataTotalPeminjaman = DB::table('peminjaman')
                ->selectRaw('MONTH(tgl_pinjam) as bulan, COUNT(*) as jumlah_total_peminjaman')
                ->groupBy(DB::raw('MONTH(tgl_pinjam)'))
                ->orderBy(DB::raw('MONTH(tgl_pinjam)'))
                ->get();
        
            $jumlahTotalPeminjaman = array_fill(1, 12, 0);
            foreach ($dataTotalPeminjaman as $row) {
                $jumlahTotalPeminjaman[$row->bulan] = $row->jumlah_total_peminjaman;
            }
        
            return view('admin.dashboard', [
                'jumlahPengembalian' => $jumlahPengembalian,
                'jumlahPeminjamanBelumDikembalikan' => $jumlahPeminjamanBelumDikembalikan,
                'jumlahTotalPeminjaman' => $jumlahTotalPeminjaman,
                'user'=>$user
            ]); 
       
        }
        
        else{
            $message = "Invalid credentials, please try again."; // Set message for failed login
            return redirect()->back();            }

    }

    public function detail($kode_buku)
    {
        $book = Buku::where('kode_buku', $kode_buku)->firstOrFail(); // Menampilkan detail buku
        $user = Auth::user();

        return view('pembaca.bukuDashboard', compact('book', 'kode_buku', 'user'));
    }

}
