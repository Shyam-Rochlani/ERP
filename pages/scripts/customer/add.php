<?php
session_start();
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
$employee_id = $_SESSION['employee_id'];

if(isset($_POST['add_customer'])){
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_email = $_POST['customer_email'];
    $customer_contact = $_POST['customer_contact'];
    $gst_no = $_POST['gst_no'];
    
    $query = "SELECT * FROM customer WHERE customer_contact = $customer_contact";
    $resultset = mysqli_query($connection,$query);
    echo $query;
    if(mysqli_num_rows($resultset)>0){
        $_SESSION["status"]= CUSTOMER_EXISTS_WARNING;
        echo mysqli_num_rows($resultset);

    header("Location: http://".BASE_SERVER."/erp/pages/add-customer");
        exit();
    }
    else{
    $tablename = "customer";
    $columns =  "customer_name,customer_address,customer_email,customer_contact,gst_no";
    $values = "'$customer_name','$customer_address','$customer_email','$customer_contact','$gst_no'";
    insert($tablename,$columns,$values);
         $_SESSION["status"]= CUSTOMER_ADDED;
        
    header("Location: http://".BASE_SERVER."/erp/pages/manage-customer.php");
        exit();
    }
}
?>