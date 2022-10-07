<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

if(isset($_POST['update'])){
    $eid = $_POST['employee_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $mobileno = $_POST['mobileno'];
    $address = $_POST['address'];
    $employeerole = $_POST['employeerole'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');

    $queryUpdate="update employees set first_name='$fname',last_name='$lname',email='$email',password='$password',mobile_number='$mobileno',address='$address', role='$employeerole', updated_at = '$updatedAt' where employee_id='$eid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);

    
    }

    mysqli_close($con);

    header('location: employees.php');


?>