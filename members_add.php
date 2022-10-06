<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

if (isset($_POST['add'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
    $address = $_POST['address'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $createdAt =  date('Y-m-d H:i:s');
    $updatedAt =  date('Y-m-d H:i:s');

    $queryCount = "select max(member_id) from members";
    $resultCount = mysqli_query($con, $queryCount);
    while ($row = mysqli_fetch_array($resultCount)) {
        $mid = $row["max(member_id)"] + 1;
    }

    $queryAdd = "INSERT INTO members values ('$mid', '$fname', '$lname', '$email','$mobileno', '$address','$createdAt','$updatedAt')";
    $resultAdd = mysqli_query($con, $queryAdd);

    if ($resultAdd > 0) {
        echo "<script>alert('Member Successfully Added')</script>";
       
    } else echo "<script>alert('Member Successfully Added')</script>";

    mysqli_close($con);
}

header('location: members.php');

?>