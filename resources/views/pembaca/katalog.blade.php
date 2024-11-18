@extends('layouts.masterpembaca')

@section('title', 'Dashboard')

@section('content')
<div class="header-container">
    <h1>Katalog Perpustakaan</h1>
    <div class="filter">
        <form id="filterForm" method="GET" action="{{ route('katalog.index') }}">
        <select name="category" id="category">
                <option value="">-- Filter kategori --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category', session('filter_category', '')) == $category->id ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>

                @endforeach
            </select>

            <div class="search-container">
                <input type="text" id="search" name="search" placeholder="Cari Buku" value="{{ request('search') }}">
                <button type="button" id="clearSearch" style="display: {{ request('search') ? 'inline' : 'none' }};">&times;</button>
            </div>
        </form>
    </div>
</div>

<div id="loading" style="display: none;">
    <img src="{{ asset('assets/images/loading.svg') }}" alt="Loading" />
</div>

<div class="books">
    @if ($books->isEmpty())
        <p>Tidak ada buku yang ditemukan.</p>
    @else
        @foreach ($books as $book)
        <div class="book">
            <a href="{{ route('katalog.detail', ['kode_buku' => $book->kode_buku, 'origin' => 'katalog']) }}">
                <img src="{{ asset('storage/assets/covers/' . $book->cover) }}" alt="Book cover of {{ $book->cover }}">
                <h3>{{ $book->judul }}</h3>
                <p>{{ $book->penerbit->nama_penerbit }}</p>
            </a>
        </div>
        @endforeach
    @endif
</div>

<div class="pagination">
    {{ $books->links() }}
</div>

<script src="{{ asset('assets/js/script.js') }}"></script>
@endsection