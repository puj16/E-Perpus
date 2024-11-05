//sidebar
// Ambil semua elemen menu di sidebar
const allSideMenu = document.querySelectorAll('#sidebar .side-menu li a');

// Fungsi untuk menambahkan class 'active' pada item menu yang sesuai dengan URL saat ini
function setActiveMenu() {
    const currentPath = window.location.pathname; // Dapatkan path dari URL saat ini

    allSideMenu.forEach(item => {
        const li = item.parentElement;
        const itemPath = item.getAttribute('href'); // Ambil href dari item menu
        
        // Jika href menu cocok dengan path URL saat ini, tambahkan kelas 'active'
        if (itemPath === currentPath) {
            li.classList.add('active');
        } else {
            li.classList.remove('active'); // Hapus kelas 'active' dari menu yang lain
        }
    });
}

// Jalankan fungsi saat halaman dimuat
setActiveMenu();

// Tambahkan event listener untuk menambahkan 'active' saat diklik
allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        });
        li.classList.add('active');
    });
});


// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .toggle-sidebar');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})

//profile dropdown
const profile = document.querySelector('nav .profile');
const userProfile = profile.querySelector('.username');
const dropdownProfile = profile.querySelector('.profile-link');
const iconRight = userProfile.querySelector('.icon-right');

userProfile.addEventListener('click', function(){
    dropdownProfile.classList.toggle('show');
    iconRight.classList.toggle('rotate');
});

window.addEventListener('click', function(e) {
    // Check if the click is outside of the userProfile (and its children) and dropdownProfile
    if (!userProfile.contains(e.target) && !dropdownProfile.contains(e.target)) {
        if (dropdownProfile.classList.contains('show')) {
            dropdownProfile.classList.remove('show');
            iconRight.classList.remove('rotate'); // Also reset the icon rotation
        }
    }
});

//SEARCH
$(document).ready(function() {
    $("#search-input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var visibleRows = 0;

        $("#table tbody tr").filter(function() {
            var isMatch = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).toggle(isMatch);

            if (isMatch && !$(this).is('#no-data-row')) {
                visibleRows++;
            }
        });

        if (visibleRows === 0) {
            $("#no-data-row").show();
        } else {
            $("#no-data-row").hide();
        }
    });
});

