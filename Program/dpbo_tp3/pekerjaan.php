<?php

// Include file konfigurasi database dan kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Pekerjaan.php');
include('classes/Template.php');

// Membuat instance objek Pekerjaan
$pekerjaan = new Pekerjaan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// Membuka koneksi ke database
$pekerjaan->open();
// Mengambil data pekerjaan
$pekerjaan->getPekerjaan();

// Proses pencarian pekerjaan
if (isset($_POST['btn-cari'])) {
    // Jika tombol cari ditekan, cari pekerjaan berdasarkan kata kunci
    $pekerjaan->searchPekerjaan($_POST['cari']);
// Proses filter/urutan pekerjaan
} else if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    // Jika parameter sort ada dalam URL, menampilkan data pekerjaan secara asc/desc
    $pekerjaan->filterPekerjaan($sort);
} else {
    // Jika tidak ada filter atau pencarian, tampilkan semua data pekerjaan
    $pekerjaan->getPekerjaan();
}

// Membuat instance objek Template untuk menampilkan halaman
$view = new Template('templates/skintabel.html');

// Menyiapkan variabel-variabel untuk data yang akan ditampilkan di tabel
$mainTitle = 'Pekerjaan';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Pekerjaan</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'pekerjaan';
$hrefTambah = 'tambah_pekerjaan.php';

// Menampilkan data pekerjaan dalam bentuk tabel
while ($row = $pekerjaan->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $row['nama_pekerjaan'] . '</td>
    <td style="font-size: 22px;">
        <a href="ubah_pekerjaan.php?id=' . $row['id_pekerjaan'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="pekerjaan.php?hapus=' . $row['id_pekerjaan'] . '" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini?\')" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// Proses hapus data pekerjaan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // Jika ID valid, coba hapus pekerjaan dengan ID tersebut
        if ($pekerjaan->deletePekerjaan($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'pekerjaan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'pekerjaan.php';
            </script>";
        }
    }
}

// Menutup koneksi ke database
$pekerjaan->close();

// Mengganti placeholder pada template dengan data yang sudah disiapkan
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_HREF_TAMBAH', $hrefTambah);

// Menampilkan halaman dengan data yang sudah diisi
$view->write();
