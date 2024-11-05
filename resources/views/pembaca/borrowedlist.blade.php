@extends('layouts.masterpembaca')

@section('title', 'Buku yang Dipinjam')

@section('content')
    <div class="header-container">
        <h1>Buku yang Dipinjam</h1>
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
        @if ($dipinjam->isEmpty())
            <p>Tidak ada buku yang dipinjam saat ini.</p>
        @else
            @foreach ($dipinjam as $pinjam)
                @php
                    $buku = $pinjam->peminjaman->buku; // Ambil data buku dari peminjaman
                    $tglKembali = $pinjam->peminjaman->tgl_kembali; // Ambil tanggal kembali
                @endphp
                <div class="book">
                    <a href="{{ route('katalog.detail', $buku->kode_buku) }}">
                        <img src="{{ asset('storage/assets/covers/' . $buku->cover) }}" alt="Cover buku {{ $buku->judul }}">
                        <h3>{{ $buku->judul }}</h3>
                        <p>Tanggal Kembali: {{ $tglKembali }}</p>
                    </a>
                    
                </div>
            @endforeach
        @endif
    </div>
@endsection
