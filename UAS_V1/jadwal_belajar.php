<?php
session_start();
if ($_SESSION['role'] != 'siswa') {
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

// Mengambil data jadwal mengajar
$days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
$schedules = [];

foreach ($days as $day) {
    $query = "SELECT * FROM jadwal_mengajar WHERE hari = '$day'";
    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $schedules[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Belajar Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }
        .table th, .table td {
            text-align: center;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #bd2130;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Jadwal Pelajaran Siswa</h2>
        <?php if (!empty($schedules)): ?>
            <table class="table table-bordered table-hover mt-3">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mapel</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedules as $schedule): ?>
                        <tr>
                            <td><?php echo $schedule['hari']; ?></td>
                            <td><?php echo $schedule['jam']; ?></td>
                            <td><?php echo $schedule['mapel']; ?></td>
                            <td><?php echo $schedule['kelas']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Tidak ada jadwal pelajaran untuk hari ini.
            </div>
        <?php endif; ?>
        <button onclick="window.location.href='siswa_dashboard.php'" class="btn btn-danger mt-3">Kembali ke Dashboard</button>
    </div>
</body>

</html>
