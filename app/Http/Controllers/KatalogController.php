<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class KatalogController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        // Ambil semua buku dari database
        $books = Buku::all(); // Anda bisa menambahkan filter jika diperlukan

        // Ambil semua kategori (jika diperlukan)
        $categories = Kategori::all(); // Jika ada model kategori

        return view('pembaca.dashboard', compact('books', 'categories'));
    }
    public function index(Request $request)
{
    // Ambil filter pencarian jika ada
    $search = $request->input('search');
    $category = $request->input('category'); // Ambil filter kategori jika ada

    
    // Ambil buku berdasarkan kategori dan pencarian
    $books = Buku::when($category, function ($query, $category) {
            return $query->where('kategori_id', $category); // Filter berdasarkan kategori
        })
        ->when($search, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%'); // Filter berdasarkan pencarian judul
        })
        ->get();

    // Ambil semua kategori
    $categories = Kategori::all();

    return view('pembaca.katalog', compact('books', 'categories'));
}



    public function show($kode_buku)
    {
        // Cari buku berdasarkan kode_buku
        $book = Buku::where('kode_buku', $kode_buku)->firstOrFail();
    
        // Kembalikan view 'katalog.detail' dengan data buku
        return view('pembaca.detailBuku', compact('book', 'kode_buku'));
    }    
}
