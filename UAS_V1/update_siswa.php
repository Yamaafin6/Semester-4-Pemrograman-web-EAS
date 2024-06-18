<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #1e90ff;
            /* Warna biru */
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            /* Tambahkan margin atas */
            display: block;
            /* Agar tombol menjadi full-width */
            margin-left: auto;
            /* Pusatkan tombol */
            margin-right: auto;
            /* Pusatkan tombol */
        }

        input[type="submit"]:hover {
            background-color: #0e75cf;
            /* Warna biru yang lebih gelap saat dihover */
        }

        .back-button {
            background-color: #4CAF50;
            /* Warna hijau */
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            display: block;
            /* Agar tombol menjadi full-width */
            margin-left: auto;
            /* Pusatkan tombol */
            margin-right: auto;
            /* Pusatkan tombol */
            text-align: center;
            margin-top: 10px;
            /* Tambahkan margin atas */
        }

        .back-button:hover {
            background-color: #45a049;
            /* Warna hijau yang lebih gelap saat dihover */
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Update Data Siswa</h2>
        <?php
        // Ambil ID siswa dari URL
        if (isset($_GET['id'])) {
            $siswa_id = $_GET['id'];

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

            // Query untuk mengambil data siswa berdasarkan ID
            $sql = "SELECT * FROM siswa WHERE id = $siswa_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Tampilkan form untuk update data siswa
                echo "<form method='post' action='proses_update_siswa.php'>
                        <input type='hidden' name='siswa_id' value='{$row['id']}'>
                        <label>Nama:</label>
                        <input type='text' name='nama' value='{$row['nama']}' required><br>
                        <label>NISN:</label>
                        <input type='text' name='nisn' value='{$row['nisn']}' required><br>
                        <label>NIK:</label>
                        <input type='text' name='nik' value='{$row['nik']}' required><br>
                        <label>Alamat:</label>
                        <input type='text' name='alamat' value='{$row['alamat']}' required><br>
                        <label>TTL:</label>
                        <input type='text' name='ttl' value='{$row['ttl']}' required><br>
                        <label>Agama:</label>
                        <input type='text' name='agama' value='{$row['agama']}' required><br>
                        <label>Riwayat Penyakit:</label>
                        <input type='text' name='riwayat_penyakit' value='{$row['riwayat_penyakit']}'><br>
                        <label>Asal Sekolah:</label>
                        <input type='text' name='asal_sekolah' value='{$row['asal_sekolah']}' required><br>
                        <label>Alamat Sekolah:</label>
                        <input type='text' name='alamat_sekolah' value='{$row['alamat_sekolah']}'><br>
                        <label>Nomor Ijazah:</label>
                        <input type='text' name='no_ijazah' value='{$row['no_ijazah']}'><br>
                        <label>Nilai:</label>
                        <input type='text' name='nilai' value='{$row['nilai']}'><br>
                        <label>Nama Ayah:</label>
                        <input type='text' name='nama_ayah' value='{$row['nama_ayah']}'><br>
                        <label>Nama Ibu:</label>
                        <input type='text' name='nama_ibu' value='{$row['nama_ibu']}'><br>
                        <label>Alamat Orang Tua:</label>
                        <input type='text' name='alamat_ortu' value='{$row['alamat_ortu']}'><br>
                        <label>Nomor Telepon Ayah:</label>
                        <input type='text' name='no_tlp_ayah' value='{$row['no_tlp_ayah']}'><br>
                        <label>Nomor Telepon Ibu:</label>
                        <input type='text' name='no_tlp_ibu' value='{$row['no_tlp_ibu']}'><br>
                        <label>Pekerjaan Ayah:</label>
                        <input type='text' name='pekerjaan_ayah' value='{$row['pekerjaan_ayah']}'><br>
                        <label>Pekerjaan Ibu:</label>
                        <input type='text' name='pekerjaan_ibu' value='{$row['pekerjaan_ibu']}'><br>
                        <label>Pendidikan Ayah:</label>
                        <input type='text' name='pendidikan_ayah' value='{$row['pendidikan_ayah']}'><br>
                        <label>Pendidikan Ibu:</label>
                        <input type='text' name='pendidikan_ibu' value='{$row['pendidikan_ibu']}'><br>
                        <input type='submit' value='Update'>
                      </form>";
            } else {
                echo "Data siswa tidak ditemukan.";
            }

            // Menutup koneksi
            $conn->close();
        } else {
            echo "ID siswa tidak tersedia.";
        }
        ?>
        <br>
        <button class="back-button" onclick="window.location.href = 'dataS.php';">Kembali</button>
    </div>

</body>

</html>