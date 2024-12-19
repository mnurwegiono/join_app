<?php
$host = 'localhost'; // Nama host database
$username = 'root';  // Username MySQL Anda
$password = '';      // Password MySQL Anda
$database = 'db_kampus'; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
