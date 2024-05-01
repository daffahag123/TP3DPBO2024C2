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

// Buat objek pekerjaan
$pekerjaan = new Pekerjaan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pekerjaan->open();            // Buka koneksi database
$pekerjaan->getPekerjaan();   // Ambil data pekerjaan

// Inisialisasi string untuk pilihan perusahaan dan pekerjaan
$perusahaanOptions = '';
$pekerjaanOptions = '';

// Loop melalui hasil perusahaan dan pekerjaan dan buat opsi untuk formulir
while ($row = $perusahaan->getResult()) {
    $perusahaanOptions .= '<option value="' . $row['id_perusahaan'] . '">' . $row['nama_perusahaan'] . '</option>';
}
while ($row = $pekerjaan->getResult()) {
    $pekerjaanOptions .= '<option value="' . $row['id_pekerjaan'] . '">' . $row['nama_pekerjaan'] . '</option>';
}

// Tutup koneksi dengan perusahaan dan pekerjaan
$perusahaan->close();
$pekerjaan->close();

// Buat objek Template untuk tampilan
$view = new Template('templates/skin_tambah_ubah.html');

// Proses Update Data jika ada parameter id
if (isset($_GET['id'])) {
    $btn = 'Simpan'; // Set label tombol simpan
    $title = 'Ubah'; // Set judul halaman

    // Ambil id karyawan dari parameter URL
    $id = $_GET['id']; 
    if ($id > 0) {
        // Ambil data karyawan berdasarkan id
        $karyawan->getKaryawanById($id);
        $row = $karyawan->getResult();

        // Ambil nilai-nilai yang akan diisi dalam formulir
        $foto_karyawan = $row['foto_karyawan'];
        $nama_karyawan = $row['nama_karyawan'];
        $nik = $row['nik'];
        $gaji = $row['gaji'];
        $id_perusahaan = $row['id_perusahaan'];
        $id_pekerjaan = $row['id_pekerjaan'];
        $nama_perusahaan = $row['nama_perusahaan'];
        $nama_pekerjaan = $row['nama_pekerjaan'];

        // Form HTML untuk mengubah data karyawan
        $data =
        '<form action="ubah_karyawan.php?id=' . $id . '" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto">Foto Karyawan</label><br>
                <img src="assets/images/foto_karyawan/' . $foto_karyawan . '" alt="Foto Karyawan" width="200px" height="150px"><br>
                <p>Abaikan jika tidak mengganti foto</p>

                <input type="file" class="form-control" id="foto" name="foto">
            </div>
            <div class="mb-3">
                <label for="nama">Nama karyawan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="' . $nama_karyawan . '" required>
            </div>
            <div class="mb-3">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="' . $nik . '" required>
            </div>
            <div class="mb-3">
                <label for="gaji">Gaji</label>
                <input type="text" class="form-control" id="gaji" name="gaji" value="' . $gaji . '" required>
            </div>
            <div class="mb-3">
                <label for="perusahaan">Perusahaan</label>
                <select class="form-select" id="perusahaan" name="perusahaan" required>';

                // Tentukan opsi yang terpilih untuk perusahaan
                if (isset($_POST['perusahaan'])) {
                    $data .= '<option selected value="' . $_POST['perusahaan'] . '">' . $nama_perusahaan . '</option>';
                } else {
                    $data .= '<option selected value="' . $id_perusahaan . '">' . $nama_perusahaan . '</option>';
                }

                $data .= $perusahaanOptions . '
                    
                </select>
            </div>
            <div class="mb-3">
                <label for="pekerjaan">Pekerjaan</label>
                <select class="form-select" id="pekerjaan" name="pekerjaan" required>';

                // Tentukan opsi yang terpilih untuk pekerjaan
                if (isset($_POST['pekerjaan'])) {
                    $data .= '<option selected value="' . $_POST['pekerjaan'] . '">' . $nama_pekerjaan . '</option>';
                } else {
                    $data .= '<option selected value="' . $id_pekerjaan . '">' . $nama_pekerjaan . '</option>';
                }

                $data .= $pekerjaanOptions . '
                    
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">' . $btn . '</button>
        </form>';

        // Proses penyimpanan data jika tombol submit ditekan
        if (isset($_POST['submit'])) {
            if ($karyawan->updateKaryawan($id, $_POST, $_FILES) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'index.php';
            </script>";
            }
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
$view->replace('DATA_HREF_PP', $hrefKaryawan);

// Menampilkan halaman dengan data yang sudah diisi
$view->write(); 
