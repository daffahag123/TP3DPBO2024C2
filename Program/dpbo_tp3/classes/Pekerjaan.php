<?php

class Pekerjaan extends DB
{
    function getPekerjaan()
    {
        // Mendapatkan semua data pekerjaan
        $query = "SELECT * FROM pekerjaan";
        return $this->execute($query);
    }

    function getPekerjaanById($id)
    {
        // Mendapatkan data pekerjaan berdasarkan ID
        $query = "SELECT * FROM pekerjaan WHERE id_pekerjaan=$id";
        return $this->execute($query);
    }

    function searchPekerjaan($keyword)
    {
        // Mencari pekerjaan berdasarkan kata kunci yang cocok dengan nama pekerjaan
        $query = "SELECT * FROM pekerjaan WHERE nama_pekerjaan LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function filterPekerjaan($sort) 
    {
        // Mengurutkan data pekerjaan berdasarkan nama secara ascending atau descending
        $query = "SELECT * FROM pekerjaan";
        if ($sort == 'asc') {
            $query .= " ORDER BY nama_pekerjaan ASC"; 
        } elseif ($sort == 'desc') {
            $query .= " ORDER BY nama_pekerjaan DESC"; 
        };
        return $this->execute($query);
    }

    function addPekerjaan($data)
    {
        // Menambahkan data pekerjaan ke database
        $nama = $data['nama'];
        $query = "INSERT INTO pekerjaan VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updatePekerjaan($id, $data)
    {
        // Memperbarui data pekerjaan berdasarkan ID
        $nama = $data['nama'];
        $query = "UPDATE pekerjaan SET nama_pekerjaan='$nama' WHERE id_pekerjaan=$id";
        return $this->executeAffected($query);
    }

    function deletePekerjaan($id)
    {
        // Menghapus data pekerjaan berdasarkan ID
        $query = "DELETE FROM pekerjaan WHERE id_pekerjaan=$id";
        return $this->executeAffected($query);
    }
}
