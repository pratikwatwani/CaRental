<?php 
error_reporting(0);
$data='
<html>
<head>
<title>Welcome | Registeration</title>
</head>
<body>';
	$data= $data . '<form action="send.php?type=' . $_GET['type'] . '&status=sent" method="post">
	<fieldset>
	<legend>Your Data</legend>
	<p><label for="fname">Name:</label><input type="text" id="fname" name="fname" placeholder="First Name"/>
	<input type="text" id="mname" name="mname" placeholder="Middle Name"/>
	<input type="text" id="lname" name="lname" placeholder="Last Name"/></p>
	<p><label for="dob">Date of Birth :</label><input type="date" id="dob" name="dob"/></p>
	<p><label for="email">E-mail :</label><input type="email" id="email" name="email"/></p>
	<p><label for="gender">Gender :</label>
	<select name="gender" id="gender">
	<option>---Select---</option>
	<option value="M">Male</option>
	<option value="F">Female</option>
	</select></p>
	<label for="add">Address : </label>
	<textarea rows="4" cols="30" id="add" name="add">
	</textarea>
	</fieldset>
	<fieldset>
	<legend>
	Login Credentials
	</legend>
	<p><i>*below data is important for future login....</i></p>
	<p><label for="username">Username</label><input type="text" placeholder="enter username" id="username" name="uname" autocomplete="off"/></p>
	<p><label for="pass">Password</label><input type="password" id="pass" name="password" autocomplete="off"/></p>
	</fieldset>
	<input type="reset" value="clear"/>&nbsp;<input type="submit" name="submit"/>
	</form>
</body>
</html>';
$reg=<<<type
<html>
<head>
<title>Welcome | Registeration</title>
</head>
<body>
	<form action="?" method="post">
	<fieldset>
	<legend>Registeration Type</legend>
		<p><a href="register.php?type=customer">Customer Registeration</a></p>
		<p><a href="register.php?type=agent">Agent Registeration</a></p>
	</fieldset>
	</form>
</body>
</html>
type;

  if(!isset($_GET['type']))
  {
	  echo $reg; 
  }
  else
  {
	  $type=$_GET['type'];
	  if($type=='agent' || $type=='customer')
	  echo $data;
	 else
	 {
		 sleep(5);
		header("Location:register.php?try=false");
		  exit();
	 }
  }
?>