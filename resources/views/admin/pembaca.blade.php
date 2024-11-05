@extends('layouts.master')

@section('title', 'E-Perpus POLINEMA')
@section('header')
     <h4>Data Kategori</h4>
@endsection
@section('content')
<style>
        <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</style>
<div class="table-data">
    <div class="data">
        <div class="head">
            <h3>Data Member</h3>
            <form action="#">
                <div class="form-input dataTables_filter">
                    <input id="search-input" type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                </div>
            </form>
            <a href="#" class="add-data" data-bs-toggle="modal" data-bs-target="#add"><i class='bx bxs-plus-circle'></i></a>
        </div>
        <table id="table" >
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP/NIM/NIDN</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. Handphone</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datamember as $data)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nip_nim_nidn }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->no_hp }}</td>
                <td>
                    <img src="{{ asset('storage/assets/fotos/' . $data->foto) }}" alt="{{ $data->foto }}">
                </td>
                <td>
                    <button class="btn-red action" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}"><i class='bx bx-trash' ></i> Delete</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        
    </div>
</div>


<!-- Form CRUD -->
            <div class="form-crud">
                <div class="add">
                    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="data-leModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg center">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form action="{{ route('registrasi_post') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="id">Masukkan NIP, NIM, atau NIDN member<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" value="{{ old('nip_nim_nidn') }}" name="nip_nim_nidn" placeholder="NIP, NIM, atau NIDN" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="id">Masukkan email <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" value="{{ old('email') }}" name="email" placeholder="Email" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="id">Masukkan username<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" value="{{ old('name') }}" name="name" placeholder="Username" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="id">Masukkan password<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="password" value="{{ old('password') }}" name="password" placeholder="Password" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="id">Masukkan nomor handphone<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" value="{{ (old('no_hp')) }}" name="no_hp" placeholder="No. Handphone" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="cover">Masukkan foto member</label>
                                                        <input class="form-control" type="file" class="form-control" name="foto" accept="image/*">
                                                    </div>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @foreach($datamember as $data)

                <!-- Modal -->
                <!-- Delete Modal -->
                <div class="delete">
                    <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$data->kode_buku}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Icon Delete (Font Awesome or Boxicons) -->
                                    <i class='bx bxs-trash bx-lg text-danger'></i> <!-- You can use another icon library like Font Awesome -->
                                    <h5 class="mt-3">Anda Yakin Ingin Menghapus Data Ini?</h5>
                                    <p>Data ini akan dihapus secara permanen dan tidak dapat dipulihkan.</p>
                                </div>
                                <div class="modal-footer border-0 d-flex justify-content-center">
                                    <!-- Cancel and Delete buttons -->
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{route('pembaca.delete', $data->id)}}" method="post" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div><!-- Form CRUD end -->
           
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