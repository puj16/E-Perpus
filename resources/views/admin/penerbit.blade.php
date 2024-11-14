@extends('layouts.master')

@section('title', 'E-Perpus POLINEMA')
@section('header')
     <h4>Data penerbit</h4>
@endsection
@section('content')

<div class="table-data">
    <div class="data">
        <div class="head">
            <h3>Data penerbit</h3>
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
                    <th>penerbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataPenerbit as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$data->id}}</td>
                        <td>{{$data->nama_penerbit}}</td>
                        <td>
                            <a href="" class="btn-yellow action" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}">Edit</a>
                            <button class="btn-red action" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}">Delete</button>
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
                    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah penerbit</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('penerbit.store')}}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="id">ID Penerbit<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="id" id="id" value="{{ $nextId }}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nama">Nama Penerbit<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="nama_penerbit" id="nama_penerbit">
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($dataPenerbit as $data)
                <div class="edit">
                   <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$data->id}}" aria-hidden="true">
                       <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Penerbit</h1>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               </div>
                               <div class="modal-body">
                                   <form action="{{route('penerbit.update', $data->id)}}" method="post" >@csrf
                                       @csrf
                                       <div class="form-group mb-6">
                                           <label for="nama">Nama penerbit<span class="text-danger">*</span></label>
                                           <input class="form-control" type="text" name="nama_penerbit" id="nama_penerbit" value="{{$data->nama_penerbit}}">
                                       <div class="modal-footer border-0 ">
                                           <!-- Cancel and Delete buttons -->
                                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                           <button type="submit" class="btn btn-primary">Update</button>
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
                   <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$data->id}}" aria-hidden="true">
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
                                   <form action="{{route('penerbit.delete', $data->id)}}" method="post" class="d-inline-block">@csrf
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