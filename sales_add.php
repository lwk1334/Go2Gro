<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");


    $saleid = $_POST['sale_id'];
    $memberid = $_POST['member_id'];
    $totalpaid = $_POST['amount_paid'];
    $date = date('Y-m-d', strtotime($_POST['date']) );                               

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $createdAt =  date('Y-m-d H:i:s');
    $updatedAt =  date('Y-m-d H:i:s');

foreach($_POST['itemid'] as $key => $value){

            //get mem orders id count
            $queryCountMemOrders = "select max(memorders_id) from mem_orders";
            $resultCountMemOrders = mysqli_query($con, $queryCountMemOrders);
            while ($row = mysqli_fetch_array($resultCountMemOrders)) {
            $memordersid = $row["max(memorders_id)"] + 1;
        }

    $itemid = $_POST['itemid'][$key];
    $itemquantity = $_POST['itemquantity'][$key];
    $sql = "INSERT INTO mem_orders VALUES('$memordersid', '$saleid', '$itemid', '$itemquantity')";
    $resultSql = mysqli_query($con, $sql);

    //minus stock
    $queryItem = "SELECT * FROM items WHERE item_id = $itemid";
    $resultItem = mysqli_query($con, $queryItem);
    $item = mysqli_fetch_array($resultItem);
    $newQuantity = $item['stock_status'] - $itemquantity;

    $updateStockQuery = "UPDATE items SET stock_status='$newQuantity' where item_id='$itemid'";
    $resultupdateStockQuery = mysqli_query($con, $updateStockQuery);
}

//insert to sales table

$queryAddSales = "INSERT INTO sales values ('$saleid', '$memberid', '$totalpaid', '$createdAt', '$updatedAt','$date')";
$resultAddSales = mysqli_query($con, $queryAddSales);



// if (isset($_POST['submitadd'])) {

//     $number = count($_POST['itemname']);
//     $saleid = $_POST['sale_id'];
//     $memberid = $_POST['member_id'];

//     date_default_timezone_set("Asia/Kuala_Lumpur");

//         //get mem orders id count
//         $queryCountMemOrders = "select max(memorders_id) from mem_orders";
//         $resultCountMemOrders = mysqli_query($con, $queryCountMemOrders);
//         while ($row = mysqli_fetch_array($resultCountMemOrders)) {
//         $memordersid = $row["max(memorders_id)"] + 1;
//     }

//     if($number > 0)
//     {
//         for($k=0; $k<$number; $k++){
//             if(trim($_POST['itemname'][$k])!=''){
//                 $sql = "INSERT INTO mem_orders VALUES('$memordersid','$saleid','".$_POST["itemname"][$k]."','".$_POST["itemquantity"][$k]."')";
//                 $resultsql = mysqli_query($con, $sql);

//             }
//         }
//         echo "<script>alert('Sale Successfully Added')</script>";
//     }
//     else{
//         echo "Please enter items purchased!";
//     }

  

//     mysqli_close($con);
// }


mysqli_close($con);
header('location: sales.php');

?>