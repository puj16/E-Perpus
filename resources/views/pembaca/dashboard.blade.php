@extends('layouts.masterpembaca')

@section('title', 'Dashboard')

@section('content')
    <h1>Koleksi Terbaru</h1>
    <div class="books">
        @foreach ($books as $book)
            <div class="book">
                <a href="{{ route('pembaca.detail', $book->kode_buku) }}">
                    <img src="{{ asset('storage/assets/covers/' . $book->cover) }}" alt="Book cover of {{ $book->judul }}">
                    <h4>{{ $book->judul }}</h4>
                </a>
            </div>
        @endforeach
    </div>
<div class="study-slogan">
    <div>
        <h2>Study anytime, <br>wherever you are</h2>
        <p>Akses perpustakaan kampus dari mana saja,<br> kapan saja. Belajar jadi lebih mudah dan fleksibel.</p>
    </div>
    <img src="{{ asset('assets/images/dash.svg') }}" alt="Study Anytime">
</div>
    <h1>Kategori Buku</h1>
    <div class="category-slogan">
        <img src="{{ asset('assets/images/roket.svg') }}" alt="Study Anytime">
        <div class="category-carousel">
            @foreach ($categories as $category)
            <a href="{{ route('katalog.index', ['category' => $category->id]) }}">
                <div class="category"><p>{{ $category->nama_kategori }}</p><a href="{{ route('katalog.index', ['category' => $category->id]) }}"></div> <!-- Menampilkan kategori -->
                <span class="separator">|</span>
            @endforeach
        </div>
</div>
@endsection
