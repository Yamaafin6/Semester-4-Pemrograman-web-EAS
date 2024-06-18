<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $siswa_id = $_POST['siswa_id'];
    $nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $ttl = $_POST['ttl'];
    $agama = $_POST['agama'];
    $riwayat_penyakit = $_POST['riwayat_penyakit'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $alamat_sekolah = $_POST['alamat_sekolah'];
    $no_ijazah = $_POST['no_ijazah'];
    $nilai = $_POST['nilai'];
    $nama_ayah = $_POST['nama_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $alamat_ortu = $_POST['alamat_ortu'];
    $no_tlp_ayah = $_POST['no_tlp_ayah'];
    $no_tlp_ibu = $_POST['no_tlp_ibu'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $pendidikan_ayah = $_POST['pendidikan_ayah'];
    $pendidikan_ibu = $_POST['pendidikan_ibu'];

    // Lakukan koneksi ke database
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

    // Query SQL untuk update data siswa berdasarkan ID
    $sql = "UPDATE siswa SET 
            nama = '$nama',
            nisn = '$nisn',
            nik = '$nik',
            alamat = '$alamat',
            ttl = '$ttl',
            agama = '$agama',
            riwayat_penyakit = '$riwayat_penyakit',
            asal_sekolah = '$asal_sekolah',
            alamat_sekolah = '$alamat_sekolah',
            no_ijazah = '$no_ijazah',
            nilai = '$nilai',
            nama_ayah = '$nama_ayah',
            nama_ibu = '$nama_ibu',
            alamat_ortu = '$alamat_ortu',
            no_tlp_ayah = '$no_tlp_ayah',
            no_tlp_ibu = '$no_tlp_ibu',
            pekerjaan_ayah = '$pekerjaan_ayah',
            pekerjaan_ibu = '$pekerjaan_ibu',
            pendidikan_ayah = '$pendidikan_ayah',
            pendidikan_ibu = '$pendidikan_ibu'
            WHERE id = $siswa_id";

    if ($conn->query($sql) === TRUE) {
        // Jika query berhasil, tampilkan notifikasi
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Notifikasi Simpan Data</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <style>
                body {
                    color: #555;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    overflow: hidden;
                    /* Background animasi gambar */
                    background: url('https://www.transparenttextures.com/patterns/broken-noise.png'),
                        linear-gradient(to bottom right, #4e73df, #1e90ff);
                    background-size: auto, cover;
                    animation: animateBackground 20s linear infinite;
                }

                .container {
                    background: rgba(255, 255, 255, 0.95);
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
                    text-align: center;
                    max-width: 400px;
                    width: 100%;
                    animation: showNotification 0.5s ease;
                }

                @keyframes showNotification {
                    0% {
                        opacity: 0;
                        transform: translateY(-50px);
                    }

                    100% {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                @keyframes animateBackground {
                    from {
                        background-position: 0 0;
                    }

                    to {
                        background-position: 100% 0;
                    }
                }

                .container i {
                    font-size: 4rem;
                    color: #1e90ff;
                    margin-bottom: 20px;
                    display: block;
                }

                .container h2 {
                    font-size: 2rem;
                    margin-bottom: 10px;
                }

                .container p {
                    font-size: 1.2rem;
                    margin-bottom: 20px;
                }

                .btn {
                    margin-top: 20px;
                    font-size: 1.2rem;
                    border-radius: 25px;
                    padding: 10px 20px;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    /* Teks "Kembali" berada di tengah */
                }

                .btn:hover {
                    transform: scale(1.05);
                }
            </style>
        </head>

        <body>
            <div class="container">
                <i class="fas fa-check-circle"></i>
                <h2 class="mt-4 mb-4 text-center font-weight-bold">Data Berhasil Diperbarui</h2>
                <p>Data siswa berhasil diperbarui.</p>
                <a href="dataS.php" class="btn btn-primary">Kembali</a>
            </div>
        </body>

        </html>
        <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
} else {
    echo "Akses tidak sah!";
}
?>