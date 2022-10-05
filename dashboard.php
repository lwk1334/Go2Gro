<!DOCTYPE html>
<html>


<?php

include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "go2gro");

?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if ($_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Employee') {

                ?>

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">

                                    <p>Total Sales</p>

                                    <?php
                                    $querySales = "select count(sale_id) from sales";
                                    $resultSales = mysqli_query($con, $querySales);
                                    while ($salesRow = mysqli_fetch_array($resultSales)) {
                                        $salesCount = $salesRow["count(sale_id)"];
                                    }

                                    echo "<h3>" . $salesCount . "</h3>";
                                    ?>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <a href="sales.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">

                                    <p>Number of Items</p>

                                    <?php
                                    $queryItem = "select count(item_id) from items";
                                    $resultItem = mysqli_query($con, $queryItem);
                                    while ($itemRow = mysqli_fetch_array($resultItem)) {
                                        $itemCount = $itemRow["count(item_id)"];
                                    }

                                    echo "<h3>" . $itemCount . "</h3>";
                                    ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-file-o"></i>
                                </div>
                                <a href="items.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">

                                    <p>Number of Members</p>

                                    <?php
                                    $queryMem = "select count(member_id) from members";
                                    $resultMem = mysqli_query($con, $queryMem);
                                    while ($MemRow = mysqli_fetch_array($resultMem)) {
                                        $MemCount = $MemRow["count(member_id)"];
                                    }

                                    echo "<h3>" . $MemCount . "</h3>";
                                    ?>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="members.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->

                    </div>

                <?php

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