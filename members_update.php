<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

if(isset($_POST['update'])){
    $mid = $_POST['member_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
    $address = $_POST['address'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');

    $queryUpdate="update members set first_name='$fname',last_name='$lname',email='$email',mobile_number='$mobileno',address='$address', updated_at = '$updatedAt' where member_id='$mid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);


    
    }

    mysqli_close($con);

    header('location: members.php');


?>