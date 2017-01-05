<?php
require 'connect.php';
session_start();
if(!isset($_GET['status']))
{
	echo 'Please Select vehicle first';
}
else
{
	$start=$_SESSION['start_date'];
	$end=$_SESSION['end_date'];
	$total=$_SESSION['total'];
	$driver=1;
	$num=$_SESSION['num'];
	$user=$_SESSION['username'];
	//echo $start . ' ' . $end . ' ' . $total . ' ' . $driver . ' ' . $num . ' ' . $user . ' ';
	$query="INSERT INTO bill(amount,start_date,End_date,driver_id,vid,user) 
	values (" . $total . ",'". $start ."','" .$end. "',1,'". $num ."','". $user ."')";
	$result=mysql_query($query,$db) or die('Error in sending data to server');
	echo '<br/>Your booking is successful!<br><a href="product.php">CLICK to go back to product page</a>';
}

?>
