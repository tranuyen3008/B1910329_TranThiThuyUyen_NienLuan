<!DOCTYPE html>
<html>
<head>
<style type="text/css">
.chart {
    width: 1000px;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/Chart.min.js"></script>


</head>
<body>
  <div class="chart">
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                    var name = [];
                    var marks = [];

                    for (var i in data) {
                        // name.push(data[i].productName);
                        // marks.push(data[i].numOfProduct);
                        name.push(data[i].numOfProduct);
                        marks.push(data[i].productName);
                    }

                    var chartdata = {
                        // labels: name,
                        datasets: [
                            {
                                label: 'Số lượng',
                                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"]   ,
                                borderColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                                hoverBackgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                                hoverBorderColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                                data: marks
                            }
                        ],
                        labels: name,
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'horizontalBar',
                        data: chartdata
                    });
                });
            }
        }
        </script>
</div>
</body>
</html>