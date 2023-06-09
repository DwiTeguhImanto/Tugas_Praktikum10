<?php
include('../koneksi.php');
$country = mysqli_query($koneksi, "select * from datacovid");
while ($row = mysqli_fetch_array($country)) {
    $nama_country[] = $row['country'];
    $total_case[] = $row['total_case'];

}
?>
<!doctype html>
<html>

<head>
    <title>Pie Chart</title>
    <script type="text/javascript" src="../Chart.js"></script>
</head>

<body>
    <div id="canvas-holder" style="width:45%">
        <canvas id="chart-area"></canvas>
    </div>
    <script>
        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: <?php echo json_encode($total_case);

                    ?>,

                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(210, 38, 30, 0.3)',
                        'rgba(95, 150, 198, 0.2)',
                        'rgba(240, 15, 255, 1.0)',
                        'rgba(0, 15, 255, 0.5)',
                        'rgba(229, 82, 42, 0.75)',
                        'rgba(127, 255, 0, 0.75)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(6, 224, 251, 0.9)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(210, 38, 30, 0.4)',
                        'rgba(95, 150, 198, 1)',
                        'rgba(240, 15, 255, 1)',
                        'rgba(0, 15, 255, 1)',
                        'rgba(229, 82, 42, 1)',
                        'rgba(127, 255, 0, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(6, 224, 251, 1)'
                    ],
                    label: 'Presentase Penjualan Barang'
                }],
                labels: <?php echo json_encode($nama_country); ?>
            },
            options: {
                responsive: true
            }
        };
        window.onload = function () {

            var ctx = document.getElementById('chart-area').getContext('2d');

            window.myPie = new Chart(ctx, config);
        };
        document.getElementById('randomizeData').addEventListener('click',
            function () {

                config.data.datasets.forEach(function (dataset) {
                    dataset.data = dataset.data.map(function () {
                        return randomScalingFactor();
                    });
                });
                window.myPie.update();
            });
        var colorNames = Object.keys(window.chartColors);
        document.getElementById('addDataset').addEventListener('click',

            function () {

                var newDataset = {
                    backgroundColor: [],
                    data: [],
                    label: 'New dataset ' +

                        config.data.datasets.length,

                };
                for (var index = 0; index < config.data.labels.length;

                    ++index) {

                    newDataset.data.push(randomScalingFactor());
                    var colorName = colorNames[index %

                        colorNames.length];

                    var newColor = window.chartColors[colorName];
                    newDataset.backgroundColor.push(newColor);
                }
                config.data.datasets.push(newDataset);
                window.myPie.update();
            });
        document.getElementById('removeDataset').addEventListener('click',
            function () {

                config.data.datasets.splice(0, 1);
                window.myPie.update();
            });
    </script>
</body>

</html>