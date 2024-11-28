@extends('layouts.master')

@section('title', 'E-Perpus POLINEMA')
@section('header')
     <h4>Data Peminjaman</h4>
@endsection
@section('content')

<div class="table-data">
    <div class="data">
        <div class="head">
            <h3>Data Peminjaman</h3>
            <form action="#">
                <div class="form-input dataTables_filter">
                    <input id="search-input" type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                </div>
            </form>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class='bx bx-filter-alt'></i>
            </button>
            <a href="{{ route('peminjaman.report', request()->all()) }}" class="btn-blue1 action"><i class='bx bxs-report'></i> Report</a>
            <a href="{{ route('peminjaman.export', request()->all()) }}" class="btn-green action"><i class='bx bxs-file-export'></i> Eksport</a>
        </div>
        <table id="table" >
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
                        <td>{{$data->id}}</td>
                        <td>{{$data->nip_nidn_nim}}</td>
                        <td>{{$data->buku_kode}}</td>
                        <td>{{$data->tgl_pinjam}}</td>
                        <td>{{$data->tgl_kembali}}</td>
                        <td>
                            <span class="status-box 
                                {{ $data->status === 'Sudah Dikembalikan' ? 'status-returned' : 'status-not-returned' }}">
                                {{ $data->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header model-filter text-white">
                <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabs Navigation -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <ul class="nav nav-pills" id="filterTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active btn-outline-primary" id="range-tab" data-bs-toggle="tab" data-bs-target="#range" type="button" role="tab" aria-controls="range" aria-selected="true">
                                <i class="bx bx-calendar"></i> Rentang Tanggal
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn-outline-primary" id="month-tab" data-bs-toggle="tab" data-bs-target="#month" type="button" role="tab" aria-controls="month" aria-selected="false">
                                <i class="bx bx-calendar-event"></i> Per Bulan
                            </button>
                        </li>
                    </ul>
                    <a href="{{ route('peminjaman.show') }}" class="btn btn-reset">
                        <i class="bx bx-reset" style="font-size: 24px;"></i>
                    </a>
                </div>
                <!-- Tabs Content -->
                <div class="tab-content p-3 border rounded">
                    <!-- Rentang Tanggal -->
                    <div class="tab-pane fade show active" id="range" role="tabpanel" aria-labelledby="range-tab">
                        <form method="GET" action="{{ route('peminjaman.show') }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label fw-bold">Tanggal Mulai</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control border-primaryy shadow-sm" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label fw-bold">Tanggal Akhir</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control border-primaryy shadow-sm" value="{{ request('end_date') }}">
                                </div>
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary shadow-sm"><i class=""></i> Terapkan</button>
                            </div>
                        </form>
                    </div>

                    <!-- Per Bulan -->
                    <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
                        <form method="GET" action="{{ route('peminjaman.show') }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="month" class="form-label fw-bold">Bulan</label>
                                    <select name="month" id="month" class="form-select border-primary shadow-sm">
                                        <option value="">-- Pilih Bulan --</option>
                                        @foreach (range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="year" class="form-label fw-bold">Tahun</label>
                                    <select name="year" id="year" class="form-select border-primary shadow-sm">
                                        <option value="">-- Pilih Tahun --</option>
                                        @foreach (range(date('Y') - 10, date('Y')) as $year)
                                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary shadow-sm"><i class="bx bx-filter-alt"></i> Terapkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form CRUD -->
           <!-- Form CRUD end -->
           
            <script>
            $(document).ready(function() {
                // Inisialisasi DataTables tanpa fitur pencarian bawaan
                var table = $('#table').DataTable({
                    "lengthMenu": [5, 10, 25, 50],
                    "language": {
                        "lengthMenu": "Show  _MENU_  entries",
                        "zeroRecords": "Tidak ada data yang ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Data tidak tersedia",
                        "infoFiltered": "(difilter dari total _MAX_ data)",
                        "paginate": {
                            "previous": "Previous",
                            "next": "Next"
                        }
                    },
                    "searching": false // Menonaktifkan pencarian bawaan
                });

                // Event listener untuk form pencarian kustom
                $('#search-input').on('keyup', function() {
                    table.search(this.value).draw(); // Menggunakan form pencarian kustom
                });
            });
            </script>
            
            
@endsection