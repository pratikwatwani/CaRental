<?php
$success=<<<SUCCESS
<html>
<head>
<title>Welcome | Registeration</title>
</head>
<body>
	<form action="?" method="post">
	<fieldset>
	<legend>Application Send SuccessFully</legend>
	<p>Kindly wait for our <i>response</i>!
	</fieldset>
	</form>
</body>
</html>
SUCCESS;
if(isset($_POST['submit']))
		{
	  $type=$_GET['type'];
	  $name=$_POST['fname'] . ' ' . $_POST['mname']. ' ' . $_POST['lname'];
	  $dob=$_POST['dob'];
	  $gender=$_POST['gender'];
	  $dor='1995-10-15';
	  $email=$_POST['email'];
	  $add=$_POST['add'];
	  $username=$_POST['uname'];
	  $password=$_POST['password'];
	  require 'connect.php';
		if($type=='customer')
	  {
		  
		  $query="INSERT INTO customer(name,DoB,DoR,gender,email,address) values ('" . $name . "','" .$dob. "','" .$dor. "','" .$gender. "','" . $email . "','" . $add . "')";
		  $query2="SELECT MAX(cid) as max from customer";
		  //$id=mysql_query($query2,$db) or die(mysql_error($db));
		  //$row = mysql_fetch_row($id) or die('error');
		  //echo $row[0];
	  }
	  else if($type=='agent')
	  {
		  
		  $query="INSERT INTO agent(name,DoB,DoR,gender,email,address) values ('" . $name ."','" . $dob . "','" . $dor . "','" . $gender . "','" . $email . "','" . $add . "')";
	      $query2="SELECT MAX(aid) as max from agent";
		  //$id=mysql_query($query2,$db) or die(mysql_error($db));
		  //$row = mysql_fetch_row($id) or die('error');
	  }
	  else
	  {
		  echo 'Some error occured\nPlease fill again you are redirected to registration page within 5 sec...';
		  //sleep(5);
		  header("Location:register.php?try=false");
		  exit();
	  }
			mysql_query($query,$db) or die('some error occur');
			echo $success;
			
			$query="INSERT INTO login(username,pass,type,identify) VALUES('" .$username. "','" . $password . "','" .$type."','20')";
			mysql_query($query,$db) or die('Try with Different username.');
	}
?>