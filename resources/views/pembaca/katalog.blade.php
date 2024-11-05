@extends('layouts.masterpembaca')

@section('title', 'Katalog Perpustakaan')

@section('content')
    <!-- <h1>Katalog Perpustakaan</h1>
    <div class="filter">
        <select>
            <option>-- Filter kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option> <!-- Menampilkan kategori -->
            <!-- @endforeach
        </select>
        <input type="text" placeholder="Cari Buku">
    </div>
    <div class="books">
    @foreach ($books as $book)
        <div class="book">
            <a href="{{ route('katalog.detail', $book->kode_buku) }}">
                <img src="{{ asset('storage/assets/covers/' . $book->cover) }}" alt="Book cover of {{ $book->cover }}">
                <h3>{{ $book->judul }}</h3>
                <p>{{ $book->penerbit->nama_penerbit }}</p>
            </a>
        </div>
    @endforeach -->
    <div class="header-container">
    <h1>Katalog Perpustakaan</h1>
    <div class="filter">
        <form method="GET" action="{{ route('katalog.index') }}">
        <select name="category">
            <option value="">-- Filter kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
            <input type="text" name="search" placeholder="Cari Buku" value="{{ request('search') }}">
        </form>
    </div>
</div>

    <div class="books">
    @if ($books->isEmpty())
        <p>Tidak ada buku yang ditemukan.</p>
    @else
        @foreach ($books as $book)
            <div class="book">
            <a href="{{ route('katalog.detail', $book->kode_buku) }}">
                <img src="{{ asset('storage/assets/covers/' . $book->cover) }}" alt="Book cover of {{ $book->cover }}">
                <h3>{{ $book->judul }}</h3>
                <p>{{ $book->penerbit->nama_penerbit }}</p>
            </a>
            </div>
        @endforeach
    @endif

</div>
@endsection
