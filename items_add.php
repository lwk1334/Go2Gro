<?php

$con = mysqli_connect("localhost", "admin", null, "go2gro");

if (isset($_POST['add'])) {
    $iname = $_POST['iname'];
    $iprice = $_POST['iprice'];
    $idesc = $_POST['idesc'];
    $istock = $_POST['istock'];
    $filename = $_FILES['photo']['name'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $createdAt =  date('Y-m-d H:i:s');
    $updatedAt =  date('Y-m-d H:i:s');

    $queryCount = "select max(item_id) from items";
    $resultCount = mysqli_query($con, $queryCount);
    while ($row = mysqli_fetch_array($resultCount)) {
        $itemid = $row["max(item_id)"] + 1;
    }

    

    if (!empty($filename)) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newfilename = preg_replace('/[^a-zA-Z0-9\']/', '-', $iname);
        $newfilename = str_replace("'", '', $newfilename);
        $new_filename = $newfilename . '.' . $ext;

        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $new_filename);
    } else {
        $new_filename = '';
    }

    $queryAdd = "INSERT INTO items values ('$itemid', '$iname', '$new_filename','$iprice', '$idesc', '$istock', '$createdAt','$updatedAt')";
    $resultAdd = mysqli_query($con, $queryAdd);

    if ($resultAdd > 0) {
        echo "<script>alert('Item Successfully Added')</script>";
       

    } else echo "<script>alert('Item Successfully Added')</script>";

    mysqli_close($con);
}

header('location: items.php');

?>