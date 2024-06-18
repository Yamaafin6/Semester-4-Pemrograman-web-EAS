<!-- siswa_dashboard.php -->

<?php
session_start();

if ($_SESSION['role'] != 'siswa') {
    header("Location: index.html");
    exit();
}

// Dummy data for demonstration. Replace this with actual database query.
$siswa = [
    'name' => 'Student',
    'photo' => 'https://cdn-icons-png.flaticon.com/256/201/201818.png' // Using the new image URL
];

// Dummy data for the list of top students. Replace this with actual database query.
$top_students = [
    ['name' => 'Egy Firmansyah', 'class' => '7A', 'achievement' => 'Juara 1 Sepak Takraw'],
    ['name' => 'Ahmad Maulana', 'class' => '8B', 'achievement' => 'Juara 2 Catur'],
    ['name' => 'Baihaqi', 'class' => '9A', 'achievement' => 'Juara 3 Lomba Matematika'],
    ['name' => 'Ikbal Maulana', 'class' => '8B', 'achievement' => 'Juara 1 Lomba Bahasa Inggris'],
    ['name' => 'Sinta Ayu', 'class' => '8A', 'achievement' => 'Juara 1 Lomba Sains']
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Font Awesome CSS -->
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
            /* Menyusun isi sidebar */
        }

        .sidebar-content {
            flex-grow: 1;
            /* Agar konten di sidebar mengisi sisa ruang */
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Pusatkan konten vertikal */
        }

        .sidebar-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Pusatkan tombol vertikal */
            margin-top: 10px;
            /* Mengurangi margin top agar tombol lebih dekat dengan profil */
            margin-bottom: 20px;
            /* Mengurangi margin bottom agar tombol lebih dekat dengan border */
        }

        .sidebar-buttons button {
            width: 100%;
            /* Lebar 100% dari parent */
            margin-bottom: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ffffff;
            /* Warna latar belakang */
            color: #4e73df;
            /* Warna teks */
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            /* Efek bayangan */
        }

        .sidebar-buttons button:hover {
            background-color: #008cba;
            /* Warna latar belakang saat hover */
            color: #ffffff;
            /* Warna teks saat hover */
        }

        .content {
            padding: 20px;
        }

        .scrollable-content {
            max-height: calc(100vh - 40px);
            /* Adjust height as needed */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }

        .box {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 15px;
            /* Border radius lebih besar */
        }

        .box1 {
            background: linear-gradient(to bottom right, #4e73df, #008cba);
            color: #ffffff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 15px;
            /* Tambahkan border radius untuk box1 */
            display: flex;
            align-items: center;
            /* Pusatkan konten secara horizontal */
            justify-content: space-between;
            /* Jarakkan logo dan teks ke kanan dan kiri */
        }

        .box1 h3 {
            margin-bottom: 0;
            /* Hapus margin bawah agar tidak ada jarak tambahan */
        }

        .box1 img {
            height: 50px;
            /* Sesuaikan tinggi logo */
            margin-left: 10px;
            /* Berikan sedikit margin kiri dari teks */
            border-radius: 10px;
        }

        .carousel-container {
            margin-bottom: 20px;
            /* Memberikan jarak antara box1 dan carousel */
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

        .top-students-table {
            width: 100%;
            margin-top: 20px;
        }

        .top-students-table th,
        .top-students-table td {
            padding: 10px;
            text-align: left;
        }

        .top-students-table th {
            background-color: #f8f9fa;
        }

        .top-students-table td {
            background-color: #ffffff;
        }

        .top-students-table .class-column,
        .top-students-table .achievement-column {
            padding-left: 40px;
        }

        .top-students-table .name-column img {
            width:
                20px;
            height: 20px;
            margin-right: 10px;
        }

        .box2 {
            background-color: #f2f2f2;
            /* Warna abu-abu untuk box2 */
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
            /* Efek bayangan saat tombol ditekan */
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar text-center">
                <div class="sidebar-content">
                    <img src="<?php echo $siswa['photo']; ?>" alt="Profile Photo" class="profile-photo mb-3">
                    <h2><?php echo $siswa['name']; ?></h2>
                </div>
                <div class="sidebar-buttons">
                    <button onclick="window.location.href='Pendaftaran.php'">Pendaftaran</button>
                    <button onclick="window.location.href='jadwal_belajar.php'">Jadwal Pelajaran</button>
                    <button onclick="window.location.href='cetak.php'">Cetak Rapot</button>
                    <button style="background-color: #ff0000; color: #ffffff; margin-top: 20px;"
                        onclick="window.location.href='index.html'">Logout</button>
                </div>
            </div>

            <!-- Konten Utama -->
            <div class="col-md-9 content">
                <div class="scrollable-content">
                    <!-- Box 1 - Informasi Sekolah -->
                    <div class="box1">
                        <h3>SMPN 1 SUMBER MALANG <i class="fas fa-bell"></i></h3>
                        <img src="https://smpn1sumbermalang.sch.id/assets/files/logo/logo-ztqvp2ht.jpg"
                            alt="School Logo">
                    </div>

                    <!-- Carousel - Gambar -->
                    <div class="carousel-container">
                        <div class="carousel">
                            <img src="https://disdik.tanjabtimkab.go.id/media/foto_pintarberbagi/2021/07/14/77sejumlah-siswa-baru-yang-didampingi-orangtuanya-mengikuti-masa-pengenalan_200709185744-376.jpg"
                                alt="Image 1">
                            <img src="https://disdik.tanjabtimkab.go.id/media/foto_pintarberbagi/2022/05/12/41foto-literasi-visual.jpg"
                                alt="Image 2">
                            <img src="https://rakyatjabarnews.com/wp-content/uploads/2017/08/ilustrasi.jpg"
                                alt="Image 3">
                            <img src="https://asset-2.tstatic.net/jatim/foto/bank/images/suasana-kegiatan-pembelajaran-tatap-muka-di-smpn-1-kota-blitar-beberapa-waktu-lalu.jpg"
                                alt="Image 4">
                            <img src="https://awsimages.detik.net.id/community/media/visual/2021/08/30/sekolah-tatap-muka-di-kudus-7.jpeg?w=600&q=90"
                                alt="Image 5">
                            <img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/150/2024/01/03/f-belajar-2-2659841805.jpeg"
                                alt="Image 6">
                        </div>
                    </div>


                    <!-- Box 2 - Siswa Berprestasi -->
                    <div class="box2">
                        <h3>Siswa Berprestasi</h3>
                        <table class="top-students-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th class="class-column">Kelas</th>
                                    <th class="achievement-column">Prestasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($top_students as $student): ?>
                                    <tr>
                                        <td class="name-column">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLp6fdyilZPP0ilyDi9c0qcNmfc2pxWEJRET82m-_i7UpkdZDT8GgRJoUPYCfygvElKaY&usqp=CAU"
                                                alt="Icon">
                                            <?php echo $student['name']; ?>
                                        </td>
                                        <td class="class-column"><?php echo $student['class']; ?></td>
                                        <td class="achievement-column"><?php echo $student['achievement']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>