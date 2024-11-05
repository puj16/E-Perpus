<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
        public function index() {
            $data = Kategori::all();
            $nextId = Kategori::max('id') + 1;
            $user=Auth::user();
            return view('admin.kategori', [
                'dataKategori' => $data,
                'nextId' => $nextId,
                'user'=>$user
            ]);        }
    
        public function create() {
            $nextId = Kategori::max('id') + 1;
            return view('kategori.create', compact('nextId')
            );
        }
    
        public function store(Request $request) {
            $data = new Kategori();
            $data->id = $request->id;
            $data->nama_kategori = $request->nama_kategori;
            $data->save();
            return redirect('/tampil-kategori');
        }
    
        public function edit($id) {
            $data = Kategori::find($id);
            return view('kategori.edit', compact('data'));
        }
    
        public function update(Request $request, $id) {
            $data = Kategori::find($id);
            $data->nama_kategori = $request->nama_kategori;
            $data->update();
            return redirect('/tampil-kategori');
        }
    
        public function destroy($id) {
            $data = Kategori::find($id);
            $data->delete();
            return redirect('/tampil-kategori');
        }
    
}
