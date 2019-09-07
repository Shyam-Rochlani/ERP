<?php

//require_once("../../includes/db.php");
require_once("../../includes/functions.php");
session_start();
$employee_id = $_SESSION['employee_id'];
if(isset($_POST['deleteBtn'])){
    $product_id = $_POST['product_id'];
   $tableName = "product";
    $primarykeyColumnName = "product_id";
    
    deleteRecord($tableName, $primarykeyColumnName, $product_id, $employee_id);
    
    $tableName = "product_sale_rate";
    deleteRecord($tableName, $primarykeyColumnName, $product_id, $employee_id);
    //$_POST['status'] = DELETE_SUCCESS;
    //header("Location: http://".BASE_SERVER."/erp/pages/manage-product.php");
    //mysqli_query($connection, $query);
    echo "Deleted Successfully";
    
}
?>