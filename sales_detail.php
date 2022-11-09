<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';

$con = mysqli_connect("localhost", "admin", null, "go2gro");

$sid = $_GET['sid'];


$query = "SELECT * FROM mem_orders where sale_id = '$sid'";
$result = mysqli_query($con, $query);

?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View Sale Details
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Sales</li>
                    <li class="active">Sale Details</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="box">
            <div class="box-body">
            <table id="orders-table" class="table table-bordered">
                                        <thead>
                                            <th>Product Name:</th>
                                            <th>Quantity:</th>
                                        </thead>
                                        <tbody>
                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>Order Details not found.</p>";
                } else {
                    echo "<br><br><h3> SALE ID: ".$sid." </h3><br> <br>";
                    while ($row = mysqli_fetch_array($result)) {

                        $itemID2Name = $row['item_id'];
                        $queryID2Name = "SELECT item_name FROM items WHERE item_id = $itemID2Name";
                        $resultID2Name = mysqli_query($con, $queryID2Name);

                        foreach ($resultID2Name as $item) {
                            $itemName = $item['item_name'];
                          }

                            echo "
                            <tr>
                            <td style='width:150px'>" . $itemName . "</td>
                            <td style='width:120px'>" . $row['quantity'] . "</td>
                            </tr>
                            ";
                    }
                }
                ?>
                </tbody>
            </table>
            </div>
            </div>

            </section>
        </div>
    </div>
    <?php
    mysqli_close($con);
    ?>
</body>

</html>