<?php
//category_id
//JABHI8 FORM ko submit karna hai toh syle chaleg 
require_once("../../includes/functions.php");
session_start();

if(isset($_POST['edit_supplier'])){
    $supplier_id = $_POST['supplier_id'];
    $supplier_name = $_POST['supplier_name'];
    $employee_id =$_SESSION['employee_id'];
    $query = "UPDATE supplier SET supplier_name = '$supplier_name' , updated_by = $employee_id, updated_at = now() WHERE supplier_id = $supplier_id";
    
    $result = mysqli_query($connection , $query);
    
    checkQueryResult($result);
    $_SESSION['status'] = SUPPLIER_EDIT_SUCCESS;
    header("Location: http://".BASE_SERVER."/erp/pages/manage-supplier.php");
    exit();
}

?>