<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login atau halaman lain yang sesuai
    header("Location: index.html");
    exit();
}

// Ambil data nama dan NISN dari sesi
$nama = $_SESSION['nama'];
$nisn = $_SESSION['nisn'];

// Koneksi ke database
$servername = "localhost"; // Ganti dengan hostname server database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "simds"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query SQL untuk mengambil data siswa dan nilai berdasarkan NISN
$sql = "SELECT s.nama, s.nisn, s.nik, s.alamat, s.ttl, n.mapel, n.nilai 
        FROM siswa s
        LEFT JOIN nilai_raport n ON s.nisn = n.nisn
        WHERE s.nama='$nama' AND s.nisn='$nisn'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Jika data ditemukan, ambil data siswa
    $row = $result->fetch_assoc();
    $nama_siswa = $row['nama'];
    $nisn_siswa = $row['nisn'];
    $nik_siswa = $row['nik'];
    $alamat_siswa = $row['alamat'];
    $ttl_siswa = $row['ttl'];

    // Ambil data nilai raport
    $nilai_raport = [];
    do {
        if (!is_null($row['mapel'])) {
            $nilai_raport[] = [
                'mapel' => $row['mapel'],
                'nilai' => $row['nilai']
            ];
        }
    } while ($row = $result->fetch_assoc());

} else {
    // Jika data tidak ditemukan, sesuaikan dengan logika Anda
    $nama_siswa = "Nama tidak ditemukan";
    $nisn_siswa = "NISN tidak ditemukan";
    $nik_siswa = "NIK tidak ditemukan";
    $alamat_siswa = "Alamat tidak ditemukan";
    $ttl_siswa = "TTL tidak ditemukan";
}


// Query SQL untuk mengambil data nilai berdasarkan NISN
$sql_nilai = "SELECT * FROM nilai_raport WHERE nisn='$nisn'";
$result_nilai = $conn->query($sql_nilai);

$nilai_raport = [];
if ($result_nilai->num_rows > 0) {
    while($row_nilai = $result_nilai->fetch_assoc()) {
        $nilai_raport[] = $row_nilai;
    }
} else {
    // Jika data nilai tidak ditemukan
    $nilai_raport[] = ['mapel' => 'Data tidak ditemukan', 'nilai' => 'Data tidak ditemukan'];
}

// Hitung rata-rata nilai mata pelajaran
$rata_rata = 0;
$count = 0;
foreach ($nilai_raport as $nilai) {
    if (is_numeric($nilai['nilai'])) {
        $rata_rata += $nilai['nilai'];
        $count++;
    }
}
if ($count > 0) {
    $rata_rata /= $count;
}

// Format rata-rata menjadi dua desimal
$rata_rata_formatted = number_format($rata_rata, 2);

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Raport</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .raport-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: left;
        }
        .raport-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #000;;
        }
        .raport-content {
            margin-bottom: 20px;
        }
        .btn-print {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: auto;
            padding: 10px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-print:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="raport-container">
    <h2>Raport Capaian Kompetensi Akademik</h2>
    <div class="raport-content">
        <p><strong>Nama :</strong> <?php echo $nama_siswa; ?></p>
        <p><strong>NISN :</strong> <?php echo $nisn_siswa; ?></p>
        <p><strong>NIK :</strong> <?php echo $nik_siswa; ?></p>
        <p><strong>Alamat :</strong> <?php echo $alamat_siswa; ?></p>
        <p><strong>Tempat Tanggal Lahir :</strong> <?php echo $ttl_siswa; ?></p>
    </div>
    <table>
        <tr>
            <th>Mata Pelajaran</th>
            <th>Nilai</th>
        </tr>
        <?php foreach ($nilai_raport as $nilai) { ?>
            <tr>
                <td><?php echo $nilai['mapel']; ?></td>
                <td><?php echo $nilai['nilai']; ?></td>
            </tr>
        <?php } ?>
        <!-- Baris untuk rata-rata nilai -->
        <tr>
            <td><strong>Rata-rata Nilai</strong></td>
            <td><strong><?php echo $rata_rata_formatted; ?></strong></td>
        </tr>
    </table>
    <button class="btn-print" onclick="window.print()">Cetak Raport</button>
</div>

    <div class="footer">
        &copy; <?php echo date('Y'); ?> SMPN 1 Sumber Malang. All rights reserved.
    </div>
</body>
</html>
