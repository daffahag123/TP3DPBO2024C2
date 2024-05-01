<?php

/* Saya Daffa Fakhry Anshori dengan NIM 2200337 mengerjakan soal TP 3 dalam Praktikum mata kuliah Desain dan Pemrograman 
Berbasis Objek, untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamin. */

// Include file konfigurasi database dan kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Perusahaan.php');
include('classes/Pekerjaan.php');
include('classes/Karyawan.php');
include('classes/Template.php');

// Membuat instance objek Karyawan
$listKaryawan = new Karyawan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// Membuka koneksi ke database
$listKaryawan->open();
// Tampilkan data karyawan
$listKaryawan->getKaryawanJoin();

// Proses pencarian karyawan
if (isset($_POST['btn-cari'])) {
    // Jika tombol cari ditekan, cari karyawan berdasarkan kata kunci
    $listKaryawan->searchKaryawan($_POST['cari']);
// Proses filter/urutkan karyawan
} else if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    // Jika parameter sort ada dalam URL, menampilkan data karyawan secara asc/desc
    $listKaryawan->filterKaryawan($sort);
} else {
    // Jika tidak ada filter atau pencarian, tampilkan semua data karyawan
    $listKaryawan->getKaryawanJoin();
}

$data = null;

// Ambil data karyawan dan gabungkan dengan tag HTML untuk ditampilkan pada template
while ($row = $listKaryawan->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 karyawan-thumbnail">
        <a href="detail.php?id=' . $row['id_karyawan'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/foto_karyawan/' . $row['foto_karyawan'] . '" class="card-img-top" alt="' . $row['foto_karyawan'] . '"style="width: 160px; height: 130px;">
            </div>
            <div class="card-body">
                <p class="card-text nama-karyawan my-0">' . $row['nama_karyawan'] . '</p>
                <p class="card-text nama-perusahaan">' . $row['nama_perusahaan'] . '</p>
                <p class="card-text nama-pekerjaan my-0">' . $row['nama_pekerjaan'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// Proses hapus data karyawan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // Jika ID valid, coba hapus karyawan dengan ID tersebut
        if ($listKaryawan->deleteKaryawan($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

// Tutup koneksi ke database
$listKaryawan->close();

// Membuat instance objek Template untuk menampilkan halaman utama
$home = new Template('templates/skin.html');
$home->replace('DATA_KARYAWAN', $data); // Simpan data karyawan ke template
$home->write();                         // Tampilkan halaman utama dengan data karyawan