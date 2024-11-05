<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body>
    <!-- Layer transparan biru -->
    <div class="blue-overlay"></div>

    <div class="login-container">
        <div class="left-side">
            <!-- Menggabungkan logo dan teks dalam satu container -->
            <div class="logo-container">
                <img src="{{ asset('assets/images/logo-polinema.png') }}" alt="Logo">
                <div class="text-container">
                    <h1>UPT</h1>
                    <h1>E-PERPUSTAKAAN</h1>
                    <h2>PSDKU POLINEMA KEDIRI</h2>
                </div>
            </div>
        </div>
        <div class="right-side">
            <div class="login-box">
                <h2>LOGIN</h2>
                <p>Silahkan login menggunakan nip, nim, atau nidn!</p>
                <form action="{{ route('login_post') }}" method="POST">
                    @csrf
                    <input type="text" value="{{ old('nip_nim_nidn') }}" name="nip_nim_nidn" placeholder="NIP, NIM, atau NIDN" required>
                    <input type="password" value="{{ old('password') }}" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
