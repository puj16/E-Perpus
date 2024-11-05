<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembacaController extends Controller
{
    //
    public function index()
    {
        $datamember = User::where('role', 1)->get();
        $user=Auth::user();
        return view('admin.pembaca',compact('datamember','user'));
    }
    public function destroy($id) {
        $data = User::find($id);
        $data->delete();
        return redirect('/tampil-pembaca');
    }


}
