<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Category Distribution</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>

<body>
    {{-- @dd($news) --}}
    <h1>Distribusi Kategori Berita Bulan {{ $bulan }}</h1>
    <canvas id="barChart" width="800" height="400"></canvas>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.js"></script> --}}
    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var chartData = JSON.parse('<?= json_encode($chartData) ?>');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true, // Maintain responsiveness
                scales: {
                    y: {
                        beginAtZero: true // Start y-axis at zero
                    }
                },
                plugins: {
                    datalabels: { // Configure data labels
                        anchor: 'start', // Position at bar end
                        align: 'start', // Align to the right
                        color: 'blue', // Label color
                        font: {
                            weight: 'bold',
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
