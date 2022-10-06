<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

$deleteid = $_GET['id'];

$queryDelete = "DELETE FROM members WHERE member_id = '$deleteid'";
$resultDelete = mysqli_query($con, $queryDelete);


mysqli_close($con);


header('location: members.php');

?>

