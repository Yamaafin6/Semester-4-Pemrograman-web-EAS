<!DOCTYPE html>
<html>

<head>
    <title>Data Pendaftaran Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #3498db;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        .title-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        .table-container {
            width: 100%;
            max-width: 1200px;
            overflow-x: auto;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 12px;
            text-align: center;
            color: #000;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-column {
            width: 120px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .delete-button,
        .update-button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-button {
            background-color: #e74c3c;
            color: white;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        .update-button {
            background-color: #3498db;
            color: white;
        }

        .update-button:hover {
            background-color: #2980b9;
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        h2 {
            color: #000;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Modal Style */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .modal-buttons {
            display: flex;
            justify-content: space-between;
        }

        .modal-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cancel-button {
            background-color: #95a5a6;
            color: white;
        }

        .cancel-button:hover {
            background-color: #7f8c8d;
        }

        .confirm-button {
            background-color: #e74c3c;
            color: white;
        }

        .confirm-button:hover {
            background-color: #c0392b;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteData(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#95a5a6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "delete_siswa.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            Swal.fire(
                                'Terhapus!',
                                'Data siswa telah dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    };
                    xhr.send("id=" + id);
                }
            });
        }

        function updateData(id) {
            // Redirect to update page with the ID
            window.location.href = 'update_siswa.php?id=' + id;
        }
    </script>
</head>

<body>

    <div class="title-container">
        <h2>Data Pendaftaran Siswa</h2>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>NIK</th>
                <th>Alamat</th>
                <th>TTL</th>
                <th>Agama</th>
                <th>Riwayat Penyakit</th>
                <th>Asal Sekolah</th>
                <th>Alamat Sekolah</th>
                <th>Nomor Ijazah</th>
                <th>Nilai</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Alamat Orang Tua</th>
                <th>Nomor Telepon Ayah</th>
                <th>Nomor Telepon Ibu</th>
                <th>Pekerjaan Ayah</th>
                <th>Pekerjaan Ibu</th>
                <th>Pendidikan Ayah</th>
                <th>Pendidikan Ibu</th>
                <th>Aksi</th>
            </tr>
            <?php
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

            // SQL untuk mengambil data siswa dari tabel siswa
            $sql = "SELECT * FROM siswa";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Variabel untuk menyimpan nomor urut
                $nomor_urut = 1;

                // Output data setiap baris
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$nomor_urut}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['nisn']}</td>
                        <td>{$row['nik']}</td>
                        <td>{$row['alamat']}</td>
                        <td>{$row['ttl']}</td>
                        <td>{$row['agama']}</td>
                        <td>{$row['riwayat_penyakit']}</td>
                        <td>{$row['asal_sekolah']}</td>
                        <td>{$row['alamat_sekolah']}</td>
                        <td>{$row['no_ijazah']}</td>
                        <td>{$row['nilai']}</td>
                        <td>{$row['nama_ayah']}</td>
                        <td>{$row['nama_ibu']}</td>
                        <td>{$row['alamat_ortu']}</td>
                        <td>{$row['no_tlp_ayah']}</td>
                        <td>{$row['no_tlp_ibu']}</td>
                        <td>{$row['pekerjaan_ayah']}</td>
                        <td>{$row['pekerjaan_ibu']}</td>
                        <td>{$row['pendidikan_ayah']}</td>
                        <td>{$row['pendidikan_ibu']}</td>
                        <td class='action-column'>
                            <div class='action-buttons'>
                                <button class='delete-button' onclick='deleteData({$row['id']})'>Delete</button>
                                <button class='update-button' onclick='updateData({$row['id']})'>Update</button>
                            </div>
                        </td>
                    </tr>";

                    // Increment nomor urut
                    $nomor_urut++;
                }
            } else {
                echo "<tr><td colspan='22'>0 hasil</td></tr>";
            }
            // Menutup koneksi
            $conn->close();
            ?>
        </table>
    </div>

    <button class="back-button" onclick="window.location.href = 'guru_dashboard.php';">Kembali</button>

</body>

</html>