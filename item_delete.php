<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

$deleteid = $_GET['id'];

$queryDelete = "DELETE FROM items WHERE item_id = '$deleteid'";
$resultDelete = mysqli_query($con, $queryDelete);


mysqli_close($con);


header('location: items.php');

?>

