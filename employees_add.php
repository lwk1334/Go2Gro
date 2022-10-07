<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

if (isset($_POST['add'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $mobileno = $_POST['mobileno'];
    $address = $_POST['address'];
    $employeerole = $_POST['employeerole'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $createdAt =  date('Y-m-d H:i:s');
    $updatedAt =  date('Y-m-d H:i:s');

    $queryCount = "select max(employee_id) from employees";
    $resultCount = mysqli_query($con, $queryCount);
    while ($row = mysqli_fetch_array($resultCount)) {
        $eid = $row["max(employee_id)"] + 1;
    }

    $queryAdd = "INSERT INTO employees values ('$eid', '$fname', '$lname', '$email','$password','$mobileno', '$address', '$employeerole', '$createdAt','$updatedAt')";
    $resultAdd = mysqli_query($con, $queryAdd);

    if ($resultAdd > 0) {
        echo "<script>alert('Employee Successfully Added')</script>";
       

    } else echo "<script>alert('Employee Successfully Added')</script>";

    mysqli_close($con);
}

header('location: employees.php');

?>