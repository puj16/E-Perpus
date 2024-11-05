<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerbit;
use Illuminate\Support\Facades\Auth;

class PenerbitController extends Controller
{
    public function index() {
        $data = Penerbit::all();
        $nextId = Penerbit::max('id') + 1;
        $user = Auth::user();
        return view ('admin.penerbit', [
            'dataPenerbit' => $data,
            'nextId' => $nextId,
            'user' =>$user
        ]);
    }

    public function create() {
        $nextId = Penerbit::max('id') + 1;
        return view('penerbit.create', compact('nextId')
        );
    }

    public function store(Request $request) {
        $data = new Penerbit();
        $data->id = $request->id;
        $data->nama_penerbit = $request->nama_penerbit;
        $data->save();
        return redirect('/tampil-penerbit');
    }

    public function edit($id) {
        $data = Penerbit::find($id);
        return view('penerbit.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $data = Penerbit::find($id);
        $data->nama_penerbit = $request->nama_penerbit;
        $data->update();
        return redirect('/tampil-penerbit');
    }

    public function destroy($id) {
        $data = Penerbit::find($id);
        $data->delete();
        return redirect('/tampil-penerbit');
    }

}
