<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "go2gro");

$id = $_GET['id'];
$kcounter=0;

$query = "SELECT * FROM sales where sale_id = '$id'";
$result = mysqli_query($con, $query);

$query2 = "SELECT * FROM mem_orders where sale_id = '$id'";
$result2 = mysqli_query($con, $query2);


?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Sale
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Sales</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Sales Found.</p>";
                } else {
                    echo "<br><br><h4>Sale Information: </h4><br> <br>";
                    echo "<form class='form-horizontal' id='salesupdate' action='sales_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {
                        
                        echo "<div class='form-group'>";
                        echo "<label for='sale_id' class='col-sm-1 control-label'>Sale ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='sale_id' name='sale_id' value='" . $row['sale_id'] . "' readonly></div>";
                        echo "</div>";
                        
                        echo '<table id="orders-table" class="table table-bordered">
                        <thead>
                            <th>Current Item: </th>
                            <th>New Item:</th>
                            <th>Quantity:</th>
                        </thead>
                        <tbody>';

                        while ($row2 = mysqli_fetch_array($result2)) {

                        $ItemID2Name = $row2['item_id'];
                        $query3 = "SELECT item_name FROM items WHERE item_id = $ItemID2Name";
                        $result3 = mysqli_query($con, $query3);

                        $queryItem = "SELECT * FROM items";
                        $resultItem = mysqli_query($con, $queryItem);

                        foreach ($result3 as $item) {
                            $itemName = $item['item_name'];
                        }
                        
                        echo "
                        <tr>
                        <td style='width:150px'><select class='form-control' id ='old_item_id".$kcounter."' name='old_item_id".$kcounter."' required><option value='" . $row2['item_id'] . "' selected>" . $itemName . "</option></select></td>
                        <td style='width:150px'><select class='form-control' id ='item_id".$kcounter."' name='item_id".$kcounter."' required><option value='" . $row2['item_id'] . "' selected>" . $itemName . "</option>";
                        foreach ($resultItem as $items) {
                            echo "<option value='" . $items['item_id'] . "'>" . $items['item_name'] . "</option>";
                        }
                        echo "</td>
                        <td style='width:120px'><input type='number' class='form-control' id ='quantity".$kcounter."' name='quantity".$kcounter."' value='" . $row2['quantity'] . "'></td>
                        </tr>
                        ";
                        
                        $kcounter++;
                    
                    }
                    $_SESSION['kcounter'] = $kcounter;
                    echo "</tbody>
                    </table>";

                }

                    echo "</form>";
                    echo "<div class='col-sm-2 col-sm-offset-1 '><a href='sales.php'><button type='button' class='btn btn-default btn-flat' id='close' name='close'><i class='fa fa-close'></i> Close </button></a></div>";
                    echo "<div class='col-sm-5'><button type='submit' form='salesupdate' class='btn btn-primary btn-flat pull-right' id='update' name='update'><i class='fa fa-save'></i> Update </button></div>";
                }
                ?>


            </section>
        </div>
    </div>
    <?php
    mysqli_close($con);
    ?>
</body>

</html>