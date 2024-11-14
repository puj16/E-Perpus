@extends('layouts.masterpembaca')

@section('title', 'Detail Buku')

@section('content')
    <!-- Begin Page Content -->
    <h1>Profil Member</h1>
    <div class="container-fluid">
        <form method="post" action="{{ route('profilePembacaUpdate') }}" enctype="multipart/form-data" autocomplete="off">

            <!-- Card -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="container-xl">
                        <div class="row">
                            <div class="col-md-4 profile-pic">
                                <!-- Profile picture card-->
                                <div class="card-detail mb-4 mb-md-0">
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <img class="img-account-profile rounded-circle mb-2" 
                                             src="{{ asset('storage/assets/fotos/' . $user->foto) }}" 
                                             style="max-width: 150px; height: 150px;" alt="Profile Picture" />
                                        <br><br>
                                        <h4 class="mb-4">{{ $user->name }}</h4>

                                        <!-- Profile Picture Update Button -->
                                        <input type="file" id="profile-picture" name="foto" accept="image/*" />
                                        <label for="profile-picture" class="btn btn-secondary">Change Picture</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 form-container">
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

                                        <!-- Nomor Identitas Input -->
                                        <div class="mb-3 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="small mb-1 form-control-label" for="input-name">Nomor Identitas</label>
                                            <input type="text" name="name" id="input-name" 
                                                   class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                                   placeholder="" value="{{ $user->nip_nim_nidn }}" required readonly>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Email Input -->
                                        <div class="mb-3 form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="small mb-1 form-control-label" for="input-email">Email</label>
                                            <input type="email" name="email" id="input-email" 
                                                   class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                                   placeholder="" value="{{ $user->email }}" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <!-- No HP Input -->
                                        <div class="mb-3 form-group{{ $errors->has('nohp') ? ' has-danger' : '' }}">
                                            <label class="small mb-1 form-control-label" for="input-nohp">No HP</label>
                                            <input type="text" name="nohp" id="input-nohp" 
                                                   class="form-control form-control-alternative{{ $errors->has('nohp') ? ' is-invalid' : '' }}" 
                                                   placeholder="" value="{{ $user->no_hp }}" required>
                                            @if ($errors->has('nohp'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nohp') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Back Button -->
                                        <a href="{{'member/dashboard'}}" class="btn btn-secondary">
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
@endsection
