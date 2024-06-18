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

$selected_day = $_POST['selected_day'] ?? 'Senin';

$query = "SELECT * FROM jadwal_mengajar WHERE hari = '$selected_day'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$teaching_schedule = [];

while ($row = mysqli_fetch_assoc($result)) {
    $teaching_schedule[] = [
        'Jam' => $row['jam'],
        'Mapel' => $row['mapel'],
        'Kelas' => $row['kelas']
    ];
}

// Dummy data for demonstration. Replace with actual data fetch.
$guru = [
    'name' => 'Teacher',
    'photo' => 'img/teacher.png'
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .sidebar {
            height: 100vh;
            background: linear-gradient(to bottom right, #4e73df, #008cba);
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .sidebar-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .sidebar-buttons button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ffffff;
            color: #4e73df;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar-buttons button:hover {
            background-color: #008cba;
            color: #ffffff;
        }

        .content {
            padding: 20px;
        }

        .scrollable-content {
            max-height: calc(100vh - 40px);
            overflow-y: auto;
        }

        .box {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 15px;
        }

        .box1 {
            background: linear-gradient(to bottom right, #4e73df, #008cba);
            color: #ffffff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .box1 h3 {
            margin-bottom: 0;
        }

        .box1 img {
            height: 50px;
            margin-left: 10px;
            border-radius: 10px;
        }

        .carousel-container {
            margin-bottom: 20px;
            width: 100%;
            overflow: hidden;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .carousel {
            display: flex;
            transition: transform 1s ease;
        }

        .carousel img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin: 0 10px;
        }

        .schedule-table {
            width: 100%;
            margin-top: 20px;
        }

        .schedule-table th,
        .schedule-table td {
            padding: 10px;
            text-align: left;
        }

        .schedule-table th {
            background-color: #f8f9fa;
        }

        .schedule-table td {
            background-color: #ffffff;
        }

        .schedule-table .time-column,
        .schedule-table .subject-column,
        .schedule-table .class-column {
            padding-left: 40px;
        }

        .box2 {
            background-color: #f2f2f2;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            color: #000000;
            margin-bottom: 20px;
        }

        .box2 h3 {
            margin-bottom: 20px;
        }

        .sidebar-buttons button:focus {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar text-center">
                <div class="sidebar-content">
                    <img src="<?php echo $guru['photo']; ?>" alt="Profile Photo" class="profile-photo mb-3">
                    <h2><?php echo $guru['name']; ?></h2>
                </div>

                <div class="sidebar-buttons">
                    <button onclick="window.location.href='ubah_jadwal.php'">Ubah Jadwal Mengajar</button>
                    <button onclick="window.location.href='dataS.php'">Data Pendaftaran Siswa</button>
                    <button onclick="showStudentList()">Input Nilai Raport</button>
                    <button onclick="window.location.href='grafik.php'">Data Grafik Siswa</button>
                    <button style="background-color: #ff0000; color: #ffffff; margin-top: 20px;"
                        onclick="window.location.href='index.html'">Logout</button>
                </div>
            </div>

            <div class="col-md-9 content">
                <div class="scrollable-content">
                    <div class="box1">
                        <h3>Hello, Teacher <i class="fas fa-bell"></i></h3>
                        <img src="https://smpn1sumbermalang.sch.id/assets/files/logo/logo-ztqvp2ht.jpg"
                            alt="School Logo">
                    </div>

                    <div class="carousel-container">
                        <div class="carousel">
                            <img src="https://goodstats.id/img/articles/original/2022/08/24/mengulik-statistik-guru-dan-tenaga-kependidikan-di-indonesia-f3cKWkAQ8q.jpg?p=articles-lg"
                                alt="Image 1">
                            <img src="https://statik.tempo.co/data/2019/08/31/id_868432/868432_720.jpg" alt="Image 2">
                            <img src="https://asset-2.tstatic.net/tribunnews/foto/bank/images/Guru_Ngajar.jpg"
                                alt="Image 3">
                            <img src="https://images.bisnis.com/posts/2014/11/26/275628/guruok.jpg" alt="Image 4">
                            <img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/132/2023/08/28/images-65_resize_91-1335636484.jpg"
                                alt="Image 5">
                            <img src="https://cdn.medcom.id/dynamic/content/2022/11/24/1506075/ZXRfcINazi.jpg?w=1024"
                                alt="Image 6">
                        </div>
                    </div>

                    <div class="box2">
                        <h3>Jadwal Mengajar</h3>
                        <form method="post">
                            <div class="form-group">
                                <label for="selected_day">Pilih Hari:</label>
                                <select name="selected_day" id="selected_day" class="form-control">
                                    <?php
                                    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                                    foreach ($days as $day) {
                                        echo "<option value='$day'" . ($selected_day == $day ? ' selected' : '') . ">$day</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Lihat Jadwal</button>
                        </form>

                        <?php if (!empty($teaching_schedule)): ?>
                            <table class="schedule-table table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Jam</th>
                                        <th>Mapel</th>
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($teaching_schedule as $schedule): ?>
                                        <tr>
                                            <td class="jam-column"><?php echo $schedule['Jam']; ?></td>
                                            <td class="mapel-column"><?php echo $schedule['Mapel']; ?></td>
                                            <td class="kelas-column"><?php echo $schedule['Kelas']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Tidak ada jadwal mengajar untuk hari ini.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="student-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeStudentModal()">&times;</span>
            <h2>Daftar Siswa</h2>
            <div id="student-list">
                <!-- Student list will be populated here by JavaScript -->
            </div>
        </div>
    </div>
    <script>
        function showStudentList() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var students = JSON.parse(this.responseText);
                    displayStudentModal(students);
                }
            };
            xhr.open("GET", "get_students.php", true);
            xhr.send();
        }

        function displayStudentModal(students) {
            students.sort((a, b) => a.nama.localeCompare(b.nama));

            var studentListHtml = `
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NISN</th>
                    </tr>
                </thead>
                <tbody>
                    ${students.map(student => `
                        <tr>
                            <td><a href="#" onclick="showGradeInput('${student.nama}', '${student.nisn}')">${student.nama}</a></td>
                            <td>${student.nisn}</td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        `;

            document.getElementById('student-list').innerHTML = studentListHtml;

            var modal = document.getElementById('student-modal');
            modal.style.display = "block";
        }

        function showGradeInput(nama, nisn) {
            var modal = document.getElementById('student-modal');
            modal.innerHTML = `
            <div class="modal-content">
                <span class="close" onclick="closeStudentModal()">&times;</span>
                <h2>Input Nilai: ${nama}</h2>
                <form id="nilaiForm" onsubmit="submitGrade(event, '${nama}', '${nisn}')">
                    <div class="form-group">
                        <label for="mapel">Mata Pelajaran:</label>
                        <select class="form-control" id="mapel" name="mapel" required>
                            <option value="Pendidikan Agama">Pendidikan Agama</option>
                            <option value="Pendidikan Pancasila dan Kewarganegaraan">Pendidikan Pancasila dan Kewarganegaraan</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Ilmu Pengetahuan Alam">Ilmu Pengetahuan Alam</option>
                            <option value="Ilmu Pengetahuan Sosial">Ilmu Pengetahuan Sosial</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                        </select>                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai:</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" required>
                            <input type="hidden" name="nisn" value="${nisn}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            `;
        }

        function submitGrade(event, nama, nisn) {
            event.preventDefault();
            var mapel = document.getElementById('mapel').value;
            var nilai = document.getElementById('nilai').value;

            var formData = new FormData();
            formData.append('nisn', nisn);
            formData.append('mapel', mapel);
            formData.append('nilai', nilai);

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Jika berhasil disimpan, tampilkan pesan sukses
                    showGradeInputSuccess(nama);
                }
            };
            xhr.open("POST", "input_nilai_siswa.php", true);
            xhr.send(formData);
        }

        function showGradeInputSuccess(nama) {
            var modal = document.getElementById('student-modal');
            modal.innerHTML = `
                <div class="modal-content">
                    <span class="close" onclick="closeStudentModal()">&times;</span>
                    <h2>Input Nilai Sukses</h2>
                    <p>Nilai untuk ${nama} berhasil disimpan.</p>
                </div>
            `;
        }

        function closeStudentModal() {
            var modal = document.getElementById('student-modal');
            modal.style.display = "none";
        }
    </script>
</body>

</html>