<?php
/**
*User :shyam
*/
require_once("db.php");

function checkQueryResult($resultset){
    global $connection;
    if(!$resultset){
        die("Query FAILED : ". mysqli_error($connection));
    }
}

//return karega konsa usere logged in h 
function getLoggedInEmployeeName($LoggedInId){
    global $connection;
    $query = "SELECT * FROM employee WHERE employee_id = $LoggedInId";
    $employee_details = mysqli_query($connection, $query);
    checkQueryResult($employee_details);
    if($row = mysqli_fetch_assoc($employee_details)){
        return ($row['employee_name']);
    }
}


function insert($tableName, $columns, $values){
    global $connection;
    $query = "INSERT INTO $tableName($columns) VALUES ($values)";
    $resultset = mysqli_query($connection, $query);
    checkQueryResult($resultset);
     
    return $resultset;
}
function deleteRecord($tableName,$primarykeyColumnName, $primarykeyValue, $employeeID){
    global $connection;
    $query = "UPDATE $tableName SET deleted = 1, deleted_by =  $employeeID, deleted_at = now() where $primarykeyColumnName = $primarykeyValue";
    $resultset = mysqli_query($connection,$query);
    checkQueryResult($resultset);
}
function redirect($url){
    header("Location: $url");
    exit();
}
?>