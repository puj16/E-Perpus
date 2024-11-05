@extends('layouts.master')

@section('title', 'E-Perpus POLINEMA')
@section('header')
     <h4>Dashboard</h4>
@endsection
@section('content')
                    <ul class="box-info">
                    <li>
                        <img src="{{ asset('assets/images/data-pembaca.svg') }}" alt="">
                        <span class="text">
                            <p>Data Member</p>
                             <h3>{{ \App\Models\User::where('role', 1)->count() }}</h3>
                        </span>
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/data-kategori.svg') }}" alt="">
                        <span class="text">
                            <p>Data Kategori</p>
                             <h3>{{ \App\Models\Kategori::count() }}</h3>
                        </span>
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/data-penulis.svg') }}" alt="">
                        <span class="text">
                             <p>Data Penulis</p>
                             <h3>{{ \App\Models\Penulis::count() }}</h3>
                        </span>
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/data-penerbit.svg') }}" alt="">
                        <span class="text">
                            <p>Data Penerbit</p>
                             <h3>{{ \App\Models\Penerbit::count() }}</h3>
                        </span>
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/data-buku.svg') }}" alt="">
                        <span class="text">
                            <p>Data Buku</p>
                             <h3>{{ \App\Models\Buku::count() }}</h3>
                        </span>
                    </li>
                </ul> 

@endsection