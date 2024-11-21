@extends('layouts.masterpembaca')

@section('title', 'History')

@section('content')
<link href="{{ asset('assets/css/history.css') }}" rel="stylesheet">

<h1>History Peminjaman Buku</h1>

<div id="loading" style="display: none;">
    <img src="{{ asset('assets/images/loading.svg') }}" alt="Loading" />
</div>

<div class="history-container">
    @foreach ($groupedReturns as $date => $returns) <!-- Kelompokkan berdasarkan tanggal -->
        <div class="history-day-card">
        <h2>
            @if (\Carbon\Carbon::parse($date)->isToday())
                Today
            @else
                {{ \Carbon\Carbon::parse($date)->diffForHumans() }}
            @endif
        </h2>

            @foreach ($returns as $return) <!-- Tampilkan setiap buku dalam satu card -->
                <div class="book-card">
                    <a href="{{ route('katalog.detail', ['kode_buku' => $return->peminjaman->buku->kode_buku, 'origin' => 'history']) }}">
                        <div class="book-card-content">
                            <img src="{{ asset('storage/assets/covers/' . $return->peminjaman->buku->cover) }}" alt="Book cover">
                            <div class="book-info">
                            <h3>{{ $return->peminjaman->buku->judul }}</h3>
                            <p>Tanggal Dikembalikan: {{ $return->tgl_dikembalikan }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

<script src="{{ asset('assets/js/script.js') }}"></script>
@endsection
