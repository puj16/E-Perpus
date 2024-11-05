<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</head>
<body>
    
       <!-- sidebar section start -->
        <section id="sidebar">
            <a href="#" class="logo"><img src="{{ asset('assets/images/logo.svg') }}" alt=""></a>
            <ul class="side-menu">
                <li ><a href={{ '/pustakawan/dashboard' }} ><i class='bx bx-home-alt icon'></i>Dashboard</a></li>
                <li><a href="{{ '/tampil-pembaca' }}"><i class='bx bx-book-reader icon'></i> Data Member</a></li>
                <li><a href="{{'/tampil-kategori'}}"><i class='bx bx-list-ul icon'></i>Data Kategori</a></li>
                <li><a href="{{'/tampil-penulis'}}"><i class='bx bxs-edit icon'></i>Data Penulis</a></li>
                <li><a href="{{'/tampil-penerbit'}}"><i class='bx bxs-paint icon'></i>Data Penerbit</a></li>
                <li><a href="{{'/buku'}}"><i class='bx bxs-book-open icon'></i>Data Buku</a></li>
            </ul>
        </section>
       <!-- sidebar section end -->

       
        <section id="content">
            <!-- navbar section start -->
            <nav>
                <i class='bx bx-menu toggle-sidebar'></i>
                <a href="" class="nav-link">
                    <i class="icon">@yield('header')</i>
                    <span class="badge"></span>  
                </a>
                <span class="divider"></span>
                <div class="profile">
                        <button class="username"><img src="{{ asset('storage/assets/fotos/' . $user->foto) }}" alt="">
                        {{ $user->name }}<i class='bx bx-chevron-right icon-right'></i> 
                        </button>
                        <ul class="profile-link">
                        <li><a href="{{ url('profileAdmin') }}"><i class='bx bx-user-circle icon-right'></i>Profil</a></li>
                        <li><a href="{{ route('logout') }}"><i class='bx bx-log-out icon'></i>Log-Out</a></li>
                    </ul>
                </div>
            </nav>
            <!-- navbar section end -->
            <!-- main section start -->
            <main>

              @yield('content')
                

                <!-- footer section start -->
                <footer>
                    <div>
                    <p>Copyright © 2024 Design By <span >PSDKU POLINEMA KEDIRI</span></p>
                    </div>
                </footer>
                <!-- footer section end -->  
            </main>
            <!-- main section end --> 
             
            
        </section>

          


       <script src="{{ asset('assets/js/script.js') }}"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
          $(document).ready(function() {
              $("#search-input").on("keyup", function() {
                  var value = $(this).val().toLowerCase();
                  var visibleRows = 0;
          
                  $("#table tbody tr").filter(function() {
                      if ($(this).text().toLowerCase().indexOf(value) > -1) {
                          $(this).toggle(true);
                          if (!$(this).is('#no-data-row')) {
                              visibleRows++;
                          }
                      } else {
                          $(this).toggle(false);
                      }
                  });
          
                  if (visibleRows === 0) {
                      $("#no-data-row").show();
                  } else {
                      $("#no-data-row").hide();
                  }
              });
          });
          </script>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>          
</body>
</html>