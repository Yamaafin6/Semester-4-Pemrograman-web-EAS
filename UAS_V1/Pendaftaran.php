<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS (optional for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <style>
        body {
            background: linear-gradient(to bottom right, #4e73df, #1e90ff);
            color: #555;
            font-family: Arial, sans-serif;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            /* Membuat latar belakang container semi-transparan */
            padding: 30px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            background-color: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .persyaratan-section {
            background-color: #e9ecef;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
        }

        /* Centering submit button */
        .submit-btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mt-4 mb-4 text-center font-weight-bold">Form Pendaftaran Siswa</h2>

        <!-- Form Data Pribadi -->
        <div class="form-section">
            <h3>Data Pribadi</h3>
            <form id="registrationForm" action="submit_pendaftaran.php" method="POST">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="nisn">NISN:</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" required>
                </div>
                <div class="form-group">
                    <label for="nik">NIK:</label>
                    <input type="text" class="form-control" id="nik" name="nik" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="ttl">Tempat Tanggal Lahir:</label>
                    <input type="text" class="form-control" id="ttl" name="ttl" required>
                </div>
                <div class="form-group">
                    <label for="agama">Agama:</label>
                    <input type="text" class="form-control" id="agama" name="agama" required>
                </div>
                <div class="form-group">
                    <label for="riwayat_penyakit">Riwayat Penyakit:</label>
                    <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" rows="3"
                        required></textarea>
                </div>
        </div>

        <!-- Form Data Pendidikan -->
        <div class="form-section">
            <h3>Data Pendidikan</h3>
            <div class="form-group">
                <label for="asal_sekolah">Asal Sekolah:</label>
                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
            </div>
            <div class="form-group">
                <label for="alamat_sekolah">Alamat Sekolah:</label>
                <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="no_ijazah">Nomor Ijazah:</label>
                <input type="text" class="form-control" id="no_ijazah" name="no_ijazah" required>
            </div>
            <div class="form-group">
                <label for="nilai">Nilai:</label>
                <input type="text" class="form-control" id="nilai" name="nilai" required>
            </div>
        </div>

        <!-- Form Data Orang Tua/Wali -->
        <div class="form-section">
            <h3>Data Orang Tua/Wali</h3>
            <div class="form-group">
                <label for="nama_ayah">Nama Ayah/Wali:</label>
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
            </div>
            <div class="form-group">
                <label for="nama_ibu">Nama Ibu/Wali:</label>
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
            </div>
            <div class="form-group">
                <label for="alamat_ortu">Alamat:</label>
                <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="no_tlp_ayah">No. Telepon Ayah/Wali:</label>
                <input type="text" class="form-control" id="no_tlp_ayah" name="no_tlp_ayah" required>
            </div>
            <div class="form-group">
                <label for="no_tlp_ibu">No. Telepon Ibu/Wali:</label>
                <input type="text" class="form-control" id="no_tlp_ibu" name="no_tlp_ibu" required>
            </div>
            <div class="form-group">
                <label for="pekerjaan_ayah">Pekerjaan Ayah/Wali:</label>
                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" required>
            </div>
            <div class="form-group">
                <label for="pekerjaan_ibu">Pekerjaan Ibu/Wali:</label>
                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" required>
            </div>
            <div class="form-group">
                <label for="pendidikan_ayah">Pendidikan Terakhir Ayah/Wali:</label>
                <input type="text" class="form-control" id="pendidikan_ayah" name="pendidikan_ayah" required>
            </div>
            <div class="form-group">
                <label for="pendidikan_ibu">Pendidikan Terakhir Ibu/Wali:</label>
                <input type="text" class="form-control" id="pendidikan_ibu" name="pendidikan_ibu" required>
            </div>
        </div>

        <!-- Persyaratan -->
        <div class="persyaratan-section">
            <h3>Persyaratan</h3>
            <ul>
                <li>SKHU asli dan fotocopy yang telah dilegalisir = 1 Lembar</li>
                <li>Fotocopy Kartu Keluarga = 1 Lembar</li>
                <li>Fotocopy Akte Kelahiran = 1 Lembar</li>
                <li>Pasfoto ukuran 3x4 cm = 2 Lembar</li>
                <li>Map kertas Laki-laki (Biru) Perempuan (Kuning)</li>
            </ul>
        </div>

        <!-- Submit Button -->
        <div class="submit-btn-container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-primary btn-block" onclick="showConfirmation()">Submit</button>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-12 text-center">
                    <button class="btn btn-danger btn-block"
                        onclick="window.location.href='siswa_dashboard.php';">Batal</button>

                </div>
            </div>
        </div>
    </div>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showConfirmation() {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin ingin mengirimkan formulir pendaftaran?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('registrationForm').submit();
                }
            });
        }
    </script>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>