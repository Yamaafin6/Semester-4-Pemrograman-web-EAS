<?php
// Koneksi ke database
$servername = "localhost"; // Sesuaikan dengan server database Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "simds"; // Sesuaikan dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // SQL untuk menghapus data siswa dari tabel siswa
    $sql = "DELETE FROM siswa WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data siswa berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>