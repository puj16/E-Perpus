<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfilPembacaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pembaca.profilPembaca', compact('user'));
    }


    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = auth()->user(); // Mendapatkan pengguna yang sedang login
    
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',  // Validasi untuk nama
            'email' => 'required|email',  // Validasi email
            'nohp' => 'required',  // Validasi nomor HP
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'password' => 'nullable|min:8|confirmed', // Validasi password dengan konfirmasi
        ]);
        
        // Update name (nama lengkap), email, dan no_hp
        $user->name = $request->input('name'); // Mengubah nama pengguna
        $user->email = $request->input('email');
        $user->no_hp = $request->input('nohp');
    
        // Cek apakah ada password baru yang diisi
        if ($request->filled('password')) {
            // Hash password baru sebelum disimpan
            $user->password = bcrypt($request->input('password'));
        }
    
        // Cek jika ada foto baru yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && \Storage::exists('public/assets/fotos/' . $user->foto)) {
                \Storage::delete('public/assets/fotos/' . $user->foto);
            }
    
            // Simpan foto baru
            $path = $request->file('foto')->store('public/assets/fotos');
            $filename = basename($path);
    
            // Update path foto di database
            $user->foto = $filename;
        }
    
        // Simpan perubahan
        $user->save();
    
        // Redirect dengan pesan sukses
        return redirect()->back()->with('status', 'Profile updated successfully!');
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(Request $request)
    {

    }
}
