<?php
session_start();
$message=array();
require('database.php');

if(isset($_POST['data']))
{
	$data=$_POST['data'];
	if($data==1)
	{
		$set_column='d';

	}
	elseif($data==2)
	{
		$set_column='p';
	}
	elseif($data==3)
	{
		$set_column='ns';
	}
	elseif($data==4)
	{
		$set_column='pn';
	}
	elseif($data==5)
	{
		$set_column='dn';
	}
		
		$query="SELECT $set_column FROM feeback where id=1";
		$result=$connect->query($query) or die('error in fetching');
		
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		$votes=$row[$set_column];
		$votes++;
		
		$query2="UPDATE feeback SET $set_column=$votes WHERE id=1";
		$result2=$connect->query($query2) or die('hola');
		
		$message['type']="Thank you for your valuable feedback";
}
else
{
	$message['type']="FAIL";
}
header('content-type:application/json');
echo json_encode($message);
?>