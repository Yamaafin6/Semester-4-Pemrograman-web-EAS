<?php
session_start();
if ($_SESSION['role'] != 'guru') {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'simds';

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

$nisn = $_POST['nisn'];
$nilai = $_POST['nilai'];

$query = "INSERT INTO nilai_raport (nisn, nilai) VALUES ('$nisn', '$nilai') 
          ON DUPLICATE KEY UPDATE nilai = VALUES(nilai)";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

mysqli_close($koneksi);
?>
