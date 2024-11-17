<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman E-Perpus {{ \Carbon\Carbon::now()->format('d-m-Y') }}</title>
    <style>
        /* Mengatur ukuran halaman dan margin untuk PDF */
        @page {
            size: A4;
            margin: 10mm;
        }

        /* Gaya CSS untuk mengatur tampilan */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            margin-bottom: 5px;
            page-break-after: avoid; /* Menghindari pemisahan header di halaman baru */
             /* Menyelaraskan teks di header ke tengah */
        }

        .logo, .header div {
            display: inline-block; /* Menjadikan gambar dan teks berada dalam satu baris */
            vertical-align: middle; /* Menjaga teks dan gambar berada sejajar */
        }

        .logo {
            width: 120px; /* Memperbesar ukuran gambar */
            height: auto;
            margin-right: 60px; /* Jarak antara gambar dan teks */
        }

        .header h2, .header h3 {
            margin: 0;
            font-size: 20px; /* Ukuran font yang disesuaikan */
            text-align: center;
            align-items: center;
        }

        /* Garis pemisah antara header dan konten menggunakan border-top */
        .divider {
            border-top: 2px solid black;
            margin-bottom: 20px;
        }

        /* Styling untuk elemen tanggal laporan */
        .date {
            text-align: right;
            font-size: 12px;
            margin-bottom: 10px;
            padding-right: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 6px 10px; /* Padding yang disesuaikan */
            text-align: left;
            font-size: 12px; /* Ukuran font yang disesuaikan */
        }

    </style>
</head>
<body>
    <div class="header">
        <!-- Gunakan URL lengkap ke gambar -->
        <img src="{{ public_path('assets/images/logo-polinema.jpg')}}" alt="Logo Politeknik Negeri Malang" class="logo">

        <div>
            <h2>Laporan Peminjaman E-Perpus</h2>
            <h3>Politeknik Negeri Malang Kampus Kediri</h3>
        </div>
    </div>

    <!-- Garis pemisah antara header dan konten menggunakan div -->
    <div class="divider"></div>

    <!-- Tanggal laporan yang digenerate menggunakan PHP -->
    <div class="date">
        Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}
    </div>

    <table id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Id</th>
                <th>NIP/NIM/NIDN</th>
                <th>Kode Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPeminjaman as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['nip_nidn_nim'] }}</td>
                <td>{{ $data['buku_kode'] }}</td>
                <td>{{ $data['tgl_pinjam'] }}</td>
                <td>{{ $data['tgl_kembali'] }}</td>
                <td>{{ $data['status'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
