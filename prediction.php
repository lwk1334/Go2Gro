<!DOCTYPE html>
<html>

<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


error_reporting(0);

$con = mysqli_connect("localhost", "admin", null, "go2gro");
?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Prediction
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Prediction</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <input type="search" onkeyup="searchFunction()" id="search" class="form-control" name="search" placeholder="Search">
                                </div>

                                <div class="box-body">
                                    <br>&nbsp;<br>
                                    <table id="prediction-table" class="table table-bordered">
                                        <thead>
                                            <th>Item Name:</th>
                                            <th>Month: </th>
                                            <th>Status:</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $previousyear = date("Y",strtotime("-1 year"));
                                            
                                            for($count = 01; $count <= 12; $count++){
                                            $OctQuery = "SELECT mo.item_id FROM mem_orders mo JOIN sales s ON mo.sale_id = s.sale_id WHERE s.date BETWEEN '$previousyear-$count-01' AND '$previousyear-$count-31' GROUP BY item_id ORDER BY COUNT(*) DESC LIMIT 1;";
                                            $Octresult = mysqli_query($con, $OctQuery);


                                            if (mysqli_num_rows($Octresult) == 0) {
                                                echo "<p>No prediction found.</p>";
                                                break;
                                            } else {
                                                while ($row = mysqli_fetch_array($Octresult)) {
                                                    $itemID2Name = $row['item_id'];
                                                    $query2 = "SELECT * FROM items WHERE item_id = $itemID2Name";
                                                    $result2 = mysqli_query($con, $query2);

                                                    foreach ($result2 as $item) {

                                                        echo "
                            <tr>
                            <td style='width:120px'>" . $item['item_name'] . "</td>
                            <td style='width:120px'>" . $count . "</td>
                            <td style='width:150px'>High in demand!</td>
                           </tr>
                            ";
                                                    }
                                                }
                                            }

                                        }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </section>
        </div>
    </div>

    <script>
        function searchFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("prediction-table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                let rowTds = tr[i].getElementsByTagName("td")
                for (j = 0; j < rowTds.length; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }
    </script>
</body>

</html>