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
            $books = Buku::all(); 
            $categories = Kategori::all();
            return view('pembaca.dashboard', compact('books', 'categories'));
        }elseif(Auth::User()->role=='0'){
            $user=Auth::user();
            return view('admin.dashboard',compact('user')); 
        }else{
            $message = "Invalid credentials, please try again."; // Set message for failed login
            return redirect()->back();            }

    }
}
