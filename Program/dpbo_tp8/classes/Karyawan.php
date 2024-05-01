<?php

class Karyawan extends DB
{
    function getKaryawanJoin()
    {
        // Mendapatkan semua data karyawan dengan menggabungkan tabel karyawan, perusahaan, dan pekerjaan
        $query = "SELECT * FROM karyawan JOIN perusahaan ON karyawan.id_perusahaan=perusahaan.id_perusahaan JOIN pekerjaan ON karyawan.id_pekerjaan=pekerjaan.id_pekerjaan ORDER BY karyawan.id_karyawan";
        return $this->execute($query);
    }

    function getKaryawan()
    {
        // Mendapatkan semua data karyawan
        $query = "SELECT * FROM karyawan";
        return $this->execute($query);
    }

    function getKaryawanById($id)
    {
        // Mendapatkan data karyawan berdasarkan ID
        $query = "SELECT * FROM karyawan JOIN perusahaan ON karyawan.id_perusahaan=perusahaan.id_perusahaan JOIN pekerjaan ON karyawan.id_pekerjaan=pekerjaan.id_pekerjaan WHERE id_karyawan=$id";
        return $this->execute($query);
    }

    function searchKaryawan($keyword)
    {
        // Mencari karyawan berdasarkan kata kunci yang cocok dengan nama karyawan, nama perusahaan, atau nama pekerjaan
        $query = "SELECT * FROM karyawan 
                JOIN perusahaan ON karyawan.id_perusahaan=perusahaan.id_perusahaan
                JOIN pekerjaan ON karyawan.id_pekerjaan=pekerjaan.id_pekerjaan
                WHERE nama_karyawan LIKE '%$keyword%' OR nama_perusahaan LIKE '%$keyword%' OR nama_pekerjaan LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function filterKaryawan($sort) 
    {
         // Mengurutkan data karyawan berdasarkan nama secara ascending atau descending
        $query = "SELECT * FROM karyawan JOIN perusahaan ON karyawan.id_perusahaan=perusahaan.id_perusahaan JOIN pekerjaan ON karyawan.id_pekerjaan=pekerjaan.id_pekerjaan";
        if ($sort == 'asc') {
            $query .= " ORDER BY karyawan.nama_karyawan ASC"; 
        } elseif ($sort == 'desc') {
            $query .= " ORDER BY karyawan.nama_karyawan DESC"; 
        };
        return $this->execute($query);
    }

    function addKaryawan($data, $file)
    {
        // Menambahkan data karyawan ke database
        $foto = $file['foto']['name'];
        $file_tmp = $file['foto']['tmp_name'];
        move_uploaded_file($file_tmp, 'assets/images/foto_karyawan/' . $foto);

        $nama = $data['nama'];
        $nik = $data['nik'];
        $gaji = $data['gaji'];
        $id_perusahaan = $data['perusahaan'];
        $id_pekerjaan = $data['pekerjaan'];

        $query = "INSERT INTO karyawan (foto_karyawan, nama_karyawan, nik, gaji, id_perusahaan, id_pekerjaan) VALUES ('$foto', '$nama', '$nik', '$gaji', '$id_perusahaan', '$id_pekerjaan')";
        return $this->executeAffected($query);
    }


    function updateKaryawan($id, $data, $file)
    {
        // Memperbarui data karyawan berdasarkan ID
        $nama = $data['nama'];
        $nik = $data['nik'];
        $gaji = $data['gaji'];
        $id_perusahaan = $data['perusahaan'];
        $id_pekerjaan = $data['pekerjaan'];

        $foto = $file['foto']['name']; 
        $file_tmp = $file['foto']['tmp_name'];

        // Cek apakah ada file foto baru yang diunggah
        if (!empty($foto)) {
            // Jika ada, pindahkan file foto baru ke lokasi penyimpanan
            $lokasiSimpanFoto = 'assets/images/foto_karyawan/'; 
            $lokasiFotoFinal = $lokasiSimpanFoto . $foto;
            move_uploaded_file($file_tmp, $lokasiFotoFinal);

            // Update data karyawan beserta foto baru
            $query = "UPDATE karyawan SET foto_karyawan='$foto', nama_karyawan='$nama', nik='$nik', gaji='$gaji', id_perusahaan='$id_perusahaan', id_pekerjaan='$id_pekerjaan' WHERE id_karyawan=$id";
        } else {
            // Jika tidak ada file foto baru yang diunggah, tetap gunakan foto yang ada
            $query = "UPDATE karyawan SET nama_karyawan='$nama', nik='$nik', gaji='$gaji', id_perusahaan='$id_perusahaan', id_pekerjaan='$id_pekerjaan' WHERE id_karyawan=$id";
        }

        return $this->executeAffected($query);
    }

    function deleteKaryawan($id)
    {
        // Menghapus data karyawan berdasarkan ID
        $query = "DELETE FROM karyawan WHERE id_karyawan=$id";
        return $this->executeAffected($query);
    }
}
