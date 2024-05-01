<?php

// Include file konfigurasi database dan kelas-kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Perusahaan.php');
include('classes/Pekerjaan.php');
include('classes/Karyawan.php');
include('classes/Template.php');

// Buat objek karyawan
$karyawan = new Karyawan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$karyawan->open();          // Buka koneksi database
$karyawan->getKaryawan();   // Ambil data karyawan

// Buat objek perusahaan
$perusahaan = new Perusahaan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$perusahaan->open();            // Buka koneksi database
$perusahaan->getPerusahaan();   // Ambil data perusahaan
$perusahaanOptions = '';        // Inisialisasi variabel untuk menyimpan pilihan dropdown perusahaan
while ($row = $perusahaan->getResult()) {
    $perusahaanOptions .= '<option value="' . $row['id_perusahaan'] . '">' . $row['nama_perusahaan'] . '</option>'; // Generate HTML options untuk dropdown perusahaan
}
// Tutup koneksi database
$perusahaan->close(); 

// Buat objek pekerjaan
$pekerjaan = new Pekerjaan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pekerjaan->open();         // Buka koneksi database
$pekerjaan->getPekerjaan(); // Ambil data pekerjaan
$pekerjaanOptions = '';     // Inisialisasi variabel untuk menyimpan pilihan dropdown pekerjaan
while ($row = $pekerjaan->getResult()) {
    $pekerjaanOptions .= '<option value="' . $row['id_pekerjaan'] . '">' . $row['nama_pekerjaan'] . '</option>'; // Generate HTML options untuk dropdown pekerjaan
}
// Tutup koneksi database
$pekerjaan->close(); 

// Buat objek Template untuk tampilan
$view = new Template('templates/skin_tambah_ubah.html');

// Proses Tambah Data jika tidak ada parameter id
if (!isset($_GET['id'])) {
    $btn = 'Tambah';    // Set label tombol tambah
    $title = 'Tambah';  // Set judul halaman

    // Form HTML untuk menambahkan karyawan baru
    $data = 
    '<form action="tambah_karyawan.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="foto">Foto Karyawan</label>
            <input type="file" class="form-control" id="foto" name="foto" required>
        </div>
        <div class="mb-3">
            <label for="nama">Nama karyawan</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" required>
        </div>
        <div class="mb-3">
            <label for="gaji">Gaji</label>
            <input type="text" class="form-control" id="gaji" name="gaji" required>
        </div>
        <div class="mb-3">
            <label for="perusahaan">Perusahaan</label>
            <select class="form-select" id="perusahaan" name="perusahaan" required>
                <option selected disabled>Pilih Perusahaan</option>
                ' . $perusahaanOptions . '
            </select>
        </div>
        <div class="mb-3">
            <label for="pekerjaan">Pekerjaan</label>
            <select class="form-select" id="pekerjaan" name="pekerjaan" required>
                <option selected disabled>Pilih Pekerjaan</option>
                ' . $pekerjaanOptions . '
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">' . $btn . '</button>
    </form>';

    // Proses penambahan data jika tombol submit ditekan
    if (isset($_POST['submit'])) {
        // Tambahkan karyawan baru ke database
        if ($karyawan->addKaryawan($_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$mainTitle = 'Karyawan';        // Set judul utama halaman
$hrefKaryawan = 'karyawan.php'; // Set href untuk link 'Karyawan'

// Tutup koneksi database
$karyawan->close(); 

// Mengganti placeholder pada template dengan data yang sudah disiapkan
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TAMBAH_UBAH', $data);

// Menampilkan halaman dengan data yang sudah diisi
$view->write();
