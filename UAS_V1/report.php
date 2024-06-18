<?php
// Konfigurasi koneksi ke database
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "simds"; // Ganti dengan nama database Anda

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Ambil data dari POST request
$email = $_POST['email'];
$judul = $_POST['judul'];
$laporan = $_POST['laporan'];

// Query untuk menyimpan data ke tabel lapor
$sql = "INSERT INTO lapor (email, judul, laporan) VALUES ('$email', '$judul', '$laporan')";

if ($conn->query($sql) === TRUE) {
    echo "Laporan bug berhasil disimpan.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
