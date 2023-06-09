<?php
include('../koneksi.php');
$country = mysqli_query($koneksi, "select * from datacovid");
while ($row = mysqli_fetch_array($country)) {
    $nama_country[] = $row['country'];
    $total_case[] = $row['total_case'];

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Membuat Grafik Menggunakan Chart JS</title>
    <script type="text/javascript" src="../Chart.js"></script>
</head>

<body>
    <div style="width: 800px;height: 800px">
        <canvas id="myChart"></canvas>
    </div>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nama_country); ?>,
                datasets: [{
                    label: 'Grafik Penjualan',
                    data: <?php echo json_encode($total_case);

                    ?>,

                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>