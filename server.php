<?php
session_start();
$message=array();
require('database.php');

$query="SELECT * FROM feeback";
$result=mysqli_query($connect,$query) or die('Data fetching error');
$votes=array();
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

$message['result']=$row;
header('content-type:application/json');
echo json_encode($message);
?>