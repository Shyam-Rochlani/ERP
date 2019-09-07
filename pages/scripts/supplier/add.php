<?php
session_start();
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
$employee_id = $_SESSION['employee_id'];

if(isset($_POST['add_supplier'])){
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_email = $_POST['supplier_email'];
    $supplier_contact = $_POST['supplier_contact'];
    $gst_no = $_POST['gst_no'];
    
    $query = "SELECT * FROM supplier WHERE supplier_contact = $supplier_contact";
    $resultset = mysqli_query($connection,$query);
    echo $query;
    if(mysqli_num_rows($resultset)>0){
        $_SESSION["status"]= supplier_EXISTS_WARNING;
        echo mysqli_num_rows($resultset);

    header("Location: http://".BASE_SERVER."/erp/pages/add-supplier");
        exit();
    }
    else{
    $tablename = "supplier";
    $columns =  "supplier_name,supplier_address,supplier_email,supplier_contact,gst_no";
    $values = "'$supplier_name','$supplier_address','$supplier_email','$supplier_contact','$gst_no'";
    insert($tablename,$columns,$values);
         $_SESSION["status"]= SUPPLIER_ADDED;
        
    header("Location: http://".BASE_SERVER."/erp/pages/manage-supplier.php");
        exit();
    }
}
?>