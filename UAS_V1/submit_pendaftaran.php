<?php
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

// Memproses form jika data dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
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

    // SQL untuk menyimpan data ke tabel siswa
    $sql = "INSERT INTO siswa (nama, nisn, nik, alamat, ttl, agama, riwayat_penyakit, asal_sekolah, alamat_sekolah, no_ijazah, nilai, nama_ayah, nama_ibu, alamat_ortu, no_tlp_ayah, no_tlp_ibu, pekerjaan_ayah, pekerjaan_ibu, pendidikan_ayah, pendidikan_ibu)
            VALUES ('$nama', '$nisn', '$nik', '$alamat', '$ttl', '$agama', '$riwayat_penyakit', '$asal_sekolah', '$alamat_sekolah', '$no_ijazah', '$nilai', '$nama_ayah', '$nama_ibu', '$alamat_ortu', '$no_tlp_ayah', '$no_tlp_ibu', '$pekerjaan_ayah', '$pekerjaan_ibu', '$pendidikan_ayah', '$pendidikan_ibu')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.";
        // Redirect ke halaman notifS.php setelah 2 detik
        header("refresh:0;url=notifS.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Simpan nama dan NISN ke dalam sesi
session_start();
$_SESSION['nama'] = $nama; // $nama berasal dari $_POST['nama']
$_SESSION['nisn'] = $nisn; // $nisn berasal dari $_POST['nisn']


    // Menutup koneksi
    $conn->close();
}
?>