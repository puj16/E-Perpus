@extends('layouts.masterpembaca')

@section('title', 'Detail Buku')

@section('content')
    <!-- Begin Page Content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('assets/css/profil.css') }}" rel="stylesheet"> <!-- Pastikan link ke CSS lokal juga ada -->

    <div class="mainn">
        <h1>Profil Member</h1>
    </div>
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
                                        <img id="profileImagePreview" class="img-account-profile rounded-circle mb-2" 
                                             src="{{ asset('storage/assets/fotos/' . $user->foto) }}" 
                                             style="max-width: 150px; height: 150px;" alt="Profile Picture" />
                                        <br><br>
                                        <h4 class="mb-4">{{ $user->name }}</h4>

                                        <!-- Profile Picture Update Button -->
                                        <div class="mb-3">
                                            <label for="profile-picture">Change Picture</label>
                                            <input type="file" class="form-control" id="profile-picture" name="foto" accept="image/*" onchange="previewProfileImage()" />
                                        </div>

                                        <button type="submit" class="btn-borrow">Save Photo</button>
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
                                            <label class="small mb-1 form-control-label" for="input-name">Nama</label>
                                            <input type="name" name="name" id="input-name" 
                                                   class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                                   placeholder="" value="{{ $user->name }}" required>
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

                                        <div class="mb-3 form-group">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="small mb-1 form-control-label" for="inputPassword">Password Baru (Abaikan Jika Tidak)</label>
                                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative" placeholder="Masukkan Password Baru">
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label class="small mb-1 form-control-label" for="inputConfirmPassword">Confirm Password Baru (Abaikan Jika Tidak)</label>
                                                    <input type="password" name="password_confirmation" id="input-confirm-password" class="form-control form-control-alternative" placeholder="Masukkan kembali password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-2 mb-4">
                                            <a href="{{ 'member/dashboard' }}" class="btn-back">Back</a>
                                            <button type="submit" class="btn-borrow">{{ __('Simpan Perubahan') }}</button>
                                        </div>

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
    <script>
        function previewProfileImage() {
            const file = document.getElementById("profile-picture").files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                document.getElementById("profileImagePreview").src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                document.getElementById("profileImagePreview").src = "{{ asset('storage/assets/fotos/' . $user->foto) }}";
            }
        }
        
        document.querySelector('.mainn h1').style.fontFamily = 'Roboto, sans-serif';

    </script>
@endsection
