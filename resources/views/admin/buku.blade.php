@extends('layouts.master')

@section('title', 'E-Perpus POLINEMA')
@section('header')
     <h4>Data Kategori</h4>
@endsection
@section('content')

<div class="table-data">
    <div class="data">
        <div class="head">
            <h3>Data Buku</h3>
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
                    <th>Id</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Cover</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($databuku as $data)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->kode_buku }}</td>
                <td>{{ $data->judul }}</td>
                <td>@if ($data->penulis_id)
                    {{ $data->penulis->nama_penulis }}
                @else
                    Penulis tidak ditemukan
                @endif</td>
                <td>@if ($data->penerbit_id)
                    {{ $data->penerbit->nama_penerbit }}
                @else
                    Penulis tidak ditemukan
                @endif</td>                
                <td>
                    @if ($data->kategori_id)
                    {{ $data->kategori->nama_kategori }}
                @else
                    Penulis tidak ditemukan
                @endif
                </td>
                <td>{{ $data->tahun_terbit }}</td>
                <td>
                    <img src="{{ asset('storage/assets/covers/' . $data->cover) }}" alt="{{ $data->cover }}">
                </td>
                <td>{{ $data->stok }}</td>
                <td>
                    <a href="" class="btn-yellow action" data-bs-toggle="modal" data-bs-target="#editModal{{$data->kode_buku}}"><i class='bx bx-edit-alt'></i></a>
                    <button class="btn-red action" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->kode_buku}}"><i class='bx bx-trash' ></i></button>
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
                        <div class="modal-dialog modal-lg ">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf                                                
                                                    <div class="row">
                                                        <div class="col-6 col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="kode_buku" >Kode Buku</label>
                                                                <input type="text" class="form-control" name="kode_buku" id="kode_buku">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="judul" >Judul</label>
                                                                <input type="text" class="form-control" name="judul" id="judul">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="penulis">Penulis</label>
                                                                <select class="form-select form-select-sm" aria-label="Small select example" name="penulis_id">
                                                                    <option value="">-- Pilih Penulis --</option>
                                                                    @foreach($datapenulis as $penulis)
                                                                    <option value="{{ $penulis->id }}">{{ $penulis->nama_penulis}}</option>
                                                                    @endforeach                                
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="penerbit">Penerbit</label>
                                                                <select class="form-select form-select-sm" aria-label="Small select example" name="penerbit_id">
                                                                    <option value="">-- Pilih Penerbit --</option>
                                                                    @foreach($datapenerbit as $penerbit)
                                                                    <option value="{{ $penerbit->id }}">{{ $penerbit->nama_penerbit}}</option>
                                                                    @endforeach                                
                                                                  </select>                                                                
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kategori">Kategori</label>
                                                                <select class="form-select form-select-sm" aria-label="Small select example" name="kategori_id">
                                                                    <option value="">-- Pilih Kategori --</option>
                                                                    @foreach($datakategori as $kategori)
                                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori}}</option>
                                                                    @endforeach                                
                                                                  </select>                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="tahun_terbit" >Tahun Terbit</label>
                                                                <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="stok">Stok</label>
                                                                <input type="number" class="form-control" id="stok" name="stok" min="0" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="cover">Cover Buku</label>
                                                                <input type="file" class="form-control" name="cover" accept="image/*">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="file_buku">File</label>
                                                                <input type="file" class="form-control " value="" name="file_buku" accept=".pdf" required>
                                                            </div>
                                                            
                                                        </div>
                                                    <div class="col-4 offset-9">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @foreach($databuku as $data)
                 <div class="edit">
                    <div class="modal fade" id="editModal{{$data->kode_buku}}" tabindex="-1" aria-labelledby="editModalLabel{{$data->kode_buku}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('buku.update', $data->kode_buku)}}" method="post" enctype="multipart/form-data" >
                                        @csrf  
                                        @method('PUT')                                              
                                        <div class="row">
                                            <div class="col-6 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="kode_buku" >Kode Buku</label>
                                                    <input type="text" class="form-control" name="kode_buku" id="kode_buku" value="{{$data->kode_buku }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="judul" >Judul</label>
                                                    <input type="text" class="form-control" name="judul" id="judul" value="{{$data->judul }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="penulis">Penulis</label>
                                                    <select class="form-select form-select-sm" aria-label="Small select example" name="penulis_id">
                                                        <option value="">-- Pilih Penulis --</option>
                                                        @foreach($datapenulis as $penulis)
                                                        <option value="{{ $penulis->id }}" {{ $penulis->id == $data->penulis_id ? 'selected' : '' }}>{{ $penulis->nama_penulis}}</option>
                                                        @endforeach                                
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="penerbit">Penerbit</label>
                                                    <select class="form-select form-select-sm" aria-label="Small select example" name="penerbit_id">
                                                        <option value="">-- Pilih Penerbit --</option>
                                                        @foreach($datapenerbit as $penerbit)
                                                        <option value="{{ $penerbit->id }}" {{ $penerbit->id == $data->penerbit_id ? 'selected' : '' }}>{{ $penerbit->nama_penerbit}}</option>
                                                        @endforeach                                
                                                      </select>                                                                
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kategori">Kategori</label>
                                                    <select class="form-select form-select-sm" aria-label="Small select example" name="kategori_id">
                                                        <option value="">-- Pilih Kategori --</option>
                                                        @foreach($datakategori as $kategori)
                                                        <option value="{{ $kategori->id }}"{{ $kategori->id == $data->kategori_id ? 'selected' : '' }}>{{ $kategori->nama_kategori}}</option>
                                                        @endforeach                                
                                                      </select>                                                                
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="tahun_terbit" >Tahun Terbit</label>
                                                    <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{$data->tahun_terbit}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="stok">Stok</label>
                                                    <input type="number" class="form-control" id="stok" name="stok" min="0" value="{{$data->stok }}">
                                                </div>                                                
                                                <div class="mb-3">
                                                    <label for="cover">Cover Buku</label>
                                                    <input type="file" class="form-control" name="cover" accept="image/*">
                                                    <div id="cover" class="form-text" style="color: red;">*Kosongi bila tidak ingin mengupdate cover</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="file_buku">File</label>
                                                    <input type="file" class="form-control " value="" name="file_buku" accept=".pdf">
                                                    <div id="file_buku" class="form-text" style="color: red;">*Kosongi bila tidak ingin mengupdate file</div>
                                                </div>

                                            </div>
                                        <div class="col-4 offset-9">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        </div>                                
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
                <!-- Modal -->
                <!-- Delete Modal -->
                <div class="delete">
                    <div class="modal fade" id="deleteModal{{$data->kode_buku}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$data->kode_buku}}" aria-hidden="true">
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
                                    <form action="{{route('buku.destroy', $data->kode_buku)}}" method="post" class="d-inline-block">
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