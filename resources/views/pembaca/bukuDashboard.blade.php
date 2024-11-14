@extends('layouts.masterpembaca')

@section('title', 'Detail Buku')

@section('content')
<div class="main">
    <h1>Katalog Perpustakaan</h1>
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
                    <a href="{{ route('pembaca.dashboard') }}" class="btn-back">Back</a>
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
