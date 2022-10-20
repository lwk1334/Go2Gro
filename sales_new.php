<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';

$con = mysqli_connect("localhost", "admin", null, "go2gro");

$memid = $_GET['memid'];

$query = "SELECT * FROM members where member_id = '$memid'";
$result = mysqli_query($con, $query);

$queryCount = "select max(sale_id) from sales";
$resultCount = mysqli_query($con, $queryCount);
while ($row = mysqli_fetch_array($resultCount)) {
    $saleid = $row["max(sale_id)"] + 1;
}

?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    New Sale
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Sale</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Sales Found.</p>";
                } else {
                    echo "<br><br><h4>Sale Information: </h4><br> <br>";
                    echo "<form class='form-horizontal' name ='salesadd' id='salesadd' action='sales_add.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {

                        echo "<div class='form-group'>";
                        echo "<label for='sale_id' class='col-sm-1 control-label'>Sale ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='sale_id' name='sale_id' value='" . $saleid . "' readonly></div>";
                        echo "</div>";
                        
                        echo "<div class='form-group'>";
                        foreach ($result as $member) {
                        echo "<label for='member_id' class='col-sm-1 control-label'>Member ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='member_id' name='member_id' value='" . $member['member_id'] . "' readonly ></div>";
                        }
                        echo "</div>";

                        echo "<div class='form-group'>";
                        foreach ($result as $member) {
                        echo "<label for='member_fname' class='col-sm-1 control-label'>First Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='member_fname' name='member_fname' value='" . $member['first_name'] . "' readonly ></div>";
                        echo "<label for='member_lname' class='col-sm-2 control-label'>Last Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='member_lname' name='member_lname' value='" . $member['last_name'] . "' readonly ></div>";

                        }
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='amount_paid' class='col-sm-1 control-label'>Amount Paid: </label><div class='col-sm-3'><input type='text' class='form-control' id ='amount_paid' name='amount_paid'></div>";
                        echo "<label for='date[]' class='col-sm-2 control-label'>Date: </label><div class='col-sm-3'><input type='date' min='2022-01-02' id ='date' name='date' placeholder='Enter a date' class='form-control'></div>";
                        echo "</div>";
                        
        
                        // echo "<div class='form-group'> "; 
                        // echo "<div class='table-responsive'>";  
                        // echo "<br/>";
                        // echo "<table class='table table-bordered' id='dynamic_field'>";  
                        // echo "<tr>"; 
                        // echo "<td><div class='col-sm-offset-1 col-sm-3'><button type='button' name='addField' id='addField' class='btn btn-success'>Add More</button></div></td>";  
                        // echo "</tr>"; 
                        // echo "<tr>"; 
                        // echo "<td><label for='itemname[]' class='col-sm-2 control-label'>Item 1: </label><div class='col-sm-5'><input type='text' name='itemname[]' placeholder='Enter Item Name' class='form-control name_list' /></td>";  
                        // echo "<td><label for='itemquantity[]' class='col-sm-1 control-label'>Quantity: </label><div class='col-sm-5'><input type='number' name='itemquantity[]' placeholder='Enter Quantity' class='form-control name_list' /></td>";
                        // echo "</tr>";  
                        // echo "</table>";  
                        // echo "</div>";  
                        // echo "</div>";  
                        
                        echo "<div class='form-group'> "; 
                        echo "<div class='table-responsive'>";  
                        echo "<br/>";
                        echo "<table class='table table-bordered' id='dynamic_field'>";  
                        echo "<tr>"; 
                        echo "<td><div class='col-sm-offset-1 col-sm-3'><button type='button' name='addField' id='addField' class='btn btn-success'>Add More</button></div></td>";  
                        echo "</tr>"; 
                        echo "<tr>"; 
                        echo "<td><label for='itemname[]' class='col-sm-2 control-label'>Item 1: </label><div class='col-sm-5'><input type='text' name='itemname[]' placeholder='Enter Item Name' class='form-control name_list' /></td>";  
                        echo "<td><label for='itemquantity[]' class='col-sm-1 control-label'>Quantity: </label><div class='col-sm-5'><input type='number' name='itemquantity[]' placeholder='Enter Quantity' class='form-control name_list' /></td>";
                        echo "</tr>";  
                        echo "</table>";  
                        echo "</div>";  
                        echo "</div>";  


                    }
                    echo "</form>";
                    echo "<br>";
                    echo "<div class='col-sm-2 col-sm-offset-1 '><a href='members.php'><button type='button' class='btn btn-default btn-flat pull-left' id='close' name='close'><i class='fa fa-close'></i> Close </button></a></div>";
                    echo "<div class='col-sm-6'><button type='submit' form='salesadd' class='btn btn-primary btn-flat pull-right' id='submitadd' name='submitadd'><i class='fa fa-plus'></i> Add </button></div>";
                }
                ?>


            </section>
        </div>
    </div>

</body>

</html>

<script src="https://cdnjs.cloudfare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>  
 $(document).ready(function(){  
      var i=1;  
      $('#addField').click(function(){  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><label for="itemname['+i+']" class=" col-sm-2 control-label">Item '+i+': </label><div class="col-sm-5"><input type="text" name="itemname['+i+']" placeholder="Enter Item Name" class="form-control name_list" /></td><td><label for="itemquantity['+i+']" class="col-sm-1 control-label">Quantity: </label><div class="col-sm-5"><input type="number" name="itemquantity['+i+']" placeholder="Enter Quantity" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
           i++;
        });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();
           i = i-1;  
      });  
      
      $('#salesadd').submit(function(e){
        e.preventDefault();
        $("#submitadd").val('Adding...');
        $.ajax({  
                url:"sales_add.php",  
                method:"POST",  
                data:$(this).serialize(),  
                success:function(response)  
                {  
                    window.location.href = "sales.php";
                    
                }  
           });  
      })
 });  
 </script>

<?php
    mysqli_close($con);
    ?>