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
          Sales Report
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Sales Report</li>
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
                  <table id="report-table" class="table table-bordered">
                    <thead>
                      <th>Sale ID</th>
                      <th>Member Name</th>
                      <th>Item ID</th>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>Total Amount(RM)</th>
                      <th>Date</th>
                    </thead>
                    <tbody>
                      <?php

                        if(isset($_GET['start-date']) && isset($_GET['end-date'])){

                            $_SESSION['dateBegin'] = date('Y-m-d', strtotime($_GET['start-date']));
                            $_SESSION['dateEnd'] = date('Y-m-d', strtotime($_GET['end-date']));

                            if($_SESSION['dateBegin'] > $_SESSION['dateEnd']){
                                header('Location: dashboard.php');
                            }

                        $query = "SELECT s.sale_id as 'Sale ID', CONCAT(m.first_name, ' ',m.last_name) as Name, i.item_id as 'Item ID', i.item_name as 'Item Name', mo.quantity as Quantity, mo.quantity * i.price as 'Total Amount', s.date as Date FROM sales s JOIN mem_orders mo ON s.sale_id = mo.sale_id JOIN items i ON mo.item_id = i.item_id JOIN members m ON s.member_id = m.member_id WHERE s.date BETWEEN '".$_SESSION['dateBegin']."' AND '".$_SESSION['dateEnd']."' ORDER BY s.sale_id;";

                        $result =  mysqli_query($con, $query);
                        }


                      if (mysqli_num_rows($result) == 0) {
                        echo "<p>No sales found.</p>";
                      } else {
                        while ($row = mysqli_fetch_array($result)) {

                            echo "
                            <tr>
                            <td style='width:50px'>" . $row['Sale ID'] . "</td>
                            <td style='width:150px'>" . $row['Name'] . "</td>
                            <td style='width:50px'>" . $row['Item ID'] . "</td>
                            <td style='width:150px'> ". $row['Item Name'] . "</td>
                            <td style='width:100px'> ". $row['Quantity'] . "</td>
                            <td style='width:100px'> ". $row['Total Amount'] . "</td>
                            <td style='width:100px'> ". $row['Date'] . "</td>
                           </tr>
                            ";
                        }
                      }

                      ?>
                    </tbody>
                    
                  </table>
                </div>
                    <div class="form-group">
                        <div class="pull-right">
                            <a href="sales_report.php"><button type="submit" name="submit" class="btn btn-primary">Export</button></a>
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

    function searchFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("report-table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    let rowTds = tr[i].getElementsByTagName("td")
    for (j = 0; j < rowTds.length; j++){
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