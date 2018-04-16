<?php

$conn = mysqli_connect('localhost', 'root','');
if(!$conn){
    die("Database Connection Failed" . mysqli_error($conn));
}
$select_db = mysqli_select_db($conn, 'myinvoicedb');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($conn));
}

 

?>
