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

$query = "SELECT * FROM siswa ORDER BY nama ASC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$students = [];
while ($row = mysqli_fetch_assoc($result)) {
    $students[] = [
        'nama' => $row['nama'],
        'nisn' => $row['nisn']
    ];
}

header('Content-Type: application/json');
echo json_encode($students);
?>
