<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include html2pdf library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <!-- Include xlsx library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .chart-container {
            width: 80%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h2 {
            color: #4e73df;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .chart-container {
                width: 100%;
            }
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .button-group .btn {
            width: 150px;
            /* Sesuaikan lebar tombol sesuai kebutuhan */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Data Grafik Siswa (2019 - 2024)</h2>
        <div class="chart-container">
            <canvas id="studentChart"></canvas>
        </div>
        <div class="button-group">
            <button class="btn btn-primary back-button"
                onclick="window.location.href='guru_dashboard.php'">Kembali</button>
            <button class="btn btn-success print-button" id="printButton">Cetak ke PDF</button>
            <button class="btn btn-success print-excel-button">Cetak ke Excel</button>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('studentChart').getContext('2d');
        const studentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['2019', '2020', '2021', '2022', '2023', '2024'],
                datasets: [{
                    label: 'Persentase Siswa',
                    data: [40, 60, 65, 70, 70, 90],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function (value) {
                                return value + "%";
                            }
                        },
                        title: {
                            display: true,
                            text: 'Persentase (%)',
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tahun',
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Persentase Siswa per Tahun',
                        color: '#4e73df',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
                    }
                }
            }
        });

        // Function to handle printing to PDF
        document.getElementById('printButton').addEventListener('click', function () {
            const chartContainer = document.querySelector('.chart-container');
            const options = {
                margin: 1,
                filename: 'grafik_siswa.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
            };
            html2pdf().from(chartContainer).set(options).save();
        });

        // Function to handle printing to Excel
        document.querySelector('.print-excel-button').addEventListener('click', function () {
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.json_to_sheet([
                { Tahun: '2019', 'Persentase Siswa (%)': 40 },
                { Tahun: '2020', 'Persentase Siswa (%)': 60 },
                { Tahun: '2021', 'Persentase Siswa (%)': 65 },
                { Tahun: '2022', 'Persentase Siswa (%)': 70 },
                { Tahun: '2023', 'Persentase Siswa (%)': 70 },
                { Tahun: '2024', 'Persentase Siswa (%)': 90 }
            ]);
            XLSX.utils.book_append_sheet(wb, ws, 'Grafik Siswa');
            XLSX.writeFile(wb, 'grafik_siswa.xlsx');
        });
    </script>
</body>

</html>