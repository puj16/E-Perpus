@extends('layouts.masterpembaca')

@section('title', 'History')

@section('content')
<h1>History Peminjaman Buku</h1>

<div id="loading" style="display: none;">
    <img src="{{ asset('assets/images/loading.svg') }}" alt="Loading" />
</div>

<div class="books">
    @if ($groupedReturns->isEmpty())
        <p>Tidak ada history peminjaman ditemukan.</p>
    @else
        @foreach ($groupedReturns as $returns)
            @php
                // Ambil pengembalian pertama (terbaru) untuk setiap buku
                $return = $returns->first();
            @endphp
            <div class="book">
                <a href="{{ route('katalog.detail', ['kode_buku' => $return->peminjaman->buku->kode_buku, 'origin' => 'history']) }}">
                    <img src="{{ asset('storage/assets/covers/' . $return->peminjaman->buku->cover) }}" alt="Book cover of {{ $return->peminjaman->buku->judul }}">
                    <h3>{{ $return->peminjaman->buku->judul }}</h3>
                    <p>{{ $return->peminjaman->buku->penerbit->nama_penerbit }}</p>
                </a>
            </div>
        @endforeach
    @endif
</div>

<script src="{{ asset('assets/js/script.js') }}"></script>
@endsection
