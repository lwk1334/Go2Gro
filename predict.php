<?php
/*Predict sales of item based on previous record*/
require_once('vendor/autoload.php');
use Phpml\Regression\LeastSquares;

include 'includes/session.php';
include 'header.php';
include 'sidebar.php';

error_reporting(0);

$con = mysqli_connect("localhost", "admin", null, "go2gro");

if (isset($_GET['item_id'])) {
    $id = trim($_GET['item_id']);

    // Find the item
    $fetch_item_query = "SELECT i.item_id, i.item_name, i.price, i.stock_status FROM items i WHERE i.item_id =:item_id";
    $handle = $pdo->prepare($fetch_item_query);
    $params = ['item_id' => $id];
    $handle->execute($params);

    if ($handle->rowCount() > 0) {
        // Data exists so store the data
        $item_data = $handle->fetchAll()[0];
    }

    // Fetch sold quantity
    $fetch_sold_query = "SELECT sum(quantity) as amount FROM sales s JOIN mem_orders mo ON s.sale_id = mo.sale_id WHERE DATE(s.date) = :date AND i.item_id = :item_id GROUP BY i.item_id";
    $sold_handler = $pdo->prepare($fetch_sold_query);
    $sold_params = [
        'date' => date('Y-m-d'),
        'item_id' => $id,
    ];
    $sold_handler->execute($sold_params);

    $sold_amount = 0;

    if ($sold_handler->rowCount() > 0) {
        $sold_amount = $sold_handler->fetchAll()[0]['amount'];
    }

    // Fetch total sold number
    $fetch_total_sold_query = "SELECT sum(mo.quantity * i.price) as amount FROM sales s JOIN mem_orders mo ON s.sale_id = mo.sale_id JOIN items i ON mo.item_id = i.item_id WHERE i.item_id = :item_id GROUP BY i.item_id";
    $total_sold_handler = $pdo->prepare($fetch_total_sold_query);
    $total_sold_params = [
        'item_id' => $id,
    ];
    $total_sold_handler->execute($total_sold_params);

    $total_sold_amount = 0;
        if ($total_sold_handler->rowCount() > 0) {
            $total_sold_amount = $total_sold_handler->fetchAll()[0]['amount'];
        }

    $month_array = [];
    $revenue_array = [];

    $x = [];
    $prediction_array = [];
    $counter = 0;
    foreach ($month_array as $month) {
        array_push($x, [$counter]);
        array_push($prediction_array, null);
        $counter++;
    }

    $regression = new LeastSquares();
    $regression->train($x, $revenue_array);
    $result = round($regression->predict([$counter]));




}

?>


<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Sales Prediction
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Sales Prediction</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">

              <canvas id="fullChart" style="width: 50%"></canvas>
            

              </div>
            </div>
          </div>
        </div>



      </section>
    </div>
  </div>

<script>
        var xValuesT = <?php echo json_encode($month_array_t); ?>;
        var yValuesT = <?php echo json_encode($revenue_array_t); ?>;
        var yValuesPredictionT = <?php echo json_encode($prediction_array_t); ?>;

        const ctx1 = document.getElementById('fullChart');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: xValuesT,
                datasets: [{
                    label: "Actual",
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgb(4 255 0)",
                    borderColor: "rgb(3 176 0)",
                    data: yValuesT,
                    spanGaps: true
                },
                {
                    label: "Prediction",
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgb(69 69 69)",
                    borderColor: "rgb(122 122 122)",
                    data: yValuesPredictionT,
                    spanGaps: true
                }],
            },
            options: {
                responsive: true,
                scales: {
                    x : {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y : {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'RM ' + value;
                            },
                        },
                        title: {
                            display: true,
                            text: 'Sales Item Prediction'
                        }
                    }
                }
            }
        });
</script>



</body>

</html>

