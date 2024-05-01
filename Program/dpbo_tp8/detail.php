<?php

// Memasukkan file konfigurasi database dan kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Perusahaan.php');
include('classes/Pekerjaan.php');
include('classes/Karyawan.php');
include('classes/Template.php');

// Membuat instance objek Karyawan
$karyawan = new Karyawan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// Membuka koneksi ke database
$karyawan->open();

$data = nulL; // Inisialisasi variabel data

// Memeriksa apakah parameter 'id' ada dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Memeriksa apakah nilai 'id' lebih dari 0
    if ($id > 0) {
        // Mengambil data karyawan berdasarkan ID
        $karyawan->getKaryawanById($id);
        // Mendapatkan hasil dari query
        $row = $karyawan->getResult(); 

        // Membuat tampilan detail karyawan
        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama_karyawan'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/foto_karyawan/' . $row['foto_karyawan'] . '" class="img-thumbnail" alt="' . $row['foto_karyawan'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama_karyawan'] . '</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td>' . $row['nik'] . '</td>
                                </tr>
                                <tr>
                                    <td>Gaji</td>
                                    <td>:</td>
                                    <td>' . number_format($row['gaji'], 0, ',', '.') . '</td>
                                </tr>
                                <tr>
                                    <td>Perusahaan</td>
                                    <td>:</td>
                                    <td>' . $row['nama_perusahaan'] . '</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>:</td>
                                    <td>' . $row['nama_pekerjaan'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="ubah_karyawan.php?id=' . $row['id_karyawan'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="index.php?hapus=' . $row['id_karyawan'] . '" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini?\')"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

// Menutup koneksi ke database
$karyawan->close();

// Membuat objek Template untuk menampilkan detail karyawan
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_KARYAWAN', $data);    // Mengganti placeholder dengan data detail karyawan
$detail->write();                                   // Menampilkan hasil
