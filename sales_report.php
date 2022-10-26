<?php
include 'includes/session.php';
$con = mysqli_connect("localhost", "admin", null, "go2gro");

if(isset($_SESSION['dateBegin']) && isset($_SESSION['dateEnd'])){

    $query = "SELECT s.sale_id as 'Sale ID', CONCAT(m.first_name, ' ',m.last_name) as Name, i.item_id as 'Item ID', i.item_name as 'Item Name', mo.quantity as Quantity, mo.quantity * i.price as 'Total Amount', s.date as Date FROM sales s JOIN mem_orders mo ON s.sale_id = mo.sale_id JOIN items i ON mo.item_id = i.item_id JOIN members m ON s.member_id = m.member_id WHERE s.date BETWEEN '".$_SESSION['dateBegin']."' AND '".$_SESSION['dateEnd']."' ORDER BY s.sale_id ;";

    $result =  mysqli_query($con, $query);

    if($_SESSION['dateBegin'] > $_SESSION['dateEnd']){
        header('Location: dashboard.php');
    }

    if($result->num_rows > 0){
        $delimiter = ",";
        $filename = "Sales-Report".date('Y-m-d').".csv";

        //Create a file pointer
        $f = fopen('php://memory', 'w');

        //Set column headers
        $fields = array('Sale ID', 'Member Name','Item ID','Item Name', 'Quantity', 'Total Amount(RM)', 'Date');
        fputcsv($f, $fields, $delimiter);

        //Output each row of the table, format line as csv and write to file pointer
        while($row = $result-> fetch_assoc() ){
            $lineData = array($row['Sale ID'], $row['Name'], $row['Item ID'], $row['Item Name'], $row['Quantity'], $row['Total Amount'], $row['Date']);
            fputcsv($f, $lineData, $delimiter);
        }

        //Move back to beginning of file 
        fseek($f,0);

        //Set headers to download file rather than display it 
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');

        //Output all remaining data on a file pointer
        fpassthru($f);

    }
}
else{
header('Location: dashboard.php');
}
?>
