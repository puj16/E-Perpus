<?php

namespace App\Http\Controllers;

use App\Exports\PengembalianExport;
use App\Models\BukuDipinjam;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function store(Request $request, $id)
    {
        try {
            
            $bukuDipinjam = BukuDipinjam::findOrFail($id);
            $peminjaman = $bukuDipinjam->peminjaman;
    
            // Tambahkan data ke tabel pengembalian
            Pengembalian::create([
                'id_pinjam' => $peminjaman->id,
                'tgl_dikembalikan' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
    
            // Tambahkan stok buku kembali
            $peminjaman->buku->increment('stok');
    
            // Hapus data dari tabel buku_dipinjam
            $bukuDipinjam->delete();
    
            return response()->json(['success' => true, 'message' => 'Buku berhasil dikembalikan!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function show(){
        $data = Pengembalian::all();
        $user = Auth::user();
        return view ('admin.pengembalian', [
            'dataPengembalian' => $data,
            'user' =>$user
        ]);
    }
    public function export() 
    {
        return Excel::download(new PengembalianExport, 'Lap.Pengembalian('. date('Y-m-d H:i:s').').'.'xlsx');
    }
}    