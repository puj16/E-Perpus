@extends('layouts.masterpembaca')

@section('title', 'Baca Buku')

@section('content')
<style>
    #pdf-container {
    width: 100%;
    height: 80vh;
    overflow-y: scroll;  /* Mengizinkan scroll vertikal */
    overflow-x: scroll;  /* Mencegah scroll horizontal */
    position: relative;
}
    canvas {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    /* CSS untuk overlay loading */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.1); /* Background semi-transparan */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Menempatkan loading di atas konten lainnya */
}

/* CSS untuk spinner */
.spinner {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid #fff;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

/* Animasi spinner */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.worker.min.js"></script>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Baca Buku</h1>
                <!-- Tombol Zoom dengan Icon -->
                <button id="zoom-in" class="btn btn-primary">
                <strong>+</strong>
            </button>
            <button id="zoom-out" class="btn btn-primary">
                <strong>−</strong>
            </button>
        </div>
        <div>
    <div class="judul-buku-container text-center mb-4">
        <h3 class="judul-buku">{{$book->judul}}</h3>            
            <span id="page-info">Page 1/--</span>
        </div>
    </div>
    
    <div id="pdf-container" style="width: 100%; height: 80vh; overflow: auto; border: 1px solid #ddd; position: relative;">
        <!-- Semua halaman akan dirender di sini -->
    </div>
    <div class="mt-3">
        <a href="{{ route('pembaca.pinjam') }}" class="btn btn-secondary">Kembali ke Katalog</a>
        <br>
        <br>
    </div>
</div>

<script>
    const url = "{{ $filePath }}"; // URL file PDF
    let pdfDoc = null; // Variabel untuk menyimpan dokumen PDF
    let scale = 1.5; // Zoom level awal
    const container = document.getElementById('pdf-container');

    // Fungsi untuk merender semua halaman
    function renderAllPages() {
    container.innerHTML = ''; // Bersihkan container sebelum merender ulang

    for (let pageNum = 1; pageNum <= pdfDoc.numPages; pageNum++) {
        const pageContainer = document.createElement('div');
        pageContainer.className = 'page-container';
        pageContainer.style.marginBottom = '20px';

        const canvas = document.createElement('canvas');
        canvas.id = `page-${pageNum}`;
        canvas.style.display = 'block';
        canvas.style.margin = '0 auto';

        pageContainer.appendChild(canvas);
        container.appendChild(pageContainer);

        renderPage(pageNum, canvas); // Render halaman dengan skala baru
    }
}
// Fungsi untuk merender satu halaman
function renderPage(num, canvas) {
    pdfDoc.getPage(num).then((page) => {
        const viewport = page.getViewport({ scale: scale });
        const ctx = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderContext = {
            canvasContext: ctx,
            viewport: viewport,
        };

        page.render(renderContext).promise.then(() => {
            updateCurrentPage(); // Perbarui informasi halaman saat ini

            // Menambahkan event listener untuk mencegah klik kanan (Save Image As)
            canvas.addEventListener('contextmenu', function(event) {
                event.preventDefault();  // Mencegah menu konteks muncul
            });
        });
    });
}



    // Fungsi untuk memperbarui halaman yang terlihat di viewport
    function updateCurrentPage() {
        const pages = document.getElementsByClassName('page-container');
        const containerTop = container.scrollTop;
        const containerHeight = container.offsetHeight;

        for (let i = 0; i < pages.length; i++) {
            const page = pages[i];
            const pageTop = page.offsetTop;
            const pageHeight = page.offsetHeight;

            if (
                pageTop < containerTop + containerHeight &&
                pageTop + pageHeight > containerTop
            ) {
                const currentPage = i + 1;
                document.getElementById('page-info').textContent = `Page ${currentPage}/${pdfDoc.numPages}`;
                break;
            }
        }
    }

// Fungsi untuk mengatur zoom
function zoomIn() {
    scale += 0.1; // Tambahkan nilai skala
    renderAllPages(); // Render ulang semua halaman dengan skala baru
}

function zoomOut() {
    if (scale > 0.5) { // Pastikan skala tidak terlalu kecil
        scale -= 0.1; // Kurangi nilai skala
        renderAllPages(); // Render ulang semua halaman dengan skala baru
    }
}

function handleMouseWheelZoom(event) {
    if (event.ctrlKey) {
        event.preventDefault();  // Mencegah scroll biasa saat ctrl + scroll
        if (event.deltaY < 0) {
            // Scroll ke atas (Zoom In)
            scale += 0.1;
        } else {
            // Scroll ke bawah (Zoom Out)
            if (scale > 0.5) {
                scale -= 0.1;
            }
        }
        renderAllPages(); // Render ulang semua halaman dengan skala baru
    }
}

    document.addEventListener('keydown', function(event) {
    if (event.key === 'PrintScreen' || event.key === 'F12') {
        event.preventDefault();  // Mencegah tindakan tertentu seperti Print Screen
    }
});
    // Event listener untuk tombol zoom
    document.getElementById('zoom-in').addEventListener('click', zoomIn);
    document.getElementById('zoom-out').addEventListener('click', zoomOut);

    // Event listener untuk scroll mouse di container
    container.addEventListener('wheel', handleMouseWheelZoom);

    // Event listener untuk scroll container (update halaman terlihat)
    container.addEventListener('scroll', updateCurrentPage);

    // Ambil dokumen PDF dan render semua halaman
    pdfjsLib.getDocument(url).promise.then((pdfDoc_) => {
        pdfDoc = pdfDoc_;
        document.getElementById('page-info').textContent = `Page 1/${pdfDoc.numPages}`;
        renderAllPages();
    });


    
</script>
@endsection
