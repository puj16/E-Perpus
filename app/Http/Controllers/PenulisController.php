<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penulis;
use Illuminate\Support\Facades\Auth;

class PenulisController extends Controller
{
    public function index() {
        $data = Penulis::all();
        $nextId = Penulis::max('id') + 1;
        $user = Auth::user();
        return view ('admin.penulis', [
            'dataPenulis' => $data,
            'nextId' => $nextId,
            'user' =>$user
        ]);
    }

    public function create() {
        $nextId = Penulis::max('id') + 1;
        return view('penulis.create', compact('nextId')
        );
    }

    public function store(Request $request) {
        $data = new Penulis();
        $data->id = $request->id;
        $data->nama_penulis = $request->nama_penulis;
        $data->save();
        return redirect('/tampil-penulis');
    }

    public function edit($id) {
        $data = Penulis::find($id);
        return view('penulis.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $data = Penulis::find($id);
        $data->nama_penulis = $request->nama_penulis;
        $data->update();
        return redirect('/tampil-penulis');
    }

    public function destroy($id) {
        $data = Penulis::find($id);
        $data->delete();
        return redirect('/tampil-penulis');
    }


}
