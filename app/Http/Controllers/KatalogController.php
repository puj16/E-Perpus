<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        // Reset filter saat mengakses halaman katalog tanpa filter
        if ($request->has('reset_filters')) {
            session()->forget(['filter_category', 'filter_search']);
            return redirect()->route('katalog.index');
        }
    
        // Mengambil input filter dari permintaan atau sesi jika sebelumnya sudah ada
        $search = $request->input('search', session('filter_search', ''));
        $category = $request->input('category', session('filter_category', ''));
    
        // Simpan filter ke sesi agar dipertahankan saat navigasi
        session([
            'filter_search' => $search,
            'filter_category' => $category,
        ]);
    
        $booksQuery = Buku::query();
    
        if ($category) {
            $booksQuery->where('kategori_id', $category);
        }
    
        if ($search) {
            $booksQuery->where('judul', 'LIKE', '%' . $search . '%');
        }
        $booksQuery->with('penerbit');
        $books = $booksQuery->orderBy('created_at', 'desc')->paginate(10);
    
        // Jika permintaan AJAX, kembalikan data sebagai JSON
        if ($request->ajax()) {
            return response()->json([
                'books' => $books->items(),
                'pagination' => $books->links()->render(), // Menyediakan HTML pagination
            ]);
        }
    
        // Data untuk halaman utama
        $categories = Kategori::all();
        $user = Auth::user();

        return view('pembaca.katalog', compact('books', 'categories', 'user'));
    }
    
    public function show($kode_buku, Request $request)
    {
        // Cari buku berdasarkan kode_buku
        $book = Buku::where('kode_buku', $kode_buku)->firstOrFail();
        $user = Auth::user();

        $request->session()->put('origin', $request->input('origin', 'katalog'));

        // Kembalikan view 'katalog.detail' dengan data buku
        return view('pembaca.detailBuku', compact('book', 'kode_buku', 'user'));
    }
    
}
