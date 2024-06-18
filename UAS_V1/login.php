<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simds";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $username = stripslashes($username);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($password);
    $password = mysqli_real_escape_string($conn, $password);

    if ($action == 'login') {
        $sql = "SELECT * FROM users WHERE username='$username' AND role='$role'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                if ($role == 'guru') {
                    // Ambil guru_id dari tabel guru
                    $user_id = $row['id'];
                    $guru_sql = "SELECT id FROM guru WHERE user_id='$user_id'";
                    $guru_result = mysqli_query($conn, $guru_sql);
                    if (mysqli_num_rows($guru_result) == 1) {
                        $guru_row = mysqli_fetch_assoc($guru_result);
                        $_SESSION['guru_id'] = $guru_row['id'];
                    }
                }

                if ($role == 'siswa') {
                    header("Location: siswa_dashboard.php");
                } elseif ($role == 'guru') {
                    header("Location: guru_dashboard.php");
                } elseif ($role == 'admin') {
                    header("Location: admin_dashboard.php");
                }
                exit();
            } else {
                echo "Password salah!";
            }
        } else {
            echo "Username atau role tidak ditemukan!";
        }
    } elseif ($action == 'register') {
        // Periksa ketersediaan username
        $check_username = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $check_username);

        if (mysqli_num_rows($result) > 0) {
            echo "Username sudah digunakan!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                if ($role == 'guru') {
                    // Ambil user_id yang baru saja dimasukkan
                    $user_id = mysqli_insert_id($conn);
                    $guru_sql = "INSERT INTO guru (user_id) VALUES ('$user_id')";
                    mysqli_query($conn, $guru_sql);
                    $guru_id = mysqli_insert_id($conn);
                    $_SESSION['guru_id'] = $guru_id;
                }

                if ($role == 'siswa') {
                    header("Location: siswa_dashboard.php");
                } elseif ($role == 'guru') {
                    header("Location: guru_dashboard.php");
                } elseif ($role == 'admin') {
                    header("Location: admin_dashboard.php");
                }
                exit();
            } else {
                echo "Gagal mendaftarkan akun!";
            }
        }
    }
}
?>