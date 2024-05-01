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

Hubungan Antar Tabel:
- Setiap karyawan dapat bekerja di satu perusahaan (many-to-one relationship). Perusahaan merupakan foreign-key dari Karyawan.
- Setiap karyawan memiliki satu posisi pekerjaan (many-to-one relationship). Pekerjaan merupakan foreign-key dari Karyawan.

Terdapat proses Create, Read, Update, dan Delete (CRUD) data pada setiap tabel:
1. CRUD Karyawan
- CREATE : Untuk menambahkan data baru pada tabel Karyawan, digunakan fungsi addKaryawan() yang terdapat dalam file Karyawan.php. Proses ini terhubung dengan halaman tambah_karyawan.php dan template skin_tambah_ubah.html. Pengguna dapat mengisi formulir dengan informasi tentang karyawan yang ingin ditambahkan.
- READ : Untuk membaca data dari tabel Karyawan, kita perlu menggunakan fungsi getKaryawanJoin() yang terdapat dalam file Karyawan.php. Proses ini terhubung dengan halaman index.php dan template skin.html. Proses pembacaan data untuk menampilkan daftar karyawan kepada pengguna.
- UPDATE : Untuk memperbarui data pada tabel Karyawan, digunakan fungsi updateKaryawan($id, $data, $file) yang terdapat dalam file Karyawan.php. Proses ini terhubung dengan halaman ubah_karyawan.php dan template skin_tambah_ubah.html. Pengguna dapat mengedit informasi karyawan yang sudah ada.
- DELETE : Untuk menghapus data dari tabel Karyawan, digunakan fungsi deleteKaryawan($id) yang terdapat dalam file Karyawan.php. Proses ini terhubung dengan halaman index.php dan template skin.html. Ketika pengguna mengklik tombol "Hapus Data" pada halaman detail.php, maka data karyawan yang dipilih akan dihapus dari tabel.
  
2. CRUD Perusahaan
- CREATE: Untuk menambah data baru pada tabel Perusahaan, digunakan fungsi addPerusahaan() yang terdapat dalam file Perusahaan.php. Proses ini terhubung dengan halaman tambah_perusahaan.php dan template skin_tambah_ubah.html. Pengguna dapat mengisi formulir dengan informasi perusahaan yang ingin ditambahkan.
- READ: Pembacaan data dari tabel Perusahaan dilakukan menggunakan fungsi getPerusahaan() yang terdapat dalam file Perusahaan.php. Proses ini terhubung dengan halaman perusahaan.php dan template skin.html. Data perusahaan dibaca untuk menampilkan daftar perusahaan kepada pengguna.
- UPDATE: Untuk memperbarui data pada tabel Perusahaan, digunakan fungsi updatePerusahaan($id, $data) yang terdapat dalam file Perusahaan.php. Proses ini terhubung dengan halaman ubah_perusahaan.php dan template skin_tambah_ubah.html. Pengguna dapat mengedit informasi perusahaan yang sudah ada.
- DELETE: Data dari tabel Perusahaan dapat dihapus menggunakan fungsi deletePerusahaan($id) yang terdapat dalam file Perusahaan.php. Proses ini terhubung dengan halaman perusahaan.php dan template skin.html. Ketika pengguna mengklik tombol icon "Sampah" pada halaman perusahaan.php, data perusahaan yang dipilih akan dihapus dari tabel.
  
3. CRUD Pekerjaan
- CREATE: Untuk menambah data baru pada tabel Pekerjaan, digunakan fungsi addPekerjaan() yang terdapat dalam file Pekerjaan.php. Proses ini terhubung dengan halaman tambah_pekerjaan.php dan template skin_tambah_ubah.html. Pengguna dapat mengisi formulir dengan informasi pekerjaan yang ingin ditambahkan.
- READ: Pembacaan data dari tabel Pekerjaan dilakukan menggunakan fungsi getPekerjaan() yang terdapat dalam file Pekerjaan.php. Proses ini terhubung dengan halaman pekerjaan.php dan template skin.html. Data pekerjaan dibaca untuk menampilkan daftar pekerjaan kepada pengguna.
- UPDATE: Untuk memperbarui data pada tabel Pekerjaan, digunakan fungsi updatePekerjaan($id, $data) yang terdapat dalam file Pekerjaan.php. Proses ini terhubung dengan halaman ubah_pekerjaan.php dan template skin_tambah_ubah.html. Pengguna dapat mengedit informasi pekerjaan yang sudah ada.
- DELETE: Data dari tabel Pekerjaan dapat dihapus menggunakan fungsi deletePekerjaan($id) yang terdapat dalam file Pekerjaan.php. Proses ini terhubung dengan halaman pekerjaan.php dan template skin.html. Ketika pengguna mengklik mengklik tombol icon "Sampah" pada halaman pekerjaan.php, data pekerjaan yang dipilih akan dihapus dari tabel.

