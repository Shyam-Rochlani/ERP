<?php
session_start();
require_once("../../includes/db.php");

if(isset($_POST['customer_id'])){
    $customer_id = $_POST['customer_id'];
    $query = "SELECT * FROM customer HAVING customer.customer_id = $customer_id";
    
    
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}
?>