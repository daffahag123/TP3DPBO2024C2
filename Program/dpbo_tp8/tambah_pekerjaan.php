<?php

// Include file konfigurasi database dan kelas-kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Pekerjaan.php');
include('classes/Template.php');

// Buat objek pekerjaan
$pekerjaan = new Pekerjaan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pekerjaan->open();         // Buka koneksi database
$pekerjaan->getPekerjaan(); // Ambil data pekerjaan

// Buat objek Template untuk tampilan
$view = new Template('templates/skin_tambah_ubah.html');

// Proses Tambah Data jika tidak ada parameter id
if (!isset($_GET['id'])) {
    $btn = 'Tambah';    // Set label tombol tambah
    $title = 'Tambah';  // Set judul halaman

    // Form HTML untuk menambahkan pekerjaan baru
    $data = 
    '<form action="tambah_pekerjaan.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama">Nama Pekerjaan</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">' . $btn . '</button>
    </form>';

    // Proses penambahan data jika tombol submit ditekan
    if (isset($_POST['submit'])) {
        // Tambahkan pekerjaan baru ke database
        if ($pekerjaan->addPekerjaan($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'pekerjaan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'pekerjaan.php';
            </script>";
        }
    }
}

$mainTitle = 'Pekerjaan';           // Set judul utama halaman
$hrefPekerjaan = 'pekerjaan.php';   // Set href untuk link 'Pekerjaan'

$daftar = ''; // Inisialisasi variabel untuk menyimpan link 'Daftar Pekerjaan'
if ($mainTitle != 'Karyawan') {
    $daftar = 
    '<a class="nav-link text-light" aria-current="page" href="' . $hrefPekerjaan . '">Daftar ' . $mainTitle . '</a>'; // Generate link 'Daftar Pekerjaan'
}

// Tutup koneksi database
$pekerjaan->close(); 

// Mengganti placeholder pada template dengan data yang sudah disiapkan
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TAMBAH_UBAH', $data);
$view->replace('DATA_DAFTAR', $daftar);

// Menampilkan halaman dengan data yang sudah diisi
$view->write();
