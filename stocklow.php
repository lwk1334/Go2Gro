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
          Items Low In Stock
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Items Low In Stock</li>
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
                  <table id="stocklow-table" class="table table-bordered">
                    <thead>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Stock Status</th>
                    </thead>
                    <tbody>
                      <?php

                      $query = "SELECT * FROM items WHERE stock_status <= 10";
                      $result = mysqli_query($con, $query);



                      if (mysqli_num_rows($result) == 0) {
                        echo "<p>No items found.</p>";
                      } else {
                        while ($row = mysqli_fetch_array($result)) {

                            $image = (!empty($row['img'])) ? 'images/' . $row['img'] : 'images/noimage.jpg';
                            echo "
                            <tr>
                            <td style='width:150px'>" . $row['item_name'] . "</td>
                            <td style='width:120px'>
                              <img src='" . $image . "' height='60px' width='60px'>
                            </td>
                            <td>" . $row['description'] . "</td>
                            <td style='width:120px'>RM " . number_format($row['price'], 2) . "</td>
                            <td style='width:120px'>" . $row['stock_status'] . "</td>
                           </tr>
                            ";
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
  table = document.getElementById("stocklow-table");
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