@extends('layouts.masterpembaca')

@section('title', 'Dashboard')

@section('content')
    <h1>Koleksi Terbaru</h1>
    <div class="books">
        @foreach ($books as $book)
            <div class="book">
                <a href="{{ route('katalog.detail', ['kode_buku' => $book->kode_buku, 'origin' => 'dashboard']) }}">
                    <img src="{{ asset('storage/assets/covers/' . $book->cover) }}" alt="Book cover of {{ $book->judul }}">
                    <h4>{{ $book->judul }}</h4>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Carousel for Slogan -->
<div id="carouselExampleCaptions" class="carousel slide study-slogan" data-bs-ride="carousel">
    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <!-- Carousel Inner -->
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="d-flex align-items-center">
                <div class="slogan-content flex-fill p-4">
                    <h2>Study anytime, <br>wherever you are</h2>
                    <p>Akses perpustakaan kampus dari mana saja, kapan saja. Belajar jadi lebih mudah dan fleksibel.</p>
                </div>
                <div class="image-content flex-fill">
                    <img src="{{ asset('assets/images/dash.svg') }}" class="img-fluid" alt="Study Anytime">
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item slide-2">
            <div class="d-flex flex-column align-items-center text-center">
                <div class="slogan-content p-4">
                    <h2>Panduan Peminjaman</h2>
                    <p>Temukan koleksi buku favorit untuk belajar dan hiburan Anda.</p>
                </div>
                <div class="image-content mt-3">
                    <img src="{{ asset('assets/images/semangat.png') }}" class="img-fluid" alt="Explore More">
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item slide-3">
            <div class="d-flex flex-column align-items-center text-center">
                <div class="slogan-content p-4">
                    <h2>Panduan Pengembalian</h2>
                    <p>Mendukung pembelajaran di era digital dengan kemudahan akses.</p>
                </div>
                <div class="image-content mt-3">
                    <img src="{{ asset('assets/images/pengembalian.png') }}" class="img-fluid" alt="Explore More">
                </div>
            </div>
        </div>
    </div>


        <!-- Navigation Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Kategori Buku -->
    <h1>Kategori Buku</h1>
    <div class="category-slogan">
        <img src="{{ asset('assets/images/roket.svg') }}" alt="Study Anytime">
        <div class="category-carousel">
            @foreach ($categories as $category)
                <a href="{{ route('katalog.index', ['category' => $category->id]) }}">
                    <div class="category">
                        <p>{{ $category->nama_kategori }}</p>
                    </div>
                </a>
                <span class="separator">|</span>
            @endforeach
        </div>
    </div>
@endsection
