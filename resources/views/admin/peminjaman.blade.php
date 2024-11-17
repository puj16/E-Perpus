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
            <a href="{{ route('peminjaman.report') }}" class="btn-blue1 action"><i class='bx bxs-report'></i>Report</a>
            <a href="{{ route('peminjaman.export') }}" class="btn-green action"><i class='bx bxs-file-export'></i> Eksport Data</a>
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