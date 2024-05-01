<?php

// Include file konfigurasi database dan kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Perusahaan.php');
include('classes/Template.php');

// Membuat instance objek Perusahaan
$perusahaan = new Perusahaan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// Membuka koneksi ke database
$perusahaan->open();
// Mengambil data perusahaan
$perusahaan->getPerusahaan();

// Proses pencarian perusahaan
if (isset($_POST['btn-cari'])) {
    // Jika tombol cari ditekan, cari perusahaan berdasarkan kata kunci
    $perusahaan->searchPerusahaan($_POST['cari']);
// Proses filter/urutan perusahaan
} else if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    // Jika parameter sort ada dalam URL, menampilkan data perusahaan secara asc/desc
    $perusahaan->filterPerusahaan($sort);
} else {
    // Jika tidak ada filter atau pencarian, tampilkan semua data perusahaan
    $perusahaan->getPerusahaan();
}

// Membuat instance objek Template untuk menampilkan halaman
$view = new Template('templates/skintabel.html');

// Menyiapkan variabel-variabel untuk data yang akan ditampilkan di tabel
$mainTitle = 'Perusahaan';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Perusahaan</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'perusahaan';
$hrefTambah = 'tambah_perusahaan.php';

// Menampilkan data perusahaan dalam bentuk tabel
while ($row = $perusahaan->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $row['nama_perusahaan'] . '</td>
    <td style="font-size: 22px;">
        <a href="ubah_perusahaan.php?id=' . $row['id_perusahaan'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="perusahaan.php?hapus=' . $row['id_perusahaan'] . '" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini?\')" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// Proses hapus data perusahaan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // Jika ID valid, coba hapus perusahaan dengan ID tersebut
        if ($perusahaan->deletePerusahaan($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'perusahaan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'perusahaan.php';
            </script>";
        }
    }
}

// Menutup koneksi ke database
$perusahaan->close();

// Mengganti placeholder pada template dengan data yang sudah disiapkan
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_HREF_TAMBAH', $hrefTambah);

// Menampilkan halaman dengan data yang sudah diisi
$view->write();
