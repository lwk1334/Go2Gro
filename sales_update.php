<?php
include 'includes/session.php';
$con = mysqli_connect("localhost", "admin", null, "go2gro");

if(isset($_POST['update'])){
    $sid = $_POST['sale_id'];
    $kcounter = $_SESSION['kcounter'];

    for($i=0;$i<$kcounter;$i++){

    $item_id = $_POST['item_id'.$i];
    $quantity = $_POST['quantity'.$i];
    $old_item_id = $_POST['old_item_id'.$i];

    //calculate stock

    if($item_id == $old_item_id){
    $queryMemOrders = "SELECT * FROM mem_orders WHERE item_id='$old_item_id' and sale_id='$sid'";
    $resultMemOrders = mysqli_query($con, $queryMemOrders);
    $MemOrders = mysqli_fetch_array($resultMemOrders);

    $oldQuantity = $MemOrders['quantity'];

    $queryItem1 = "SELECT * FROM items WHERE item_id = $old_item_id";
    $resultItem1 = mysqli_query($con, $queryItem1);
    $item1 = mysqli_fetch_array($resultItem1);

    if($oldQuantity > $quantity){
        $addQuantity = ($oldQuantity - $quantity);
        $changeQuantity = $addQuantity + $item1['stock_status'];
    }
    else if($oldQuantity < $quantity){
        $minusQuantity = ($quantity - $oldQuantity);
        $changeQuantity = $item1['stock_status'] - $minusQuantity;
    }
    

    $updateStockQuery = "UPDATE items SET stock_status='$changeQuantity' where item_id='$old_item_id'";
    $resultupdateStockQuery = mysqli_query($con, $updateStockQuery);

    $queryUpdate="update mem_orders set item_id='$item_id',quantity='$quantity' where item_id='$old_item_id' and sale_id='$sid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);
    }

    if($item_id != $old_item_id){
        $queryMemOrders = "SELECT * FROM mem_orders WHERE item_id='$old_item_id' and sale_id='$sid'";
        $resultMemOrders = mysqli_query($con, $queryMemOrders);
        $MemOrders = mysqli_fetch_array($resultMemOrders);
    
        $queryItem1 = "SELECT * FROM items WHERE item_id = $old_item_id";
        $resultItem1 = mysqli_query($con, $queryItem1);
        $item1 = mysqli_fetch_array($resultItem1);

        $changeQuantityOldItem = $item1['stock_status'] + $MemOrders['quantity'];

        $queryItem2 = "SELECT * FROM items WHERE item_id = $item_id";
        $resultItem2 = mysqli_query($con, $queryItem2);
        $item2 = mysqli_fetch_array($resultItem2);
        
        $changeQuantityNewItem = $item2['stock_status'] - $quantity;
        
    
        $updateStockQuery1 = "UPDATE items SET stock_status='$changeQuantityOldItem' where item_id='$old_item_id'";
        $resultupdateStockQuery1 = mysqli_query($con, $updateStockQuery1);

        $updateStockQuery2 = "UPDATE items SET stock_status='$changeQuantityNewItem' where item_id='$item_id'";
        $resultupdateStockQuery2 = mysqli_query($con, $updateStockQuery2);
    
        $queryUpdate="update mem_orders set item_id='$item_id',quantity='$quantity' where item_id='$old_item_id' and sale_id='$sid'";
        $resultUpdate = mysqli_query($con, $queryUpdate);

    }


    }
    }

    mysqli_close($con);

    header('location: sales_detail.php?sid='.$sid);


?>