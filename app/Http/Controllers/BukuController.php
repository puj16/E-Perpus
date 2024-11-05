<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $databuku = Buku::with(['penulis', 'penerbit', 'kategori'])->get();
        $datapenulis = Penulis::all();
        $datapenerbit = Penerbit::all();
        $datakategori = Kategori::all();
        $user = Auth::user();
        return view('admin.buku', compact('databuku','datapenulis','datapenerbit', 'datakategori','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku',
            'judul' => 'required',
            'penulis_id' => 'required',
            'penerbit_id' => 'required',
            'kategori_id' => 'required',
            'tahun_terbit' => 'required|digits:4',
            'cover' => 'image|mimes:jpeg,png|max:2048',
            'file_buku' => 'required|mimes:pdf|max:10000',
            'stok' => 'required|integer'
        ]);
        
        $coverName = null;
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = $request->kode_buku . date('YmdH') . '.' . $cover->getClientOriginalExtension();
            $cover->storeAs('assets/covers', $coverName, 'public');        }


        $fileName = null;
        if ($request->hasFile('file_buku')) {
            $file = $request->file('file_buku');
            $fileName = $request->kode_buku . date('YmdH') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('assets/books', $fileName, 'public');        }


        // Menyimpan data buku ke database
        $buku = new Buku();
        $buku->kode_buku = $request->kode_buku;
        $buku->judul = $request->judul;
        $buku->penulis_id = $request->penulis_id;
        $buku->penerbit_id = $request->penerbit_id;
        $buku->kategori_id = $request->kategori_id;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->cover = $coverName;
        $buku->file_buku = $fileName;
        $buku->stok = $request->stok;
        $buku->save();
        
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!!');    }
    
   

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required',
            'penulis_id' => 'required',
            'penerbit_id' => 'required',
            'kategori_id' => 'required',
            'tahun_terbit' => 'required|digits:4',
            'stok' => 'required|integer'
        ]);

        $buku = Buku::find($id);

        // Update cover buku jika ada file baru
        if ($request->hasFile('cover')) {
            $coverPath = 'public/assets/covers/' . $buku->cover; // Add the correct folder to the path
            if ($buku->cover && Storage::disk('local')->exists($coverPath)) {
                Storage::disk('local')->delete($coverPath);
            }
            $cover = $request->file('cover');
            $coverName = $request->kode_buku . date('YmdH') . '.' . $cover->getClientOriginalExtension();
            $cover->storeAs('assets/covers', $coverName, 'public');        
            $buku->cover = $coverName;
        }

        // Update file buku jika ada file baru
        if ($request->hasFile('file_buku')) {
            $fileBukuPath = 'public/assets/books/' . $buku->file_buku;
            if ($buku->file_buku && Storage::disk('local')->exists($fileBukuPath)) {
                Storage::disk('local')->delete($fileBukuPath);
            }
            $file = $request->file('file_buku');
            $fileName = $request->kode_buku . date('YmdH') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('assets/books', $fileName, 'public');
            $buku->file_buku = $fileName; // Correct this assignment
        }
        

        $buku->judul = $request->judul;
        $buku->penulis_id = $request->penulis_id;
        $buku->penerbit_id = $request->penerbit_id;
        $buku->kategori_id = $request->kategori_id;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;
        $buku->update();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
{
    // Use the $buku object directly since it is type-hinted
    if ($buku) { // Ensure the book is found
        // Check and delete the cover if it exists
        if ($buku->cover) {
            $coverPath = 'public/assets/covers/' . $buku->cover; // Add the correct folder to the path
            if (Storage::disk('local')->exists($coverPath)) {
                Storage::disk('local')->delete($coverPath);
            }
        }

        // Check and delete the book file if it exists
        if ($buku->file_buku) {
            $fileBukuPath = 'public/assets/books/' . $buku->file_buku; // Ensure it points to the right folder
            if (Storage::disk('local')->exists($fileBukuPath)) {
                Storage::disk('local')->delete($fileBukuPath);
            }
        }

        // Delete the book from the database
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    } else {
        return redirect('/tampil-buku')->with('error', 'Buku tidak ditemukan!!');
    }
}

}
