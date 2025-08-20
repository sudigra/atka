<!doctype html>
<html>

<head>
    <title>Line Chart</title>
    <script src="js/Chart.bundle.js"></script>
    <script src="js/jquery.min.js"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
</head>

<body>
    <div style="width:75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
 
        var randomColorFactor = function() {
            return Math.round(Math.random() * 255);
        };
        var randomColor = function(opacity) {
            return 'rgba(' + 10 + ',' + 255 + ',' + 10 + ',' + (opacity || '.3') + ')';
        };

        var config = {
            type: 'line',
            data: {
                labels: ["0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"],
                datasets: [{
                    label: "",
                    data: [1, 2,3,4,5,6,7,8,9,10],
                    fill: false,
                    borderDash: [2, 2],
                }]
            },
            options: {
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Bulan'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Berat Badan'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Buku Posyandu Balita'
                }
            }
        };

        $.each(config.data.datasets, function(i, dataset) {
            var background = randomColor(0.5);
            dataset.borderColor = background;
            dataset.backgroundColor = background;
            dataset.pointBorderColor = background;
            dataset.pointBackgroundColor = background;
            dataset.pointBorderWidth = 1;
        });

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);
        };
    </script>
</body>

</html>
