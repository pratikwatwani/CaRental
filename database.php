<?php
$DBServer='localhost';
$DBUser='bp6am';
$DBPassword='bp6ampass';
$DBName='feed';

$connect=mysqli_connect($DBServer,$DBUser,$DBPassword,$DBName);
if($connect->connect_error)
{
	die('Connection Error: ' . $connect->connect_error);
}
?>