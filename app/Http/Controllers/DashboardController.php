<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard() {
        if(Auth::User()->role == '1'){
            $books = Buku::latest()->take(5)->get(); 
            $categories = Kategori::all();
            $user = Auth::user();
            return view('pembaca.dashboard', compact('books', 'categories','user'));
        }elseif(Auth::User()->role=='0'){
            $user=Auth::user();
            return view('admin.dashboard',compact('user')); 
        }else{
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
