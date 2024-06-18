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

// Periksa apakah guru_id ada dalam session
if (!isset($_SESSION['guru_id'])) {
    die("Guru ID tidak ditemukan dalam session.");
}

$guru_id = $_SESSION['guru_id'];

// Fungsi untuk menghapus data
if (isset($_GET['hapus_id'])) {
    $hapus_id = $_GET['hapus_id'];
    $query = "DELETE FROM jadwal_mengajar WHERE id = $hapus_id";
    mysqli_query($koneksi, $query);
    header("Location: ubah_jadwal.php");
    exit();
}

// Fungsi untuk menambah data
if (isset($_POST['tambah'])) {
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];
    $mapel = $_POST['mapel'];
    $kelas = $_POST['kelas'];

    $query = "INSERT INTO jadwal_mengajar (hari, jam, mapel, kelas, guru_id) VALUES ('$hari', '$jam', '$mapel', '$kelas', '$guru_id')";
    mysqli_query($koneksi, $query);
    header("Location: ubah_jadwal.php");
    exit();
}

// Mengambil data jadwal
$days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
$schedules = [];

foreach ($days as $day) {
    $query = "SELECT * FROM jadwal_mengajar WHERE hari = '$day' AND guru_id='$guru_id'";
    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $schedules[$day][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Jadwal Mengajar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Ubah Jadwal Mengajar</h2>

        <?php foreach ($days as $day): ?>
            <h3><?php echo $day; ?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jam</th>
                        <th>Mapel</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($schedules[$day])): ?>
                        <?php foreach ($schedules[$day] as $schedule): ?>
                            <tr>
                                <td><?php echo $schedule['jam']; ?></td>
                                <td><?php echo $schedule['mapel']; ?></td>
                                <td><?php echo $schedule['kelas']; ?></td>
                                <td>
                                    <a href="ubah_jadwal.php?hapus_id=<?php echo $schedule['id']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada jadwal untuk hari ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endforeach; ?>

        <h3>Tambah Jadwal Baru</h3>
        <form method="post" action="ubah_jadwal.php">
            <div class="form-group">
                <label for="hari">Hari:</label>
                <select name="hari" id="hari" class="form-control">
                    <?php foreach ($days as $day): ?>
                        <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jam">Jam:</label>
                <input type="text" name="jam" id="jam" class="form-control">
            </div>
            <div class="form-group">
                <label for="mapel">Mapel:</label>
                <input type="text" name="mapel" id="mapel" class="form-control">
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" name="kelas" id="kelas" class="form-control">
            </div>
            <button type="submit" name="tambah" class="btn btn-primary"
                onclick="return confirm('Apakah Anda yakin ingin menambah jadwal ini?');">Tambah Jadwal</button>
        </form>
        <button onclick="window.location.href='guru_dashboard.php'" class="btn btn-danger mt-3">Kembali ke
            Dashboard</button>
    </div>
</body>

</html>