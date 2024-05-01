<?php

class Perusahaan extends DB
{
    function getPerusahaan()
    {
        // Mendapatkan semua data perusahaan
        $query = "SELECT * FROM perusahaan";
        return $this->execute($query);
    }

    function getPerusahaanById($id)
    {
        // Mendapatkan data perusahaan berdasarkan ID
        $query = "SELECT * FROM perusahaan WHERE id_perusahaan=$id";
        return $this->execute($query);
    }

    function searchPerusahaan($keyword)
    {
        // Mencari perusahaan berdasarkan kata kunci yang cocok dengan nama perusahaan
        $query = "SELECT * FROM perusahaan WHERE nama_perusahaan LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function filterPerusahaan($sort)
    {
        // Mengurutkan data perusahaan berdasarkan nama secara ascending atau descending
        $query = "SELECT * FROM perusahaan";
        if ($sort == 'asc') {
            $query .= " ORDER BY nama_perusahaan ASC";
        } elseif ($sort == 'desc') {
            $query .= " ORDER BY nama_perusahaan DESC";
        };
        return $this->execute($query);
    }

    function addPerusahaan($data)
    {
        // Menambahkan data perusahaan ke database
        $nama = $data['nama'];
        $query = "INSERT INTO perusahaan VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updatePerusahaan($id, $data)
    {
        // Memperbarui data perusahaan berdasarkan ID
        $nama = $data['nama'];
        $query = "UPDATE perusahaan SET nama_perusahaan='$nama' WHERE id_perusahaan=$id";
        return $this->executeAffected($query);
    }

    function deletePerusahaan($id)
    {
        // Menghapus data perusahaan berdasarkan ID
        $query = "DELETE FROM perusahaan WHERE id_perusahaan=$id";
        return $this->executeAffected($query);
    }
}
