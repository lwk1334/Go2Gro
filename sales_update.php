<?php
include 'includes/session.php';
$con = mysqli_connect("localhost", "admin", null, "go2gro");

if(isset($_POST['update'])){
    $sid = $_POST['sale_id'];
    $kcounter = $_SESSION['kcounter'];

    for($i=0;$i<$kcounter;$i++){

    $product_id = $_POST['product_id'.$i];
    $quantity = $_POST['quantity'.$i];
    $old_product_id = $_POST['old_product_id'.$i];
    $queryUpdate="update mem_orders set product_id='$product_id',quantity='$quantity' where product_id='$old_product_id' and sale_id='$sid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);

    }
    }

    mysqli_close($con);

    header('location: sales_detail.php?sid='.$sid);


?>