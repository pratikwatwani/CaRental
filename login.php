<?php
session_start();
session_unset();
if(!isset($_POST['send'])){
$start=<<<FORM
<html>
<head>
	<title>CaRental</title>
	<link rel="stylesheet" type="text/css" href="style/login.css">
</head>
<body>
<form action="?" method="post" id="login_form">
<label for="Username">Username :</label><input type="text" name="username" id="Username" />
<label for="password">Password :</label><input type="password" name="password" id="password" />
<input type="submit" name="send" value="Login"/>
</form>
</body>
</html>
FORM;
echo $start;
}
else{
	 $user=$_POST['username'];
	$pass=$_POST['password'];

	//database connect
	require 'connect.php';
	$query="SELECT * from login where username='" . $user .  "' and pass='" . $pass . "'";
	$result=mysql_query($query,$db) or die(mysql_error($db));
	$count = mysql_num_rows($result);

	
		if($count==1)
		{
			$_SESSION['username']= $user ;
		}
		else{
			echo '<html>
					<head>
						<title>CaRental</title>
						<link rel="stylesheet" type="text/css" href="style/login.css">
					</head>
					<body><div id="message"><h2>Invalid Login Credentials.</h2>';
			echo '<p>Would you like to <a href="login.php"> <i>retry<i></a></p><br>or<p>New Customer register <a href="register.php"><strong>here</strong></a></p>
			</div>
			</body>
			</html>';
		}
		if(isset($_SESSION['username']))
		{
			header('Location:product.php');
		}
}
?>