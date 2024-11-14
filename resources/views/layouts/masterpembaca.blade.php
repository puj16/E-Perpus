<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profil.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo">
            <a href="#" class="logo"><img src="{{ asset('assets/images/logo.svg') }}" alt=""></a>
        </div>
        <div class="nav">
            <a href="{{ '/member/dashboard' }}" class="{{ request()->is('member/dashboard*') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ url('/katalog?reset_filters=1') }}" class="{{ request()->is('katalog') ? 'active' : '' }}">Katalog</a>
            <a href="{{ '/borrowedlist' }}" class="{{ request()->is('borrowedlist') ? 'active' : '' }}">Borrowed list</a>
        </div>
        <div class="profile">
            <button class="username"><img src="{{ asset('storage/assets/fotos/' . $user->foto) }}" alt="">
                {{ $user->name }}<i class='bx bx-chevron-right icon-right'></i> 
            </button>
            <ul class="profile-link">
                <li><a href="{{ url('profilePembaca') }}"><i class='bx bx-user-circle icon-right'></i>Profil</a></li>
                <li><a href="{{ route('logout') }}"><i class='bx bx-log-out icon'></i>Log-Out</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        @yield('content')
    </div>

<!-- Footer Section -->
<div class="footer">
        <a href="#" class="logo"><img src="{{ asset('assets/images/logo.svg') }}" alt="" text-align: center></a>
        <div class="footer-columns">
        <div class="column about-column">
            <h3>ABOUT</h3>
            <p>UPT E-PERPUSATAKAAN PSDKU POLINEMA KEDIRI adalah website perpustakaan online sebagai wadah membaca warga PSDKU POLINEMA di Kota Kediri.</p>
        </div>
        <div class="column lokasi-column">
            <h3>LOKASI</h3>
            <p>Perpus Graha Lt.3<br>Jl. Soekarno Hatta No. 9 Malang<br>Telp: (0341) 404424, 404425<br>Fax: (0341) 404420<br>Email: psdkupolinema@gmail.com</p>
        </div>
        <div class="column">
            <h3>HUBUNGI KAMI</h3>
            <div class="social">
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </div>
    </div>
    <div class="copyright">
        <p>Copyright © 2024 Design By PSDKU POLINEMA KEDIRI</p>
    </div>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>