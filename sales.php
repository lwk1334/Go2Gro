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
                    Sales
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Sales</li>
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
                                    <table id="sales-table" class="table table-bordered">
                                        <thead>
                                            <th>Sale ID:</th>
                                            <th>Member Name:</th>
                                            <th>Amount Paid</th>
                                            <th>Date</th>
                                            <th>Details</th>
                                            <th>Tools</th>
                                        </thead>   
                                        <tbody>
                                            <?php

                                            $query = "SELECT * FROM sales";
                                            $result = mysqli_query($con, $query);



                                            if (mysqli_num_rows($result) == 0) {
                                                echo "<p>No sales found.</p>";
                                            } else {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $memberName2ID = $row['member_id'];
                                                    $query2 = "SELECT * FROM members WHERE member_id = $memberName2ID";
                                                    $result2 = mysqli_query($con, $query2);

                                                    foreach ($result2 as $member) {

                                                        echo "
                            <tr>
                            <td style='width:120px'>" . $row['sale_id'] . "</td>
                            <td style='width:150px'>" . $member['first_name'] . " " . $member['last_name'] . "</td>
                            <td style='width:120px'>RM " . number_format($row['price'], 2) . "</td>
                            <td style='width:120px'>" . $row['date'] . "</td>
                            <td style='width:70px'><a href='sales_detail.php?sid=" . $row['sale_id'] . "' id='saledetails' ><i class='fa fa-info-circle fa-lg'></i></a></td>
                            <td style='width:150px'>
                            <a href ='sales_edit.php?id=" . $row['sale_id'] . "&memid=" . $row['member_id'] . "'><button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['sale_id'] . "'><i class='fa fa-edit'></i> Edit</button></a>
                            <button onclick='deleteSale(" . $row['sale_id'] . ")' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['sale_id'] . "'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                           </tr>
                            ";
                                                    }
                                                }
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                        
                                        <div class="panel-body">
                                            <form class="clearfix" method="get" action="sales_report_display.php">
                                                <div class="form-group">
                                                    <label class="form-label">Date Range For Sales Report</label>
                                                    <div class="input-group ">
                                                        <input type="date" class="datepicker form-control" name="start-date" id="start-date" min="2022-01-01" placeholder="From">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                                                        <input type="date" class="datepicker form-control" name="end-date" id="end-date" min="2022-01-02" placeholder="To">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="pull-left">
                                                        <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </section>
        </div>
    </div>

  <script>
    document.getElementById('addsale').addEventListener('click',
      function() {
        document.querySelector('.bg-modal-addSale').style.display = 'flex';

      });

      //if confirm, run php
    function deleteSale(saleID) {
      var result = confirm("Are you sure you would like to DELETE this sale?");
      if (result) {
        window.location = "sales_delete.php?id=" + saleID;
      }
    }

</script>

    <script>
        function searchFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("sales-table");
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