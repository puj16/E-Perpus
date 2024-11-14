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

    // KATALOG
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const loadingElement = document.getElementById('loading');
        const booksContainer = document.querySelector('.books');
        const paginationContainer = document.querySelector('.pagination');
        const searchInput = document.getElementById('search');
        const clearSearchButton = document.getElementById('clearSearch');
    
        function toggleClearSearchButton() {
            clearSearchButton.style.display = searchInput.value ? 'inline' : 'none';
        }
    
        function submitFilterForm() {
            loadingElement.style.display = 'block';
            const formData = new FormData(filterForm);
            const params = new URLSearchParams(formData).toString();
    
            fetch(`${filterForm.action}?${params}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                loadingElement.style.display = 'none';
                booksContainer.innerHTML = '';
                if (data.books.length === 0) {
                    booksContainer.innerHTML = '<p>Tidak ada buku yang ditemukan.</p>';
                } else {
                    data.books.forEach(book => {
                        const bookElement = document.createElement('div');
                        bookElement.classList.add('book');
                        bookElement.innerHTML = `
                            <a href="/katalog/${book.kode_buku}">
                                <img src="/storage/assets/covers/${book.cover}" alt="Book cover of ${book.judul}">
                                <h3>${book.judul}</h3>
                                <p>${book.penerbit ? book.penerbit.nama_penerbit : 'Tidak diketahui'}</p>
                            </a>
                        `;
                        booksContainer.appendChild(bookElement);
                    });
                }
                paginationContainer.innerHTML = data.pagination;
            })
            .catch(error => {
                console.error('Error:', error);
                loadingElement.style.display = 'none';
            });
        }
    
        document.getElementById('category').addEventListener('change', submitFilterForm);
        searchInput.addEventListener('input', function() {
            toggleClearSearchButton();
            clearTimeout(this.delay);
            this.delay = setTimeout(submitFilterForm, 500);
        });
        
        clearSearchButton.addEventListener('click', function() {
            searchInput.value = '';
            toggleClearSearchButton();
            submitFilterForm();
        });
    
        // Pastikan tombol "x" hanya muncul jika ada teks di kolom pencarian
        toggleClearSearchButton();
        });

        // MASTER PEMBACA
        document.querySelectorAll('.book h3').forEach(function (titleElement) {
            let text = titleElement.textContent.trim();
            if (text.length > 60) {
                titleElement.textContent = text.substring(0, 60) + '...';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
        const profileButton = document.querySelector('.profile .username');
        const profileLink = document.querySelector('.profile .profile-link');
        
        profileButton.addEventListener('click', function(event) {
            event.stopPropagation(); // Mencegah event click merambat ke elemen lain
            profileLink.classList.toggle('show'); // Tambah/hapus kelas 'show'
        });
        
        // Tutup dropdown jika mengklik di luar elemen profile
        document.addEventListener('click', function(event) {
            if (!profileButton.contains(event.target) && !profileLink.contains(event.target)) {
                profileLink.classList.remove('show');
            }
        });
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

