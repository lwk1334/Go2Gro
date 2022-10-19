<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';

$con = mysqli_connect("localhost", "admin", null, "go2gro");

$id = $_GET['id'];

$query = "SELECT * FROM items where item_id = '$id'";
$result = mysqli_query($con, $query);

?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Items
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Items</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Items Found.</p>";
                } else {
                    echo "<br><br>Item Information: <br> <br>";
                    echo "<form class='form-horizontal' action='items_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {

                        $photoName = $row['img'];

                        echo "<input type='hidden' name='photoName' value='".$photoName."'>";
                        echo "<input type='hidden' name='item_id' value='".$id."'>";
                        echo "<div class='form-group'>";
                        echo "<label for='item_name' class='col-sm-1 control-label'>Item Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='item_name' name='item_name' value='" . $row['item_name'] . "'></div>";     
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='stock_status' class='col-sm-1 control-label'>Stock: </label><div class='col-sm-3'><input type='text' class='form-control' id ='stock_status' name='stock_status' value='" . $row['stock_status'] . "'></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='price' class='col-sm-1 control-label'>Price: </label><div class='col-sm-3'><input type='text' class='form-control' id ='price' name='price' value='" . $row['price'] . "'></div>";
                        echo "<label for='photo' class='col-sm-1 control-label'>Photo: </label><div class='col-sm-3'><input type='file' class='form-control' id ='photo' name='photo'></div>";
                        echo "</div>";


                        echo "<div class='form-group'>";
                        echo "<label for='description' class='col-sm-1 control-label'>Description: </label><div class='col-sm-7'><textarea name='description' rows='10' cols='133' class='form-control' id ='description'>". $row['description'] . "</textarea></div>";
                        echo "</div>";
                    }

                    echo "<div class='col-sm-8'><button type='submit' class='btn btn-primary btn-flat pull-right' id='update' name='update'><i class='fa fa-save'></i> Update </button></div>";
                    echo "</form>";
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