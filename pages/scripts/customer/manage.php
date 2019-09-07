<?php
require_once("../../includes/db.php");

//this code is used to create the table in mange.php

$columns = array("customer.customer_name","customer.customer_address","customer.customer_email","customer.customer_contact","customer.gst_no");
$query = "SELECT * FROM customer HAVING deleted=0 "; 

if(isset($_POST["search"]["value"])){
    $query .= " AND (customer.customer_name like '%".$_POST["search"]["value"].
        "%' OR customer.customer_contact like '%".$_POST["search"]["value"].
        "%' OR customer.customer_email like '%".$_POST["search"]["value"].
        "%')";
}
if(isset($_POST["order"])){
    $query .= " ORDER BY ".$columns[$_POST['order']['0']['column']]." ".
        $_POST['order']['0']['dir'];
}else{
    $query .= " ORDER BY ".$columns[0]." ASC";
}

$query1 = "";

if($_POST["length"]!=-1){
    $query1 = ' LIMIT '. $_POST['start'].','.$_POST['length'];
}
$number_filtered_row = mysqli_num_rows(mysqli_query($connection,$query));

$result = mysqli_query($connection,$query . $query1);

$data = array();
while($row = mysqli_fetch_assoc($result)){
    $sub_array = array();
    
    $sub_array[] = $row["customer_name"];
    $sub_array[] = $row["customer_address"];
    $sub_array[] = $row["customer_email"];
    $sub_array[] = $row["customer_contact"];
    $sub_array[] = $row["gst_no"];
    
    $sub_array[] = "<button class ='edit fa fa-pencil btn blue'
     id='".$row['customer_id']."' data-toggle='modal' data-target='#editModal'></button>";
    $sub_array[] = "<button class = 'delete fa fa-trash btn red' id='".
        $row['customer_id']."' data-toggle='modal' data-target='#deleteModal'></button>";    
    
    $data[] = $sub_array;
}

function get_all_data($connection){
    $query = "SELECT * FROM customer";
    return(mysqli_num_rows(mysqli_query($connection, $query)));
}

$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => get_all_data($connection),
    "recordsFiltered" => $number_filtered_row,
    "data" => $data,
);

echo json_encode($output);
//end of table 
?>