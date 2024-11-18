@extends('layouts.masterpembaca')

@section('title', 'Detail Buku')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="{{ asset('assets/css/profil.css') }}" rel="stylesheet"> <!-- Pastikan link ke CSS lokal juga ada -->
<div class="mainnn">
    <h1>Katalog Perpustakaan</h1>
    <div>
        @if(session()->has('message'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="20" height="20">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
                {{ session()->get('message') }}
            </div>
            <!-- Tombol close di ujung kanan -->
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    
    <div class="catalog-container">
        <div class="book-detail">
            <!-- Menampilkan cover buku -->
            <img src="{{ asset('storage/assets/covers/' . $book->cover) }}" alt="Book Cover" class="book-cover">
            <div class="book-info">
                <table>
                    <tr>
                        <td><strong>Judul</strong></td>
                        <!-- Menampilkan judul buku dari database -->
                        <td>{{ $book->judul }}</td>
                    </tr>
                    <tr>
                        <td><strong>Penulis</strong></td>
                        <!-- Menampilkan penulis buku dari database -->
                        <td>{{ $book->penulis->nama_penulis }}</td>
                    </tr>
                    <tr>
                        <td><strong>Penerbit</strong></td>
                        <!-- Menampilkan penerbit buku dari database -->
                        <td>{{ $book->penerbit->nama_penerbit }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kategori</strong></td>
                        <!-- Menampilkan kategori buku dari database -->
                        <td>{{ $book->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tahun Terbit</strong></td>
                        <!-- Menampilkan tahun terbit buku dari database -->
                        <td>{{ $book->tahun_terbit }}</td>
                    </tr>
                    <tr>
                        <td><strong>Stok</strong></td>
                        <!-- Menampilkan stok buku dari database -->
                        <td>{{ $book->stok }}</td>
                    </tr>
                </table>
                <div class="buttons">
                    <a href="{{ session('origin') === 'dashboard' ? route('pembaca.dashboard') : (session('origin') === 'katalog' ? route('katalog.index') : route('pembaca.history')) }}" class="btn-back">Back</a>
                    
                    @if($book->stok > 0)
                        <!-- Jika stok lebih dari 0, tampilkan tombol pinjam -->
                        <form action="{{ route('peminjaman.store', $book->kode_buku) }}" method="post" class="d-inline-block">
                            @csrf
                            <button class="btn-borrow">Pinjam</button>
                        </form>
                    @else
                        <!-- Jika stok 0, tombol dinonaktifkan -->
                        <button class="btn-disabled" disabled>Pinjam</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
