# TP3DPBO2024C2

Saya Daffa Fakhry Anshori dengan NIM 2200337 mengerjakan soal TP 3 dalam Praktikum mata kuliah Desain dan Pemrograman 
Berbasis Objek, untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamin.

# Desain Database
![desain_db](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/2a67c692-0592-4c27-95c3-a51c68b5cc92)

# Desain Program
Program ini adalah sebuah website sederhana untuk manajemen karyawan yang menggunakan PHP sebagai bahasa pemrogramannya. Website ini memiliki tiga kelas utama yang mewakili tiga tabel dalam basis data:
1. Karyawan
- Kelas ini bertanggung jawab untuk mengelola data karyawan
- Setiap karyawan memiliki atribut seperti foto, nama, nik, gaji, perusahaan tempat bekerja, dan pekerjaan yang dilakukan.
2. Perusahaan
- Kelas ini bertanggung jawab untuk mengelola data perusahaan
- Setiap perusahaan memiliki atribut yaitu nama perusahaan.
3. Pekerjaan
- Kelas ini bertanggung jawab untuk mengelola data pekerjaan
- Setiap jenis pekerjaan memiliki atribut yaitu nama pekerjaan.

Terdapat proses Create, Read, Update, dan Delete data pada setiap tabel:
1. CRUD Karyawan
- CREATE : Untuk menambahkan data baru pada tabel Karyawan, digunakan fungsi addKaryawan() yang terdapat dalam file Karyawan.php. Proses ini terhubung dengan halaman tambah_karyawan.php dan template skin_tambah_ubah.html. Pengguna dapat mengisi formulir dengan informasi tentang karyawan yang ingin ditambahkan.
- READ : Untuk membaca data dari tabel Karyawan, kita perlu menggunakan fungsi getKaryawanJoin() yang terdapat dalam file Karyawan.php. Proses ini terhubung dengan halaman index.php dan template skin.html. Proses pembacaan data untuk menampilkan daftar karyawan.
- UPDATE : Untuk memperbarui data pada tabel Karyawan, digunakan fungsi updateKaryawan($id, $data, $file) yang terdapat dalam file Karyawan.php. Proses ini terhubung dengan halaman ubah_karyawan.php dan template skin_tambah_ubah.html. Pengguna dapat mengedit informasi karyawan yang sudah ada.
- DELETE : Untuk menghapus data dari tabel Karyawan, digunakan fungsi deleteKaryawan($id) yang terdapat dalam file Karyawan.php. Proses ini terhubung dengan halaman index.php dan template skin.html. Ketika pengguna mengklik tombol "Hapus Data" pada halaman detail.php, maka data karyawan yang dipilih akan dihapus dari tabel.
  
2. CRUD Perusahaan
3. CRUD Pekerjaan

