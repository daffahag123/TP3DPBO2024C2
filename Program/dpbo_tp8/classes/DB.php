<?php

class DB
{
    private $hostname; // Nama host database
    private $username; // Nama pengguna database
    private $password; // Kata sandi pengguna database
    private $dbname;   // Nama database
    private $conn;     // Koneksi database
    private $result;   // Hasil query

    function __construct($hostname, $username, $password, $dbname)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    function open()
    {
        // Membuka koneksi ke database menggunakan mysqli
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
    }

    function execute($query)
    {
        // Menjalankan query pada database
        $this->result = mysqli_query($this->conn, $query);
    }

    function getResult()
    {
        // Mengambil hasil query sebagai array asosiatif
        return mysqli_fetch_array($this->result);
    }

    function executeAffected($query = "")
    {
        // Mengeksekusi query
        mysqli_query($this->conn, $query);
        return mysqli_affected_rows($this->conn);
    }

    function close()
    {
        // Menutup koneksi ke database
        mysqli_close($this->conn);
    }
}
