<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

$deleteid = $_GET['id'];

$queryDelete = "DELETE FROM employees WHERE employee_id = '$deleteid'";
$resultDelete = mysqli_query($con, $queryDelete);


mysqli_close($con);


header('location: employees.php');

?>

