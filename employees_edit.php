<!DOCTYPE html>
<html>


<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';


$con = mysqli_connect("localhost", "admin", null, "go2gro");

$id = $_GET['id'];

$query = "SELECT * FROM employees where employee_id = '$id'";
$result = mysqli_query($con, $query);


?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edit Employees
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Employees</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No Employee Record Found.</p>";
                } else {
                    echo "<br><br>Employee Information: <br> <br>";
                    echo "<form class='form-horizontal' action='employees_update.php' method='POST' enctype='multipart/form-data'>";
                    while ($row = mysqli_fetch_array($result)) {

                        echo "<div class='form-group'>";
                        echo "<label for='employee_id' class='col-sm-1 control-label'>Employee ID: </label><div class='col-sm-3'><input type='text' class='form-control' id ='employee_id' name='employee_id' value='" . $row['employee_id'] . "' readonly></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='first_name' class='col-sm-1 control-label'>First Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='first_name' name='first_name' value='" . $row['first_name'] . "'></div>";
                        echo "<label for='last_name' class='col-sm-1 control-label'>Last Name: </label><div class='col-sm-3'><input type='text' class='form-control' id ='last_name' name='last_name' value='" . $row['last_name'] . "'></div>";
      
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='email' class='col-sm-1 control-label'>Email: </label><div class='col-sm-3'><input type='text' class='form-control' id ='email' name='email' value='" . $row['email'] . "'></div>";
                        echo "<label for='password' class='col-sm-1 control-label'>Password: </label><div class='col-sm-3'><input type='password' class='form-control' id ='password' name='password' required></div>";
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='mobileno' class='col-sm-1 control-label'>Mobile No: </label><div class='col-sm-3'><input type='text' class='form-control' id ='mobileno' name='mobileno' value='" . $row['mobile_number'] . "'></div>";
                        echo "<label for='employeerole' class='col-sm-1 control-label'>Role: </label><div class='col-sm-3'><select class='form-control' id='employeerole' name='employeerole' required>";
                            if($row['role'] == 'Manager'){
                                echo "<option value='" . $row['role'] . "' selected>" . $row['role'] . "</option>"; 
                                echo "<option value='Employee'>Employee</option>"; 

                            } 
                            if($row['role'] == 'Employee'){
                                echo "<option value='" . $row['role'] . "' selected>" . $row['role'] . "</option>"; 
                                echo "<option value='Manager'>Manager</option>"; 

                            }
                                
                        echo "</select></div>";   
                        echo "</div>";

                        echo "<div class='form-group'>";
                        echo "<label for='address' class='col-sm-1 control-label'>Address: </label><div class='col-sm-7'><textarea name='address' rows='10' cols='133' class='form-control' id ='address'>". $row['address'] . "</textarea></div>";
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