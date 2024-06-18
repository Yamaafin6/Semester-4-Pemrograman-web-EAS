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
        <h2 class="mt-4 mb-4 text-center font-weight-bold">Data Berhasil Disimpan</h2>
        <p>Data yang Anda masukkan telah berhasil disimpan.</p>
        <a href="siswa_dashboard.php" class="btn btn-primary">Kembali</a>
    </div>
</body>

</html>