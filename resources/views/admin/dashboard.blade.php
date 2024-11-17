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
        <li>
            <img src="{{ asset('assets/images/data-buku.svg') }}" alt="">
            <span class="text">
                <p>Dipinjam Saat Ini</p>
                <h3>{{ \App\Models\BukuDipinjam::count() }}</h3>
            </span>
        </li>
    </ul>

    <!-- Tambahkan Line Chart -->
    <div class="chart-container">
        <div >
        <h3 class="head">Data Peminjaman</h3>
        <canvas id="peminjamanChart" width="800" height="400"></canvas>
        </div>
        <div>
            <h2 class="head">Status Pengembalian</h2>
            <canvas id="loanChart"></canvas>
        </div>
    </div>


    <script>
        // linechart
        const bulanNama = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Peminjaman data dari controller
        const jumlahTotalPeminjaman = @json($jumlahTotalPeminjaman);
        // Menyiapkan data chart
        const labels = bulanNama; // Bulan sebagai label di sumbu X
        const data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: [
                    jumlahTotalPeminjaman[1] || 0, jumlahTotalPeminjaman[2] || 0, jumlahTotalPeminjaman[3] || 0,
                    jumlahTotalPeminjaman[4] || 0, jumlahTotalPeminjaman[5] || 0, jumlahTotalPeminjaman[6] || 0,
                    jumlahTotalPeminjaman[7] || 0, jumlahTotalPeminjaman[8] || 0, jumlahTotalPeminjaman[9] || 0,
                    jumlahTotalPeminjaman[10] || 0, jumlahTotalPeminjaman[11] || 0, jumlahTotalPeminjaman[12] || 0
                ],
                borderColor: '#5E50F9', // Warna garis
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna area chart
                borderWidth: 3, // Ketebalan garis
                tension: 0.3, // Kelengkungan garis
            }]
        };

        // Menyiapkan konfigurasi chart
        const config = {
            type: 'line', // Jenis chart adalah line chart
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true // Memastikan sumbu Y mulai dari 0
                    }
                }
            }
        };

        // Menyusun chart
        const peminjamanChart = new Chart(document.getElementById('peminjamanChart'), config);


        var ctx = document.getElementById('loanChart').getContext('2d');

// Mengambil data dari PHP dan mengonversinya menjadi format JavaScript
            var jumlahPengembalian = @json($jumlahPengembalian);
            var jumlahPeminjamanBelumDikembalikan = @json($jumlahPeminjamanBelumDikembalikan);
            // var bulan = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Menentukan bulan

            var loanChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: bulanNama.map(function(b) { return  b; }), // Menampilkan nama bulan
                    datasets: [{
                        label: 'Sudah Dikembalikan',
                        data: Object.values(jumlahPengembalian),
                        backgroundColor: '#4B49AC',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Belum Dikembalikan',
                        data: Object.values(jumlahPeminjamanBelumDikembalikan),
                        backgroundColor: '#FF4747',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
@endsection
