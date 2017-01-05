<?php
require 'connect.php';
$arr=['Register','Remove','Update','View'];
echo '
<html>
<head>
<title>' . $arr[$_GET['control']-1] .
'</title>
</head>
<body>
<section>';
	if($_GET['control']==1)
{
	echo '<article>
		<header>
			<h1>Vehicle Registration Portal</h2>
			<p>... start your business with us</p>
		</header>
		<div>
			<form name="register" action="processRegister.php" method="post" enctype="multipart/form-data">
				<p><label for="name">Enter your Vehicle Name :</label><input type="text" name="name" id="name" maxlength="60"/></p>
				<p><label  for="type">Type :</label><select name="type" id="type"><option value="">Car catrgory</option>';
								$query='SELECT * from v_type where tid>0';
								$result=mysql_query($query,$db) or die(mysql_error($db));
	
								while($row=mysql_fetch_array($result))
								{
									extract($row);
									echo '<option value="'. $tid . '">'. $type . '</option>'; 
								}
				
				echo '</select></p>
				<p><label  for="age">Age :</label><input type="number" name="age" id="age" max="10" min="0"/></p>
				<p><label  for="reg">Registration Number :</label><input type="text" name="reg" id="reg" maxlength="11"/></p>
				<p><label  for="photo">photo :</label><input type="file" name="photo" id="photo"/></p>
				<p><label  for="fee">Hourly Rate :</label><input type="number" name="fee" id="fee" min="100" step="100"/></p>
				<p><input type="reset" name="Erase Entry"/>&nbsp;&nbsp;<input type="submit" value="Register" name="submit"/></p>
			</form>
		</div>
	</article>';
}
elseif($_GET['control']==2)
{
	echo '<form name="delete" action="agentProcess.php?response=2" method="post">
	<label for="num">Vehicle registration number</label>
	<input type="text" placeholder="Enter" name="num" id="num"/>
	<input type="submit" name="submit"/>
	</form>';
}
elseif($_GET['control']==3)
{
	echo '<form name="update" action="agentProcess.php?response=3&update=0" method="post"><label for="num">Vehicle registration number</label><input type="text" placeholder="Enter" name="num" id="num"/>
	<input type="submit" name="submit"/>
	</form>';
}
elseif($_GET['control']==4)
{
	echo 'welcome<br/>
		<html><head>
		<title>Agent | data | CaRental.com</title>
		</head>
		<body>
		<table border="1">
		<tr><th>Category</th><th>Number of Vehicle</th</tr>
		';
		$query='SELECT v_type.type,count(vehicle.regnum) as number from v_type LEFT JOIN vehicle
						ON v_type.tid=vehicle.type
						GROUP BY v_type.type';
		$result=mysql_query($query,$db) or die('Data Fetch Error');
								while($row=mysql_fetch_array($result))
								{
									extract($row);
										echo '<tr><td>' .$type. '</td><td>' .$number. '</td></tr>'; 
								}
		echo '
		</table>
		</body>
		</html>
		';
}
echo '</section>
</body>
</html>';
?>