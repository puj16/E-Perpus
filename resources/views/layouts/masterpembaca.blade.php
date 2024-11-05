<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo">
            <a href="#" class="logo"><img src="{{ asset('assets/images/logo.svg') }}" alt=""></a>
        </div>
        <div class="nav">
            <a href="{{ '/dashboard' }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ '/katalog' }}" class="{{ request()->is('katalog') ? 'active' : '' }}">Katalog</a>
            <a href="{{ '/borrowedlist' }}" class="{{ request()->is('borrowed') ? 'active' : '' }}">Borrowed list</a>
        </div>
        <div class="user">
            <i class="fas fa-user"></i>
            <span>Member</span>
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

    <script>
        document.querySelectorAll('.book h3').forEach(function (titleElement) {
            let text = titleElement.textContent.trim();
            if (text.length > 60) {
                titleElement.textContent = text.substring(0, 60) + '...';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>