Terdapat fungsi pencarian dan pengurutan data pada semua tabel:
- Fungsi Pencarian: Mencari nama karyawan terdapat fungsi searchKaryawan($keyword) pada Karyawan.php, mencari nama perusahaan terdapat fungsi searchPerusahaan($keyword) pada Perusahaan.php, dan  mencari nama pekerjaan terdapat fungsi searchPekerjaan($keyword) pada Pekerjaan.php.
- Fungsi Pengurutan: Mengurutkan data tabel Karyawan/Perusahaan/Pekerjaan dengan menekan tombol "Urutkan Nama Berdasarkan" dengan mimilih Ascending atau Descending untuk pengurutan tampilannya dengan membuat fungsi filterKaryawan($sort), filterPerusahaan($sort), dan filterPekerjaan($sort).

# Penjelasan Alur
Pengguna dapat menggunakan fitur-fitur pada website yang sudah saya buat diantaranya:
1. Halaman Home (Daftar Karyawan)
- Create: Pengguna dapat menambahkan karyawan baru dengan mengisi data seperti foto, nama, nik, gaji, perusahaan tempat bekerja, dan pekerjaan yang dilakukan.
- View: Pengguna dapat melihat daftar semua karyawan
- Update: Pengguna dapat mengedit data karyawan
- Delete: Pengguna dapat menghapus data karyawan
- Fitur Pencarian: Pengguna dapat mencari karyawan tertentu berdasarkan nama
- Fitur Pengurutan: Pengguna dapat mengurutkan daftar karyawan berdasarkan nama secara ascending atau descending
  
2. Halaman Daftar Perusahaan
- Create: Pengguna dapat menambahkan perusahaan baru dengan mengisi data seperti nama perusahaan
- View: Pengguna dapat melihat daftar semua perusahaan
- Update: Pengguna dapat mengedit data perusahaan
- Delete: Pengguna dapat menghapus data perusahaan
- Fitur Pencarian: Pengguna dapat mencari perusahaan tertentu berdasarkan nama
- Fitur Pengurutan: Pengguna dapat mengurutkan daftar perusahaan berdasarkan nama secara ascending atau descending
  
3. Halaman Daftar Pekerjaan
- Create: Pengguna dapat menambahkan pekerjaan baru dengan mengisi data seperti nama pekerjaan
- View: Pengguna dapat melihat daftar semua pekerjaan
- Update: Pengguna dapat mengedit data pekerjaan
- Delete: Pengguna dapat menghapus data pekerjaan
- Fitur Pencarian: Pengguna dapat mencari pekerjaan tertentu berdasarkan nama
- Fitur Pengurutan: Pengguna dapat mengurutkan daftar pekerjaan berdasarkan nama secara ascending atau descending

# Dokumentasi Program
Tabel Karyawan, memiliki beberapa halaman:
1. Halaman Home
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/10130812-c624-40ff-8966-cc209e641343)
2. Halaman Detail Karyawan
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/020e7e64-d108-4e6e-855b-0469b61f8b30)
3. Halaman Tambah Karyawan
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/d9cb37ed-8968-4616-8833-697d89d49fe6)
4. Halaman Ubah Karyawan
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/eaa33469-d5e3-455b-b852-92e784071609)

Tabel Perusahaan, memiliki beberapa halaman:
1. Halaman Daftar Perusahaan
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/944aaeb3-7acc-45af-8670-15395c7666de)
2. Halaman Tambah Perusahaan
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/ca373529-73eb-415c-ba5a-805e2483e6b5)
3. Halaman Ubah Perusahaan
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/94313302-eacb-4954-a762-6259888106e2)

Tabel Pekerjaan, memiliki beberapa halaman:
1. Halaman Daftar Pekerjaan
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/2146ba68-359b-4964-95a1-59096d064e7e)
2. Halaman Tambah Pekerjaan
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/ab4d7f3c-25b5-4d73-889f-ae98ec70c42a)
3. Halaman Ubah Pekerjaan
![image](https://github.com/daffahag123/TP3DPBO2024C2/assets/135239333/e8735ed8-8510-4727-a928-7e4361a89c80)







