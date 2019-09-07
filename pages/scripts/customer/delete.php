<?php

require_once("../../includes/db.php");
session_start();
$employee_id = $_SESSION['employee_id'];
if(isset($_POST['deleteBtn'])){
    $customer_id = $_POST['customer_id'];
    $query = "UPDATE customer SET deleted = 1, deleted_at=now(), deleted_by = $employee_id WHERE customer_id = $customer_id";
    $_POST['status'] = DELETE_SUCCESS;
    header("Location: http://".BASE_SERVER."/erp/pages/manage-customer.php");
    mysqli_query($connection, $query);
    
}
?>