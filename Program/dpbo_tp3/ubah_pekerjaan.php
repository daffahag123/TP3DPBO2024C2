<?php

// Include file konfigurasi database dan kelas-kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Pekerjaan.php');
include('classes/Template.php');

// Buat objek pekerjaan
$pekerjaan = new Pekerjaan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pekerjaan->open(); // Buka koneksi database

// Buat objek Template untuk tampilan
$view = new Template('templates/skin_tambah_ubah.html');

// Proses Update Data jika ada parameter id
if (isset($_GET['id'])) {
    $btn = 'Simpan'; // Set label tombol simpan
    $title = 'Ubah'; // Set judul halaman

    // Ambil id pekerjaan dari parameter URL
    $id = $_GET['id']; 
    if ($id > 0) {
        // Ambil data pekerjaan berdasarkan id
        $pekerjaan->getPekerjaanById($id);
        $row = $pekerjaan->getResult();

        // Ambil nilai-nilai yang akan diisi dalam formulir
        $nama_pekerjaan = $row['nama_pekerjaan'];

        // Form HTML untuk mengubah data pekerjaan
        $data = 
        '<form action="ubah_pekerjaan.php?id=' . $id . '" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama">Nama Pekerjaan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="' . $nama_pekerjaan . '" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">' . $btn . '</button>
        </form>';

        // Proses penyimpanan data jika tombol submit ditekan
        if (isset($_POST['submit'])) {
            if ($pekerjaan->updatePekerjaan($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'pekerjaan.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'pekerjaan.php';
            </script>";
            }
        }
    }
}

$mainTitle = 'Pekerjaan';           // Set judul utama halaman
$hrefPekerjaan = 'pekerjaan.php';   // Set href untuk link 'Pekerjaan'

// Buat tautan daftar jika judul utama bukan 'Karyawan'
if($mainTitle != 'Karyawan') {
    $daftar = 
    '<a class="nav-link text-light" aria-current="page" href="' . $hrefPekerjaan . '">Daftar ' . $mainTitle . '</a>';
}

// Tutup koneksi database
$pekerjaan->close(); 

// Mengganti placeholder pada template dengan data yang sudah disiapkan
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TAMBAH_UBAH', $data);
$view->replace('DATA_HREF_PP', $hrefPekerjaan);
$view->replace('DATA_DAFTAR', $daftar);

// Menampilkan halaman dengan data yang sudah diisi
$view->write(); 
