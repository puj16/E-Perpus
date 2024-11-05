@extends('layouts.master')

@section('title', 'E-Perpus POLINEMA')
@section('header')
     <h4>Profil Pustakawan</h4>
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <form method="post" action="{{ route('profileAdminUpdate') }}" enctype="multipart/form-data" autocomplete="off">

            <!-- Card -->
            <div class="card shadow mb-4">
                <div class="card d-flex align-items-center justify-content-between mb-5">
                
                </div>
                <div class="card-body">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-xl-4">
                                <!-- Profile picture card-->
                                <div class="card-detail mb-4 mb-xl-0">
                                    <!-- <div class="card-header">Profile Picture</div> -->
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('storage/assets/fotos/' . $user->foto) }}" style="max-width: 128px" alt="" />
                                        <br><br>
                                        <h4 class="mb-4">{{ $user->name}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <!-- Account details card-->
                                <div class="card-detail mb-4">
                                    <div class="card-body">

                                        @csrf

                                        @if (session('status'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('status') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                        <div class="mb-3 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="small mb-1 form-control-label" for="input-name">Nomor Identitas</label>
                                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="" value="{{ $user->nip_nim_nidn }}" required autofocus readonly>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                                            @endif
                                        </div>

                                        <div class="mb-3 form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="small mb-1 form-control-label" for="input-email">Email</label>
                                            <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="" value="{{ $user->email }}" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                                            @endif
                                        </div>

                                        <div class="mb-3 form-group{{ $errors->has('nohp') ? ' has-danger' : '' }}">
                                            <label class="small mb-1 form-control-label" for="input-nohp">No HP</label>
                                            <input type="nohp" name="nohp" id="input-nohp" class="form-control form-control-alternative{{ $errors->has('nohp') ? ' is-invalid' : '' }}" placeholder="" value="{{ $user->no_hp }}" required>
                                            @if ($errors->has('nohp'))
                                                <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('nohp') }}</strong>
                    </span>
                                            @endif
                                        </div>
                                        <!-- Form Row-->
                                        <a href="{{'pustakawan/dashboard'}}" class="btn btn-danger">
                                            <i class="fas fa-sm text-white-50"></i>Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- /.container-fluid -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
    @endsection