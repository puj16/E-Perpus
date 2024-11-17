@extends('layouts.master')

@section('title', 'E-Perpus POLINEMA')
@section('header')
     <h4>Data Pengembalian</h4>
@endsection
@section('content')

<div class="table-data">
    <div class="data">
        <div class="head">
            <h3>Data Pengembalian</h3>
            <form action="#">
                <div class="form-input dataTables_filter">
                    <input id="search-input" type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                </div>
            </form>
            <a href="{{ route('pengembalian.export') }}" class="btn-green action"><i class='bx bxs-file-export'></i> Eksport Data</a>
        </div>
        <table id="table" >
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Pengembalian</th>
                    <th>Id Pengembalian</th>
                    <th>Tanggal Buku Dikembalikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataPengembalian as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$data->id_kembali}}</td>
                        <td>{{$data->id_pinjam}}</td>
                        <td>{{$data->tgl_dikembalikan}}</td>
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