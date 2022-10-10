<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

$deleteid = $_GET['id'];

$queryDelete = "DELETE FROM mem_orders WHERE sale_id = '$deleteid'";
$resultDelete = mysqli_query($con, $queryDelete);

$queryDelete2 = "DELETE FROM sales WHERE sale_id = '$deleteid'";
$resultDelete2 = mysqli_query($con, $queryDelete2);


mysqli_close($con);


header('location: sales.php');

?>

