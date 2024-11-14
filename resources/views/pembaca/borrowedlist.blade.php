@extends('layouts.masterpembaca')

@section('title', 'Buku yang Dipinjam')

@section('content')
<div class="header-container">
    <h1>Buku yang Dipinjam</h1>
    <div class="filter">
        <form method="GET" action="{{ route('katalog.index') }}">
            <select name="category">
                <option value="">-- Filter kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="search" placeholder="Cari Buku" value="{{ request('search') }}">
        </form>
    </div>
</div>

<div id="notification" class="alert" style="display: none;"></div>

<div class="books">
    @if ($dipinjam->isEmpty())
        <p>Tidak ada buku yang dipinjam saat ini.</p>
    @else
        @foreach ($dipinjam as $pinjam)
            @php
                $buku = $pinjam->peminjaman->buku;
                $tglKembali = $pinjam->peminjaman->tgl_kembali;
            @endphp
            <div class="book" id="book-{{ $pinjam->id }}">
                <a href="{{ route('katalog.detail', $buku->kode_buku) }}">
                    <img src="{{ asset('storage/assets/covers/' . $buku->cover) }}" alt="Cover buku {{ $buku->judul }}">
                    <h3>{{ $buku->judul }}</h3>
                </a>
                <div class="book-footer">
                    <p>Tanggal Kembali: {{ $tglKembali }}</p>
                    
                    <!-- Dropdown Button -->
                    <div class="dropdown">
                        <button onclick="toggleDropdown({{ $loop->index }})" class="dropdown-toggle">
                            &#x22EE; <!-- Icon titik tiga vertikal -->
                        </button>
                        <div id="dropdown-{{ $loop->index }}" class="dropdown-menu" style="display: none;">
                            <a href="#" onclick="event.preventDefault(); openModal({{ $pinjam->id }});">
                                Perpanjangan Peminjaman
                            </a>

                            <a href="#" onclick="event.preventDefault(); openModal({{ $pinjam->id }});">
                            Pengembalian
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi pengembalian-->
        <div id="modal-{{ $pinjam->id }}" class="modal">
            <div class="modal-content">
                <p>Apakah Anda yakin ingin mengembalikan buku?</p>
                <button onclick="returnBook({{ $pinjam->id }})">Ya</button>
                <button onclick="closeModal({{ $pinjam->id }})">Tidak</button>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
    function toggleDropdown(index) {
        const dropdown = document.getElementById('dropdown-' + index);
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }
    
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        dropdowns.forEach((dropdown) => {
            if (!dropdown.contains(event.target) && dropdown.previousElementSibling !== event.target) {
                dropdown.style.display = 'none';
            }
        });
    });

    function openModal(id) {
    const modal = document.getElementById('modal-' + id);
    modal.style.display = 'flex'; // Set display to flex to center it
}

function closeModal(id) {
    const modal = document.getElementById('modal-' + id);
    modal.style.display = 'none';
}
// script pengembalian
async function returnBook(id) {
    const modal = document.getElementById('modal-' + id);
    try {
        const response = await fetch(`/pengembalian/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        });

        const result = await response.json();
        if (result.success) {
            // Hapus elemen buku dari daftar
            const bookElement = document.getElementById('book-' + id);
            if (bookElement) {
                bookElement.remove();
            }

            // Periksa apakah semua buku sudah dikembalikan
            if (document.querySelectorAll('.book').length === 0) {
                const booksContainer = document.querySelector('.books');
                booksContainer.innerHTML = '<p>Tidak ada buku yang dipinjam saat ini.</p>';
            }

            // Tampilkan notifikasi sukses
            showNotification('Buku berhasil dikembalikan!', 'success');
        } else {
            showNotification('Gagal mengembalikan buku: ' + result.message, 'danger');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan saat mengembalikan buku.', 'danger');
        console.error('Fetch Error:', error);
    } finally {
        closeModal(id); // Tutup modal
    }
}

function showNotification(message, type = 'danger') {
    const notification = document.getElementById('notification');
    notification.innerHTML = `<span>${message}</span> 
        <button type="button" class="close" onclick="hideNotification()">&times;</button>`;
    notification.className = `alert alert-${type}`; // Bootstrap class (alert-danger, alert-success, etc.)
    notification.style.display = 'block';
}

function hideNotification() {
    const notification = document.getElementById('notification');
    notification.style.display = 'none';
}


</script>

<style>
    .book {
        position: relative;
        margin-bottom: 20px;
    }
    .book-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 8px;
    }
    .dropdown {
        position: relative;
    }
    .dropdown-toggle {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }
    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 150px;
        z-index: 1;
    }
    .dropdown-menu a {
        display: block;
        padding: 8px 12px;
        color: #333;
        text-decoration: none;
    }
    .dropdown-menu a:hover {
        background-color: #f1f1f1;
    }
    
    /* Modal styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 2;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
    max-width: 90%; /* Agar tidak terlalu besar di layar kecil */
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.modal-content button {
    margin: 10px;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

.modal-content button:first-child {
    background-color: #4CAF50;
    color: white;
}

.modal-content button:last-child {
    background-color: #f44336;
    color: white;
}
/* css notif */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    position: relative;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert .close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 20px;
    line-height: 1;
    cursor: pointer;
}


</style>
@endsection