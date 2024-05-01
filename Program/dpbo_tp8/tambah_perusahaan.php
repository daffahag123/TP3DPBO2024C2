<?php

// Include file konfigurasi database dan kelas-kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Perusahaan.php');
include('classes/Template.php');

// Buat objek perusahaan
$perusahaan = new Perusahaan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$perusahaan->open();            // Buka koneksi database
$perusahaan->getPerusahaan();   // Ambil data perusahaan

// Buat objek Template untuk tampilan
$view = new Template('templates/skin_tambah_ubah.html');

// Proses Tambah Data jika tidak ada parameter id
if (!isset($_GET['id'])) {
    $btn = 'Tambah';    // Set label tombol tambah
    $title = 'Tambah';  // Set judul halaman

    // Form HTML untuk menambahkan perusahaan baru
    $data = 
    '<form action="tambah_perusahaan.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama">Nama Perusahaan</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">' . $btn . '</button>
    </form>';

    // Proses penambahan data jika tombol submit ditekan
    if (isset($_POST['submit'])) {
        // Tambahkan perusahaan baru ke database
        if ($perusahaan->addPerusahaan($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'perusahaan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'perusahaan.php';
            </script>";
        }
    }
}

$mainTitle = 'Perusahaan';          // Set judul utama halaman
$hrefPerusahaan = 'perusahaan.php'; // Set href untuk link 'Perusahaan'

$daftar = ''; // Inisialisasi variabel untuk menyimpan link 'Daftar Perusahaan'
if ($mainTitle != 'Karyawan') {
    $daftar = 
    '<a class="nav-link text-light" aria-current="page" href="' . $hrefPerusahaan . '">Daftar ' . $mainTitle . '</a>'; // Generate link 'Daftar Perusahaan'
}

// Tutup koneksi database
$perusahaan->close(); 

// Mengganti placeholder pada template dengan data yang sudah disiapkan
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TAMBAH_UBAH', $data);
$view->replace('DATA_DAFTAR', $daftar);

// Menampilkan halaman dengan data yang sudah diisi
$view->write(); 
