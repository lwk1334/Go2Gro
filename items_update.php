<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

if(isset($_POST['update'])){
    $itemid = $_POST['item_id'];
    $iname = $_POST['item_name'];
    $iprice = $_POST['price'];
    $idesc = $_POST['description'];
    $istock = $_POST['stock_status'];
    $filename = $_FILES['photo']['name'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');

    
    if (!empty($filename)) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newfilename = preg_replace('/[^a-zA-Z0-9\']/', '-', $iname);
        $newfilename = str_replace("'", '', $newfilename);
        $new_filename = $newfilename . '.' . $ext;

        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $new_filename);
    } else {
        $new_filename = $_POST['photoName'];
    }

    $queryUpdate="update items set item_name='$iname', img='$new_filename',price='$iprice',description='$idesc', stock_status='$istock', updated_at = '$updatedAt' where item_id='$itemid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);

    
    }

    mysqli_close($con);

    header('location: items.php');


?>