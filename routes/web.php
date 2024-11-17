<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PembacaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfilPembacaController;
use App\Models\Pengembalian;

Route::get('registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('registrasi_post', [AuthController::class, 'registrasi_post'])->name('registrasi_post');
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('login_post', [AuthController::class, 'login_post'])->name('login_post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware'=>'pustakawan'], function(){

    Route::get('pustakawan/dashboard',[DashboardController::class,'dashboard']);
    Route::get('profileAdmin', [ProfilAdminController::class, 'index'])->name('profileAdmin');
    Route::post('profileAdminUpdate', [ProfilAdminController::class, 'update'])->name('profileAdminUpdate');

    //Route Kategori
        Route::get('tampil-kategori', [KategoriController::class, 'index'])->name('kategori.show');
        Route::get('tambah-kategori', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('tampil-kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::post('/kategori/edit/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::post('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');
        
    //Route Penulis
        Route::get('tampil-penulis', [PenulisController::class, 'index'])->name('penulis.show');;
        Route::get('tambah-penulis', [PenulisController::class, 'create'])->name('penulis.create');
        Route::post('tampil-penulis', [PenulisController::class, 'store'])->name('penulis.store');
        Route::get('/penulis/edit/{id}', [PenulisController::class, 'edit'])->name('penulis.edit');
        Route::post('/penulis/edit/{id}', [PenulisController::class, 'update'])->name('penulis.update');
        Route::post('/penulis/delete/{id}', [PenulisController::class, 'destroy'])->name('penulis.delete');
    
    //Route Penerbit
        Route::get('tampil-penerbit', [PenerbitController::class, 'index'])->name('penerbit.show');;
        Route::get('tambah-penerbit', [PenerbitController::class, 'create'])->name('penerbit.create');
        Route::post('tampil-penerbit', [PenerbitController::class, 'store'])->name('penerbit.store');
        Route::get('/penerbit/edit/{id}', [PenerbitController::class, 'edit'])->name('penerbit.edit');
        Route::post('/penerbit/edit/{id}', [PenerbitController::class, 'update'])->name('penerbit.update');
        Route::post('/penerbit/delete/{id}', [PenerbitController::class, 'destroy'])->name('penerbit.delete');
    
    // Route penerbit
        Route::resource('buku',BukuController::class);

        Route::get('tampil-pembaca', [PembacaController::class, 'index'])->name('pembaca.show');
        Route::delete('/pembaca/delete/{id}', [PembacaController::class, 'destroy'])->name('pembaca.delete');
        Route::get('peminjaman', [PeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::get('pinjam/export/', [PeminjamanController::class, 'export'])->name('peminjaman.export');
        Route::get('pinjam/report/', [PeminjamanController::class, 'report'])->name('peminjaman.report');
        Route::get('pengembalian', [PengembalianController::class, 'show'])->name('pengembalian.show');
        Route::get('kembali/export/', [PengembalianController::class, 'export'])->name('pengembalian.export');

});

    Route::group(['middleware'=>'member'], function(){
        Route::get('profilePembaca', [ProfilPembacaController::class, 'index'])->name('profilePembaca');
        Route::post('profilePembacaUpdate', [ProfilPembacaController::class, 'update'])->name('profilePembacaUpdate');

        Route::get('member/dashboard',[DashboardController::class,'dashboard'])->name('pembaca.dashboard'); 
        Route::get('member/dashboard/{kode_buku}', [DashboardController::class, 'detail'])->name('pembaca.detail');
        Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
        Route::get('/katalog/{kode_buku}', [KatalogController::class, 'show'])->name('katalog.detail');
        Route::post('/peminjaman/create/{kode}', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('/borrowedlist', [PeminjamanController::class, 'index'])->name('pembaca.pinjam');
        Route::post('/pengembalian/{id}', [PengembalianController::class, 'store'])->name('pengembalian.store');
        Route::post('/perpanjangan/{id}', [PeminjamanController::class, 'perpanjangan'])->name('peminjaman.perpanjangan');
    });
    
    // Route Katalog
    
    Route::get('/cek', [PeminjamanController::class, 'index']);



    //Route Login
    
    


