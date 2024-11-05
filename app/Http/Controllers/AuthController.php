<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function registrasi() {
        return view('auth.registrasi');
    }

    public function registrasi_post(Request $request) {
        // dd($request->all());
        $user = request()->validate([
            'nip_nim_nidn' =>'required|unique:users',
            'email'=>'required|unique:users',
            'password'=>'required',
            'name'=>'required',
            'no_hp'=>'required',
            'foto'=>'required'
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = $request->nip_nim_nidn .  '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('assets/fotos', $fotoName, 'public');        }


        $user = new User;
        $user->nip_nim_nidn = trim($request->nip_nim_nidn);
        $user->email = trim($request->email);
        $user->name = trim($request->name);
        $user->password = Hash::make($request->password);
        $user->no_hp = trim($request->no_hp);
        $user->role = "1";
        $user->foto = $fotoName;
        $user->remember_token = Str::random(50);
        $user->save();

        return redirect('/tampil-pembaca')->with('success', 'Register Succesfully');
        // return $fotoName;
    }

    public function login() {
        $message ="";
        return view('auth.login');
    }

    public function login_post(Request $request) {
        // dd($request->all());
        $message ="";
        if(Auth::attempt([
            'nip_nim_nidn' => $request->nip_nim_nidn,
            'password' => $request->password]
        ,true)){
            if(Auth::User()->role == '1'){
                return redirect()->intended('member/dashboard');
            }elseif(Auth::User()->role=='0'){
                // echo "gg"; die();
                return redirect()->intended('pustakawan/dashboard'); 
            }else{
                $message = "Invalid credentials, please try again."; // Set message for failed login
                return redirect()->back();            }
        }else{
            return redirect()->back();
        };
    }

    public function logout(){
        Auth::logout();
        return redirect(url('/'));
    }
    
}
