<?php
session_start();
if ($_SESSION['role'] != 'guru') {
    header("Location: index.html");
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nisn = $_POST['nisn'];
    $mapel = $_POST['mapel'];
    $nilai = $_POST['nilai'];

    $query = "INSERT INTO nilai_raport (nisn, mapel, nilai) VALUES ('$nisn', '$mapel', '$nilai')";
    if (mysqli_query($koneksi, $query)) {
        echo "Nilai berhasil disimpan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
